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
                    <a href="/" class="nav-item">Inicio</a>
                    <a href="/tour" class="nav-item">Tours</a>
                    <a href="/blog" class="nav-item">Blogs</a>
                    <a href="/donations" class="nav-item">Donar</a>
                    <a href="/volunteers" class="nav-item">Voluntariado</a>
                </div>
                <div class="user-actions" id="auth-buttons">
                    @if (Route::has('login'))
                        {{-- <div class="auth-links" id="auth-links"> --}}
                            @auth
                                @role('Super Admin|Admin|Volunteer')
                                    <a href="{{ url('/home') }}" class="intranet-btn">INTRANET</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="logout-btn">
                                        Cerrar sesión
                                        </a>
                                    </form>
                                    {{-- <a>Eres admin</a> --}}
                                @else
                                    {{-- <a href="{{ route('profile.edit') }}" class="profile-btn">Perfil</a> --}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="logout-btn">
                                        Cerrar sesión
                                        </a>
                                    </form>
                                    {{-- <a>No eres admin</a> --}}
                                @endrole


                            @else
                                <a href="{{ route('login') }}" class="login-btn">Iniciar sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="register-btn">Registrarse</a>
                                @endif
                            @endauth
                        {{-- </div> --}}
                    @endif
                </div>
            </nav>
        </div>
    </header>
</body>
</html>
