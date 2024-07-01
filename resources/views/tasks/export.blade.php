@extends('layouts.pdf_layout')
@section('content')
<h4>
    Reporte de tareas asignadas a voluntarios -
    del {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}
    al {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
</h4>
<table style="width: 100%; border-collapse: collapse; font-size: 12px;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tipo</th>
            <th scope="col">Título</th>
            <th scope="col">Contenido</th>
            <th scope="col">Estado</th>
            <th scope="col">Asignado</th>
            <th scope="col">Completado</th>
            <th scope="col">Voluntario</th>
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
                    <td>{{ $task->volunteers->first()->pivot->completed_date ? \Carbon\Carbon::parse($task->volunteers->first()->pivot->completed_date)->format('d/m/Y') : 'No' }}</td>
                    <td>{{ $task->volunteers->first()->user->name }}</td>
                @else
                    <td>No asignado</td>
                    <td>No asignado</td>
                    <td>No asignado</td>
                    <td>No asignado</td>
                @endif
            </tr>
        @empty
            <tr><td colspan="9"><strong>No hay datos</strong></td></tr>
        @endforelse
    </tbody>
</table>
@endsection
