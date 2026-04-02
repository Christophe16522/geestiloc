@extends('layouts.app')
@section('title', $property->name)
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('properties.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <div class="flex-grow-1">
        <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">{{ $property->name }}</h1>
        <small class="text-muted">{{ $property->reference }} — {{ $property->full_address }}</small>
    </div>
    <x-status-badge :status="$property->status" type="property" />
    <a href="{{ route('properties.edit', $property) }}" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-edit me-1"></i>{{ __('common.edit') }}
    </a>
    <form method="POST" action="{{ route('properties.destroy', $property) }}" onsubmit="return confirm('{{ __('properties.delete_confirm') }}')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" title="{{ __('common.delete') }}"><i class="fas fa-trash"></i></button>
    </form>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3"><x-stat-card label="Loyer mensuel" :value="number_format($property->monthly_rent,0,',',' ').' €'" icon="euro-sign" variant="primary" /></div>
    <div class="col-md-3"><x-stat-card label="Charges" :value="number_format($property->charges,0,',',' ').' €'" icon="receipt" variant="accent" /></div>
    <div class="col-md-3"><x-stat-card label="Dépôt de garantie" :value="number_format($property->deposit,0,',',' ').' €'" icon="shield-alt" variant="warning" /></div>
    <div class="col-md-3"><x-stat-card label="Surface" :value="($property->surface_m2 ?? '—').' m²'" icon="ruler-combined" variant="success" /></div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">{{ __('properties.tenants_count') }} ({{ $property->tenants->count() }})</h6>
            @forelse($property->tenants as $tenant)
            <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <div class="tenant-initials" style="width:36px;height:36px;font-size:.85rem;">{{ $tenant->initials }}</div>
                    <div>
                        <div class="fw-600 small">{{ $tenant->full_name }}</div>
                        <small class="text-muted">{{ $tenant->email }}</small>
                    </div>
                </div>
                <x-status-badge :status="$tenant->payment_status" type="payment" />
            </div>
            @empty
            <p class="text-muted small">{{ __('properties.no_tenants') }}</p>
            @endforelse
        </div>
    </div>
    <div class="col-lg-6">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">{{ __('nav.maintenances') }} ({{ $property->maintenances->count() }})</h6>
            @forelse($property->maintenances->take(5) as $m)
            <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                <div>
                    <div class="fw-600 small">{{ $m->title }}</div>
                    <x-status-badge :status="$m->status" type="maintenance" />
                </div>
                <x-progress-bar :percentage="$m->progress_percentage" :showLabel="true" />
            </div>
            @empty
            <p class="text-muted small">{{ __('properties.no_maintenances') }}</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
