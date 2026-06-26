<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dish;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // === ENTRADAS (menu_category_id: 1) ===
        Dish::create([
            'menu_category_id' => 1,
            'name' => 'Ceviche Clásico',
            'description' => 'Pescado fresco del día marinado en limón sutil, acompañado de camote, choclo y cancha.',
            'price' => 35.00,
            'stock' => 50,
            'image' => null,
            'is_active' => true,
        ]);

         Dish::create([
            'menu_category_id' => 1,
            'name' => 'Causa Rellena de Pollo',
            'description' => 'Masa de papa amarilla sazonada con ají amarillo y limón, rellena de pollo e hilos de palta.',
            'price' => 18.00,
            'stock' => 40,
            'image' => null,
            'is_active' => true,
        ]);

        // === PLATOS DE FONDO (menu_category_id: 2) ===
        Dish::create([
            'menu_category_id' => 2,
            'name' => 'Lomo Saltado',
            'description' => 'Jugosos trozos de lomo de res salteados al wok con cebolla, tomate, ají amarillo, acompañados de papas fritas y arroz.',
            'price' => 45.00,
            'stock' => 60,
            'image' => null,
            'is_active' => true,
        ]);

        Dish::create([
            'menu_category_id' => 2,
            'name' => 'Ají de Gallina',
            'description' => 'Pechuga de pollo deshilachada en una crema de ají amarillo, leche y queso de la casa, con arroz con bife.',
            'price' => 32.00,
            'stock' => 45,
            'image' => null,
            'is_active' => true,
        ]);

        // === BEBIDAS (menu_category_id: 3) ===
        Dish::create([
            'menu_category_id' => 3,
            'name' => 'Chicha Morada (1 Litro)',
            'description' => 'Refrescante bebida tradicional a base de maíz morado, frutas y un toque de limón y canela.',
            'price' => 15.00,
            'stock' => 100,
            'image' => null,
            'is_active' => true,
        ]);

        Dish::create([
            'menu_category_id' => 3,
            'name' => 'Maracuyá (Jarra)',
            'description' => 'Jarra de jugo natural de la fruta de la pasión bien helada.',
            'price' => 14.00,
            'stock' => 80,
            'image' => null,
            'is_active' => true,
        ]);

        // === POSTRES (menu_category_id: 4) ===
        Dish::create([
            'menu_category_id' => 4,
            'name' => 'Suspiro a la Limeña',
            'description' => 'Clásico manjar blanco limeño cubierto de un suave merengue al oporto con canela.',
            'price' => 12.00,
            'stock' => 30,
            'image' => null,
            'is_active' => true,
        ]);
    }
}