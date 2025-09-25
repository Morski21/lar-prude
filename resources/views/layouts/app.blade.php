<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lar dos Idosos')</title>
    
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    @include('partials.navbar')
    
    <main>
        @yield('content')
    </main>
    
    @stack('scripts')
</body>
</html>
