@extends('layouts.app_new')

@section('content')
<div class="card">
    <div class="card-header">Lista de Tours</div>
    <div class="card-body">
        @can('create-tour')
            <a href="{{ route('tours.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Añadir Nuevo Tour</a>
        @endcan
        @canany(['edit-visit', 'delete-visit'])
            <a class="btn btn-info btn-sm my-2" href="{{ route('visits.index') }}">
                <i class="bi bi-calendar-week"></i> Solicitudes de Tour</a>
        @endcanany
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Descripción</th>
                <th scope= "col">Inicio del Tour</th>
                <th scope= "col">Fin del Tour</th>
                <th scope="col">Capacidad</th>
                <th scope="col">Componentes Involucrados</th> <!-- Nueva columna para componentes -->
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tours as $tour)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $tour->name }}</td>
                    <td>{{ $tour->description }}</td>
                    <td>{{ $tour->start_date }}</td>
                    <td>{{ $tour->end_date }}</td>
                    <td>{{ $tour->max_people }}</td>
                    <td>
                        @foreach ($tour->components as $component)
                            <span class="badge bg-secondary">{{ $component->titleComponente }}</span>
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('tours.destroy', $tour->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Mostrar</a>

                            @can('edit-tour')
                                <a href="{{ route('tours.edit', $tour->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>
                            @endcan

                            @can('delete-tour')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tour?');"><i class="bi bi-trash"></i> Eliminar</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="6">
                        <span class="text-danger">
                            <strong>Tour no encontrado!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $tours->links() }}

    </div>
</div>
@endsection
