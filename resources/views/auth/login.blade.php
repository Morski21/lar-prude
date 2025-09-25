<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - {{ config('app.name', 'Laravel') }}</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        @endif
    </head>
    <body class="auth-body">
        <div class="auth-card">
            <div class="auth-split">
                <div class="auth-left">
                    <div class="auth-logo"><img src="/images/logo.png" alt="Lar"/></div>
                    <h2>Lar dos Idosos</h2>
                    <p>Seja bem-vindo(a)! Sua ajuda transforma vidas. Acesse sua conta para continuar.</p>
                </div>
                <div class="auth-right">
                    <h1 class="auth-title">Bem-vindo</h1>
                    <p class="auth-subtitle">Entre na sua conta para continuar</p>

            @if ($errors->any())
                <div class="auth-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
                @csrf
                <div class="auth-box">
                    <div class="auth-field">
                        <label for="email" class="auth-label">E-mail</label>
                        <span class="auth-icon">📧</span>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="auth-input" />
                    </div>
                    <div class="auth-field">
                        <label for="password" class="auth-label">Senha</label>
                        <span class="auth-icon">🔒</span>
                        <input id="password" name="password" type="password" required class="auth-input" />
                    </div>
                </div>
                <label class="auth-remember">
                    <input type="checkbox" name="remember" value="1" class="rounded-sm">
                    Lembrar-me
                </label>
                <button type="submit" class="auth-btn primary">Entrar</button>
            </form>
            <p class="auth-link-text">
                Não tem uma conta? <a href="{{ route('register') }}" class="underline auth-link">Crie agora</a>
            </p>
                </div>
            </div>
        </div>
    </body>
</html>


