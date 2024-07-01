<!DOCTYPE html>
<html lang="es">

<link rel="stylesheet" href="{{ asset('css/register_style.css') }}">
<link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarse - Ecomuseo LLAQTA AMARU - YOYEN KUWA</title>
</head>

<body>
    <div class="container">
        <div class="left-side">
            <div class="register-form">
                <img src="{{ asset('images/logo_vectorizado.svg') }}" alt="Logo" class="logo-svg">

                {{-- <h2>Bienvenido a ECOMUSEO</h2> --}}
                <h3>REGISTRARSE</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nombre completo')" />
                        {{-- <input id="name" type="text" name="name" placeholder="Ingresa tu nombre..."> --}}
                        <x-text-input id="name" type="text" name="name"  placeholder="Nombre completo"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- DNI -->
                    <div class="mt-4">
                        <x-input-label for="dni" :value="__('DNI')" />
                        <x-text-input id="dni" class="block mt-1 w-full" type="text" name="dni"  placeholder="Documento de identidad"/>
                        <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Correo electrónico')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username"  placeholder="Correo electrónico"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Telefono -->
                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Telefono')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"  placeholder="Telefono de contacto"/>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Fecha Nacimiento -->
                    <div class="mt-4">
                        <x-input-label for="birthdate" :value="__('Fecha de nacimiento')" />
                        <x-input-date-picker id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" max="" />
                        <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Contraseña')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password"  placeholder="Contraseña"/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirme contraseña"/>

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
                    <a href="/google-auth/redirect" id="link-google">
                        <img src="{{ asset('images/google_logo_2.svg') }}" alt="Iniciar sesión por google" class="google_logo_svg">
                    </a>
                </form>
            </div>
        </div>
        <div class="right-side">
            <div class="top-right-div">
                Registrarse
            </div>
        </div>
    </div>
    <script>
        var setMaxDate = function () {
            var hoy = new Date();
            var dd = hoy.getDate();
            var mm = hoy.getMonth() + 1;
            var yyyy = hoy.getFullYear();
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            hoy = dd + '/' + mm + '/' + yyyy;
            document.getElementById("birthdate").setAttribute("max", hoy);
            //return hoy.toString();
            console.log(hoy);
        };
        setMaxDate();
    </script>
</body>
</html>
