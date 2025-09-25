@extends('layouts.simple')

@section('title', 'Minha Conta - Lar dos Idosos')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endpush

@section('content')
<main class="main-content">
    <div class="account-container">
        <div class="account-header">
            <h1 class="account-title">Minha Conta</h1>
            <p class="account-subtitle">Gerencie suas informações pessoais</p>
        </div>

        <div class="account-content">
            <div class="account-card">
                <div class="card-header">
                    <h2 class="card-title">Informações Pessoais</h2>
                </div>
                <div class="card-content">
                    <div class="info-grid">
                        <div class="info-item">
                            <label class="info-label">Nome</label>
                            <div class="info-value">{{ Auth::user()->name }}</div>
                        </div>
                        
                        <div class="info-item">
                            <label class="info-label">E-mail</label>
                            <div class="info-value">{{ Auth::user()->email }}</div>
                        </div>
                        
                        <div class="info-item">
                            <label class="info-label">Membro desde</label>
                            <div class="info-value">{{ Auth::user()->created_at->format('d/m/Y') }}</div>
                        </div>
                        
                        <div class="info-item">
                            <label class="info-label">Último acesso</label>
                            <div class="info-value">{{ now()->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="account-card">
                <div class="card-header">
                    <h2 class="card-title">Estatísticas de Doações</h2>
                </div>
                <div class="card-content">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">{{ $totalDoacoes }}</div>
                            <div class="stat-label">Total de Doações</div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-number">{{ $doacoesAceitas }}</div>
                            <div class="stat-label">Doações Aceitas</div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-number">{{ $doacoesEmEspera }}</div>
                            <div class="stat-label">Em Espera</div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-number">{{ $doacoesRecebidas }}</div>
                            <div class="stat-label">Doações Recebidas</div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-number">
                                @if($totalValor > 0)
                                    R$ {{ number_format($totalValor, 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </div>
                            <div class="stat-label">Valor Total Doado</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="account-card">
                <div class="card-header">
                    <h2 class="card-title">Ações Rápidas</h2>
                </div>
                <div class="card-content">
                    <div class="actions-grid">
                        <a href="{{ route('donation') }}" class="action-btn primary">
                            <div class="action-icon">💝</div>
                            <div class="action-content">
                                <h3>Fazer Nova Doação</h3>
                                <p>Contribua para o Lar dos Idosos</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('donation.status') }}" class="action-btn secondary">
                            <div class="action-icon">📊</div>
                            <div class="action-content">
                                <h3>Ver Status das Doações</h3>
                                <p>Acompanhe suas contribuições</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('priorities') }}" class="action-btn secondary">
                            <div class="action-icon">🎯</div>
                            <div class="action-content">
                                <h3>Ver Prioridades</h3>
                                <p>Saiba o que mais precisamos</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('contact') }}" class="action-btn secondary">
                            <div class="action-icon">📞</div>
                            <div class="action-content">
                                <h3>Entrar em Contato</h3>
                                <p>Fale conosco</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
