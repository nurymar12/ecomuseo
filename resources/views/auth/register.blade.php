<!DOCTYPE html>
<html lang="es">

<link rel="stylesheet" href="{{ asset('css/register_style.css') }}">
<link rel="icon" type="image/svg+xml" href="{{ asset('images_2/logo_vectorizado.svg') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarse - Ecomuseo LLAQTA AMARU -YOYEN KUWA</title>

</head>

<body>
    <div class="container">
        <div class="left-side">
            <div class="register-form">
                <img src="{{ asset('images_2/logo_vectorizado.svg') }}" alt="Logo" class="logo-svg">

                {{-- <h2>Bienvenido a ECOMUSEO</h2> --}}
                <h3>REGISTRARSE</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nombre')" />
                        {{-- <input id="name" type="text" name="name" placeholder="Ingresa tu nombre..."> --}}
                        <x-text-input id="name" type="text" name="name"  placeholder="Ingresa tu nombre..."/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Correo electronico')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username"  placeholder="Ingresa tu correo electrónico..."/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Contraseña')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password"  placeholder="Contraseña..."/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirme contraseña..."/>

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="register-section">

                        <x-primary-button class="ms-4">
                            {{ __('Register') }}
                        </x-primary-button>

                        <a class="already-registered" href="{{ route('login') }}">
                            {{ __('¿Ya está registrado?') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="right-side">
            <div class="top-right-div">
                Registrarse
            </div>
        </div>
    </div>
</body>

</html>
