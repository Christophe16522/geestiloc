<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maintenances = [
            [
                'property_id'         => 1,
                'title'               => 'Fuite robinet cuisine',
                'priority'            => 'haute',
                'status'              => 'en_cours',
                'progress_percentage' => 60,
                'estimated_cost'      => 150,
                'actual_cost'         => null,
                'completed_at'        => null,
            ],
            [
                'property_id'         => 2,
                'title'               => 'Peinture salon',
                'priority'            => 'basse',
                'status'              => 'a_faire',
                'progress_percentage' => 0,
                'estimated_cost'      => 400,
                'actual_cost'         => null,
                'completed_at'        => null,
            ],
            [
                'property_id'         => 3,
                'title'               => 'Chaudière — révision annuelle',
                'priority'            => 'moyenne',
                'status'              => 'termine',
                'progress_percentage' => 100,
                'estimated_cost'      => null,
                'actual_cost'         => 280,
                'completed_at'        => Carbon::now()->subDays(7),
            ],
            [
                'property_id'         => 5,
                'title'               => 'Électricité — mise aux normes',
                'priority'            => 'haute',
                'status'              => 'en_cours',
                'progress_percentage' => 30,
                'estimated_cost'      => 1200,
                'actual_cost'         => null,
                'completed_at'        => null,
            ],
        ];

        foreach ($maintenances as $data) {
            Maintenance::create(array_merge($data, ['user_id' => 1]));
        }
    }
}
