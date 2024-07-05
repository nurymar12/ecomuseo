<link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">
<link rel="stylesheet" href="{{ asset('css/intranet/home.css') }}">

@extends('layouts.app_new')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Panel Principal') }}</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->hasRole('Volunteer'))
                        @forelse ($volunteers as $volunteer)
                            @if ($volunteer->user->id == auth()->user()->id)
                                <table class="table table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tarea</th>
                                            <th scope="col">Asignado</th>
                                            <th scope="col">Completado</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                @php
                                    $uniqueTasks = collect();
                                @endphp
                                @forelse ($volunteer->tasks as $task)
                                    @if ($task->volunteers->contains($volunteer->id) && $task->pivot->status != 'cancelled')
                                        <tr>
                                            <td>{{ ucfirst($task->type) }}</td>
                                            <td>{{ $task->pivot->assigned_date }}</td>
                                            <td>{{ $task->pivot->completed_date ? $task->pivot->completed_date : 'N/A' }}</td>
                                            <td>{{ ucfirst($task->pivot->status) }}</td>
                                            <td>
                                                @if ($task->pivot->status == 'pending')
                                                    <button type="button" class="btn btn-sm btn-success bi-check-lg complete-btn" data-id="{{ $task->id }}" data-toggle="tooltip" data-placement="top" title="Marcar como completada"></button>
                                                @endif
                                            </td>
                                        </tr>

                                        @if (!$uniqueTasks->contains($task->type) && $task->pivot->status == 'pending')
                                            @php
                                            $uniqueTasks->push($task->type);
                                            @endphp

                                            @switch($uniqueTasks->last())
                                            @case('blog')
                                                @canany(['create-blog', 'edit-blog', 'delete-blog'])
                                                    <a class="btn btn-primary" href="{{ route('blogs.index') }}">
                                                        <i class="bi bi-newspaper"></i> Gestionar Blogs</a>
                                                @endcanany
                                                @break
                                            @case('component')
                                                @canany(['create-component', 'edit-component', 'delete-component'])
                                                <a class="btn btn-warning" href="{{ route('components.index') }}">
                                                    <i class="bi bi-house-gear"></i> Gestionar Componentes</a>
                                                @endcanany
                                                @break
                                            @endswitch

                                        @endif

                                    @endif
                                @empty
                                    <p>Todas las tareas han sido completadas!</p>
                                @endforelse
                                    </tbody>
                                </table>
                            @else
                                <p>No hay tareas pendientes del usuario</p>
                            @endif
                        @empty
                            <p>No hay datos para mostrar</p>
                        @endforelse
                    @else
                        {{-- {{ __('You are logged in!') }} --}}
                        @canany(['create-user', 'edit-user', 'delete-user'])
                            <a class="btn btn-success btn-lg" href="{{ route('users.index') }}">
                                <i class="bi bi-people"></i> Gestionar usuarios</a>
                        @endcanany
                        @canany(['create-component', 'edit-component', 'delete-component'])
                            <a class="btn btn-warning btn-lg" href="{{ route('components.index') }}">
                                <i class="bi bi-house-gear"></i> Gestionar Componentes</a>
                        @endcanany
                        @canany(['create-tour', 'edit-tour', 'delete-tour'])
                            <a class="btn btn-secondary btn-lg" href="{{ route('tours.index') }}">
                                <i class="bi bi-bezier2"></i> Gestionar Tours</a>
                        @endcanany
                        @canany(['edit-visit', 'delete-visit'])
                            <a class="btn btn-info btn-lg" href="{{ route('visits.index') }}">
                                <i class="bi bi-calendar-week"></i> Gestionar Visitas</a>
                        @endcanany
                        <br/><br/>
                        @canany(['create-blog', 'edit-blog', 'delete-blog'])
                            <a class="btn btn-primary btn-lg" href="{{ route('blogs.index') }}">
                                <i class="bi bi-newspaper"></i> Gestionar Blogs</a>
                        @endcanany
                        @canany(['edit-donation', 'delete-donation'])
                            <a class="btn btn-success btn-lg" href="{{ route('donations.show') }}">
                                <i class="bi bi-coin"></i> Gestionar Donaciones</a>
                        @endcanany
                        @canany(['create-task', 'edit-task', 'delete-task'])
                            <a class="btn btn-warning btn-lg" href="{{ route('tasks.index') }}">
                                <i class="bi bi-journal"></i> Gestionar Tareas</a>
                        @endcanany
                        @canany(['create-volunteer', 'edit-volunteer', 'delete-volunteer'])
                            <a class="btn btn-danger btn-lg" href="{{ route('volunteers.show') }}">
                                <i class="bi bi-wrench"></i> Voluntarios</a>
                        @endcanany
                        @canany(['create-volunteer', 'edit-volunteer', 'delete-volunteer'])
                        <br/> <!-- usar para otro boton -->
                        @endcanany
                        <br/><br/>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.complete-btn').click(function(e) {
            e.preventDefault();
            var taskId = $(this).data('id');
            console.log(taskId);
            $.post('{{ url('/tasks') }}/' + taskId + '/complete', {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }, function(response) {
                window.location.reload();
            });
        });
    });
</script>
@endsection
