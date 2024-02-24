@extends('layouts.app_new')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Tour Information</div>
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Name:</strong></label>
                    <div class="col-md-6">{{ $tour->name }}</div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Description:</strong></label>
                    <div class="col-md-6">{{ $tour->description }}</div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Start Date and Time:</strong></label>
                    <div class="col-md-6">{{ $tour->start_date }}</div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-end"><strong>End Date and Time:</strong></label>
                    <div class="col-md-6">{{ $tour->end_date }}</div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Max People:</strong></label>
                    <div class="col-md-6">{{ $tour->max_people }}</div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Contact Info:</strong></label>
                    <div class="col-md-6">{{ $tour->contact_info }}</div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Components:</strong></label>
                    <div class="col-md-6">
                        @forelse ($tour->components as $component)
                            <span class="badge bg-secondary">{{ $component->titleComponente }}</span>
                        @empty
                            <p>No components associated.</p>
                        @endforelse
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-8 offset-md-4">
                        <a href="{{ route('tours.index') }}" class="btn btn-primary">&larr; Back to Tours</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
