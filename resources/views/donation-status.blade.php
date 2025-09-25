@extends('layouts.simple')

@section('title', 'Status das Doações - Lar dos Idosos')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/status.css') }}">
@endpush

@section('content')
<main class="main-content">
    <div class="status-container">
        <div class="status-header">
            <h1 class="status-title">Status das Minhas Doações</h1>
            <p class="status-subtitle">Acompanhe o andamento de suas doações</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <div class="alert-icon">✅</div>
                <div class="alert-content">
                    <h4>Sucesso!</h4>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if($doacoes->count() > 0)
            <div class="donations-list">
                @foreach($doacoes as $doacao)
                    <div class="donation-card status-{{ $doacao->status }}">
                        <div class="donation-header">
                            <div class="donation-info">
                                <h3 class="donation-title">
                                    {{ $doacao->tipo_doacao_formatado }}
                                    @if($doacao->valor)
                                        - {{ $doacao->valor_formatado }}
                                    @endif
                                </h3>
                                <p class="donation-date">
                                    Realizada em {{ $doacao->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <div class="donation-status">
                                <span class="status-badge status-{{ $doacao->status }}">
                                    {{ ucfirst($doacao->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="donation-details">
                            <div class="detail-row">
                                <span class="detail-label">Tipo:</span>
                                <span class="detail-value">{{ $doacao->tipo_doacao_formatado }}</span>
                            </div>
                            
                            @if($doacao->valor)
                                <div class="detail-row">
                                    <span class="detail-label">Valor:</span>
                                    <span class="detail-value">{{ $doacao->valor_formatado }}</span>
                                </div>
                            @endif

                            @if($doacao->descricao_itens)
                                <div class="detail-row">
                                    <span class="detail-label">Itens:</span>
                                    <span class="detail-value">{{ $doacao->descricao_itens }}</span>
                                </div>
                            @endif

                            <div class="detail-row">
                                <span class="detail-label">Endereço:</span>
                                <span class="detail-value">{{ $doacao->endereco_completo }}</span>
                            </div>

                            @if($doacao->data_recebimento)
                                <div class="detail-row">
                                    <span class="detail-label">Recebida em:</span>
                                    <span class="detail-value">{{ $doacao->data_recebimento->format('d/m/Y H:i') }}</span>
                                </div>
                            @endif

                            @if($doacao->observacoes)
                                <div class="detail-row">
                                    <span class="detail-label">Observações:</span>
                                    <span class="detail-value">{{ $doacao->observacoes }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="donation-timeline">
                            <!-- Etapa 1: Solicitação Enviada -->
                            <div class="timeline-step completed">
                                <div class="timeline-icon">📝</div>
                                <div class="timeline-content">
                                    <h4>Solicitação Enviada</h4>
                                    <p>{{ $doacao->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            <!-- Etapa 2: Em Espera / Visualizada -->
                            <div class="timeline-step {{ in_array($doacao->status, ['em_espera', 'aceita', 'recusada', 'reagendada', 'confirmada', 'recebida', 'cancelada']) ? 'completed' : '' }}">
                                <div class="timeline-icon">
                                    @if($doacao->status === 'em_espera')
                                        ⏳
                                    @else
                                        👁️
                                    @endif
                                </div>
                                <div class="timeline-content">
                                    <h4>
                                        @if($doacao->status === 'em_espera')
                                            Aguardando Visualização
                                        @else
                                            Visualizada pela Equipe
                                        @endif
                                    </h4>
                                    <p>
                                        @if($doacao->status === 'em_espera')
                                            Nossa equipe ainda não visualizou sua doação
                                        @else
                                            Doação foi visualizada pela equipe
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Etapa 3: Decisão da Equipe -->
                            @if(in_array($doacao->status, ['aceita', 'recusada', 'reagendada', 'confirmada', 'recebida', 'cancelada']))
                                <div class="timeline-step {{ in_array($doacao->status, ['aceita', 'confirmada', 'recebida']) ? 'completed' : ($doacao->status === 'recusada' ? 'cancelled' : 'pending') }}">
                                    <div class="timeline-icon">
                                        @if($doacao->status === 'aceita' || $doacao->status === 'confirmada' || $doacao->status === 'recebida')
                                            ✅
                                        @elseif($doacao->status === 'recusada')
                                            ❌
                                        @elseif($doacao->status === 'reagendada')
                                            📅
                                        @else
                                            ⏳
                                        @endif
                                    </div>
                                    <div class="timeline-content">
                                        <h4>Decisão da Equipe</h4>
                                        <p>
                                            @if($doacao->status === 'aceita')
                                                Doação aceita
                                            @elseif($doacao->status === 'recusada')
                                                Doação recusada
                                            @elseif($doacao->status === 'reagendada')
                                                Doação reagendada
                                            @elseif($doacao->status === 'confirmada')
                                                Doação confirmada
                                            @elseif($doacao->status === 'recebida')
                                                Doação recebida
                                            @elseif($doacao->status === 'cancelada')
                                                Doação cancelada
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <!-- Etapa 4: Recebimento (se aplicável) -->
                            @if($doacao->status === 'recebida')
                                <div class="timeline-step completed">
                                    <div class="timeline-icon">📦</div>
                                    <div class="timeline-content">
                                        <h4>Doação Recebida</h4>
                                        <p>{{ $doacao->data_recebimento ? $doacao->data_recebimento->format('d/m/Y H:i') : 'Data não informada' }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <h3>Nenhuma doação encontrada</h3>
                <p>Você ainda não realizou nenhuma doação.</p>
                <a href="{{ route('donation') }}" class="btn-primary">Fazer Primeira Doação</a>
            </div>
        @endif
    </div>
</main>
@endsection
