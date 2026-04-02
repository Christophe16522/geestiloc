<?php

namespace Database\Seeders;

use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = Carbon::today()->toDateString();

        $documents = [
            [
                'property_id'     => 1,
                'name'            => 'Contrat bail Sophie Martin',
                'category'        => 'contrat',
                'upload_date'     => $today,
                'expiration_date' => null,
                'file_path'       => 'documents/contrat_1.pdf',
                'file_size'       => 102400,
            ],
            [
                'property_id'     => 2,
                'name'            => 'Diagnostic DPE Apt Haussmannien',
                'category'        => 'diagnostic',
                'upload_date'     => $today,
                'expiration_date' => Carbon::today()->addYear()->toDateString(),
                'file_path'       => 'documents/dpe_1.pdf',
                'file_size'       => 204800,
            ],
            [
                'property_id'     => 3,
                'name'            => 'Assurance PNO 2025',
                'category'        => 'assurance',
                'upload_date'     => $today,
                'expiration_date' => '2025-12-31',
                'file_path'       => 'documents/assurance.pdf',
                'file_size'       => 51200,
            ],
            [
                'property_id'     => 4,
                'name'            => 'Quittance Janvier 2025',
                'category'        => 'quittance',
                'upload_date'     => $today,
                'expiration_date' => null,
                'file_path'       => 'documents/quittance_jan.pdf',
                'file_size'       => 25600,
            ],
        ];

        foreach ($documents as $data) {
            Document::create(array_merge($data, ['user_id' => 1]));
        }
    }
}
