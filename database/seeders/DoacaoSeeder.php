<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doacao;
use App\Models\Endereco;

class DoacaoSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $doacao = Doacao::create([
            'nome' => 'Usuário Teste',
            'email' => 'teste@teste.com',
            'telefone' => '(42) 99999-9999',
            'data_nascimento' => '1990-01-01',
            'aceita_comunicacoes' => true,
            'tipo_doacao' => 'dinheiro',
            'valor' => 100.00,
            'frequencia' => 'unica',
            'descricao_itens' => null,
            'cep' => '84400000',
            'logradouro' => 'Rua Cel João Pedro Martins',
            'numero' => 'Centro',
            'complemento' => null,
            'bairro' => 'Centro',
            'cidade' => 'Prudentópolis',
            'estado' => 'PR',
            'status' => 'em_espera'
        ]);

        Endereco::create([
            'doacao_id' => $doacao->id,
            'cep' => '84400000',
            'logradouro' => 'Rua Cel João Pedro Martins',
            'numero' => 'Centro',
            'complemento' => null,
            'bairro' => 'Centro',
            'cidade' => 'Prudentópolis',
            'estado' => 'PR',
            'tipo' => 'entrega',
            'instrucoes' => 'Teste de doação'
        ]);
    }
}