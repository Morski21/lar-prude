<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Necessário - Lar dos Idosos</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        @endif
    </head>
    <body class="login-required-body">
        <header class="login-required-nav">
            <div class="login-required-brand">
                <img src="/images/logo.png" alt="Lar dos Idosos" />
                <div>
                    <strong>Lar dos Idosos</strong>
                    <div class="login-required-subtitle">Rua Vinte e Quatro de Junho, Prudentópolis - PR</div>
                </div>
            </div>
            <nav class="login-required-menu">
                <a href="/">Home</a>
                <a href="#sobre">Sobre</a>
                <a href="#prioridades">Prioridades</a>
                <a href="#contato">Contato</a>
                <a href="/login" class="login-required-login-btn">Login</a>
            </nav>
        </header>

        <div class="login-required-card">
            <div class="login-required-icon">🔒</div>
            <h1 class="login-required-title">Login Necessário</h1>
            <p class="login-required-subtitle">
                Para fazer uma doação, você precisa ter uma conta em nosso sistema. 
                Isso nos ajuda a manter um registro seguro das doações e a entrar em contato com você.
            </p>
            <div>
                <a href="/login" class="login-required-btn">Fazer Login</a>
                <a href="/register" class="login-required-btn secondary">Criar Conta</a>
            </div>
            <p class="login-required-footer">
                Já tem uma conta? <a href="/login" class="login-required-link">Clique aqui para entrar</a>
            </p>
        </div>
    </body>
</html>



