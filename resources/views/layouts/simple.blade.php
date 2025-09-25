<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lar dos Idosos')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
            <nav class="navbar">
                <div class="nav-container">
                    <a href="/" class="logo">
                        <img src="/images/logo.png" alt="Lar dos Idosos" />
                        <div class="logo-text">
                            <div class="logo-title">Lar dos Idosos</div>
                            <div class="logo-subtitle">Prudentópolis - PR</div>
                        </div>
                    </a>
                    
                    <!-- Menu Hambúrguer -->
                    <button class="hamburger" id="hamburger">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                    
                    <ul class="nav-menu" id="nav-menu">
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#sobre" class="nav-link">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a href="/prioridades" class="nav-link {{ request()->is('prioridades') ? 'active' : '' }}">Prioridades</a>
                        </li>
                        <li class="nav-item">
                            <a href="/contato" class="nav-link {{ request()->is('contato') ? 'active' : '' }}">Contato</a>
                        </li>
                        <li class="nav-item">
                            @auth
                                <div class="user-menu">
                                    <button class="user-menu-toggle" id="userMenuToggle">
                                        <span class="user-name">{{ Auth::user()->name }}</span>
                                        <span class="dropdown-arrow">▼</span>
                                    </button>
                                    <div class="user-dropdown" id="userDropdown">
                                        <a href="{{ route('account') }}" class="dropdown-item">
                                            <span class="dropdown-icon">👤</span>
                                            Conta
                                        </a>
                                        <a href="{{ route('donation.status') }}" class="dropdown-item">
                                            <span class="dropdown-icon">📊</span>
                                            Status das Doações
                                        </a>
                                        <hr class="dropdown-divider">
                                        <form action="{{ route('logout') }}" method="POST" class="dropdown-form">
                                            @csrf
                                            <button type="submit" class="dropdown-item logout">
                                                <span class="dropdown-icon">🚪</span>
                                                Sair
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <a href="/login" class="cta-button">Login</a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </nav>
    
    <main>
        @yield('content')
    </main>
    
    @stack('scripts')
    
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        <script type="module" src="{{ asset('js/hamburger.js') }}"></script>
    @else
        <script src="{{ asset('js/hamburger.js') }}"></script>
    @endif
    
    <script>
        // User dropdown menu
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuToggle = document.getElementById('userMenuToggle');
            const userDropdown = document.getElementById('userDropdown');
            
            if (userMenuToggle && userDropdown) {
                userMenuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('show');
                });
                
                // Fechar dropdown ao clicar fora
                document.addEventListener('click', function() {
                    userDropdown.classList.remove('show');
                });
                
                // Prevenir fechamento ao clicar dentro do dropdown
                userDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        });
    </script>
</body>
</html>
