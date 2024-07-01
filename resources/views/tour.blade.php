<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">
        <link rel="stylesheet" href="{{ asset('css/tour.css') }}">
        <script src="{{ asset('js/welcome.js') }}"></script>
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <title>Ecomuseo LLAQTA AMARU -YOREN KUWAI</title>

    </head>
    <body>
        <header>
            @include('partials.header_new')
        </header>

        <!-- Sección de tours -->
        <section class="tours" id="tours">
            <h1 class="titulo"><center><span>NUESTROS TOURS</span></h1></center>
            @auth
                <div class="custom-button-container">
                    <a href="{{ route('visits.publicVisits') }}" class="custom-button">Mis Tours</a>
                    {{-- <a href="#" class="custom-button">Mis Tours</a> --}}

                </div>
            @endauth

            <div class="box-container">
                @foreach ($tours as $tour)
                    @if ($tour->available_seats > 0) <!-- Solo mostrar si hay asientos disponibles -->
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
                            <p>{{$tour->description}}</p>
                            <div class="tour-details">
                                <span><strong>Fecha:</strong> {{ $tour->start_date }} - {{ $tour->end_date }}</span>
                                <span><strong>Capacidad:</strong> {{ $tour->available_seats }}</span>
                            </div>
                            <div class="tour-components">
                                <strong>Componentes:</strong>
                                <ul>
                                    @foreach ($tour->components as $component)
                                        <li>{{ $component->titleComponente }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Contenedor del botón de reserva -->
                            <div class="reserve-button-container">
                                <a class="reserve-button" data-tour-id="{{ $tour->id }}">Reservar Tour</a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </section>


        <!-- <footer>
            @include('partials.footer')
        </footer> -->
    </body>
</html>

@include('tours.reservationModal')

<script>
    $(document).ready(function() {
      $('.reserve-button').click(function() {
        var tourId = $(this).data('tour-id');
        $('#tour_id').val(tourId);
        $('#reservationModal').modal('show');
      });
    });
  </script>
