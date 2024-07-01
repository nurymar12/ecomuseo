<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">
        <link rel="stylesheet" href="{{ asset('css/my_visits.css') }}">
        <script src="{{ asset('js/welcome.js') }}"></script>
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <title>Mis Visitas | Ecomuseo LLAQTA AMARU - YOREN KUWAI</title>

    </head>
    <body>
        <header>
            @include('partials.header_new')
        </header>

        <div class="container">
            <h2>Mis Visitas</h2>
            @foreach ($visits as $visit)
                <div class="table-container {{ $visit->status }}">
                    <div class="visit-header">
                        <h3>{{ $visit->tour->name }}</h3>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr class="visit-info">
                                <td>Fecha de inicio del tour:</td>
                                <td>{{ $visit->tour->start_date}}</td>
                            </tr>
                            <tr class="visit-info">
                                <td>Fecha de fin del tour:</td>
                                <td>{{ $visit->tour->end_date}}</td>
                            </tr>
                            <tr class="visit-info">
                                <td>Número de cupos solicitados:</td>
                                <td>{{ $visit->number_of_people }}</td>
                            </tr>
                            <tr class="visit-info">
                                <td>Fecha solicitada para la visita:</td>
                                <td>{{ $visit->requested_date}}</td>
                            </tr>
                            <tr class="visit-info">
                                <td>Estado de la visita:</td>
                                <td>{{ ucfirst($visit->status) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>

        <!-- <footer>
            @include('partials.footer')
        </footer>
    </body> -->
</html>
