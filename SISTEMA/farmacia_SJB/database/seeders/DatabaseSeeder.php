<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamada secuencial a los seeders del sistema
        $this->call([
            UserSeeder::class,
            MenuCategorySeeder::class,
            DishSeeder::class,
            RestTableSeeder::class,
            SettingSeeder::class, // Agregado aquí al final de la secuencia
        ]);
    }
}