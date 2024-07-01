<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/paymentInfo.css') }}">
    <title>Donaciones | Ecomuseo LLAQTA AMARU - YOYEN KUWA</title>
</head>
<body>
<header>
    @include('partials.header_new')
</header>
<main>
    <h1 style="margin: 20px 0px 0px 20px;">DONACIONES</h1>
    <div style="display: flex; justify-content: center;">
        <div class="payment-info-container" style="width: 45%; margin-right: 10px;">
            <div>
                @if(session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <h2 style="margin-bottom: 10px;">Registra tu donación</h2>
            <p>Elige el tipo de donación que quieres realizar.</p>
            <p>Rellena tus datos en el formulario y nos contactaremos contigo.</p>
            <br/>
            <form method="POST" action="{{ route('donations.store') }}">
                @csrf
                <!-- Tipo -->
                <div>
                    <x-input-label for="type" :value="__('Tipo de donación')" />
                    <x-select name="type" id="type" class="block mt-1 w-full">
                        <option value="material" selected>Donación de Materiales varios</option>
                        <option value="dinero">Donación de Dinero</option>
                    </x-select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>
                <!-- Monto -->
                <div id="monto-container" class="mt-4" style="display: none;">
                    <x-input-label for="monto" :value="__('Monto')" />
                    <x-text-input id="monto" class="block mt-1 w-full" type="number" step="0.01" name="monto" placeholder="Monto de la donación"/>
                    <x-input-error :messages="$errors->get('monto')" class="mt-2" />
                </div>
                <!-- Razon Social -->
                <div class="mt-4">
                    <x-input-label for="razon_social" :value="__('Razón Social')" />
                    <x-text-input id="razon_social" class="block mt-1 w-full" type="text" name="razon_social"  placeholder="Nombre de Empresa o Institución"/>
                    <x-input-error :messages="$errors->get('razon_social')" class="mt-2" />
                </div>
                <!-- Persona Contacto -->
                <div class="mt-4">
                    <x-input-label for="persona_contacto" :value="__('Persona de Contacto')" />
                    <x-text-input id="persona_contacto" class="block mt-1 w-full" type="text" name="persona_contacto"  placeholder="Nombre de persona de contacto"/>
                    <x-input-error :messages="$errors->get('persona_contacto')" class="mt-2" />
                </div>
                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email_contacto" :value="__('Correo electrónico')" />
                    <x-text-input id="email_contacto" class="block mt-1 w-full" type="email" name="email_contacto"
                        :value="old('email_contacto')" required autocomplete="username"  placeholder="Correo electrónico"/>
                    <x-input-error :messages="$errors->get('email_contacto')" class="mt-2" />
                </div>
                <!-- Telefono -->
                <div class="mt-4">
                    <x-input-label for="celular_contacto" :value="__('Celular/Telefono')" />
                    <x-text-input id="celular_contacto" class="block mt-1 w-full" type="text" name="celular_contacto"  placeholder="Celular/Telefono de contacto"/>
                    <x-input-error :messages="$errors->get('celular_contacto')" class="mt-2" />
                </div>
                <!-- Info Adicional -->
                <div class="mt-4">
                    <x-input-label for="info_adicional" :value="__('Información adicional')" />
                    <textarea id="info_adicional" class="block mt-1 w-full" type="text" name="info_adicional" rows="4" placeholder="Información adicional"></textarea>
                    <x-input-error :messages="$errors->get('info_adicional')" class="mt-2" />
                </div>
                <div class="payment-info-container-section">
                    <x-primary-button class="ms-4">
                        {{ __('Registrar donación') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
        <div class="payment-info-container" style="width: 45%;">
            <div class="account-info">
                <h2>Donaciones a traves de Transferencias bancarias</h2>
                <p>Cta. Cte. Banco de la Nación: 123-456-789</p>
                <p>Cta. Interbancaria (CCI): 002-1234567890-123456</p>
            </div>
            <div class="qr-codes">
                <h2>Donaciones a traves de Billeteras digitales</h2>
                <p>Escanea el QR para realizar tu donación</p>
                <br/>
                <div class="qr-code">
                    <img src="{{ asset('images/paymentInfo/plin.png')}}" alt="QR Plin">
                </div>
                <div class="qr-code">
                    <img src="{{ asset('images/paymentInfo/yape.png')}}" alt="QR Yape">
                </div>
            </div>
            <p>Luego de realizar tu transferencia rellena y envía el formulario de la izquierda</p>
            <p>Indica el número de operación de tu transferencia en el campo de Información adicional.</p>
        </div>
    </div>
</main>

<footer>
    @include('partials.footer')
</footer>

<script>
    document.getElementById('type').addEventListener('change', function () {
        var montoContainer = document.getElementById('monto-container');
        if (this.value === 'dinero') {
            montoContainer.style.display = 'block';
            document.getElementById('monto').setAttribute('required', 'required');
        } else {
            montoContainer.style.display = 'none';
            document.getElementById('monto').removeAttribute('required');
        }
    });
</script>

</body>
</html>
