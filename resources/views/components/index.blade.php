@extends('layouts.app_new')

@section('content')
<div class="card">
    <div class="card-header">Component List</div>
    <div class="card-body">
        @can('create-component')
            <a href="{{ route('components.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Component</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">S#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Contenido</th>
                <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($components as $component)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $component->titleComponente }}</td>
                    <td>{{ $component->description }}</td>
                    <td>{{ $component->contentComponente }}</td>
                    <td>
                        <img src="{{ asset($component->rutaImagenComponente) }}" width="100" height="100" alt="Component Image">
                    </td>
                    <td>
                        <form action="{{ route('components.destroy', $component->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('components.show', $component->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                            @can('edit-component')
                                <a href="{{ route('components.edit', $component->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan

                            @can('delete-component')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this component?');"><i class="bi bi-trash"></i> Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>No Component Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $components->links() }}

    </div>
</div>
@endsection
