@extends('layouts.app')

@section('title', 'Dashboard Administrativo - Lar dos Idosos')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1 class="admin-title">Dashboard Administrativo</h1>
        <p class="admin-subtitle">Gerencie as doações do Lar dos Idosos</p>
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

    @if(session('error'))
        <div class="alert alert-error">
            <div class="alert-icon">❌</div>
            <div class="alert-content">
                <h4>Erro!</h4>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Estatísticas Resumidas -->
    <div class="stats-grid">
        <div class="stat-card pending">
            <div class="stat-content">
                <h3>{{ $stats['doacoes_pendentes'] }}</h3>
                <p>Pendentes</p>
            </div>
        </div>

        <div class="stat-card accepted">
            <div class="stat-content">
                <h3>{{ $stats['doacoes_aceitas'] }}</h3>
                <p>Aceitas</p>
            </div>
        </div>

        <div class="stat-card completed">
            <div class="stat-content">
                <h3>{{ $stats['doacoes_recebidas'] }}</h3>
                <p>Recebidas</p>
            </div>
        </div>
    </div>

    <!-- Filtros Rápidos -->
    <div class="quick-actions">
        <div class="filter-buttons">
            <button onclick="filterDonations('all')" class="filter-btn active" id="filter-all">
                Todas
            </button>

            @if($stats['doacoes_pendentes'] > 0)
            <button onclick="filterDonations('em_espera')" class="filter-btn filter-pending" id="filter-pending">
                Pendentes ({{ $stats['doacoes_pendentes'] }})
            </button>
            @endif

            <button onclick="filterDonations('aceita')" class="filter-btn filter-accepted" id="filter-accepted">
                Aceitas
            </button>

            <button onclick="filterDonations('recebida')" class="filter-btn filter-completed" id="filter-received">
                Recebidas
            </button>
        </div>
    </div>

    <!-- Todas as Doações -->
    <div class="recent-donations">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Gerenciar Doações</h2>
            <input type="text" id="searchInput" placeholder="Buscar doador..." style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; width: 200px;">
        </div>
        
        @if($doacoes->count() > 0)
            <div class="donations-table">
                <table id="donationsTable">
                    <thead>
                        <tr>
                            <th>Doador</th>
                            <th>Tipo</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doacoes as $doacao)
                            <tr data-status="{{ $doacao->status }}" data-donor="{{ strtolower($doacao->nome) }}">
                                <td>
                                    <div class="donor-info">
                                        <strong>{{ $doacao->nome }}</strong>
                                        <small>{{ $doacao->email }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="type-badge type-{{ $doacao->tipo_doacao }}">
                                        {{ ucfirst($doacao->tipo_doacao) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $doacao->status }}">
                                        {{ ucfirst(str_replace('_', ' ', $doacao->status)) }}
                                    </span>
                                </td>
                                <td>{{ $doacao->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.donations.show', $doacao->id) }}" class="btn btn-sm btn-primary">
                                            Ver
                                        </a>
                                        
                                        @if($doacao->status == 'em_espera')
                                            <form method="POST" action="{{ route('admin.donations.accept', $doacao->id) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Aceitar esta doação?')">
                                                    Aceitar
                                                </button>
                                            </form>
                                        @endif

                                        @if(in_array($doacao->status, ['aceita', 'confirmada']))
                                            <form method="POST" action="{{ route('admin.donations.received', $doacao->id) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Marcar como recebida?')">
                                                    Recebida
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="pagination-wrapper" style="margin-top: 20px; text-align: center;">
                {{ $doacoes->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <h3>Nenhuma doação encontrada</h3>
                <p>Ainda não há doações registradas no sistema.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
// Cache de elementos para melhor performance
const donationsTable = document.getElementById('donationsTable');
const filterButtons = document.querySelectorAll('.filter-btn');
let cachedRows = null;

// Filtros por status otimizados
function filterDonations(status) {
    if (!cachedRows) {
        cachedRows = Array.from(donationsTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr'));
    }
    
    // Atualizar botões ativos de forma eficiente
    filterButtons.forEach(btn => btn.classList.remove('active'));
    
    const activeButton = status === 'all' ? 
        document.getElementById('filter-all') : 
        document.getElementById('filter-' + status.replace('_', ''));
    
    if (activeButton) activeButton.classList.add('active');
    
    // Filtrar linhas usando requestAnimationFrame para melhor performance
    requestAnimationFrame(() => {
        cachedRows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            row.style.display = (status === 'all' || rowStatus === status) ? '' : 'none';
        });
    });
}

// Busca otimizada com debounce
let searchTimeout;
const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    const searchTerm = this.value.toLowerCase();
    
    searchTimeout = setTimeout(() => {
        if (!cachedRows) {
            cachedRows = Array.from(donationsTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr'));
        }
        
        requestAnimationFrame(() => {
            cachedRows.forEach(row => {
                const donorName = row.getAttribute('data-donor');
                row.style.display = donorName.includes(searchTerm) ? '' : 'none';
            });
        });
    }, 200); // Debounce de 200ms
});

// Inicialização otimizada
document.addEventListener('DOMContentLoaded', function() {
    // Cache inicial das linhas
    cachedRows = Array.from(donationsTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr'));
    filterDonations('all');
});
</script>

<style>
/* Filtros modernos */
.filter-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 30px;
}

.filter-btn {
    padding: 12px 24px;
    border: 2px solid #e9ecef;
    background: white;
    color: #6c757d;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.filter-btn:hover {
    border-color: #007bff;
    color: #007bff;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.15);
}

.filter-btn.active {
    background: #007bff;
    border-color: #007bff;
    color: white;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

.filter-btn.filter-pending.active {
    background: #f39c12;
    border-color: #f39c12;
}

.filter-btn.filter-accepted.active {
    background: #27ae60;
    border-color: #27ae60;
}

.filter-btn.filter-completed.active {
    background: #9b59b6;
    border-color: #9b59b6;
}

/* Cards de estatísticas mais limpos */
.stat-card {
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
}

.stat-card.pending::before {
    background: #f39c12;
}

.stat-card.accepted::before {
    background: #27ae60;
}

.stat-card.completed::before {
    background: #9b59b6;
}

.stat-content {
    padding-left: 20px;
}

.stat-content h3 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-content p {
    font-size: 0.95rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Botões de ação mais profissionais */
.btn {
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.8rem;
}

@media (max-width: 768px) {
    .filter-buttons {
        flex-direction: column;
    }
    
    .filter-btn {
        text-align: center;
    }
}
</style>
@endpush
