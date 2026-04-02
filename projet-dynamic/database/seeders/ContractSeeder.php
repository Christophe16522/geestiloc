<?php

namespace Database\Seeders;

use App\Models\Contract;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contracts = [
            [
                'tenant_id'    => 1,
                'property_id'  => 1,
                'type'         => 'vide',
                'start_date'   => '2023-01-01',
                'end_date'     => '2024-12-31',
                'monthly_rent' => 1850,
                'charges'      => 150,
                'deposit'      => 3700,
                'status'       => 'actif',
            ],
            [
                'tenant_id'    => 2,
                'property_id'  => 2,
                'type'         => 'meuble',
                'start_date'   => '2022-06-01',
                'end_date'     => '2023-05-31',
                'monthly_rent' => 950,
                'charges'      => 80,
                'deposit'      => 1900,
                'status'       => 'expire',
            ],
            [
                'tenant_id'    => 3,
                'property_id'  => 3,
                'type'         => 'vide',
                'start_date'   => '2021-09-01',
                'end_date'     => '2024-08-31',
                'monthly_rent' => 2200,
                'charges'      => 200,
                'deposit'      => 4400,
                'status'       => 'actif',
            ],
            [
                'tenant_id'    => 4,
                'property_id'  => 5,
                'type'         => 'commercial',
                'start_date'   => '2020-01-01',
                'end_date'     => '2026-12-31',
                'monthly_rent' => 3200,
                'charges'      => 300,
                'deposit'      => 9600,
                'status'       => 'actif',
            ],
        ];

        foreach ($contracts as $data) {
            Contract::create(array_merge($data, ['user_id' => 1]));
        }
    }
}
