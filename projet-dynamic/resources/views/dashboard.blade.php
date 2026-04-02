@extends('layouts.app')
@section('title', 'Tableau de bord')

@section('content')
<x-page-header title="Tableau de bord" subtitle="Vue d'ensemble de votre portefeuille immobilier" />

{{-- Alerts --}}
@if(count($alerts))
<div class="mb-4">
    @foreach($alerts as $alert)
    <div class="alert alert-{{ $alert['type'] }} alert-gestiloc d-flex align-items-center gap-2 mb-2">
        <i class="fas fa-{{ $alert['type'] === 'danger' ? 'exclamation-circle' : 'exclamation-triangle' }}"></i>
        {{ $alert['message'] }}
    </div>
    @endforeach
</div>
@endif

{{-- KPI Cards --}}
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <x-stat-card label="Biens totaux" :value="$stats['total_properties']" icon="building" variant="primary" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card label="Taux d'occupation" :value="$stats['occupancy_rate'] . '%'" icon="chart-pie" variant="success" :subtitle="$stats['occupied_count'] . ' occupés / ' . $stats['vacant_count'] . ' vacants'" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card label="Revenus du mois" :value="number_format($stats['monthly_revenue'], 0, ',', ' ') . ' €'" icon="euro-sign" variant="accent" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card label="Loyers en retard" :value="$stats['late_tenants']" icon="exclamation-triangle" variant="danger" />
    </div>
</div>

{{-- Revenue Chart --}}
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">Revenus mensuels (12 derniers mois)</h6>
            <canvas id="revenueChart" height="120"></canvas>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="data-table-wrap p-3 h-100">
            <h6 class="fw-700 mb-3">Accès rapides</h6>
            <div class="d-grid gap-2">
                <a href="{{ route('properties.create') }}" class="btn btn-outline-primary btn-sm text-start"><i class="fas fa-plus me-2"></i>Ajouter un bien</a>
                <a href="{{ route('tenants.create') }}" class="btn btn-outline-primary btn-sm text-start"><i class="fas fa-user-plus me-2"></i>Ajouter un locataire</a>
                <a href="{{ route('payments.index') }}" class="btn btn-outline-success btn-sm text-start"><i class="fas fa-euro-sign me-2"></i>Voir les paiements</a>
                <a href="{{ route('maintenances.index') }}" class="btn btn-outline-warning btn-sm text-start"><i class="fas fa-wrench me-2"></i>Maintenances en cours</a>
                <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary btn-sm text-start"><i class="fas fa-chart-bar me-2"></i>Rapports</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const ctx = document.getElementById('revenueChart');
const data = @json($chart);
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: data.map(d => d.label),
        datasets: [{
            label: 'Revenus (€)',
            data: data.map(d => d.amount),
            backgroundColor: 'rgba(30,58,138,.15)',
            borderColor: '#1e3a8a',
            borderWidth: 2,
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
            x: { grid: { display: false } }
        }
    }
});
</script>
@endpush
