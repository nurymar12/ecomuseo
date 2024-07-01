@extends('layouts.app_new')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Información de la Visita
                </div>
                <div class="float-end">
                    <a href="{{ route('visits.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Usuario:</strong></label>
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
                    <label class="col-md-4 col-form-label text-md-end"><strong>Número de Personas:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $visit->number_of_people }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Información Adicional:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $visit->additional_info ?? 'N/A' }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Estado:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ ucfirst($visit->status) }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Fecha de Solicitud:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $visit->requested_date }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end"><strong>Fecha de Aprobación:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $visit->approved_date ? $visit->approved_date : 'N/A' }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
