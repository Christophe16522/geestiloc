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
        $userId       = Auth::id();
        $currentMonth = now()->month;
        $currentYear  = now()->year;

        $totalProperties = Property::where('user_id', $userId)->count();
        $occupiedCount   = Property::where('user_id', $userId)->occupee()->count();
        $occupancyRate   = $totalProperties > 0 ? round($occupiedCount / $totalProperties * 100) : 0;

        $monthlyRevenue = Payment::where('user_id', $userId)
            ->paye()->byMonth($currentMonth)->byYear($currentYear)->sum('amount');

        $lateTenantsCount = Tenant::where('user_id', $userId)->retard()->count();

        return [
            'total_properties'    => $totalProperties,
            'occupied_count'      => $occupiedCount,
            'vacant_count'        => $totalProperties - $occupiedCount,
            'occupancy_rate'      => $occupancyRate,
            'monthly_revenue'     => (float) $monthlyRevenue,
            'late_tenants'        => $lateTenantsCount,
            'total_tenants'       => Tenant::where('user_id', $userId)->count(),
            'active_contracts'    => Contract::where('user_id', $userId)->actif()->count(),
            'active_maintenances' => Maintenance::where('user_id', $userId)->enCours()->count(),
        ];
    }

    public function getAlerts(): array
    {
        $userId = Auth::id();
        $alerts = [];

        $latePayments = Tenant::where('user_id', $userId)->retard()->count();
        if ($latePayments > 0) {
            $alerts[] = ['type' => 'danger', 'icon' => 'triangle-exclamation', 'message' => "{$latePayments} locataire(s) en retard de paiement"];
        }

        $expiringContracts = Contract::where('user_id', $userId)->expirant(30)->count();
        if ($expiringContracts > 0) {
            $alerts[] = ['type' => 'warning', 'icon' => 'file-signature', 'message' => "{$expiringContracts} contrat(s) expirant dans 30 jours"];
        }

        $expiringDocs = Document::where('user_id', $userId)->expiringSoon(30)->count();
        if ($expiringDocs > 0) {
            $alerts[] = ['type' => 'warning', 'icon' => 'folder-tree', 'message' => "{$expiringDocs} document(s) expirant prochainement"];
        }

        $urgentMaintenances = Maintenance::where('user_id', $userId)->urgent()->count();
        if ($urgentMaintenances > 0) {
            $alerts[] = ['type' => 'danger', 'icon' => 'screwdriver-wrench', 'message' => "{$urgentMaintenances} maintenance(s) urgente(s) en attente"];
        }

        return $alerts;
    }

    /** 12 derniers mois : revenus encaissés */
    public function getMonthlyRevenueChart(): array
    {
        $userId = Auth::id();
        $months = [];

        for ($i = 11; $i >= 0; $i--) {
            $date   = now()->subMonths($i);
            $amount = Payment::where('user_id', $userId)
                ->paye()->byMonth($date->month)->byYear($date->year)->sum('amount');

            $months[] = [
                'label'  => $date->translatedFormat('M Y'),
                'amount' => (float) $amount,
            ];
        }

        return $months;
    }

    /** Répartition paiements du mois courant : payé / en attente / retard */
    public function getPaymentStatusChart(): array
    {
        $userId = Auth::id();
        $m = now()->month;
        $y = now()->year;

        return [
            'paid'    => (float) Payment::where('user_id', $userId)->paye()->byMonth($m)->byYear($y)->sum('amount'),
            'pending' => (float) Payment::where('user_id', $userId)->attente()->byMonth($m)->byYear($y)->sum('amount'),
            'late'    => (float) Payment::where('user_id', $userId)->retard()->byMonth($m)->byYear($y)->sum('amount'),
        ];
    }

    /** Biens par statut : occupé / vacant */
    public function getOccupancyChart(): array
    {
        $userId = Auth::id();
        $occupied = Property::where('user_id', $userId)->occupee()->count();
        $total    = Property::where('user_id', $userId)->count();

        return [
            'occupied' => $occupied,
            'vacant'   => max(0, $total - $occupied),
        ];
    }

    /** Biens par type */
    public function getPropertiesByTypeChart(): array
    {
        $userId = Auth::id();

        return Property::where('user_id', $userId)
            ->selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();
    }

    /** Interventions par statut */
    public function getMaintenanceStatusChart(): array
    {
        $userId = Auth::id();

        return [
            'a_faire'  => Maintenance::where('user_id', $userId)->aFaire()->count(),
            'en_cours' => Maintenance::where('user_id', $userId)->enCours()->count(),
            'termine'  => Maintenance::where('user_id', $userId)->termine()->count(),
        ];
    }

    /** Revenus des 6 derniers mois : encaissé vs attendu */
    public function getRevenueVsExpectedChart(): array
    {
        $userId = Auth::id();
        $data   = [];

        for ($i = 5; $i >= 0; $i--) {
            $date    = now()->subMonths($i);
            $paid    = (float) Payment::where('user_id', $userId)->paye()->byMonth($date->month)->byYear($date->year)->sum('amount');
            $pending = (float) Payment::where('user_id', $userId)->attente()->byMonth($date->month)->byYear($date->year)->sum('amount');
            $late    = (float) Payment::where('user_id', $userId)->retard()->byMonth($date->month)->byYear($date->year)->sum('amount');

            $data[] = [
                'label'    => $date->translatedFormat('M'),
                'paid'     => $paid,
                'expected' => $paid + $pending + $late,
            ];
        }

        return $data;
    }
}
