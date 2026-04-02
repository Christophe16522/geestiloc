@extends('layouts.app')
@section('title', 'Paiement — ' . $payment->period_label)

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <div class="flex-grow-1">
        <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">Paiement — {{ $payment->period_label }}</h1>
        <small class="text-muted">{{ $payment->tenant->full_name ?? '—' }} · {{ $payment->property->name ?? '—' }}</small>
    </div>
    <x-status-badge :status="$payment->status" type="payment" />
    <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-edit me-1"></i>Modifier
    </a>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <x-stat-card label="Montant" :value="number_format($payment->amount, 2, ',', ' ') . ' €'" icon="euro-sign" variant="primary" />
    </div>
    <div class="col-md-3">
        <x-stat-card label="Période" :value="$payment->period_label" icon="calendar" variant="accent" />
    </div>
    <div class="col-md-3">
        <x-stat-card label="Date de paiement" :value="$payment->payment_date ? $payment->payment_date->format('d/m/Y') : 'Non payé'" icon="check-circle" variant="{{ $payment->status === 'paye' ? 'success' : 'warning' }}" />
    </div>
    <div class="col-md-3">
        <x-stat-card label="Statut" :value="ucfirst($payment->status)" icon="info-circle" variant="{{ $payment->status === 'retard' ? 'danger' : ($payment->status === 'paye' ? 'success' : 'warning') }}" />
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">Locataire</h6>
            @if($payment->tenant)
            <div class="d-flex align-items-center gap-3">
                <div class="tenant-initials">{{ $payment->tenant->initials }}</div>
                <div>
                    <div class="fw-700">{{ $payment->tenant->full_name }}</div>
                    <small class="text-muted">{{ $payment->tenant->email }}</small><br>
                    <a href="{{ route('tenants.show', $payment->tenant) }}" class="small">Voir le locataire</a>
                </div>
            </div>
            @else
            <p class="text-muted small">Aucun locataire associé</p>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">Bien immobilier</h6>
            @if($payment->property)
            <div>
                <div class="fw-700">{{ $payment->property->name }}</div>
                <small class="text-muted">{{ $payment->property->full_address }}</small><br>
                <a href="{{ route('properties.show', $payment->property) }}" class="small">Voir le bien</a>
            </div>
            @else
            <p class="text-muted small">Aucun bien associé</p>
            @endif
        </div>
    </div>
</div>

@if($payment->status !== 'paye')
<div class="mt-4">
    <form method="POST" action="{{ route('payments.markPaid', $payment) }}">
        @csrf @method('PATCH')
        <button type="submit" class="btn btn-success">
            <i class="fas fa-check me-2"></i>Marquer comme payé
        </button>
    </form>
</div>
@endif

@endsection
