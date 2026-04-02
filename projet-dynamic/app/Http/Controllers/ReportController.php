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

        return view('reports.index', [
            'financial'   => $this->service->getFinancialReport($year),
            'occupancy'   => $this->service->getOccupancyReport(),
            'maintenance' => $this->service->getMaintenanceReport(),
            'year'        => $year,
        ]);
    }
}
