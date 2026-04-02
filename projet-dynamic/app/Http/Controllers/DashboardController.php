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
            'stats'  => $this->service->getKpiStats(),
            'alerts' => $this->service->getAlerts(),
            'chart'  => $this->service->getMonthlyRevenueChart(),
        ]);
    }
}
