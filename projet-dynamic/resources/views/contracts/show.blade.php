@extends('layouts.app')
@section('title', 'Contrat — ' . ($contract->tenant?->full_name ?? '—'))
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('contracts.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <div class="flex-grow-1">
        <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">
            Contrat — {{ $contract->tenant?->full_name ?? '—' }}
        </h1>
        <small class="text-muted">{{ ucfirst($contract->type ?? '—') }} — créé le {{ $contract->created_at->format('d/m/Y') }}</small>
    </div>
    <x-status-badge :status="$contract->status" type="contract" />
    <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-edit me-1"></i>Modifier
    </a>
    @if($contract->status !== 'archive')
    <form method="POST" action="{{ route('contracts.archive', $contract) }}">
        @csrf @method('PATCH')
        <button class="btn btn-sm btn-outline-warning" onclick="return confirm('Archiver ce contrat ?')">
            <i class="fas fa-archive me-1"></i>Archiver
        </button>
    </form>
    @endif
    <form method="POST" action="{{ route('contracts.destroy', $contract) }}" onsubmit="return confirm('Supprimer ce contrat ?')">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
    </form>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <x-stat-card label="Loyer mensuel" :value="number_format($contract->monthly_rent, 0, ',', ' ').' €'" icon="euro-sign" variant="primary" />
    </div>
    <div class="col-md-3">
        <x-stat-card label="Charges" :value="number_format($contract->charges ?? 0, 0, ',', ' ').' €'" icon="receipt" variant="accent" />
    </div>
    <div class="col-md-3">
        <x-stat-card label="Dépôt de garantie" :value="number_format($contract->deposit ?? 0, 0, ',', ' ').' €'" icon="shield-alt" variant="warning" />
    </div>
    <div class="col-md-3">
        <x-stat-card label="Durée" :value="$contract->end_date ? $contract->start_date->diffInMonths($contract->end_date).' mois' : 'Indéterminée'" icon="calendar-alt" variant="success" />
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">Locataire</h6>
            @if($contract->tenant)
            <div class="d-flex align-items-center gap-3">
                <div class="tenant-initials" style="width:48px;height:48px;font-size:1.1rem;">{{ $contract->tenant->initials }}</div>
                <div>
                    <div class="fw-700">{{ $contract->tenant->full_name }}</div>
                    <div class="small text-muted">{{ $contract->tenant->email }}</div>
                    <div class="small text-muted">{{ $contract->tenant->phone }}</div>
                    <a href="{{ route('tenants.show', $contract->tenant) }}" class="btn btn-xs btn-outline-primary btn-sm mt-2 py-0 px-2" style="font-size:.75rem;">
                        Voir le locataire
                    </a>
                </div>
            </div>
            @else
            <p class="text-muted small">Aucun locataire associé</p>
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">Bien concerné</h6>
            @if($contract->property)
            <div>
                <div class="fw-700">{{ $contract->property->name }}</div>
                <div class="small text-muted">{{ $contract->property->full_address }}</div>
                <div class="small text-muted mt-1">
                    <span class="badge bg-secondary">{{ ucfirst($contract->property->type) }}</span>
                    @if($contract->property->surface_m2)
                    <span class="ms-2">{{ $contract->property->surface_m2 }} m²</span>
                    @endif
                </div>
                <a href="{{ route('properties.show', $contract->property) }}" class="btn btn-xs btn-outline-primary btn-sm mt-2 py-0 px-2" style="font-size:.75rem;">
                    Voir le bien
                </a>
            </div>
            @else
            <p class="text-muted small">Aucun bien associé</p>
            @endif
        </div>
    </div>
    <div class="col-12">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">Période du contrat</h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="small text-muted">Date de début</div>
                    <div class="fw-600">{{ $contract->start_date?->format('d/m/Y') ?? '—' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="small text-muted">Date de fin</div>
                    <div class="fw-600">{{ $contract->end_date?->format('d/m/Y') ?? 'Indéterminée' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="small text-muted">Type</div>
                    <div class="fw-600">{{ ucfirst($contract->type ?? '—') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
