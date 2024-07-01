@extends('layouts.app_new')
<link rel="stylesheet" href="{{ asset('css/blog.css') }}">
<!-- Daterangepicker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- Vista index de tasks -->
@section('content')
<div class="card">
    <div class="card-header">Lista de Tareas</div>
    <div class="card-body">
        @can('create-task')
            <a href="{{ route('tasks.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Añadir Nueva Tarea</a>
        @endcan
    <div>
        <div style="display: flex; justify-content:end;">
            @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Super Admin'))
            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 10px 10px; border: 1px solid #ccc; width: 20%; text-align: center;">
                <i class="bi bi-calendar"></i>&nbsp;
                <span></span> <i class="bi bi-caret-down"></i>
            </div>
            <div style="padding: 0px 10px;">
                <form action="{{ route('tasks.export') }}" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="start_date" id="start_date">
                    <input type="hidden" name="end_date" id="end_date">
                    <button type="submit" class="btn btn-secondary"><i class="bi bi-download"></i> Generar Reporte</button>
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
                    <th scope="col">Título</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Asignado el</th>
                    <th scope="col">Completado el</th>
                    <th scope="col">Voluntario</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ ucfirst($task->type) }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->content }}</td>
                    @if ($task->volunteers->isNotEmpty() && $task->volunteers->first()->pivot)
                        <td>{{ ucfirst($task->volunteers->first()->pivot->status) }}</td>
                        <td>{{ \Carbon\Carbon::parse($task->volunteers->first()->pivot->assigned_date)->format('d/m/Y') }}</td>
                        <td>{{ $task->volunteers->first()->pivot->completed_date ? \Carbon\Carbon::parse($task->volunteers->first()->pivot->completed_date)->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ $task->volunteers->first()->user->name }}</td>
                    @else
                        <td>No asignado</td>
                        <td>No asignado</td>
                        <td>No asignado</td>
                        <td>No asignado</td>
                    @endif
                    <td>
                        {{-- <!-- Botón para activar -->
                        <button type="button" class="btn btn-success bi-check-lg approve-btn" data-id="{{ $task->id }}"></button>
                        <!-- Botón para desactivar -->
                        <button type="button" class="btn btn-danger bi-x-lg decline-btn" data-id="{{ $task->id }}"></button> --}}
                        @can('edit-task')
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm"> Editar</a>
                            <!-- <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Mostrar</a> -->
                        @endcan
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            @can('delete-task')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Cancelar tarea?');"> Cancelar</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                <td colspan="9">
                    <span class="text-danger">
                        <strong>No se encontraron tareas!</strong>
                    </span>
                </td>
                @endforelse
            </tbody>
        </table>
        {{ $tasks->links() }}
    </div>
</div>
@endsection
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
            //maxDate: [moment(), 'inclusive'],
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

{{-- <script>
    $(document).ready(function() {
        $('.approve-btn').click(function(e) {
            e.preventDefault();
            var taskId = $(this).data('id');
            $.post('{{ url('/tasks') }}/' + taskId + '/approve', {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }, function(response) {
                window.location.reload();
            });
        });

        $('.decline-btn').click(function(e) {
            e.preventDefault();
            var taskId = $(this).data('id');
            $.post('{{ url('/tasks') }}/' + taskId + '/decline', {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }, function(response) {
                window.location.reload();
            });
        });
    });
</script> --}}


