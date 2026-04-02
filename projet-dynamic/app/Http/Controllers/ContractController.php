<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contract;
use App\Models\Property;
use App\Models\Tenant;
use App\Services\ContractService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContractController extends Controller
{
    public function __construct(private ContractService $service) {}

    public function index(Request $request): View
    {
        return view('contracts.index', [
            'contracts' => $this->service->getFiltered($request),
        ]);
    }

    public function create(): View
    {
        $tenants    = Tenant::where('user_id', auth()->id())->get();
        $properties = Property::where('user_id', auth()->id())->get();

        return view('contracts.create', compact('tenants', 'properties'));
    }

    public function store(StoreContractRequest $request): RedirectResponse
    {
        $contract = $this->service->store($request->validated());

        return redirect()->route('contracts.show', $contract)->with('success', 'Contrat créé avec succès.');
    }

    public function show(Contract $contract): View
    {
        $this->authorize('view', $contract);
        $contract->load(['tenant', 'property']);

        return view('contracts.show', compact('contract'));
    }

    public function edit(Contract $contract): View
    {
        $this->authorize('update', $contract);
        $tenants    = Tenant::where('user_id', auth()->id())->get();
        $properties = Property::where('user_id', auth()->id())->get();

        return view('contracts.edit', compact('contract', 'tenants', 'properties'));
    }

    public function update(UpdateContractRequest $request, Contract $contract): RedirectResponse
    {
        $this->authorize('update', $contract);
        $this->service->update($contract, $request->validated());

        return redirect()->route('contracts.show', $contract)->with('success', 'Contrat mis à jour.');
    }

    public function destroy(Contract $contract): RedirectResponse
    {
        $this->authorize('delete', $contract);
        $this->service->destroy($contract);

        return redirect()->route('contracts.index')->with('success', 'Contrat supprimé.');
    }

    public function archive(Contract $contract): RedirectResponse
    {
        $this->authorize('update', $contract);
        $this->service->archive($contract);

        return redirect()->back()->with('success', 'Contrat archivé avec succès.');
    }
}
