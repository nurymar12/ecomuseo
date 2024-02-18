<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Eco Museo</title>
<link rel="stylesheet" href="{{ asset('css/header_new.css') }}">

</head>
<body>
    <header>
        <div class="header-container">
            <nav class="main-navigation">
                <img src="{{ asset('images/logo_vectorizado.svg') }}" alt="Logo" class="logo-svg">
                <div class="nav-links">
                    <a href="#" class="nav-item">Inicio</a>
                    <a href="#" class="nav-item">Reserva</a>
                    <a href="#" class="nav-item">Noticias</a>
                    <a href="#" class="nav-item">Contacto</a>
                </div>
                <div class="user-actions" id="auth-buttons">
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
                                <a href="{{ route('login') }}" class="login-btn">Inicar sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="register-btn">Registrarse</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </nav>
        </div>
    </header>
</body>
</html>
