@extends('layouts.simple')

@section('title', 'Confirmação da Doação - Lar dos Idosos')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/donation.css') }}">
@endpush

@section('content')
<main class="main-content">
    <div class="donation-container">
        <div class="form-section">
            <div class="form-header">
                <h1 class="form-title">Confirmação da Doação</h1>
                <p class="form-subtitle">Revise os dados antes de finalizar</p>
            </div>
            
            <div class="confirmation-summary">
                <div class="summary-card">
                    <h3>📋 Resumo da Doação</h3>
                    
                    <div class="summary-section">
                        <h4>Dados Pessoais</h4>
                        <div class="summary-item">
                            <span class="label">Nome:</span>
                            <span class="value">{{ $allData['nome'] }}</span>
                        </div>
                        <div class="summary-item">
                            <span class="label">Email:</span>
                            <span class="value">{{ $allData['email'] }}</span>
                        </div>
                        <div class="summary-item">
                            <span class="label">Telefone:</span>
                            <span class="value">{{ $allData['telefone'] }}</span>
                        </div>
                    </div>

                    <div class="summary-section">
                        <h4>Dados da Doação</h4>
                        <div class="summary-item">
                            <span class="label">Tipo:</span>
                            <span class="value">
                                @if($allData['tipo_doacao'] === 'dinheiro')
                                    Doação em Dinheiro
                                @elseif($allData['tipo_doacao'] === 'alimentos')
                                    Doação de Alimentos
                                @else
                                    Doação de Materiais
                                @endif
                            </span>
                        </div>
                        @if($allData['valor_customizado'])
                            <div class="summary-item">
                                <span class="label">Valor:</span>
                                <span class="value">R$ {{ number_format($allData['valor_customizado'], 2, ',', '.') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="summary-section">
                        <h4>Local de Entrega</h4>
                        <div class="summary-item">
                            <span class="label">Endereço:</span>
                            <span class="value">
                                Rua Cel João Pedro Martins - Centro<br>
                                Prudentópolis - PR, 84400-000
                            </span>
                        </div>
                        <div class="summary-item">
                            <span class="label">Horário:</span>
                            <span class="value">
                                @if($allData['horario_entrega'] === 'manha_seg_sex')
                                    Segunda a Sexta - Manhã (8h às 12h)
                                @elseif($allData['horario_entrega'] === 'tarde_seg_sex')
                                    Segunda a Sexta - Tarde (13h às 17h)
                                @elseif($allData['horario_entrega'] === 'manha_sab')
                                    Sábado - Manhã (8h às 12h)
                                @endif
                            </span>
                        </div>
                    </div>

                    @if($allData['instrucoes'])
                        <div class="summary-section">
                            <h4>Observações</h4>
                            <div class="summary-item">
                                <span class="value">{{ $allData['instrucoes'] }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="confirmation-info">
                    <div class="info-card">
                        <h4>ℹ️ Informações Importantes</h4>
                        <ul>
                            <li>Sua doação será analisada por nossa equipe</li>
                            <li>Você receberá um email de confirmação em breve</li>
                            <li>Você pode acompanhar o status em "Status das Doações"</li>
                            <li>Entre em contato pelo telefone (42) 3446-1494 se necessário</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('donation.step3') }}" class="btn-secondary">Voltar</a>
                <form action="{{ route('donation.finalize') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="all_data" value="{{ json_encode($allData) }}">
                    <button type="submit" class="btn-donate">Finalizar Doação</button>
                </form>
            </div>
        </div>

        <div class="image-section">
            <div class="image-content">
                <h2 class="image-title">Quase Pronto!</h2>
                <p class="image-subtitle">Sua doação está prestes a ser enviada. Nossa equipe analisará e entrará em contato.</p>
            </div>
        </div>
    </div>
</main>
@endsection






