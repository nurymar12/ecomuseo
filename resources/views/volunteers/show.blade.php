<link rel="stylesheet" href="{{ asset('css/volunteer.css') }}">

@extends('layouts.app_new')

@section('content')
<div class="card">
    <div class="card-header">Lista de Voluntarios</div>
    <div class="card-body">

        <table id="table">
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
                    <th scope="col" style="width: 250px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($volunteers as $volunteer)
                <tr class="{{ $volunteer->status }}">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ ucfirst($volunteer->status) }}</td>
                    <td>{{ $volunteer->user->name }}</td>
                    <td>{{ $volunteer->user->dni }}</td>
                    <td>{{ $volunteer->user->email }}</td>
                    <td>{{ $volunteer->user->phone }}</td>
                    <td>{{ \Carbon\Carbon::parse($volunteer->user->birthdate)->format('d/m/Y') }}</td>
                    <td><a href="{{ asset('storage/'.$volunteer->cv_path) }}" download class="btn btn-sm btn-secondary"><i class="bi bi-download"></i></a></td>
                    <td>{{ $volunteer->additional_info }}</td>
                    <td>
                        @if ($volunteer->status == 'pending')
                            <button type="button" class="btn btn-sm btn-success bi-check-lg approve-btn" data-id="{{ $volunteer->id }}" data-toggle="tooltip" data-placement="top" title="Aprobar"></button>
                            <button type="button" class="btn btn-sm btn-danger bi-x-lg decline-btn" data-id="{{ $volunteer->id }}" data-toggle="tooltip" data-placement="top" title="Rechazar"></button>
                        @endif
                        @if ($volunteer->status == 'active')
                            <button type="button" class="btn btn-sm btn-danger bi-x-lg decline-btn" data-id="{{ $volunteer->id }}" data-toggle="tooltip" data-placement="top" title="Rechazar"></button>
                        @endif
                        @if ($volunteer->status == 'inactive')
                        <button type="button" class="btn btn-sm btn-success bi-check-lg approve-btn" data-id="{{ $volunteer->id }}" data-toggle="tooltip" data-placement="top" title="Aprobar"></button>
                        @endif
                    </td>
                </tr>
                @empty
                    <td colspan="10">
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
            }).fail(function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al aprobar el voluntario.',
                });
            });
        });

        $('.decline-btn').click(function(e) {
            e.preventDefault();
            var volunteerId = $(this).data('id');
            $.post('{{ url('/volunteers') }}/' + volunteerId + '/decline', {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }, function(response) {
                window.location.reload();
            }).fail(function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al rechazar el voluntario.',
                });
            });
        });
    });
</script>
