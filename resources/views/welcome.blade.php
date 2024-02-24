<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <script src="{{ asset('js/welcome.js') }}"></script>
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        {{-- <title>ECOMUSEO</title> --}}

        <title>Ecomuseo LLAQTA AMARU -YOYEN KUWA</title>

    </head>



    <body>

        <header>
            @include('partials.header_new')
        </header>
        <!-- Carousel de Imagenes-->
        <section class="carousel" id="carousel">
        </section>

        <!-- Componentes -->
        <section class="actividades" id="actividades">
            <h1 class="titulo"> <span>Componentes</span></h1>
            <div class="box-container">
                @foreach ($components as $component)
                <div class="box">
                    <div class="actividad">
                        <img src="{{ asset($component->rutaImagenComponente) }}" alt="Foto de {{ $component->titleComponente }}">
                        <h3>{{ $component->titleComponente }}</h3>
                        <p>{{ $component->description }}</p>
                        <!-- Aquí puedes añadir un enlace a más información sobre el componente, si aplica -->
                        <a href="#">Más info</a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Mapa -->

        <section class="mapa" id="mapa">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4809.269451116934!2d-73.37070887429928!3d-3.8341447434190625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2spe!4v1706464087717!5m2!1ses-419!2spe" width="100%" height="889.809px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>

        <!-- Otra Imagen -->
        <section class="imagen-abajo">

        </section>

        <footer>
            @include('partials.footer')
        </footer>
    </body>



</html>
