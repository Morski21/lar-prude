@extends('layouts.simple')

@section('title', 'Itens Prioritários para Doação - Lar dos Idosos')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/priorities.css') }}">
@endpush

@section('content')
<section class="hero">
    <div class="hero-content">
        <h1>Itens Prioritários para Doação</h1>
        <p>Ajude-nos a cuidar melhor dos nossos idosos doando os itens que mais precisamos</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">O que mais precisamos</h2>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number">50+</span>
                <div class="stat-label">Idosos Atendidos</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">24h</span>
                <div class="stat-label">Cuidado Contínuo</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">15+</span>
                <div class="stat-label">Anos de Experiência</div>
            </div>
        </div>

        <div class="priority-grid">
            <div class="priority-card urgent">
                <div class="priority-level urgent">Urgente</div>
                <span class="priority-icon">🍎</span>
                <h3 class="priority-title">Alimentos</h3>
                <p class="priority-description">Alimentos nutritivos para uma alimentação saudável e balanceada.</p>
                <ul class="priority-items">
                    <li>Leite e derivados</li>
                    <li>Frutas e verduras frescas</li>
                    <li>Carnes magras</li>
                    <li>Grãos e cereais</li>
                    <li>Alimentos para dietas especiais</li>
                </ul>
                <a href="/doar" class="donate-btn">Doar Alimentos</a>
            </div>

            <div class="priority-card high">
                <div class="priority-level high">Alta</div>
                <span class="priority-icon">🧴</span>
                <h3 class="priority-title">Produtos de Higiene</h3>
                <p class="priority-description">Itens essenciais para manter a higiene e conforto dos idosos.</p>
                <ul class="priority-items">
                    <li>Sabonetes e shampoos</li>
                    <li>Fraldas geriátricas</li>
                    <li>Papel higiênico</li>
                    <li>Toalhas e lençóis</li>
                    <li>Produtos de limpeza</li>
                </ul>
                <a href="/doar" class="donate-btn">Doar Produtos</a>
            </div>

            <div class="priority-card high">
                <div class="priority-level high">Alta</div>
                <span class="priority-icon">👕</span>
                <h3 class="priority-title">Roupas e Calçados</h3>
                <p class="priority-description">Roupas confortáveis e adequadas para o dia a dia dos idosos.</p>
                <ul class="priority-items">
                    <li>Roupas íntimas</li>
                    <li>Pijamas e roupões</li>
                    <li>Meias e sapatos confortáveis</li>
                    <li>Roupas de cama</li>
                    <li>Casacos e agasalhos</li>
                </ul>
                <a href="/doar" class="donate-btn">Doar Roupas</a>
            </div>

            <div class="priority-card medium">
                <div class="priority-level medium">Média</div>
                <span class="priority-icon">🛏️</span>
                <h3 class="priority-title">Equipamentos Médicos</h3>
                <p class="priority-description">Equipamentos que ajudam no cuidado e conforto dos idosos.</p>
                <ul class="priority-items">
                    <li>Cadeiras de rodas</li>
                    <li>Andadores e bengalas</li>
                    <li>Colchões especiais</li>
                    <li>Oxímetros e termômetros</li>
                    <li>Equipamentos de fisioterapia</li>
                </ul>
                <a href="/doar" class="donate-btn">Doar Equipamentos</a>
            </div>

            <div class="priority-card medium">
                <div class="priority-level medium">Média</div>
                <span class="priority-icon">🎮</span>
                <h3 class="priority-title">Itens de Lazer</h3>
                <p class="priority-description">Itens para entretenimento e atividades recreativas.</p>
                <ul class="priority-items">
                    <li>Jogos de mesa</li>
                    <li>Livros e revistas</li>
                    <li>Materiais de artesanato</li>
                    <li>Equipamentos de música</li>
                    <li>Plantas e jardinagem</li>
                </ul>
                <a href="/doar" class="donate-btn">Doar Itens de Lazer</a>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="cta-content">
        <h2 class="cta-title">Sua Doação Faz a Diferença</h2>
        <p class="cta-subtitle">Cada item doado é uma demonstração de carinho e cuidado com nossos idosos</p>
        <div class="cta-buttons">
            <a href="/doar" class="btn">Fazer uma Doação</a>
            <a href="#contato" class="btn secondary">Entrar em Contato</a>
        </div>
    </div>
</section>
@endsection