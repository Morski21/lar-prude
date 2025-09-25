<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Atualizar o enum de status para incluir os novos status
        DB::statement("ALTER TABLE doacoes MODIFY COLUMN status ENUM('pendente', 'em_espera', 'aceita', 'recusada', 'reagendada', 'confirmada', 'recebida', 'cancelada') DEFAULT 'pendente'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverter para o enum original
        DB::statement("ALTER TABLE doacoes MODIFY COLUMN status ENUM('pendente', 'confirmada', 'recebida', 'cancelada') DEFAULT 'pendente'");
    }
};