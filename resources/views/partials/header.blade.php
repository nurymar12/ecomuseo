<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->

<!DOCTYPE html>
<html lang="es">

<link rel="stylesheet" href="{{ asset('css/header.css') }}">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoMuseo</title>
</head>

<body>
    <div class="header">
        <div class="logo">ECO MUSEO</div>
        <nav>
            <a href="#inicio">Inicio</a>
            <a href="#reserva">Reserva</a>
            <a href="#noticias">Noticias</a>
            <a href="#tienda">Tienda</a>
            <a href="#contacto">Contacto</a>
        </nav>
        <div class="language">
            <button>ES</button>
        </div>

        <div class="auth-buttons" id="auth-buttons">
            @if (Route::has('login'))
                <div class="auth-links" id="auth-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" id="link-dashboard">Dashboard</a>
                    @else
                        <a href="/google-auth/redirect" id="link-google">Google</a>
                        <a href="{{ route('login') }}" id="link-login">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" id="link-register">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</body>

</html>
