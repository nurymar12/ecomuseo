@extends('layouts.app_new')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">Editar Tour</div>
                <div class="float-end">
                    <a href="{{ route('tours.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('tours.update', $tour->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <!-- Campo para el nombre del tour -->
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre del Tour</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $tour->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Campo para la descripción del tour -->
                    <div class="mb-3 row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Descripción</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $tour->description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Campo para la fecha y hora de inicio del tour -->
                    <div class="mb-3 row">
                        <label for="start_date" class="col-md-4 col-form-label text-md-end text-start">Fecha y Hora de Inicio</label>
                        <div class="col-md-6">
                            <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d\TH:i', strtotime($tour->start_date))) }}">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Campo para la fecha y hora de fin del tour -->
                    <div class="mb-3 row">
                        <label for="end_date" class="col-md-4 col-form-label text-md-end text-start">Fecha y Hora de Fin</label>
                        <div class="col-md-6">
                            <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', date('Y-m-d\TH:i', strtotime($tour->end_date))) }}">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Campo para la capacidad máxima -->
                    <div class="mb-3 row">
                        <label for="max_people" class="col-md-4 col-form-label text-md-end text-start">Capacidad Máxima</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('max_people') is-invalid @enderror" id="max_people" name="max_people" value="{{ old('max_people', $tour->max_people) }}">
                            @error('max_people')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Campo para la información de contacto del tour -->
                    <div class="mb-3 row">
                        <label for="contact_info" class="col-md-4 col-form-label text-md-end text-start">Información de Contacto</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('contact_info') is-invalid @enderror" id="contact_info" name="contact_info" value="{{ old('contact_info', $tour->contact_info) }}" placeholder="Email, phone number, etc.">
                            @error('contact_info')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Lista de componentes para marcar -->
                    <div class="mb-3 row">
                        <label class="col-md-4 col-form-label text-md-end text-start">Componentes Involucrados</label>
                        <div class="col-md-6">
                            @foreach ($components as $component)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $component->id }}" id="component{{ $component->id }}" name="components[]" {{ in_array($component->id, $tour->components->pluck('id')->toArray()) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="component{{ $component->id }}">
                                        {{ $component->titleComponente }}
                                    </label>
                                </div>
                            @endforeach
                            @error('components')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Botón de envío -->
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar Tour">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
