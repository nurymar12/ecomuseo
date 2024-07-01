@extends('layouts.app_new')
<link rel="stylesheet" href="{{ asset('css/blog.css') }}">

@section('content')
<div class="card">
    <div class="card-header">Tareas</div>
    <div class="card-body">
    <div>
        <table id="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Voluntario</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ ucfirst($task->type) }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->content }}</td>
                    <td>{{ $task->volunteers->first()->user->name }}</td>
                    <td>{{ ucfirst($task->volunteers->first()->pivot->status) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
