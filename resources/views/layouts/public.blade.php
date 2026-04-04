<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Ingeniería en Desarrollo de Software' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/brand/icono.png') }}"  type="image/x-icon">
</head>
<body class="public-body">
    @include('partials.public-navbar')

    <main class="public-main">
        @yield('content')
    </main>

    @include('partials.public-footer')
</body>
</html>
