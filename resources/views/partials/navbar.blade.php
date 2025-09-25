<nav class="navbar">
    <div class="nav-container">
        <a href="/" class="logo">
            <img src="/images/logo.png" alt="Lar dos Idosos" />
            <div class="logo-text">
                <div class="logo-title">Lar dos Idosos</div>
                <div class="logo-subtitle">Prudentópolis - PR</div>
            </div>
        </a>
        <ul class="nav-menu">
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
                <a href="#contato" class="nav-link">Contato</a>
            </li>
            <li class="nav-item">
                @auth
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="cta-button danger">Sair</button>
                    </form>
                @else
                    <a href="/login" class="cta-button">Login</a>
                @endauth
            </li>
        </ul>
    </div>
</nav>

