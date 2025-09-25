@extends('layouts.simple')

@section('title', 'Fazer Doação - Lar dos Idosos')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/donation.css') }}">
@endpush

@section('content')
<main class="main-content">
    <div class="donation-container">
        <div class="form-section">
            <div class="form-header">
                <h1 class="form-title">Fazer Doação</h1>
                <p class="form-subtitle">Preencha seus dados para continuar com a doação</p>
            </div>
            
            <form action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome *</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="telefone">Número de Telefone *</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(11) 99999-9999" required>
                </div>
                
                <div class="form-group">
                    <label for="nascimento">Data de Nascimento *</label>
                    <input type="text" id="nascimento" name="nascimento" placeholder="DD/MM/AAAA" required>
                </div>
                
                <div class="form-group">
                    <label for="sexo">Sexo *</label>
                    <select id="sexo" name="sexo" required>
                        <option value="">Selecione</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                
                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" name="comunicacoes">
                        Nós adoraríamos poder entrar em contato com você sobre esta e outras campanhas. (?)
                    </label>
                    <div style="margin-left:30px;margin-top:8px">
                        <label>
                            <input type="checkbox" name="aceita_comunicacoes">
                            Sim, por favor. Desejo receber essas comunicações.
                        </label>
                    </div>
                </div>
                
                <button type="submit" class="btn-donate">Fazer Doação</button>
            </form>
            
            <div class="progress">
                <div class="progress-step">
                    <div class="progress-circle active">1</div>
                    <span class="progress-text">DADOS PESSOAIS</span>
                </div>
                <div class="progress-line active"></div>
                <div class="progress-step">
                    <div class="progress-circle inactive">2</div>
                    <span class="progress-text">DADOS DOAÇÃO</span>
                </div>
                <div class="progress-line"></div>
                <div class="progress-step">
                    <div class="progress-circle inactive">3</div>
                    <span class="progress-text">DADOS ENDEREÇO</span>
                </div>
            </div>
        </div>

        <div class="image-section">
            <div class="image-content">
                <h2 class="image-title">Sua Doação Faz a Diferença</h2>
                <p class="image-subtitle">Cada contribuição nos ajuda a continuar oferecendo cuidado, carinho e dignidade aos nossos idosos</p>
            </div>
        </div>
    </div>
</main>
@endsection