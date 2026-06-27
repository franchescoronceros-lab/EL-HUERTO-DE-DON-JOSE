<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CashierUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertamos al usuario encargado de la caja con el rol correspondiente
        User::create([
            'name'     => 'Lucía Portocarrero (Caja)',
            'email'    => 'lucia@elhuerto.com',
            'password' => Hash::make('caja1234'), // Credencial de acceso rápido para pruebas
            'role'     => 'cashier',
        ]);
    }
}