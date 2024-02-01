<!DOCTYPE html>
<html lang="es">

<link rel="stylesheet" href="{{ asset('css/login_style.css') }}">
<link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión - Ecomuseo LLAQTA AMARU -YOYEN KUWA</title>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <div class="top-left-div">
                Iniciar sesión
            </div>
        </div>
        <div class="right-side">
            <div class="login-form">
                <img src="{{ asset('images/logo_vectorizado.svg') }}" alt="Logo" class="logo-svg">

                {{-- <h2>Bienvenido a ECOMUSEO</h2> --}}
                <h3>INICIAR SESIÓN</h3>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Correo electrónico')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username"
                        placeholder="Ingresa su correo electrónico..."/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Contraseña')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password"
                                        placeholder="Ingresa su contraseña..."/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="div-remenber-me">
                        <label for="remember_me" class="label items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Recuerdame la contraseña') }}</span>
                        </label>
                    </div>


                    <div class="login-section">


                        <x-primary-button class="ms-3">
                            {{ __('Log in') }}
                        </x-primary-button>

                        @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">
                                {{ __('¿Olvidadaste la contraseña?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>
</html>
