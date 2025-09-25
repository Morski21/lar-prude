@extends('layouts.simple')

@section('title', 'Contato - Lar dos Idosos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="contact-hero-content">
            <h1>Entre em Contato</h1>
            <p>Estamos aqui para ajudar. Entre em contato conosco para mais informações sobre como você pode contribuir.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-container">
            <div class="contact-grid">
                <!-- Contact Information -->
                <div class="contact-info">
                    <h2>Informações de Contato</h2>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <h3>Endereço</h3>
                            <p>Rua Cel João Pedro Martins - Centro<br>Prudentópolis - PR, 84400-000</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <h3>Telefone</h3>
                            <p>(42) 3446-1494</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <h3>Horário de Funcionamento</h3>
                            <p>Segunda a Sexta: 8h às 17h<br>Sábado: 8h às 12h</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form">
                    <h2>Envie sua Mensagem</h2>
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Nome Completo</label>
                            <input type="text" id="name" name="name" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" id="email" name="email" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="tel" id="phone" name="phone" class="form-input">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">Assunto</label>
                            <select id="subject" name="subject" class="form-input" required>
                                <option value="">Selecione um assunto</option>
                                <option value="doacao">Informações sobre Doações</option>
                                <option value="voluntario">Quero ser Voluntário</option>
                                <option value="visita">Agendar Visita</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Mensagem</label>
                            <textarea id="message" name="message" class="form-textarea" placeholder="Conte-nos como podemos ajudar..." required></textarea>
                        </div>

                        <button type="submit" class="form-submit">Enviar Mensagem</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="map-container">
            <h2>Nossa Localização</h2>
            <div class="map-wrapper">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3609.1234567890123!2d-50.9876543210987!3d-25.1234567890123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjXCsDA3JzI0LjQiUyA1MMKwNTknMTUuNiJX!5e0!3m2!1spt-BR!2sbr!4v1234567890123!5m2!1spt-BR!2sbr"
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>
@endsection

