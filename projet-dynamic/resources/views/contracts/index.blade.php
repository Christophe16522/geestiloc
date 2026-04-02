@extends('layouts.app')
@section('title', 'Contrats')
@section('content')

<x-page-header
    title="Contrats de location"
    subtitle="{{ $contracts->total() }} contrat(s) enregistré(s)"
    :createRoute="route('contracts.create')"
    createLabel="Nouveau contrat"
/>

{{-- Filters --}}
<div class="data-table-wrap p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par locataire, bien..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">Tous statuts</option>
                <option value="actif" @selected(request('status')=='actif')>Actif</option>
                <option value="expire" @selected(request('status')=='expire')>Expiré</option>
                <option value="archive" @selected(request('status')=='archive')>Archivé</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="type" class="form-select">
                <option value="">Tous types</option>
                <option value="bail" @selected(request('type')=='bail')>Bail</option>
                <option value="sous-location" @selected(request('type')=='sous-location')>Sous-location</option>
                <option value="meuble" @selected(request('type')=='meuble')>Meublé</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary-custom w-100">Filtrer</button>
        </div>
        @if(request()->hasAny(['search','status','type']))
        <div class="col-md-2">
            <a href="{{ route('contracts.index') }}" class="btn btn-outline-secondary w-100">Réinitialiser</a>
        </div>
        @endif
    </form>
</div>

@if($contracts->isEmpty())
    <x-empty-state icon="file-contract" title="Aucun contrat trouvé" text="Créez votre premier contrat de location." :actionRoute="route('contracts.create')" actionLabel="Nouveau contrat" />
@else
<div class="data-table-wrap">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Locataire</th>
                    <th>Bien</th>
                    <th>Type</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Loyer</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contracts as $contract)
                <tr>
                    <td>
                        @if($contract->tenant)
                        <a href="{{ route('tenants.show', $contract->tenant) }}" class="fw-600 text-decoration-none small">
                            {{ $contract->tenant->full_name }}
                        </a>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td>
                        @if($contract->property)
                        <a href="{{ route('properties.show', $contract->property) }}" class="text-decoration-none small">
                            {{ $contract->property->name }}
                        </a>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ ucfirst($contract->type ?? '—') }}</span>
                    </td>
                    <td class="small text-muted">{{ $contract->start_date?->format('d/m/Y') ?? '—' }}</td>
                    <td class="small text-muted">{{ $contract->end_date?->format('d/m/Y') ?? 'Indéterminé' }}</td>
                    <td class="small fw-600">{{ number_format($contract->monthly_rent, 0, ',', ' ') }} €</td>
                    <td><x-status-badge :status="$contract->status" type="contract" /></td>
                    <td class="text-end">
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{ route('contracts.show', $contract) }}" class="btn btn-xs btn-outline-secondary btn-sm py-0 px-2" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-xs btn-outline-primary btn-sm py-0 px-2" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($contract->status !== 'archive')
                            <form method="POST" action="{{ route('contracts.archive', $contract) }}">
                                @csrf @method('PATCH')
                                <button class="btn btn-xs btn-outline-warning btn-sm py-0 px-2" title="Archiver" onclick="return confirm('Archiver ce contrat ?')">
                                    <i class="fas fa-archive"></i>
                                </button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('contracts.destroy', $contract) }}" onsubmit="return confirm('Supprimer ce contrat ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger btn-sm py-0 px-2" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $contracts->links() }}</div>
@endif

@endsection
