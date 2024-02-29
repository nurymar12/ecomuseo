@extends('layouts.app_new')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Visit Information
                </div>
                <div class="float-end">
                    <a href="{{ route('visits.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>User:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $visit->user->name }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Tour:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $visit->tour->name }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Number of People:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $visit->number_of_people }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Additional Info:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $visit->additional_info ?? 'N/A' }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Status:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ ucfirst($visit->status) }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Requested Date:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $visit->requested_date }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Approved Date:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $visit->approved_date ? $visit->approved_date : 'N/A' }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
