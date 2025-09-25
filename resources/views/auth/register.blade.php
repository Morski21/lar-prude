<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Criar conta - {{ config('app.name', 'Laravel') }}</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        @endif
    </head>
    <body class="auth-body">
        <div class="auth-card register">
            <h1 class="auth-title">Criar conta</h1>

            @if ($errors->any())
                <div class="auth-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.attempt') }}" method="POST" class="space-y-4">
                @csrf
                <div class="auth-box">
                    <div class="auth-field">
                        <label for="name" class="auth-label">Nome</label>
                        <span class="auth-icon">👤</span>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus class="auth-input" />
                    </div>
                    <div class="auth-field">
                        <label for="email" class="auth-label">E-mail</label>
                        <span class="auth-icon">📧</span>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required class="auth-input" />
                    </div>
                    <div class="auth-field">
                        <label for="password" class="auth-label">Senha</label>
                        <span class="auth-icon">🔒</span>
                        <input id="password" name="password" type="password" required class="auth-input" />
                    </div>
                    <div class="auth-field">
                        <label for="password_confirmation" class="auth-label">Confirmar senha</label>
                        <span class="auth-icon">🔒</span>
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="auth-input" />
                    </div>
                </div>
                <button type="submit" class="auth-btn register">Criar conta</button>
            </form>
            <p class="auth-link-text">
                Já tem conta?
                <a href="{{ route('login') }}" class="underline auth-link">Entrar</a>
            </p>
        </div>
    </body>
</html>


