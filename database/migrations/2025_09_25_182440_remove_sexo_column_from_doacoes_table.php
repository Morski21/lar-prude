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
        Schema::table('doacoes', function (Blueprint $table) {
            $table->dropColumn('sexo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doacoes', function (Blueprint $table) {
            $table->enum('sexo', ['masculino', 'feminino', 'outro'])->after('data_nascimento');
        });
    }
};
