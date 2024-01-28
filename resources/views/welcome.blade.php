<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <script src="{{ asset('js/welcome.js') }}"></script>
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <title>ECOMUSEO</title>

    </head>

    <header>
        @include('partials.header')
    </header>
    
    <body>
        <!-- Carousel de Imagenes-->
        <section class="carousel" id="carousel">
        </section>

        <!-- Actividades -->
        <section class="actividades" id="actividades">
            <h1 class="titulo"> <span>Actividades</span></h1>
            <div class="box-container">
                <div class="box">
                    <div class="actividad">
                        <img src="{{ asset('images/Photo_Act1.jpg') }}" alt="Foto de Abejas">
                        <h3>Ver abejas</h3>
                        <p>¿Quieres a ver las abejas Meliponas? Descubre todo lo que tenemos preparado para ti.</p>
                        <a href="#">Más info</a>
                    </div>
                    <div class="actividad">
                        <img src="{{ asset('images/Photo_Act2.jpg') }}" alt="Foto de Huayruro">
                        <h3>Huayruro</h3>
                        <p>Realiza una busqueda en el bosque para encontrar los arboles de Huayruro</p>
                        <a href="#">Más info</a>
                    </div>
                    <div class="actividad">
                        <img src="{{ asset('images/Photo_Act3.jpg') }}" alt="Foto de Cashaponas">
                        <h3>Cashaponas</h3>
                        <p>Con sus grandes ramas que parecen piernas. Ven y descubre mas de ellas.</p>
                        <a href="#">Más info</a>
                    </div>
                        <div class="actividad">
                        <img src="{{ asset('images/Photo_Act4.jpg') }}" alt="Foto de Interpretacion">
                        <h3>Interpretacion</h3>
                        <p>Aprendamos como cuidar la naturaleza que nos rodea</p>
                        <a href="#">Más info</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mapa -->

        <section class="mapa" id="mapa">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4809.269451116934!2d-73.37070887429928!3d-3.8341447434190625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2spe!4v1706464087717!5m2!1ses-419!2spe" width="100%" height="889.809px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
        
        <!-- Otra Imagen -->
        <section class="imagen-abajo">

        </section>
    </body>

    <footer>
        @include('partials.footer')
    </footer>
    
</html>
