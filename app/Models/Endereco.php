<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endereco extends Model
{
    protected $table = 'enderecos';
    
    protected $fillable = [
        'doacao_id',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'tipo',
        'instrucoes'
    ];

    // Relacionamento com doação
    public function doacao(): BelongsTo
    {
        return $this->belongsTo(Doacao::class);
    }

    // Accessors
    public function getEnderecoCompletoAttribute()
    {
        $endereco = $this->logradouro . ', ' . $this->numero;
        
        if ($this->complemento) {
            $endereco .= ', ' . $this->complemento;
        }
        
        $endereco .= ' - ' . $this->bairro . ', ' . $this->cidade . '/' . $this->estado;
        $endereco .= ' - CEP: ' . $this->cep;
        
        return $endereco;
    }

    public function getCepFormatadoAttribute()
    {
        return substr($this->cep, 0, 5) . '-' . substr($this->cep, 5);
    }
}
