<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RestTable;

class RestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mesas del Salón Principal (main_hall)
        RestTable::create([
            'table_number' => 'Mesa 1',
            'capacity' => 4,
            'status' => 'available',
            'location' => 'main_hall',
        ]);

        RestTable::create([
            'table_number' => 'Mesa 2',
            'capacity' => 4,
            'status' => 'available',
            'location' => 'main_hall',
        ]);

        RestTable::create([
            'table_number' => 'Mesa 3',
            'capacity' => 6,
            'status' => 'available',
            'location' => 'main_hall',
        ]);

        // Mesas de la Terraza (terrace)
        RestTable::create([
            'table_number' => 'Mesa 4',
            'capacity' => 2,
            'status' => 'available',
            'location' => 'terrace',
        ]);

        // Mesa de la Zona de Barra (bar)
        RestTable::create([
            'table_number' => 'Mesa Barra 5',
            'capacity' => 2,
            'status' => 'available',
            'location' => 'bar',
        ]);

        // Configuración virtual para pedidos para llevar o entrega (delivery)
        RestTable::create([
            'table_number' => 'Mesa Delivery',
            'capacity' => 1,
            'status' => 'available',
            'location' => 'delivery',
        ]);
    }
}