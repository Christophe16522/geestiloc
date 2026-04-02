<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use App\Services\PropertyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function __construct(private PropertyService $service) {}

    public function index(Request $request): View
    {
        return view('properties.index', [
            'properties' => $this->service->getFiltered($request),
        ]);
    }

    public function create(): View
    {
        return view('properties.create');
    }

    public function store(StorePropertyRequest $request): RedirectResponse
    {
        $property = $this->service->store($request->validated());

        return redirect()->route('properties.show', $property)->with('success', 'Bien créé avec succès.');
    }

    public function show(Property $property): View
    {
        $this->authorize('view', $property);
        $property->load(['tenants', 'contracts', 'payments', 'maintenances', 'documents']);

        return view('properties.show', compact('property'));
    }

    public function edit(Property $property): View
    {
        $this->authorize('update', $property);

        return view('properties.edit', compact('property'));
    }

    public function update(UpdatePropertyRequest $request, Property $property): RedirectResponse
    {
        $this->authorize('update', $property);
        $this->service->update($property, $request->validated());

        return redirect()->route('properties.show', $property)->with('success', 'Bien mis à jour.');
    }

    public function destroy(Property $property): RedirectResponse
    {
        $this->authorize('delete', $property);
        $this->service->destroy($property);

        return redirect()->route('properties.index')->with('success', 'Bien supprimé.');
    }
}
