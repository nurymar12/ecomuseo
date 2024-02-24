@extends('layouts.app_new')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Component
                </div>
                <div class="float-end">
                    <a href="{{ route('components.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('components.update', $component->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <!-- Title Input -->
                    <div class="mb-3 row">
                        <label for="titleComponente" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('titleComponente') is-invalid @enderror" id="titleComponente" name="titleComponente" value="{{ $component->titleComponente }}">
                            @error('titleComponente')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3 row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $component->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Content Input -->
                    <div class="mb-3 row">
                        <label for="contentComponente" class="col-md-4 col-form-label text-md-end text-start">Content</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('contentComponente') is-invalid @enderror" id="contentComponente" name="contentComponente">{{ $component->contentComponente }}</textarea>
                            @error('contentComponente')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Input -->
                    <div class="mb-3 row">
                        <label for="rutaImagenComponente" class="col-md-4 col-form-label text-md-end text-start">Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control @error('rutaImagenComponente') is-invalid @enderror" id="rutaImagenComponente" name="rutaImagenComponente">
                            <small>Current Image: {{ $component->rutaImagenComponente }}</small>
                            @error('rutaImagenComponente')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
