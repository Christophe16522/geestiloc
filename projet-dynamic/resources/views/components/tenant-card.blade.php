@props(['tenant'])
<div class="prop-card p-3">
    <div class="d-flex align-items-center gap-3 mb-3">
        <div class="tenant-initials">{{ $tenant->initials }}</div>
        <div class="flex-grow-1 min-width-0">
            <div class="fw-700">{{ $tenant->full_name }}</div>
            <small class="text-muted">{{ $tenant->email }}</small>
        </div>
        <x-status-badge :status="$tenant->payment_status" type="payment" />
    </div>
    @if($tenant->property)
    <div class="text-muted small mb-2">
        <i class="fas fa-building me-1"></i>{{ $tenant->property->name }}
    </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted small">Loyer mensuel</span>
        <span class="fw-700" style="color:var(--primary)">{{ number_format($tenant->monthly_rent, 0, ',', ' ') }} €</span>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('tenants.show', $tenant) }}" class="btn btn-sm btn-outline-primary flex-grow-1">Voir</a>
        <a href="{{ route('tenants.edit', $tenant) }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-edit"></i>
        </a>
    </div>
</div>
