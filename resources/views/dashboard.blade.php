@extends('layouts.simple')

@section('title', 'Dashboard - Lar dos Idosos')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<main class="main-content">
    <div class="container">
        <div class="dashboard-card">
            <div class="dashboard-header">
                <div>
                    <h1 class="dashboard-title">Bem-vindo ao Painel</h1>
                    <p class="dashboard-subtitle">Gerencie e acompanhe as atividades do Lar dos Idosos</p>
                </div>
            </div>

            <div class="dashboard-stats-grid">
                <div class="dashboard-stat-card">
                    <span class="dashboard-stat-icon">👥</span>
                    <span class="dashboard-stat-number">50+</span>
                    <div class="dashboard-stat-label">Idosos Atendidos</div>
                </div>
                <div class="dashboard-stat-card">
                    <span class="dashboard-stat-icon">📊</span>
                    <span class="dashboard-stat-number">24</span>
                    <div class="dashboard-stat-label">Doações Hoje</div>
                </div>
                <div class="dashboard-stat-card">
                    <span class="dashboard-stat-icon">🤝</span>
                    <span class="dashboard-stat-number">200+</span>
                    <div class="dashboard-stat-label">Voluntários Ativos</div>
                </div>
                <div class="dashboard-stat-card">
                    <span class="dashboard-stat-icon">💰</span>
                    <span class="dashboard-stat-number">R$ 15k</span>
                    <div class="dashboard-stat-label">Arrecadado Este Mês</div>
                </div>
            </div>

            <div class="quick-actions">
                <a href="/doar" class="action-card">
                    <span class="action-icon">💝</span>
                    <div class="action-title">Nova Doação</div>
                    <div class="action-description">Registrar uma nova doação recebida</div>
                </a>
                <a href="/prioridades" class="action-card">
                    <span class="action-icon">📋</span>
                    <div class="action-title">Ver Prioridades</div>
                    <div class="action-description">Consultar itens mais necessários</div>
                </a>
                <a href="#relatorios" class="action-card">
                    <span class="action-icon">📈</span>
                    <div class="action-title">Relatórios</div>
                    <div class="action-description">Visualizar estatísticas e relatórios</div>
                </a>
                <a href="#configuracoes" class="action-card">
                    <span class="action-icon">⚙️</span>
                    <div class="action-title">Configurações</div>
                    <div class="action-description">Gerenciar configurações do sistema</div>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection