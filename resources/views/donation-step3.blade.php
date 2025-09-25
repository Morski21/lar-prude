@extends('layouts.simple')

@section('title', 'Endereço - Lar dos Idosos')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/donation.css') }}">
@endpush

@section('content')
<main class="main-content">
    <div class="donation-container">
        <div class="form-section">
            <div class="form-header">
                <h1 class="form-title">Local e Horário de Entrega</h1>
                <p class="form-subtitle">Escolha o melhor horário para entregar sua doação no Lar dos Idosos</p>
            </div>
            
            <form action="{{ route('donation.step3.process') }}" method="POST">
                @csrf
                <input type="hidden" name="combined_data" value="{{ json_encode($combinedData) }}">
                
                <div class="address-section">
                    <h3 class="section-title">Endereço do Lar dos Idosos</h3>
                    <div class="lar-address-card">
                        <div class="address-info">
                            <h4>🏠 Lar dos Idosos</h4>
                            <p><strong>Endereço:</strong> Rua Cel João Pedro Martins - Centro</p>
                            <p><strong>Cidade:</strong> Prudentópolis - PR</p>
                            <p><strong>CEP:</strong> 84400-000</p>
                            <p><strong>Telefone:</strong> (42) 3446-1494</p>
                        </div>
                        <input type="hidden" name="cep" value="84400000">
                        <input type="hidden" name="logradouro" value="Rua Cel João Pedro Martins">
                        <input type="hidden" name="numero" value="Centro">
                        <input type="hidden" name="bairro" value="Centro">
                        <input type="hidden" name="cidade" value="Prudentópolis">
                        <input type="hidden" name="estado" value="PR">
                    </div>
                </div>

                <div class="schedule-section">
                    <h3 class="section-title">Horários Disponíveis para Entrega</h3>
                    <div class="schedule-options">
                        <div class="schedule-day">
                            <h4>Segunda a Sexta-feira</h4>
                            <div class="time-slots">
                                <label class="time-slot">
                                    <input type="radio" name="horario_entrega" value="manha_seg_sex" required>
                                    <span class="time-label">
                                        <span class="time-icon">🌅</span>
                                        <span class="time-text">Manhã: 8h às 12h</span>
                                    </span>
                                </label>
                                <label class="time-slot">
                                    <input type="radio" name="horario_entrega" value="tarde_seg_sex" required>
                                    <span class="time-label">
                                        <span class="time-icon">☀️</span>
                                        <span class="time-text">Tarde: 13h às 17h</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="schedule-day">
                            <h4>Sábado</h4>
                            <div class="time-slots">
                                <label class="time-slot">
                                    <input type="radio" name="horario_entrega" value="manha_sab" required>
                                    <span class="time-label">
                                        <span class="time-icon">🌅</span>
                                        <span class="time-text">Manhã: 8h às 12h</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="schedule-note">
                            <p><strong>Observação:</strong> Não recebemos doações aos domingos e feriados.</p>
                        </div>
                    </div>
                    <input type="hidden" name="tipo_entrega" value="entrega">
                </div>

                <div class="instructions-section">
                    <h3 class="section-title">Informações Adicionais</h3>
                    <div class="form-group">
                        <label for="instrucoes">Observações sobre a doação (opcional)</label>
                        <textarea id="instrucoes" name="instrucoes" placeholder="Ex: Informações sobre os itens doados, preferência de dia específico, etc." rows="4"></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('donation.step2') }}" class="btn-secondary">Voltar</a>
                    <button type="submit" class="btn-donate">Continuar</button>
                </div>
            </form>
            
            <div class="progress">
                <div class="progress-step">
                    <div class="progress-circle completed">✓</div>
                    <span class="progress-text">DADOS PESSOAIS</span>
                </div>
                <div class="progress-line active"></div>
                <div class="progress-step">
                    <div class="progress-circle completed">✓</div>
                    <span class="progress-text">DADOS DOAÇÃO</span>
                </div>
                <div class="progress-line active"></div>
                <div class="progress-step">
                    <div class="progress-circle active">3</div>
                    <span class="progress-text">DADOS ENDEREÇO</span>
                </div>
            </div>
        </div>

        <div class="image-section">
            <div class="image-content">
                <h2 class="image-title">Quase Lá!</h2>
                <p class="image-subtitle">Informe o endereço para finalizarmos sua doação e entrarmos em contato</p>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Time slot selection
    const timeSlots = document.querySelectorAll('.time-slot');
    timeSlots.forEach(slot => {
        slot.addEventListener('click', function() {
            timeSlots.forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
});
</script>
@endpush
@endsection
