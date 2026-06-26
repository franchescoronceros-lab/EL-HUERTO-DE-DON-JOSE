<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuCategory;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categoría 1: Entradas
        MenuCategory::create([
            'name' => 'Entradas',
            'description' => 'Aperitivos y platos ligeros para empezar.',
            'display_order' => 1,
            'is_active' => true,
        ]);

        // Categoría 2: Platos de Fondo
        MenuCategory::create([
            'name' => 'Platos de Fondo',
            'description' => 'Los platos principales y especialidades de la casa.',
            'display_order' => 2,
            'is_active' => true,
        ]);

        // Categoría 3: Bebidas
        MenuCategory::create([
            'name' => 'Bebidas',
            'description' => 'Refrescos naturales, gaseosas y licores.',
            'display_order' => 3,
            'is_active' => true,
        ]);

        // Categoría 4: Postres
        MenuCategory::create([
            'name' => 'Postres',
            'description' => 'Delicias dulces para cerrar con broche de oro.',
            'display_order' => 4,
            'is_active' => true,
        ]);
    }
}