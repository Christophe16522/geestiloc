<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use App\Models\Maintenance;
use App\Models\Property;
use App\Services\MaintenanceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaintenanceController extends Controller
{
    public function __construct(private MaintenanceService $service) {}

    public function index(Request $request): View
    {
        return view('maintenances.index', [
            'maintenances' => $this->service->getFiltered($request),
        ]);
    }

    public function create(): View
    {
        $properties = Property::where('user_id', auth()->id())->get();

        return view('maintenances.create', compact('properties'));
    }

    public function store(StoreMaintenanceRequest $request): RedirectResponse
    {
        $maintenance = $this->service->store($request->validated());

        return redirect()->route('maintenances.show', $maintenance)->with('success', 'Intervention créée avec succès.');
    }

    public function show(Maintenance $maintenance): View
    {
        $this->authorize('view', $maintenance);
        $maintenance->load('property');

        return view('maintenances.show', compact('maintenance'));
    }

    public function edit(Maintenance $maintenance): View
    {
        $this->authorize('update', $maintenance);
        $properties = Property::where('user_id', auth()->id())->get();

        return view('maintenances.edit', compact('maintenance', 'properties'));
    }

    public function update(UpdateMaintenanceRequest $request, Maintenance $maintenance): RedirectResponse
    {
        $this->authorize('update', $maintenance);
        $this->service->update($maintenance, $request->validated());

        return redirect()->route('maintenances.show', $maintenance)->with('success', 'Intervention mise à jour.');
    }

    public function destroy(Maintenance $maintenance): RedirectResponse
    {
        $this->authorize('delete', $maintenance);
        $this->service->destroy($maintenance);

        return redirect()->route('maintenances.index')->with('success', 'Intervention supprimée.');
    }

    public function updateProgress(Request $request, Maintenance $maintenance): RedirectResponse
    {
        $this->authorize('update', $maintenance);

        $request->validate([
            'percentage' => 'required|integer|between:0,100',
        ]);

        $this->service->updateProgress($maintenance, $request->integer('percentage'));

        return redirect()->back()->with('success', 'Avancement mis à jour.');
    }
}
