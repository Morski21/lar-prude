<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Doacao extends Model
{
    protected $table = 'doacoes';
    
    protected $fillable = [
        'nome',
        'email', 
        'telefone',
        'data_nascimento',
        'aceita_comunicacoes',
        'tipo_doacao',
        'valor',
        'frequencia',
        'descricao_itens',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'status',
        'observacoes',
        'data_recebimento'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'aceita_comunicacoes' => 'boolean',
        'valor' => 'decimal:2',
        'data_recebimento' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relacionamento com endereço
    public function endereco(): HasOne
    {
        return $this->hasOne(Endereco::class);
    }

    // Scopes
    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    public function scopeEmEspera($query)
    {
        return $query->where('status', 'em_espera');
    }

    public function scopeAceitas($query)
    {
        return $query->where('status', 'aceita');
    }

    public function scopeRecusadas($query)
    {
        return $query->where('status', 'recusada');
    }

    public function scopeReagendadas($query)
    {
        return $query->where('status', 'reagendada');
    }

    public function scopeConfirmadas($query)
    {
        return $query->where('status', 'confirmada');
    }

    public function scopeRecebidas($query)
    {
        return $query->where('status', 'recebida');
    }

    // Accessors
    public function getValorFormatadoAttribute()
    {
        return $this->valor ? 'R$ ' . number_format($this->valor, 2, ',', '.') : null;
    }

    public function getTipoDoacaoFormatadoAttribute()
    {
        $tipos = [
            'dinheiro' => 'Doação em Dinheiro',
            'alimentos' => 'Doação de Alimentos', 
            'material' => 'Doação de Materiais'
        ];

        return $tipos[$this->tipo_doacao] ?? $this->tipo_doacao;
    }

    public function getFrequenciaFormatadaAttribute()
    {
        $frequencias = [
            'unica' => 'Doação Única',
            'mensal' => 'Doação Mensal',
            'trimestral' => 'Doação Trimestral'
        ];

        return $frequencias[$this->frequencia] ?? $this->frequencia;
    }
}
