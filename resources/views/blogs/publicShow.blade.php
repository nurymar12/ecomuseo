<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }} | Ecomuseo LLAQTA AMARU - YOYEN KUWA</title>
    <link rel="stylesheet" href="{{ asset('css/public_show_blog.css') }}">
</head>
<body>
    <!-- Header de la página -->
    @include('partials.header_new')

    <main class="blog-content-container">
        <h1 class="blog-title">{{ $blog->title }}</h1>
        <div class="blog-meta">
            <span>Autor: {{ $blog->author->name }}</span> |
            <span>Fecha: {{ $blog->created_at->toFormattedDateString() }}</span>
        </div>
        <div class="blog-content">
            {!! $blog->content !!}
        </div>
        @if($blog->components->isNotEmpty())
            <div class="blog-components">
                <h3>Componentes relacionados:</h3>
                <ul>
                    @foreach($blog->components as $component)
                        <li><a href="{{ url('/components/public/' . $component->id) }}" class="component-button">{{ $component->titleComponente }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif



    </main>

    @include('partials.footer')
</body>
</html>
