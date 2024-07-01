@extends('layouts.app_new')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Visit
                </div>
                <div class="float-end">
                    <a href="{{ route('visits.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('visits.update', $visit->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <!-- Mostrar el nombre del tour como texto plano -->
                    <div class="mb-3 row">
                        <label class="col-md-4 col-form-label text-md-end text-start"><strong>Nombre del Tour:</strong></label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $visit->tour->name }}</p>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="number_of_people" class="col-md-4 col-form-label text-md-end text-start">Capacidad Máxima</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('number_of_people') is-invalid @enderror" id="number_of_people" name="number_of_people" value="{{ $visit->number_of_people }}">
                            @error('number_of_people')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="additional_info" class="col-md-4 col-form-label text-md-end text-start">Información Adicional</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('additional_info') is-invalid @enderror" id="additional_info" name="additional_info">{{ $visit->additional_info }}</textarea>
                            @error('additional_info')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="status" class="col-md-4 col-form-label text-md-end text-start">Estado</label>
                        <div class="col-md-6">
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"> <option value="pending" {{ $visit->status == 'pending' ? 'selected' : '' }}>Pediente</option> <option value="approved" {{ $visit->status == 'approved' ? 'selected' : '' }}>Aprobado</option> <option value="rejected" {{ $visit->status == 'rejected' ? 'selected' : '' }}>Rechazado</option> </select> @error('status') <span class="text-danger">{{ $message }}</span> @enderror </div> </div>
                                            <div class="mb-3 row">
                    <label for="requested_date" class="col-md-4 col-form-label text-md-end text-start">Fecha de Solicitud</label>
                    <div class="col-md-6">
                        <input type="date" class="form-control @error('requested_date') is-invalid @enderror" id="requested_date" name="requested_date" value="{{ $visit->requested_date }}">
                        @error('requested_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Mostrar la fecha de aprobación como texto plano si existe -->
                @if($visit->approved_date)
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Fecha Aprobada:</strong></label>
                    <div class="col-md-6">
                        <p class="form-control-plaintext">{{ $visit->approved_date}}</p>
                    </div>
                </div>
                @endif

                <div class="mb-3 row">
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar">
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
