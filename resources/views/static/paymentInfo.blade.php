<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/paymentInfo.css') }}">
    <title>Medios de Pago | Ecomuseo LLAQTA AMARU - YOYEN KUWA</title>
</head>
<body>

<header>
    @include('partials.header_new')
</header>

<main class="payment-info-container">
    <h1>Medios de Pago</h1>
    <div class="account-info">
        <h2>Números de Cuenta</h2>
        <p>Cuenta Bancaria: 123-456-789</p>
        <p>Cuenta Interbancaria (CCI): 002-1234567890-123456</p>
    </div>
    <div class="qr-codes">
        <h2>Pagos Instantáneos</h2>
        <div class="qr-code">
            {{-- <img src="path/to/your-qr-code-1.jpg" alt="QR Code 1"> --}}
            <img src="{{ asset('images/paymentInfo/plin.png')}}" alt="QR Code 1">

            <p>Escanea para pagar</p>
        </div>
        <div class="qr-code">
            {{-- <img src="path/to/your-qr-code-2.jpg" alt="QR Code 2"> --}}
            <img src="{{ asset('images/paymentInfo/yape.png')}}" alt="QR Code 1">

            <p>Escanea para pagar</p>
        </div>
    </div>
</main>

<footer>
    @include('partials.footer')
</footer>

</body>
</html>
