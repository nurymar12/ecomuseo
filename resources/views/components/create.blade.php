@extends('layouts.app_new')

@section('content')

<!-- Font Awesome CSS (Puede que necesites ajustar la versión o el enlace del CDN) -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

<!-- EasyMDE CSS -->
<link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">


<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add New Component
                </div>
                <div class="float-end">
                    <a href="{{ route('components.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('components.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Title Input -->
                    <div class="mb-3 row">
                        <label for="titleComponente" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('titleComponente') is-invalid @enderror" id="titleComponente" name="titleComponente" value="{{ old('titleComponente') }}">
                            @error('titleComponente')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3 row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Content Input -->
                    <div class="mb-3 row">
                        <label for="contentComponente" class="col-md-4 col-form-label text-md-end text-start">Content</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('contentComponente') is-invalid @enderror" id="contentComponente" name="contentComponente">{{ old('contentComponente') }}</textarea>
                            @error('contentComponente')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Input -->
                    <div class="mb-3 row">
                        <label for="rutaImagenComponente" class="col-md-4 col-form-label text-md-end text-start">Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control @error('rutaImagenComponente') is-invalid @enderror" id="rutaImagenComponente" name="rutaImagenComponente" accept="image/*">
                            @error('rutaImagenComponente')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Component">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- EasyMDE JS -->
<script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var easyMDE = new EasyMDE({
        element: document.getElementById('contentComponente'),
        autoDownloadFontAwesome: true,
        showPreview: true, // Automatically show preview of Markdown
        sideBySideFullscreen: false, // Disable side-by-side fullscreen mode
        minHeight: '400px', // Adjust the minimum height of the editor
        parsingConfig: {
            allowAtxHeaderWithoutSpace: true,
            strikethrough: false,
            underscoresBreakWords: true,
        },
        previewRender: function(plainText, preview) { // Async method
            setTimeout(function(){
                preview.innerHTML = this.parent.markdown(plainText);
            }.bind(this), 250);

            return "";
        },
        // Other configurations you might want to add
    });
});
</script>

@endsection
