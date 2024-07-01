<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/paymentInfo.css') }}">
    <title>Voluntarios | Ecomuseo LLAQTA AMARU - YOREN KUWAI</title>
</head>
<body>
<header>
    @include('partials.header_new')
</header>
<main>
    <center><h1 style="margin: 20px 0px 0px 20px;">VOLUNTARIADO</h1></center>
    <div style="display: flex; justify-content: center;">
        <div class="payment-info-container" style="width: 70%;">
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
            <h2 style="margin-bottom: 10px;">Registra tu solicitud de voluntario</h2>
            <p>Utiliza este formularios para enviarnos tu CV y otra información adicional que estimes conveniente</p>
            <p>Recuerda que debes registrarte como usuario en la página para poder enviar una solicitud.</p>
            <br/>
            <form method="POST" action="{{ route('volunteers.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- CV -->
                <div>
                    <x-input-label for="cv" :value="__('Curriculum Vitae')" />
                    <x-text-input id="cv" class="block mt-1 w-full" type="file" name="cv" accept="application/pdf"/>
                    <x-input-error :messages="$errors->get('cv')" class="mt-2" />
                </div>
                <!-- Info Adicional -->
                <div class="mt-4">
                    <x-input-label for="info_adicional" :value="__('Información adicional')" />
                    <textarea id="info_adicional" class="block mt-1 w-full" type="text" name="info_adicional" rows="4" placeholder="Información adicional"></textarea>
                    <x-input-error :messages="$errors->get('info_adicional')" class="mt-2" />
                </div>
                <div class="payment-info-container-section">
                    <x-primary-button class="ms-4">
                        {{ __('Registrar Solicitud') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- <footer>
    @include('partials.footer')
</footer> -->

</body>
</html>
