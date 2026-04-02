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
        $monthNames = [
            1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',
            7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Décembre',
        ];

        for ($m = 1; $m <= 12; $m++) {
            $paid    = (float) Payment::where('user_id', $userId)->paye()->byMonth($m)->byYear($year)->sum('amount');
            $pending = (float) Payment::where('user_id', $userId)->attente()->byMonth($m)->byYear($year)->sum('amount');
            $late    = (float) Payment::where('user_id', $userId)->retard()->byMonth($m)->byYear($year)->sum('amount');

            $months[] = [
                'label'   => $monthNames[$m],
                'paid'    => $paid,
                'pending' => $pending,
                'late'    => $late,
                'total'   => $paid + $pending + $late,
            ];
        }

        return [
            'year'           => $year,
            'monthly'        => $months,
            'annual_paid'    => array_sum(array_column($months, 'paid')),
            'annual_pending' => array_sum(array_column($months, 'pending')),
            'annual_late'    => array_sum(array_column($months, 'late')),
            'annual_total'   => array_sum(array_column($months, 'total')),
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
