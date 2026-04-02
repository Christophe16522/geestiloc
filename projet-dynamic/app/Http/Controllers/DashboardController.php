<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $service) {}

    public function index(): View
    {
        return view('dashboard', [
            'stats'              => $this->service->getKpiStats(),
            'alerts'             => $this->service->getAlerts(),
            'monthlyRevenue'     => $this->service->getMonthlyRevenueChart(),
            'paymentStatus'      => $this->service->getPaymentStatusChart(),
            'occupancy'          => $this->service->getOccupancyChart(),
            'propertiesByType'   => $this->service->getPropertiesByTypeChart(),
            'maintenanceStatus'  => $this->service->getMaintenanceStatusChart(),
            'revenueVsExpected'  => $this->service->getRevenueVsExpectedChart(),
        ]);
    }
}
