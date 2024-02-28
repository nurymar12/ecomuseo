<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">
        <link rel="stylesheet" href="{{ asset('css/tour.css') }}">
        <script src="{{ asset('js/welcome.js') }}"></script>
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <title>Ecomuseo LLAQTA AMARU -YOYEN KUWA</title>

    </head>
    <body>
        <header>
            @include('partials.header_new')
        </header>

        <!-- Sección de tours -->
        <section class="tours" id="tours">
            <h1 class="titulo"><span>Nuestros Tours</span></h1>
            <div class="box-container">
                @foreach ($tours as $tour)
                <div class="box">
                    <div class="image-section">
                        @if ($tour->randomImage)
                            <img src="{{ asset($tour->randomImage) }}" alt="Tour image">
                        @else
                            <!-- Mostrar una imagen por defecto si no hay una imagen aleatoria -->
                            <img src="{{ asset('path/to/default-image.jpg') }}" alt="Default image">
                        @endif
                    </div>
                    <div class="info-section">
                        <h3>{{ $tour->name }}</h3>
                        <div class="tour-details">
                            <span><strong>Fecha:</strong> {{ $tour->start_date }} - {{ $tour->end_date }}</span>
                            <span><strong>Capacidad:</strong> {{ $tour->max_people }}</span>
                        </div>
                        <div class="tour-components">
                            <strong>Componentes:</strong>
                            <ul>
                                @foreach ($tour->components as $component)
                                    <li>{{ $component->titleComponente }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <footer>
            @include('partials.footer')
        </footer>
    </body>
</html>
