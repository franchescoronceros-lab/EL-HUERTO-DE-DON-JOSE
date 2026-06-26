<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario Administrador
        User::create([
            'name' => 'Administrador Don José',
            'email' => 'admin@elhuerto.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Crear usuario Mozo 1
        User::create([
            'name' => 'Carlos Mendoza (Mozo)',
            'email' => 'carlos@elhuerto.com',
            'password' => Hash::make('mozo123'),
            'role' => 'waiter',
        ]);

        // Crear usuario Mozo 2
        User::create([
            'name' => 'María Silva (Mozo)',
            'email' => 'maria@elhuerto.com',
            'password' => Hash::make('mozo123'),
            'role' => 'waiter',
        ]);
    }
}