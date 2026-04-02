<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\Document;
use App\Models\Maintenance;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function getKpiStats(): array
    {
        $userId = Auth::id();
        $currentMonth = now()->month;
        $currentYear  = now()->year;

        $totalProperties = Property::where('user_id', $userId)->count();
        $occupiedCount   = Property::where('user_id', $userId)->occupee()->count();
        $occupancyRate   = $totalProperties > 0 ? round($occupiedCount / $totalProperties * 100) : 0;

        $monthlyRevenue = Payment::where('user_id', $userId)
            ->paye()
            ->byMonth($currentMonth)
            ->byYear($currentYear)
            ->sum('amount');

        $lateTenantsCount = Tenant::where('user_id', $userId)->retard()->count();
        $activeMaintCount = Maintenance::where('user_id', $userId)->enCours()->count();

        return [
            'total_properties' => $totalProperties,
            'occupied_count'   => $occupiedCount,
            'vacant_count'     => $totalProperties - $occupiedCount,
            'occupancy_rate'   => $occupancyRate,
            'monthly_revenue'  => $monthlyRevenue,
            'late_tenants'     => $lateTenantsCount,
            'active_maintenances' => $activeMaintCount,
            'total_tenants'    => Tenant::where('user_id', $userId)->count(),
        ];
    }

    public function getAlerts(): array
    {
        $userId = Auth::id();
        $alerts = [];

        $latePayments = Tenant::where('user_id', $userId)->retard()->count();
        if ($latePayments > 0) {
            $alerts[] = ['type' => 'danger', 'message' => "{$latePayments} locataire(s) en retard de paiement"];
        }

        $expiringContracts = Contract::where('user_id', $userId)->expirant(30)->count();
        if ($expiringContracts > 0) {
            $alerts[] = ['type' => 'warning', 'message' => "{$expiringContracts} contrat(s) expirant dans 30 jours"];
        }

        $expiringDocs = Document::where('user_id', $userId)->expiringSoon(30)->count();
        if ($expiringDocs > 0) {
            $alerts[] = ['type' => 'warning', 'message' => "{$expiringDocs} document(s) expirant prochainement"];
        }

        $urgentMaintenances = Maintenance::where('user_id', $userId)->urgent()->count();
        if ($urgentMaintenances > 0) {
            $alerts[] = ['type' => 'danger', 'message' => "{$urgentMaintenances} maintenance(s) urgente(s) en attente"];
        }

        return $alerts;
    }

    public function getMonthlyRevenueChart(): array
    {
        $userId = Auth::id();
        $months = [];

        for ($i = 11; $i >= 0; $i--) {
            $date   = now()->subMonths($i);
            $month  = $date->month;
            $year   = $date->year;
            $amount = Payment::where('user_id', $userId)
                ->paye()
                ->byMonth($month)
                ->byYear($year)
                ->sum('amount');

            $months[] = [
                'label'  => $date->translatedFormat('M Y'),
                'amount' => (float) $amount,
            ];
        }

        return $months;
    }
}
