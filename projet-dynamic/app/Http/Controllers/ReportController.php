<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __construct(private ReportService $service) {}

    public function index(Request $request): View
    {
        $year = (int) $request->get('year', now()->year);
        $currentYear = now()->year;
        $availableYears = range($currentYear, $currentYear - 4);

        return view('reports.index', [
            'financials'      => $this->service->getFinancialReport($year),
            'occupancy'       => $this->service->getOccupancyReport(),
            'maintenanceStats'=> $this->service->getMaintenanceReport(),
            'year'            => $year,
            'availableYears'  => $availableYears,
        ]);
    }
}
