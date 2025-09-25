<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Usuário Teste',
            'email' => 'teste@teste.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
        ]);
    }
}