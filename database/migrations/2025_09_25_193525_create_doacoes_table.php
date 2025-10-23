<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doacoes', function (Blueprint $table) {
            $table->id();
            
            // Dados pessoais (etapa 1)
            $table->string('nome');
            $table->string('email');
            $table->string('telefone');
            $table->date('data_nascimento');
            $table->enum('sexo', ['masculino', 'feminino', 'outro']);
            $table->boolean('aceita_comunicacoes')->default(false);
            
            // Dados da doação (etapa 2)
            $table->enum('tipo_doacao', ['dinheiro', 'alimentos', 'material']);
            $table->decimal('valor', 10, 2)->nullable(); // Para doações em dinheiro
            $table->enum('frequencia', ['unica', 'mensal', 'trimestral']);
            $table->text('descricao_itens')->nullable(); // Para doações não-monetárias
            
            // Dados do endereço (etapa 3)
            $table->string('cep');
            $table->string('logradouro');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado', 2);
            
            // Status da doação
            $table->enum('status', ['pendente', 'em_espera', 'aceita', 'recusada', 'reagendada', 'confirmada', 'recebida', 'cancelada'])->default('pendente');
            $table->text('observacoes')->nullable();
            $table->timestamp('data_recebimento')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doacoes');
    }
};
