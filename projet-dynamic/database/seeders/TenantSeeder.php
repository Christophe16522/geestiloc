<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            ['property_id' => 1, 'first_name' => 'Sophie',           'last_name' => 'Martin',  'email' => 'sophie.martin@email.fr',    'phone' => '06 12 34 56 78', 'monthly_rent' => 1850, 'lease_start_date' => '2023-01-01', 'payment_status' => 'paye'],
            ['property_id' => 2, 'first_name' => 'Lucas',            'last_name' => 'Bernard', 'email' => 'lucas.bernard@email.fr',    'phone' => '06 23 45 67 89', 'monthly_rent' => 950,  'lease_start_date' => '2022-06-01', 'payment_status' => 'retard'],
            ['property_id' => 3, 'first_name' => 'Marie',            'last_name' => 'Dubois',  'email' => 'marie.dubois@email.fr',     'phone' => '06 34 56 78 90', 'monthly_rent' => 2200, 'lease_start_date' => '2021-09-01', 'payment_status' => 'paye'],
            ['property_id' => 5, 'first_name' => 'SAS Boutique Trend','last_name' => '',        'email' => 'contact@boutique-trend.fr', 'phone' => '01 42 33 44 55', 'monthly_rent' => 3200, 'lease_start_date' => '2020-01-01', 'payment_status' => 'attente'],
            ['property_id' => null, 'first_name' => 'Thomas',        'last_name' => 'Petit',   'email' => 'thomas.petit@email.fr',     'phone' => '06 56 78 90 12', 'monthly_rent' => 0,    'lease_start_date' => null,         'payment_status' => 'attente'],
        ];

        foreach ($tenants as $data) {
            Tenant::create(array_merge($data, ['user_id' => 1]));
        }
    }
}
