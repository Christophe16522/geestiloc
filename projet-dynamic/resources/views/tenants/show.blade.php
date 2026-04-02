@extends('layouts.app')
@section('title', $tenant->full_name)
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('tenants.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <div class="flex-grow-1 d-flex align-items-center gap-3">
        <div class="tenant-initials" style="width:48px;height:48px;font-size:1.1rem;">{{ $tenant->initials }}</div>
        <div>
            <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">{{ $tenant->full_name }}</h1>
            <small class="text-muted">{{ $tenant->email }} — {{ $tenant->phone }}</small>
        </div>
    </div>
    <x-status-badge :status="$tenant->payment_status" type="payment" />
    <a href="{{ route('tenants.edit', $tenant) }}" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-edit me-1"></i>{{ __('common.edit') }}
    </a>
    <form method="POST" action="{{ route('tenants.destroy', $tenant) }}" onsubmit="return confirm('{{ __('tenants.delete_confirm') }}')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" title="{{ __('common.delete') }}"><i class="fas fa-trash"></i></button>
    </form>
</div>

{{-- KPI Row --}}
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <x-stat-card label="Loyer mensuel" :value="number_format($tenant->monthly_rent, 0, ',', ' ').' €'" icon="euro-sign" variant="primary" />
    </div>
    <div class="col-md-3">
        <x-stat-card label="Début de bail" :value="$tenant->lease_start_date ? $tenant->lease_start_date->format('d/m/Y') : '—'" icon="calendar-alt" variant="accent" />
    </div>
    <div class="col-md-3">
        <x-stat-card label="Fin de bail" :value="$tenant->lease_end_date ? $tenant->lease_end_date->format('d/m/Y') : 'Indéterminé'" icon="calendar-check" variant="warning" />
    </div>
    <div class="col-md-3">
        @if($tenant->property)
        <div class="data-table-wrap p-3 h-100 d-flex flex-column justify-content-center">
            <div class="small text-muted mb-1"><i class="fas fa-building me-1"></i>Bien loué</div>
            <a href="{{ route('properties.show', $tenant->property) }}" class="fw-700 text-decoration-none">
                {{ $tenant->property->name }}
            </a>
            <small class="text-muted">{{ $tenant->property->full_address }}</small>
        </div>
        @else
        <x-stat-card label="Bien loué" value="Non assigné" icon="building" variant="success" />
        @endif
    </div>
</div>

<div class="row g-4">
    {{-- Recent Payments --}}
    <div class="col-lg-8">
        <div class="data-table-wrap">
            <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                <h6 class="fw-700 mb-0">{{ __('tenants.recent_payments') }}</h6>
                <a href="{{ route('payments.index', ['tenant_id' => $tenant->id]) }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
            </div>
            @if($tenant->payments->isEmpty())
            <div class="p-4 text-center text-muted small">{{ __('tenants.no_payments') }}</div>
            @else
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Période</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Date de paiement</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tenant->payments->take(10) as $payment)
                        <tr>
                            <td class="small fw-600">{{ $payment->period_label }}</td>
                            <td class="small">{{ number_format($payment->amount, 0, ',', ' ') }} €</td>
                            <td><x-status-badge :status="$payment->status" type="payment" /></td>
                            <td class="small text-muted">{{ $payment->payment_date ? $payment->payment_date->format('d/m/Y') : '—' }}</td>
                            <td>
                                @if($payment->status !== 'paye')
                                <form method="POST" action="{{ route('payments.markPaid', $payment) }}">
                                    @csrf @method('PATCH')
                                    <button class="action-btn action-btn--success" title="{{ __('payments.mark_paid') }}">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    {{-- Contracts --}}
    <div class="col-lg-4">
        <div class="data-table-wrap">
            <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                <h6 class="fw-700 mb-0">{{ __('tenants.contracts') }} ({{ $tenant->contracts->count() }})</h6>
                <a href="{{ route('contracts.create', ['tenant_id' => $tenant->id]) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-plus"></i></a>
            </div>
            @forelse($tenant->contracts as $contract)
            <div class="p-3 border-bottom">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <span class="fw-600 small">{{ ucfirst($contract->type) }}</span>
                    <x-status-badge :status="$contract->status" type="contract" />
                </div>
                <div class="small text-muted">
                    Du {{ $contract->start_date->format('d/m/Y') }}
                    @if($contract->end_date) au {{ $contract->end_date->format('d/m/Y') }} @else (indéterminé) @endif
                </div>
                <div class="small fw-600 mt-1">{{ number_format($contract->monthly_rent, 0, ',', ' ') }} €/mois</div>
                <div class="mt-2">
                    <a href="{{ route('contracts.show', $contract) }}" class="btn btn-sm btn-outline-secondary mt-2">
                        <i class="fas fa-eye me-1"></i>Voir
                    </a>
                </div>
            </div>
            @empty
            <div class="p-4 text-center text-muted small">{{ __('tenants.no_contracts') }}</div>
            @endforelse
        </div>
    </div>
</div>

@endsection
