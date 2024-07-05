@extends('layouts.app_new')
<link rel="stylesheet" href="{{ asset('css/visits.css') }}">
<!-- Daterangepicker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="donations-tab" data-toggle="tab" href="#donations" role="tab" aria-controls="donations" aria-selected="true">Lista de Donaciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="chart-tab" data-toggle="tab" href="#chart" role="tab" aria-controls="chart" aria-selected="false">Gráfica de donaciones</a>
            </li>
        </ul>
    </div>
    <div class="card-body tab-content">
        <div class="tab-pane fade show active" id="donations" role="tabpanel" aria-labelledby="donations-tab">
            <div>
                <div style="display: flex; justify-content:end;">
                    @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Super Admin'))
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 10px 10px; border: 1px solid #ccc; width: 20%; text-align: center;">
                        <i class="bi bi-calendar"></i>&nbsp;
                        <span></span> <i class="bi bi-caret-down"></i>
                    </div>
                    <div style="padding: 0px 10px;">
                        <form action="{{ route('donations.export') }}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="start_date" id="start_date">
                            <input type="hidden" name="end_date" id="end_date">
                            <button type="submit" class="btn btn-secondary"><i class="bi bi-download"></i> Reporte</button>
                        </form>
                    </div>
                    @endif
                </div>
                <br />
                <table id="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha Solicitud</th>
                            <th scope="col">Fecha Aprobación</th>
                            <th scope="col">Razón Social</th>
                            <th scope="col">Contacto</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Email</th>
                            <th scope="col">Info</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($donations as $donation)
                        <tr class="{{ $donation->status }}">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $donation->type }}</td>
                            <td>{{ ucfirst($donation->status) }}</td>
                            <td>{{ $donation->requested_date }}</td>
                            <td>{{ $donation->approved_date ? $donation->approved_date : 'N/A' }}</td>
                            <td>{{ $donation->razon_social }}</td>
                            <td>{{ $donation->persona_contacto }}</td>
                            <td>{{ $donation->celular_contacto }}</td>
                            <td>{{ $donation->email_contacto }}</td>
                            <td>{{ $donation->additional_info }}</td>
                            <td>{{ $donation->type == 'dinero' ? $donation->monto : 'N/A' }}</td>
                            <td>
                                <!-- Botón para aprobar -->
                                <button type="button" class="btn btn-sm btn-success bi-check-lg approve-btn" data-id="{{ $donation->id }}" data-type="{{ $donation->type }}" data-monto="{{ $donation->monto }}" data-toggle="modal" data-target="#approveModal{{ $donation->id }}" title="Aprobar"></button>
                                <!-- Botón para declinar -->
                                <button type="button" class="btn btn-sm btn-danger bi-x-lg decline-btn" data-id="{{ $donation->id }}" data-toggle="tooltip" data-placement="top" title="Rechazar"></button>
                            </td>
                        </tr>

                        <!-- Modal para aprobar -->
                        <div class="modal fade" id="approveModal{{ $donation->id }}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel{{ $donation->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="approveModalLabel{{ $donation->id }}">Aprobar Donación</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('donations.approve', $donation->id) }}">
                                        @csrf
                                        <div class="modal-body">
                                            @if ($donation->type === 'dinero')
                                                <div id="amount-warning" class="text-danger"></div>
                                                @foreach ($components as $component)
                                                    <div class="form-group">
                                                        <label for="component{{ $component->id }}">{{ $component->titleComponente }}</label>
                                                        <input type="number" class="form-control component-amount" name="components[{{ $component->id }}][amount]" id="component{{ $component->id }}" placeholder="Monto a asignar" step="0.01">
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>Esta donación será aprobada sin asignación de montos.</p>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Aprobar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                            <td colspan="11">
                                <span class="text-danger">
                                    <strong>No Donations Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                </table>
                {{ $donations->links() }}
            </div>
        </div>
        <div class="tab-pane fade" id="chart" role="tabpanel" aria-labelledby="chart-tab">
            <canvas id="donationsChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<!-- Daterangepicker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(function() {
        var start = moment().subtract(6, 'days');
        var end = moment();
        function cb(start, end) {
            $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
        }
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            alwaysShowCalendars: true,
            locale: {
                format: 'DD/MM/YYYY',
                separator: ' - ',
                applyLabel: 'Aplicar',
                cancelLabel: 'Cancelar',
                weekLabel: 'S',
                daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                firstDay: 1,
                customRangeLabel: 'Personalizado',
                showCustomRangeLabel: true,
                showWeekNumbers: true,
            },
            ranges: {
               'Hoy': [moment(), moment()],
               'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
               'Últimos 15 días': [moment().subtract(14, 'days'), moment()],
               'Este mes': [moment().startOf('month'), moment().endOf('month')],
               'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
               'Este año': [moment().startOf('year'), moment().endOf('year')],
               'Año pasado': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
            }
        }, cb);

        cb(start, end);
    });

    // Verifica si hay mensajes de error o éxito en la sesión
    window.onload = function() {
        var error = "{{ session('error') }}";
        var success = "{{ session('success') }}";

        if (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error,
            });
        } else if (success) {
            Swal.fire({
                icon: 'success',
                title: 'Hecho',
                text: success,
            });
        }
    }

    $(document).ready(function() {
        $('.approve-btn').click(function(e) {
            e.preventDefault();
            var donationId = $(this).data('id');
            var donationType = $(this).data('type');
            var donationMonto = $(this).data('monto');

            if (donationType === 'dinero') {
                $('#approveModal' + donationId).modal('show');
                $('.component-amount').on('input', function() {
                    var totalAssigned = 0;
                    $('.component-amount').each(function() {
                        totalAssigned += parseFloat($(this).val()) || 0;
                    });

                    if (totalAssigned > donationMonto) {
                        $('#amount-warning').text('La suma de los montos asignados no puede superar el monto total de la donación.');
                    } else {
                        $('#amount-warning').text('');
                    }
                });
            } else {
                $.post('{{ url('/donations') }}/' + donationId + '/approve', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                }, function(response) {
                    window.location.reload();
                });
            }
        });

        $('.decline-btn').click(function(e) {
            e.preventDefault();
            var donationId = $(this).data('id');
            $.post('{{ url('/donations') }}/' + donationId + '/decline', {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }, function(response) {
                window.location.reload();
            });
        });

        var ctx = document.getElementById('donationsChart').getContext('2d');
        var donationsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($componentLabels) !!},
                datasets: [{
                    label: 'Distribución de Donaciones',
                    data: {!! json_encode($componentData) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Distribución de Donaciones'
                    }
                }
            }
        });
    });
</script>
@endsection
