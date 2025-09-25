 @extends('layouts.simple')

@section('title', 'Doação Enviada com Sucesso - Lar dos Idosos')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/donation.css') }}">
@endpush

@section('content')
<main class="main-content">
    <div class="donation-container">
        <div class="form-section">
            <div class="success-header">
                <div class="success-icon">✅</div>
                <h1 class="success-title">Doação Enviada com Sucesso!</h1>
                <p class="success-subtitle">Obrigado por contribuir com o Lar dos Idosos</p>
            </div>
            
            <div class="success-details">
                <div class="detail-card">
                    <h3>📋 Detalhes da Doação</h3>
                    <div class="detail-item">
                        <span class="label">Número da Doação:</span>
                        <span class="value">#{{ $doacao->id }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Tipo:</span>
                        <span class="value">{{ $doacao->tipo_doacao_formatado }}</span>
                    </div>
                    @if($doacao->valor)
                        <div class="detail-item">
                            <span class="label">Valor:</span>
                            <span class="value">{{ $doacao->valor_formatado }}</span>
                        </div>
                    @endif
                    <div class="detail-item">
                        <span class="label">Status:</span>
                        <span class="status-badge status-{{ $doacao->status }}">{{ ucfirst(str_replace('_', ' ', $doacao->status)) }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Data:</span>
                        <span class="value">{{ $doacao->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>

                <div class="next-steps">
                    <h3>📋 Próximos Passos</h3>
                    <div class="steps-list">
                        <div class="step-item">
                            <div class="step-icon">📧</div>
                            <div class="step-content">
                                <h4>Email de Confirmação</h4>
                                <p>Você receberá um email de confirmação em breve</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-icon">👁️</div>
                            <div class="step-content">
                                <h4>Análise da Equipe</h4>
                                <p>Nossa equipe analisará sua doação e entrará em contato</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-icon">📊</div>
                            <div class="step-content">
                                <h4>Acompanhar Status</h4>
                                <p>Acesse "Status das Doações" para acompanhar o progresso</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="success-actions">
                <a href="{{ route('donation.status') }}" class="btn-primary">Ver Status das Doações</a>
                <a href="{{ route('donation') }}" class="btn-secondary">Fazer Nova Doação</a>
                <a href="{{ route('home') }}" class="btn-outline">Voltar ao Início</a>
            </div>
        </div>

        <div class="image-section">
            <div class="image-content">
                <h2 class="image-title">Obrigado pela Sua Generosidade!</h2>
                <p class="image-subtitle">Sua doação faz a diferença na vida dos nossos idosos. Cada contribuição é valiosa para nós.</p>
            </div>
        </div>
    </div>
</main>
@endsection




