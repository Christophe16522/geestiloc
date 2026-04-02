@extends('layouts.app')
@section('title', 'Contrat — ' . ($contract->tenant?->full_name ?? '—'))
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('contracts.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <div class="flex-grow-1">
        <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">
            {{ __('contracts.show_title') }} — {{ $contract->tenant?->full_name ?? '—' }}
        </h1>
        <small class="text-muted">{{ ucfirst($contract->type ?? '—') }} — créé le {{ $contract->created_at->format('d/m/Y') }}</small>
    </div>
    <x-status-badge :status="$contract->status" type="contract" />
    <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-edit me-1"></i>{{ __('common.edit') }}
    </a>
    @if($contract->status !== 'archive')
    <form method="POST" action="{{ route('contracts.archive', $contract) }}">
        @csrf @method('PATCH')
        <button class="btn btn-sm btn-outline-warning" onclick="return confirm('{{ __('contracts.archive_confirm') }}')">
            <i class="fas fa-archive me-1"></i>{{ __('contracts.archive') }}
        </button>
    </form>
    @endif
    <form method="POST" action="{{ route('contracts.destroy', $contract) }}" onsubmit="return confirm('{{ __('contracts.delete_confirm') }}')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" title="{{ __('common.delete') }}"><i class="fas fa-trash"></i></button>
    </form>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <x-stat-card :label="__('contracts.monthly_rent')" :value="number_format($contract->monthly_rent, 0, ',', ' ').' €'" icon="euro-sign" variant="primary" />
    </div>
    <div class="col-md-3">
        <x-stat-card :label="__('contracts.charges')" :value="number_format($contract->charges ?? 0, 0, ',', ' ').' €'" icon="receipt" variant="accent" />
    </div>
    <div class="col-md-3">
        <x-stat-card :label="__('contracts.deposit')" :value="number_format($contract->deposit ?? 0, 0, ',', ' ').' €'" icon="shield-alt" variant="warning" />
    </div>
    <div class="col-md-3">
        <x-stat-card :label="__('contracts.duration')" :value="$contract->end_date ? $contract->start_date->diffInMonths($contract->end_date).' mois' : '—'" icon="calendar-alt" variant="success" />
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">{{ __('contracts.tenant') }}</h6>
            @if($contract->tenant)
            <div class="d-flex align-items-center gap-3">
                <div class="tenant-initials" style="width:48px;height:48px;font-size:1.1rem;">{{ $contract->tenant->initials }}</div>
                <div>
                    <div class="fw-700">{{ $contract->tenant->full_name }}</div>
                    <div class="small text-muted">{{ $contract->tenant->email }}</div>
                    <div class="small text-muted">{{ $contract->tenant->phone }}</div>
                    <a href="{{ route('tenants.show', $contract->tenant) }}" class="btn btn-sm btn-outline-primary mt-2">
                        {{ __('contracts.view_tenant') }}
                    </a>
                </div>
            </div>
            @else
            <p class="text-muted small">{{ __('contracts.no_tenant') }}</p>
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">{{ __('contracts.property') }}</h6>
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
                <a href="{{ route('properties.show', $contract->property) }}" class="btn btn-sm btn-outline-primary mt-2">
                    {{ __('contracts.view_property') }}
                </a>
            </div>
            @else
            <p class="text-muted small">{{ __('contracts.no_property') }}</p>
            @endif
        </div>
    </div>
    <div class="col-12">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">{{ __('contracts.period') }}</h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="small text-muted">{{ __('contracts.start_date') }}</div>
                    <div class="fw-600">{{ $contract->start_date?->format('d/m/Y') ?? '—' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="small text-muted">{{ __('contracts.end_date') }}</div>
                    <div class="fw-600">{{ $contract->end_date?->format('d/m/Y') ?? '—' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="small text-muted">{{ __('common.type') }}</div>
                    <div class="fw-600">{{ ucfirst($contract->type ?? '—') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
