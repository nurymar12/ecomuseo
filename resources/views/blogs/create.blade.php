@extends('layouts.app_new')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Add New Blog</div>
            <div class="card-body">
                <form action="{{ route('blogs.store') }}" method="post">
                    @csrf

                    <!-- Campo para el título del blog -->
                    <div class="mb-3 row">
                        <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Campo para el contenido del blog (Markdown) -->
                    <div class="mb-3 row">
                        <label for="content" class="col-md-4 col-form-label text-md-end">Content</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Integración del editor Markdown -->
                    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
                    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
                    <script>
                        new EasyMDE({ element: document.getElementById('content') });
                    </script>

                    <!-- Lista de componentes para marcar -->
                    <div class="mb-3 row">
                        <label class="col-md-4 col-form-label text-md-end text-start">Components</label>
                        <div class="col-md-6">
                            @foreach ($components as $component)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $component->id }}" id="component{{ $component->id }}" name="components[]">
                                    <label class="form-check-label" for="component{{ $component->id }}">
                                        {{ $component->titleComponente }}
                                    </label>
                                </div>
                            @endforeach
                            @error('components')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <!-- Selector de estado -->
                    <div class="mb-3 row">
                        <label for="status" class="col-md-4 col-form-label text-md-end">Status</label>
                        <div class="col-md-6">
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}


                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Blog">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Integración del editor Markdown -->
<link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
<script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
<script>
    new EasyMDE({ element: document.getElementById('content') });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new EasyMDE({element: document.getElementById('content')});
    });
</script>
@endsection
