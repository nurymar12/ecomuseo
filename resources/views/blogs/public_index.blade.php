<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs | Ecomuseo LLAQTA AMARU - YOYEN KUWA</title>
    {{-- <link rel="stylesheet" href="styles.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/public_index_blog.css') }}">

</head>
<body>
    <!-- Header de la página -->
    <header>
        @include('partials.header_new')
    </header>

    <!-- Sección principal de contenido -->
    <main class="blog-previews-container">
        <h1 class="blog-previews-title">Nuestros Blogs</h1>
        <div class="blog-previews">
            @foreach ($blogs as $blog)
                <div class="blog-preview-card">
                    <img src="{{ asset($blog->displayImage) }}" alt="Imagen representativa del blog" class="blog-preview-image">
                    <div class="blog-preview-content">
                        <h2 class="blog-preview-title">{{ $blog->title }}</h2>
                        {{-- <p class="blog-preview-excerpt">{{ Str::limit($blog->content, 150) }}</p> --}}
                        <div class="blog-preview-components">
                            @foreach ($blog->components as $component)
                                <span class="blog-component-badge">{{ $component->titleComponente }}</span>
                            @endforeach
                        </div>
                        <a href="{{ route('blogs.publicShow', $blog->id) }}" class="blog-preview-link">Leer más →</a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Footer de la página -->
    <footer>
        @include('partials.footer')
    </footer>
</body>
</html>
