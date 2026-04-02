@extends('layouts.app')
@section('title', 'Paiements')
@section('content')

<x-page-header
    title="Suivi des paiements"
    subtitle="Gestion des loyers et encaissements"
    :createRoute="route('payments.create')"
    createLabel="Nouveau paiement"
/>

{{-- Monthly Stats --}}
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <x-stat-card label="Total du mois" :value="number_format($stats['total'] ?? 0, 0, ',', ' ').' €'" icon="euro-sign" variant="primary" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card label="Payés" :value="number_format($stats['paid'] ?? 0, 0, ',', ' ').' €'" icon="check-circle" variant="success" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card label="En attente" :value="number_format($stats['pending'] ?? 0, 0, ',', ' ').' €'" icon="clock" variant="accent" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card label="En retard" :value="number_format($stats['late'] ?? 0, 0, ',', ' ').' €'" icon="exclamation-triangle" variant="danger" />
    </div>
</div>

{{-- Filters --}}
<div class="data-table-wrap p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par locataire..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">Tous statuts</option>
                <option value="paye" @selected(request('status')=='paye')>Payé</option>
                <option value="attente" @selected(request('status')=='attente')>En attente</option>
                <option value="retard" @selected(request('status')=='retard')>En retard</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="month" class="form-select">
                <option value="">Tous les mois</option>
                @foreach(range(1,12) as $m)
                <option value="{{ $m }}" @selected(request('month')==$m)>{{ \Carbon\Carbon::create()->month($m)->isoFormat('MMMM') }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="year" class="form-control" placeholder="Année" value="{{ request('year', now()->year) }}" min="2000" max="2100">
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary-custom w-100">OK</button>
        </div>
        @if(request()->hasAny(['search','status','month','year']))
        <div class="col-md-2">
            <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary w-100">Réinitialiser</a>
        </div>
        @endif
    </form>
</div>

@if($payments->isEmpty())
    <x-empty-state icon="euro-sign" title="Aucun paiement trouvé" text="Aucun paiement ne correspond à vos critères." :actionRoute="route('payments.create')" actionLabel="Nouveau paiement" />
@else
<div class="data-table-wrap">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Locataire</th>
                    <th>Bien</th>
                    <th>Période</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Date de paiement</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>
                        @if($payment->tenant)
                        <a href="{{ route('tenants.show', $payment->tenant) }}" class="fw-600 text-decoration-none small">
                            {{ $payment->tenant->full_name }}
                        </a>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td>
                        @if($payment->property)
                        <a href="{{ route('properties.show', $payment->property) }}" class="text-decoration-none small">
                            {{ $payment->property->name }}
                        </a>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td class="small fw-600">{{ $payment->period_label }}</td>
                    <td class="small fw-600">{{ number_format($payment->amount, 0, ',', ' ') }} €</td>
                    <td><x-status-badge :status="$payment->status" type="payment" /></td>
                    <td class="small text-muted">{{ $payment->payment_date ? $payment->payment_date->format('d/m/Y') : '—' }}</td>
                    <td class="text-end">
                        <div class="d-flex gap-1 justify-content-end">
                            @if($payment->status !== 'paye')
                            <form method="POST" action="{{ route('payments.markPaid', $payment) }}">
                                @csrf @method('PATCH')
                                <button class="btn btn-xs btn-outline-success btn-sm py-0 px-2" title="Marquer payé" style="font-size:.75rem;">
                                    <i class="fas fa-check me-1"></i>Payé
                                </button>
                            </form>
                            @endif
                            <a href="{{ route('payments.edit', $payment) }}" class="btn btn-xs btn-outline-primary btn-sm py-0 px-2" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('payments.destroy', $payment) }}" onsubmit="return confirm('Supprimer ce paiement ?')">
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
<div class="mt-4">{{ $payments->links() }}</div>
@endif

@endsection
