<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_vectorizado.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/contactUs.css') }}">
    <script src="{{ asset('js/welcome.js') }}"></script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Ecomuseo LLAQTA AMARU -YOREN KUWAI</title>
</head>
<body>

<header>
    @include('partials.header_new')
</header>

<main>
    <section class="contact-container">
        <h1>Contactanos</h1>
        <p>Si tienes alguna pregunta, no dudes en enviarnos un mensaje</p>
        <form action="/send-message" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="subject">Asunto:</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="message">Mensaje:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn">Enviar Mensaje</button>
        </form>
    </section>
</main>

<!-- <footer>
    @include('partials.footer')
</footer> -->

</body>
</html>
