<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->

<!DOCTYPE html>
<html lang="es">

<link rel="stylesheet" href="{{ asset('css/header_old.css') }}">


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

        <div class="profile-actions" id="auth-buttons">
            @if (Route::has('login'))
                <div class="auth-links" id="auth-links">
                    @auth

                        {{-- <a href="{{ url('/dashboard') }}" id="link-dashboard">Dashboard</a> --}}

                        <a href="{{ route('profile.edit') }}" class="profile-action-link">Perfil</a>
                        <form method="POST" action="{{ route('logout') }}" class="profile-action-form">
                            @csrf
                            <a href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="profile-action-link">
                            Cerrar sesión
                            </a>
                        </form>
                    @else
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
