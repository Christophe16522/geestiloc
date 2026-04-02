<?php

namespace App\Services;

use App\Models\Maintenance;
use App\Models\Payment;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class ReportService
{
    public function getFinancialReport(int $year): array
    {
        $userId = Auth::id();
        $months = [];

        for ($m = 1; $m <= 12; $m++) {
            $paid    = Payment::where('user_id', $userId)->paye()->byMonth($m)->byYear($year)->sum('amount');
            $pending = Payment::where('user_id', $userId)->attente()->byMonth($m)->byYear($year)->sum('amount');
            $late    = Payment::where('user_id', $userId)->retard()->byMonth($m)->byYear($year)->sum('amount');

            $months[$m] = [
                'paid'    => (float) $paid,
                'pending' => (float) $pending,
                'late'    => (float) $late,
                'total'   => (float) ($paid + $pending + $late),
            ];
        }

        return [
            'year'         => $year,
            'monthly'      => $months,
            'annual_total' => array_sum(array_column($months, 'paid')),
        ];
    }

    public function getOccupancyReport(): array
    {
        $userId = Auth::id();
        $total    = Property::where('user_id', $userId)->count();
        $occupied = Property::where('user_id', $userId)->occupee()->count();
        $vacant   = $total - $occupied;

        $byType = Property::where('user_id', $userId)
            ->selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        return [
            'total'    => $total,
            'occupied' => $occupied,
            'vacant'   => $vacant,
            'rate'     => $total > 0 ? round($occupied / $total * 100, 1) : 0,
            'by_type'  => $byType,
        ];
    }

    public function getMaintenanceReport(): array
    {
        $userId = Auth::id();

        return [
            'a_faire'   => Maintenance::where('user_id', $userId)->aFaire()->count(),
            'en_cours'  => Maintenance::where('user_id', $userId)->enCours()->count(),
            'termine'   => Maintenance::where('user_id', $userId)->termine()->count(),
            'urgent'    => Maintenance::where('user_id', $userId)->urgent()->count(),
            'total_cost' => Maintenance::where('user_id', $userId)->termine()->sum('actual_cost'),
        ];
    }
}
