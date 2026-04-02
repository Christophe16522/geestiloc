@props(['property'])
<div class="prop-card">
    <div class="prop-card-header">
        <div>
            <div class="fw-700" style="font-size:.95rem;">{{ $property->name }}</div>
            <small style="opacity:.8">{{ $property->reference }}</small>
        </div>
        <x-status-badge :status="$property->status" type="property" />
    </div>
    <div class="prop-card-body">
        <div class="d-flex align-items-center gap-2 text-muted small mb-2">
            <i class="fas fa-map-marker-alt"></i>
            <span>{{ $property->city }}</span>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted small"><i class="fas fa-ruler-combined me-1"></i>{{ $property->surface_m2 ?? '—' }} m²</span>
            <span class="fw-700" style="color:var(--primary)">{{ number_format($property->monthly_rent, 0, ',', ' ') }} €/mois</span>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('properties.show', $property) }}" class="btn btn-sm btn-outline-primary flex-grow-1">Voir</a>
            <a href="{{ route('properties.edit', $property) }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-edit"></i>
            </a>
        </div>
    </div>
</div>
