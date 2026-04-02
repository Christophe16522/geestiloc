<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            ['name' => 'Appartement Haussmannien', 'address' => '12 Rue de Rivoli',        'city' => 'Paris',     'postal_code' => '75001', 'type' => 'appartement', 'surface_m2' => 65,  'monthly_rent' => 1850, 'charges' => 150, 'deposit' => 3700, 'status' => 'occupee'],
            ['name' => 'Studio Bastille',           'address' => '8 Rue de la Roquette',    'city' => 'Paris',     'postal_code' => '75011', 'type' => 'studio',      'surface_m2' => 28,  'monthly_rent' => 950,  'charges' => 80,  'deposit' => 1900, 'status' => 'occupee'],
            ['name' => 'Maison Vincennes',          'address' => '3 Avenue de Paris',       'city' => 'Vincennes', 'postal_code' => '94300', 'type' => 'maison',      'surface_m2' => 120, 'monthly_rent' => 2200, 'charges' => 200, 'deposit' => 4400, 'status' => 'occupee'],
            ['name' => 'Appartement Nation',        'address' => '45 Boulevard de Picpus',  'city' => 'Paris',     'postal_code' => '75012', 'type' => 'appartement', 'surface_m2' => 55,  'monthly_rent' => 1450, 'charges' => 120, 'deposit' => 2900, 'status' => 'vacante'],
            ['name' => 'Local Commercial Marais',   'address' => '22 Rue des Archives',     'city' => 'Paris',     'postal_code' => '75004', 'type' => 'commercial',  'surface_m2' => 85,  'monthly_rent' => 3200, 'charges' => 300, 'deposit' => 9600, 'status' => 'occupee'],
            ['name' => 'Studio Montmartre',         'address' => '15 Rue Lepic',            'city' => 'Paris',     'postal_code' => '75018', 'type' => 'studio',      'surface_m2' => 22,  'monthly_rent' => 850,  'charges' => 60,  'deposit' => 1700, 'status' => 'vacante'],
        ];

        foreach ($properties as $data) {
            Property::create(array_merge($data, ['user_id' => 1]));
        }
    }
}
