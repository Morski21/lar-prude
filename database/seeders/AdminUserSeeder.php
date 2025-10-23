<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar se usuário admin existe
        $admin = \App\Models\User::where('email', 'admin@laridosos.com')->first();
        
        if (!$admin) {
            // Criar usuário admin se não existir
            $admin = \App\Models\User::create([
                'name' => 'Administrador',
                'email' => 'admin@laridosos.com',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'is_admin' => true,
            ]);

            $this->command->info('Usuário admin criado com sucesso!');
        } else {
            // Atualizar usuário existente para garantir que é admin
            $admin->update([
                'is_admin' => true,
                'name' => 'Administrador'
            ]);
            
            $this->command->info('Usuário admin atualizado com sucesso!');
        }
        
        $this->command->info('Email: admin@laridosos.com');
        $this->command->info('Senha: admin123');
        $this->command->info('is_admin: ' . ($admin->is_admin ? 'true' : 'false'));
    }
}
