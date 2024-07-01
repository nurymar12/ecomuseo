<link rel="stylesheet" href="{{ asset('css/visits.css') }}">

@extends('layouts.app_new')

@section('content')
<div class="card">
    <div class="card-header">Lista de Voluntarios</div>
    <div class="card-body">

        <table class="table table-striped table-bordered table-responsive">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Estado</th>
                <th scope="col">Nombre</th>
                <th scope="col">DNI</th>
                <th scope="col">Email</th>
                <th scope="col">Fono</th>
                <th scope="col">Fecha Nacimiento</th>
                <th scope="col">CV</th>
                <th scope="col">Info</th>
                {{-- <th scope="col">Fecha Registro</th>
                <th scope="col">Fecha Aprobación</th>
                <th scope="col">Fecha Inactivo</th> --}}
                {{-- <th scope="col">Acciones</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($volunteers as $volunteer)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ ucfirst($volunteer->status) }}</td>
                    <td>{{ $volunteer->user->name }}</td>
                    <td>{{ $volunteer->user->dni }}</td>
                    <td>{{ $volunteer->user->email }}</td>
                    <td>{{ $volunteer->user->phone }}</td>
                    <td>{{ \Carbon\Carbon::parse($volunteer->user->birthdate)->format('d/m/Y') }}</td>
                    <td><a href="{{ asset('storage/'.$volunteer->cv_path) }}" download class="btn btn-sm btn-secondary"><i class="bi bi-download"></i></a></td>
                    <td>{{ $volunteer->additional_info }}</td>
                    {{-- <td>{{ $volunteer->requested_date }}</td>
                    <td>{{ $volunteer->approved_date ? $volunteer->approved_date : 'N/A' }}</td>
                    <td>{{ $volunteer->inactive_date ? $volunteer->inactive_date : 'N/A' }}</td> --}}
                    {{-- <td>
                        <!-- Botón para aprobar -->
                        <button type="button" class="btn btn-sm btn-success bi-check-lg approve-btn" data-id="{{ $volunteer->id }}" data-toggle="tooltip" data-placement="top" title="Aprobar"></button>
                        <!-- Botón para declinar -->
                        <button type="button" class="btn btn-sm btn-danger bi-x-lg decline-btn" data-id="{{ $volunteer->id }}" data-toggle="tooltip" data-placement="top" title="Rechazar"></button>
                        <form action="{{ route('volunteers.destroy', $volunteer->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            @can('delete-volunteer')
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Inactivar" onclick="return confirm('Dar de baja al Voluntario?');"><i class="bi bi-trash"></i></button>
                            @endcan
                        </form>
                    </td> --}}
                </tr>
                @empty
                    <td colspan="6">
                        <span class="text-danger">
                            <strong>No Volunteers Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>
        {{ $volunteers->links() }}
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.approve-btn').click(function(e) {
            e.preventDefault();
            var volunteerId = $(this).data('id');
            $.post('{{ url('/volunteers') }}/' + volunteerId + '/approve', {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }, function(response) {
                window.location.reload();
            });
        });

        $('.decline-btn').click(function(e) {
            e.preventDefault();
            var volunteerId = $(this).data('id');
            $.post('{{ url('/volunteers') }}/' + volunteerId + '/decline', {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }, function(response) {
                window.location.reload();
            });
        });
    });
</script>
