@extends('layouts.app_new')
<link rel="stylesheet" href="{{ asset('css/visits.css') }}">
<!-- Daterangepicker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- Vista show donations -->
@section('content')
<div class="card">
    <div class="card-header">Lista de Donaciones</div>
    <div class="card-body">
        @can('create-tour')
            {{-- boton --}}
        @endcan
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
                    <th scope= "col">Razón Social</th>
                    <th scope= "col">Contacto</th>
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
                            <button type="button" class="btn btn-sm btn-success bi-check-lg approve-btn" data-id="{{ $donation->id }}" data-toggle="tooltip" data-placement="top" title="Aprobar"></button>
                            <!-- Botón para declinar -->
                            <button type="button" class="btn btn-sm btn-danger bi-x-lg decline-btn" data-id="{{ $donation->id }}" data-toggle="tooltip" data-placement="top" title="Rechazar"></button>
                        </td>
                    </tr>
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
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
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
</script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
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
            //console.log(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
            //var startdate = $('#start_date').val();
            //console.log(startdate);
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
</script>
<!-- approve decline buttons -->
<script>
    $(document).ready(function() {
        $('.approve-btn').click(function(e) {
            e.preventDefault();
            var donationId = $(this).data('id');
            $.post('{{ url('/donations') }}/' + donationId + '/approve', {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }, function(response) {
                window.location.reload();
            });
        });

        $('.decline-btn').click(function(e) {
            e.preventDefault();
            var donationId = $(this).data('id');
            $.post('{{ url('/donations') }}/' + donationId + '/decline', {
                _token: $('meta[name="csrf-token)').attr('content'),
            }, function(response) {
                window.location.reload();
            });
        });
    });
</script>
