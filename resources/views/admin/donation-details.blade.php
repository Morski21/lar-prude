@extends('layouts.app')

@section('title', 'Detalhes da Doação - Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<style>
    .donation-detail-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    .detail-header {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .detail-info h1 {
        margin: 0 0 10px 0;
        color: #2c3e50;
        font-size: 1.8rem;
    }

    .detail-info p {
        margin: 0;
        color: #7f8c8d;
    }

    .detail-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .detail-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .detail-card h3 {
        margin-top: 0;
        margin-bottom: 20px;
        color: #2c3e50;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding: 10px 0;
        border-bottom: 1px solid #f1f3f4;
    }

    .detail-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .detail-label {
        font-weight: 600;
        color: #2c3e50;
        flex: 1;
    }

    .detail-value {
        color: #34495e;
        flex: 2;
        text-align: right;
    }

    .status-section {
        text-align: center;
        padding: 20px 0;
    }

    .current-status {
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .status-actions {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .action-form {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        background-color: #f8f9fa;
    }

    .action-form h4 {
        margin-top: 0;
        margin-bottom: 15px;
        color: #2c3e50;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 0.9rem;
        box-sizing: border-box;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    .timeline {
        margin-top: 30px;
    }

    .timeline-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        padding-left: 40px;
        position: relative;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 8px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #007bff;
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        left: 19px;
        top: 18px;
        width: 2px;
        height: calc(100% + 10px);
        background-color: #e9ecef;
    }

    .timeline-item:last-child::after {
        display: none;
    }

    .timeline-content {
        flex: 1;
    }

    .timeline-content h5 {
        margin: 0 0 5px 0;
        color: #2c3e50;
        font-size: 1rem;
    }

    .timeline-content p {
        margin: 0;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .timeline-date {
        color: #007bff;
        font-size: 0.8rem;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .detail-header {
            flex-direction: column;
            align-items: stretch;
        }

        .detail-actions {
            justify-content: stretch;
        }

        .detail-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .detail-row {
            flex-direction: column;
            gap: 5px;
        }

        .detail-value {
            text-align: left;
        }
    }
</style>
@endpush

@section('content')
<div class="donation-detail-container">
    <div class="detail-header">
        <div class="detail-info">
            <h1>Doação #{{ $doacao->id }}</h1>
            <p>Solicitada em {{ $doacao->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <div class="detail-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">
                ← Voltar ao Dashboard
            </a>
        </div>
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

    <div class="detail-grid">
        <!-- Informações da Doação -->
        <div class="detail-card">
            <h3>📋 Doação #{{ $doacao->id }}</h3>
            
            <div class="detail-row">
                <span class="detail-label">Doador:</span>
                <span class="detail-value"><strong>{{ $doacao->nome }}</strong></span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Contato:</span>
                <span class="detail-value">
                    {{ $doacao->email }}<br>
                    {{ $doacao->telefone }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Tipo:</span>
                <span class="detail-value">
                    <span class="type-badge type-{{ $doacao->tipo_doacao }}">
                        {{ ucfirst($doacao->tipo_doacao) }}
                    </span>
                </span>
            </div>

            @if($doacao->valor)
                <div class="detail-row">
                    <span class="detail-label">Valor:</span>
                    <span class="detail-value"><strong>{{ $doacao->valor_formatado }}</strong></span>
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
                <span class="detail-value">
                    {{ $doacao->logradouro }}, {{ $doacao->numero }}<br>
                    {{ $doacao->bairro }}, {{ $doacao->cidade }}/{{ $doacao->estado }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Data:</span>
                <span class="detail-value">{{ $doacao->created_at->format('d/m/Y H:i') }}</span>
            </div>

            @if($doacao->observacoes)
                <div class="detail-row">
                    <span class="detail-label">Observações:</span>
                    <span class="detail-value">{{ $doacao->observacoes }}</span>
                </div>
            @endif
        </div>

        <!-- Ações Rápidas -->
        <div class="detail-card">
            <h3>⚡ Ações</h3>
            
            <div class="status-section">
                <div class="current-status">
                    <strong>Status:</strong>
                    <span class="status-badge status-{{ $doacao->status }}">
                        {{ ucfirst(str_replace('_', ' ', $doacao->status)) }}
                    </span>
                </div>

                <div class="status-actions" style="margin-top: 20px;">
                    @if($doacao->status == 'em_espera')
                        <form method="POST" action="{{ route('admin.donations.accept', $doacao->id) }}" style="margin-bottom: 10px;">
                            @csrf
                            <button type="submit" class="btn btn-success" onclick="return confirm('Aceitar esta doação?')" style="width: 100%;">
                                ✅ Aceitar
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.donations.refuse', $doacao->id) }}" style="margin-bottom: 10px;">
                            @csrf
                            <input type="hidden" name="motivo" value="Doação recusada pela administração">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Recusar esta doação?')" style="width: 100%;">
                                ❌ Recusar
                            </button>
                        </form>
                    @endif

                    @if(in_array($doacao->status, ['aceita', 'confirmada']))
                        <form method="POST" action="{{ route('admin.donations.received', $doacao->id) }}" style="margin-bottom: 10px;">
                            @csrf
                            <button type="submit" class="btn btn-success" onclick="return confirm('Marcar como recebida?')" style="width: 100%;">
                                📦 Marcar como Recebida
                            </button>
                        </form>
                    @endif

                    @if(in_array($doacao->status, ['em_espera', 'aceita', 'confirmada']))
                        <form method="POST" action="{{ route('admin.donations.reschedule', $doacao->id) }}" style="margin-bottom: 10px;">
                            @csrf
                            <input type="hidden" name="motivo" value="Reagendamento necessário por questões operacionais">
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Reagendar esta doação?')" style="width: 100%;">
                                📅 Reagendar
                            </button>
                        </form>
                    @endif

                    <!-- Status Rápido -->
                    <form method="POST" action="{{ route('admin.donations.update-status', $doacao->id) }}" style="margin-top: 20px;">
                        @csrf
                        <select name="status" onchange="this.form.submit()" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ddd;">
                            <option value="">Alterar Status...</option>
                            <option value="em_espera" {{ $doacao->status == 'em_espera' ? 'selected' : '' }}>Em Espera</option>
                            <option value="aceita" {{ $doacao->status == 'aceita' ? 'selected' : '' }}>Aceita</option>
                            <option value="recusada" {{ $doacao->status == 'recusada' ? 'selected' : '' }}>Recusada</option>
                            <option value="confirmada" {{ $doacao->status == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                            <option value="recebida" {{ $doacao->status == 'recebida' ? 'selected' : '' }}>Recebida</option>
                            <option value="cancelada" {{ $doacao->status == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
