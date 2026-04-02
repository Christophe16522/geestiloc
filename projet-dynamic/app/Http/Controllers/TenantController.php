<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Models\Property;
use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TenantController extends Controller
{
    public function __construct(private TenantService $service) {}

    public function index(Request $request): View
    {
        return view('tenants.index', [
            'tenants' => $this->service->getFiltered($request),
        ]);
    }

    public function create(): View
    {
        $properties = Property::where('user_id', auth()->id())->get();

        return view('tenants.create', compact('properties'));
    }

    public function store(StoreTenantRequest $request): RedirectResponse
    {
        $tenant = $this->service->store($request->validated());

        return redirect()->route('tenants.show', $tenant)->with('success', 'Locataire créé avec succès.');
    }

    public function show(Tenant $tenant): View
    {
        $this->authorize('view', $tenant);
        $tenant->load(['property', 'payments', 'contracts']);

        return view('tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant): View
    {
        $this->authorize('update', $tenant);
        $properties = Property::where('user_id', auth()->id())->get();

        return view('tenants.edit', compact('tenant', 'properties'));
    }

    public function update(UpdateTenantRequest $request, Tenant $tenant): RedirectResponse
    {
        $this->authorize('update', $tenant);
        $this->service->update($tenant, $request->validated());

        return redirect()->route('tenants.show', $tenant)->with('success', 'Locataire mis à jour.');
    }

    public function destroy(Tenant $tenant): RedirectResponse
    {
        $this->authorize('delete', $tenant);
        $this->service->destroy($tenant);

        return redirect()->route('tenants.index')->with('success', 'Locataire supprimé.');
    }
}
