@extends('layouts.app_new')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Blog Details
                </div>
                <div class="float-end">
                    <a href="{{ route('blogs.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Title:</strong></label>
                    <div class="col-md-6">
                        <p>{{ $blog->title }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Author:</strong></label>
                    <div class="col-md-6">
                        <p>{{ $blog->author->name }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Content:</strong></label>
                    <div class="col-md-6">
                        {!! Illuminate\Support\Str::markdown($blog->content) !!}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Components:</strong></label>
                    <div class="col-md-6">
                        @foreach ($blog->components as $component)
                            <span class="badge bg-secondary">{{ $component->titleComponente }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Status:</strong></label>
                    <div class="col-md-6">
                        <p>{{ ucfirst($blog->status) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
