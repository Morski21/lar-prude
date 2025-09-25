@extends('layouts.simple')

@section('title', 'Lar dos Idosos - Cuidando com Amor')

@section('content')
<section class="hero">
    <div class="hero-content">
        <h1>Cuidando com Amor e Dignidade</h1>
        <p>Sua doação aquece vidas e leva carinho a quem já cuidou de tantas gerações. Juntos, podemos fazer a diferença na vida dos nossos idosos.</p>
        <div class="hero-buttons">
            <a href="/doar" class="btn-primary">Fazer Doação</a>
            <a href="/prioridades" class="btn-secondary">Ver Prioridades</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Nossos Números</h2>
            <p class="section-subtitle">Conheça o impacto do nosso trabalho na comunidade</p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-icon">👥</span>
                <span class="stat-number">50+</span>
                <div class="stat-label">Idosos Atendidos</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon">⏰</span>
                <span class="stat-number">24h</span>
                <div class="stat-label">Cuidado Contínuo</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon">🤝</span>
                <span class="stat-number">200+</span>
                <div class="stat-label">Voluntários</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon">🏆</span>
                <span class="stat-number">15+</span>
                <div class="stat-label">Anos de Experiência</div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Nossa Instituição</h2>
            <p class="section-subtitle">Conheça o ambiente acolhedor e os momentos especiais que proporcionamos aos nossos idosos</p>
        </div>
        
        <div class="carousel-container">
            <div class="carousel-wrapper">
                <div class="carousel-slides" id="carouselSlides">
                    <div class="carousel-slide active">
                        <div class="carousel-image">
                            <div class="image-placeholder">
                                <div class="placeholder-icon">📸</div>
                            </div>
                        </div>
                        <div class="carousel-content">
                            <h3>Atividades Recreativas</h3>
                            <p>Momentos de alegria e socialização que trazem vida e energia aos nossos idosos</p>
                        </div>
                    </div>
                    
                    <div class="carousel-slide">
                        <div class="carousel-image">
                            <div class="image-placeholder">
                                <div class="placeholder-icon">📸</div>
                            </div>
                        </div>
                        <div class="carousel-content">
                            <h3>Cuidado Médico</h3>
                            <p>Atendimento especializado e acompanhamento contínuo para garantir o bem-estar</p>
                        </div>
                    </div>
                    
                    <div class="carousel-slide">
                        <div class="carousel-image">
                            <div class="image-placeholder">
                                <div class="placeholder-icon">📸</div>
                            </div>
                        </div>
                        <div class="carousel-content">
                            <h3>Alimentação Balanceada</h3>
                            <p>Cardápio nutritivo preparado com carinho e adaptado às necessidades de cada idoso</p>
                        </div>
                    </div>
                    
                    <div class="carousel-slide">
                        <div class="carousel-image">
                            <div class="image-placeholder">
                                <div class="placeholder-icon">📸</div>
                            </div>
                        </div>
                        <div class="carousel-content">
                            <h3>Equipe Especializada</h3>
                            <p>Profissionais dedicados e qualificados prontos para oferecer o melhor cuidado</p>
                        </div>
                    </div>
                    
                    <div class="carousel-slide">
                        <div class="carousel-image">
                            <div class="image-placeholder">
                                <div class="placeholder-icon">📸</div>
                            </div>
                        </div>
                        <div class="carousel-content">
                            <h3>Ambiente Acolhedor</h3>
                            <p>Instalações confortáveis e seguras que proporcionam um lar verdadeiro</p>
                        </div>
                    </div>
                </div>
                
                <button class="carousel-btn carousel-prev" id="prevBtn">
                    <span>‹</span>
                </button>
                <button class="carousel-btn carousel-next" id="nextBtn">
                    <span>›</span>
                </button>
                
                <div class="carousel-dots">
                    <span class="dot active" data-slide="0"></span>
                    <span class="dot" data-slide="1"></span>
                    <span class="dot" data-slide="2"></span>
                    <span class="dot" data-slide="3"></span>
                    <span class="dot" data-slide="4"></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonials">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">O que Dizem Sobre Nós</h2>
            <p class="section-subtitle">Depoimentos de familiares e pessoas que conhecem nosso trabalho</p>
        </div>
        
        <div class="testimonial-grid">
            <div class="testimonial-card">
                <p class="testimonial-text">"O Lar dos Idosos transformou a vida da minha mãe. Ela recebe todo o cuidado e carinho que precisa, e eu tenho a tranquilidade de saber que ela está em boas mãos."</p>
                <div class="testimonial-author">Maria Silva</div>
                <div class="testimonial-role">Filha de residente</div>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text">"A dedicação da equipe é impressionante. Meu pai sempre fala sobre o carinho que recebe e como se sente acolhido. É mais que um lar, é uma família."</p>
                <div class="testimonial-author">João Santos</div>
                <div class="testimonial-role">Filho de residente</div>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text">"Como voluntária, posso ver de perto o amor e dedicação que cada funcionário tem pelos idosos. É um trabalho que realmente faz a diferença."</p>
                <div class="testimonial-author">Ana Costa</div>
                <div class="testimonial-role">Voluntária</div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="cta-content">
        <h2 class="cta-title">Sua Doação Faz a Diferença</h2>
        <p class="cta-subtitle">Cada contribuição nos ajuda a continuar oferecendo cuidado, carinho e dignidade aos nossos idosos. Junte-se a nós nesta missão de amor.</p>
        <div class="cta-buttons">
            <a href="/doar" class="btn">Fazer uma Doação</a>
            <a href="/prioridades" class="btn secondary">Ver Itens Necessários</a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    <script type="module" src="{{ asset('js/carousel.js') }}"></script>
@else
    <script src="{{ asset('js/carousel.js') }}"></script>
@endif
@endpush