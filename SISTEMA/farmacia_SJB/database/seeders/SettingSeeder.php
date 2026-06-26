<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'restaurant_name' => 'El Huerto de Don José',
            'ruc' => '20123456789',
            'address' => 'Av. Principal 123, Miraflores, Lima',
            'phone' => '987654321',
            'igv_percentage' => 18.00, // Configurado con el estándar del 18%
            'logo_path' => null, // Se gestionará posteriormente desde el panel
            'facebook_url' => 'https://facebook.com/elhuertodedonjose',
            'instagram_url' => 'https://instagram.com/elhuertodedonjose',
            'receipt_footer' => '¡Gracias por su preferencia! Vuelva pronto.',
        ]);
    }
}