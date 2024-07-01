<link rel="stylesheet" href="{{ asset('css/visits.css') }}">

@extends('layouts.app_new')

@section('content')

<div class="card">
    <div class="card-header">Lista de Visitas</div>
    <div class="card-body">
        <table id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Tour</th>
                    <th scope="col">Número de Personas</th>
                    <th scope="col">Información Adicional</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha de Solicitud</th>
                    <th scope="col">Fecha de Aprobación</th>
                    <th scope="col" style="width: 250px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($visits as $visit)
                <tr class="{{ $visit->status }}" >
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $visit->user->name }}</td>
                    <td>{{ $visit->tour->name }}</td>
                    <td>{{ $visit->number_of_people }}</td>
                    <td>{{ $visit->additional_info }}</td>
                    <td >{{ ucfirst($visit->status) }}</td>
                    <td>{{ $visit->requested_date }}</td>
                    <td>{{ $visit->approved_date ? $visit->approved_date : 'N/A' }}</td>
                    <td>
                        <!-- Botón para aprobar -->
                        <button type="button" class="btn btn-success bi-check-lg approve-btn" data-id="{{ $visit->id }}"></button>
                        <!-- Botón para declinar -->
                        <button type="button" class="btn btn-danger bi-x-lg decline-btn" data-id="{{ $visit->id }}"></button>
                        {{-- <form action="{{ route('visits.destroy', $visit->id) }}" method="post"> --}}

                            <a href="{{ route('visits.show', $visit->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                            <!-- @can('edit-visit')
                            <a href="{{ route('visits.edit', $visit->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan -->
{{--
                            @can('delete-tour')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tour?');"><i class="bi bi-trash"></i> Delete</button>
                            @endcan
                        </form> --}}


                    </td>
                </tr>
                @empty
                    <td colspan="8">
                        <span class="text-danger">
                            <strong>No se encuentran visitas</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $visits->links() }}

    </div>
</div>
@endsection

{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.approve-btn').click(function(e) {
            e.preventDefault();
            var visitId = $(this).data('id');
            $.post('{{ url('/visits') }}/' + visitId + '/approve', {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }, function(response) {
                window.location.reload();
            });
        });

        $('.decline-btn').click(function(e) {
            e.preventDefault();
            var visitId = $(this).data('id');
            $.post('{{ url('/visits') }}/' + visitId + '/decline', {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }, function(response) {
                window.location.reload();
            });
        });
    });
</script>

