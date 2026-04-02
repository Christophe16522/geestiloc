<?php

namespace Database\Seeders;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenantPayments = [
            ['tenant_id' => 1, 'property_id' => 1, 'amount' => 1850, 'status' => 'paye'],
            ['tenant_id' => 2, 'property_id' => 2, 'amount' => 950,  'status' => 'retard'],
            ['tenant_id' => 3, 'property_id' => 3, 'amount' => 2200, 'status' => 'paye'],
            ['tenant_id' => 4, 'property_id' => 5, 'amount' => 3200, 'status' => 'attente'],
        ];

        $months = [
            Carbon::now()->subMonths(2),
            Carbon::now()->subMonth(),
            Carbon::now(),
        ];

        foreach ($months as $month) {
            foreach ($tenantPayments as $data) {
                Payment::create([
                    'user_id'      => 1,
                    'tenant_id'    => $data['tenant_id'],
                    'property_id'  => $data['property_id'],
                    'amount'       => $data['amount'],
                    'period_month' => (int) $month->format('n'),
                    'period_year'  => (int) $month->format('Y'),
                    'status'       => $data['status'],
                    'payment_date' => $data['status'] === 'paye' ? $month->copy()->day(5)->toDateString() : null,
                ]);
            }
        }
    }
}
