<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/component_detail.css') }}">
        <script src="{{ asset('js/welcome.js') }}"></script>
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        {{-- <title>ECOMUSEO</title> --}}

        <title>Ecomuseo LLAQTA AMARU -YOYEN KUWA</title>

    </head>
<body>
    <header>
        @include('partials.header_new')
    </header>

    <main>
        <!-- Presentación del componente como una noticia -->
        <article class="component-detail">
            <header style="text-align: center;">
                <img src="{{ asset($component->rutaImagenComponente) }}" alt="Imagen de {{ $component->titleComponente }}" style="max-width: 100%; height: auto;">
                <h1>{{ $component->titleComponente }}</h1>
            </header>
            <section style="font-style: italic; padding: 1em 0;">
                {{ $component->description }}
            </section>
            <section style="padding: 1em;">
                {!! $component->contentComponente !!}
            </section>
        </article>
    </main>

</body>



<!-- Aquí puedes reutilizar el mismo footer que la página de bienvenida -->
@include('partials.footer')


</html>

