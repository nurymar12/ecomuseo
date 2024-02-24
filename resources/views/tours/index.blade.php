@extends('layouts.app_new')

@section('content')
<div class="card">
    <div class="card-header">Tour List</div>
    <div class="card-body">
        @can('create-tour')
            <a href="{{ route('tours.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Tour</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">S#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope= "col">Tour start</th>
                <th scope= "col">Tour end</th>
                <th scope="col">Capacity</th>
                <th scope="col">Components</th> <!-- Nueva columna para componentes -->
                <th scope="col">Action</th>
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

                            <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                            @can('edit-tour')
                                <a href="{{ route('tours.edit', $tour->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan

                            @can('delete-tour')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tour?');"><i class="bi bi-trash"></i> Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="6">
                        <span class="text-danger">
                            <strong>No Tour Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $tours->links() }}

    </div>
</div>
@endsection
