@php
use League\CommonMark\CommonMarkConverter;

$converter = new CommonMarkConverter([
    'allow_unsafe_links' => false,
]);

$convertedContent = $converter->convertToHtml($component->contentComponente);
@endphp
<style>
    .content-box {
        border: 1px solid #000; /* Añade un borde negro */
        padding: 15px; /* Añade un poco de espacio interior */
        margin-bottom: 20px; /* Añade espacio debajo del cuadro */
        background-color: #fff; /* Fondo blanco para el contenido */
        color: #333; /* Texto oscuro para mejor legibilidad */
    }
</style>
@extends('layouts.app_new')

@section('content')


<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Component Information
                </div>
                <div class="float-end">
                    <a href="{{ route('components.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <label for="titleComponente" class="col-md-4 col-form-label text-md-end text-start"><strong>Title:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $component->titleComponente }}
                    </div>
                </div>

                <div class="row">
                    <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Description:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $component->description }}
                    </div>
                </div>

                <div class="row">
                    <label for="contentComponente" class="col-md-4 col-form-label text-md-end text-start"><strong>Content:</strong></label>
                    <div class="col-md-6">
                        <div class="content-box" style="line-height: 35px;">
                            {!! $convertedContent !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label for="rutaImagenComponente" class="col-md-4 col-form-label text-md-end text-start"><strong>Image:</strong></label>
                    <div class="col-md-6">
                        <img src="{{ asset($component->rutaImagenComponente) }}" style="max-width: 100%; max-height: 200px;" alt="Component Image">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
