@extends('layouts.app')
@section('title', __('dashboard.title'))
@section('content')

<x-page-header :title="__('dashboard.title')" :subtitle="__('dashboard.subtitle')" />

{{-- ── ROW 1 : KPI Cards ─────────────────────────────────────────── --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <x-stat-card :label="__('dashboard.total_properties')" :value="$stats['total_properties']" icon="city" variant="primary" />
    </div>
    <div class="col-6 col-xl-3">
        <x-stat-card :label="__('dashboard.occupancy_rate')" :value="$stats['occupancy_rate'].'%'" icon="chart-pie" variant="success" />
    </div>
    <div class="col-6 col-xl-3">
        <x-stat-card :label="__('dashboard.monthly_revenue')" :value="number_format($stats['monthly_revenue'], 0, ',', ' ').' €'" icon="coins" variant="accent" />
    </div>
    <div class="col-6 col-xl-3">
        <x-stat-card :label="__('dashboard.late_rents')" :value="$stats['late_tenants']" icon="clock-rotate-left" variant="danger" />
    </div>
</div>

{{-- ── ROW 2 : Revenue 12 mois + Alertes ────────────────────────── --}}
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="chart-card h-100">
            <div class="chart-card__header">
                <div>
                    <h6 class="chart-card__title"><i class="fa-solid fa-chart-line me-2 text-primary"></i>{{ __('dashboard.revenue_chart') }}</h6>
                    <p class="chart-card__subtitle">{{ __('dashboard.last_12_months') }}</p>
                </div>
            </div>
            <div class="chart-card__body">
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="data-table-wrap h-100 d-flex flex-column">
            <div class="p-3 border-bottom d-flex align-items-center gap-2">
                <i class="fa-solid fa-bell text-warning"></i>
                <h6 class="fw-700 mb-0">{{ __('dashboard.alerts') }}</h6>
                @if(count($alerts) > 0)
                <span class="badge rounded-pill ms-auto" style="background:var(--danger);font-size:.65rem;">{{ count($alerts) }}</span>
                @endif
            </div>
            <div class="p-2 flex-fill">
                @forelse($alerts as $alert)
                <div class="alert-item alert-item--{{ $alert['type'] }}">
                    <i class="fa-solid fa-{{ $alert['icon'] }}"></i>
                    <span>{{ $alert['message'] }}</span>
                </div>
                @empty
                <div class="text-center py-4 text-muted">
                    <i class="fa-solid fa-circle-check fa-2x mb-2 text-success d-block"></i>
                    <p class="small mb-0">{{ __('dashboard.no_alerts') }}</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ── ROW 3 : Revenus encaissé vs attendu + Répartition paiements ─ --}}
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="chart-card h-100">
            <div class="chart-card__header">
                <div>
                    <h6 class="chart-card__title"><i class="fa-solid fa-coins me-2 text-warning"></i>Encaissé vs Attendu</h6>
                    <p class="chart-card__subtitle">6 derniers mois</p>
                </div>
            </div>
            <div class="chart-card__body">
                <canvas id="revenueVsChart" height="110"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="chart-card h-100">
            <div class="chart-card__header">
                <div>
                    <h6 class="chart-card__title"><i class="fa-solid fa-circle-half-stroke me-2 text-accent"></i>Paiements du mois</h6>
                    <p class="chart-card__subtitle">Répartition en euros</p>
                </div>
            </div>
            <div class="chart-card__body d-flex align-items-center justify-content-center" style="min-height:180px;">
                <canvas id="paymentStatusChart" style="max-height:200px;"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- ── ROW 4 : Occupation + Type de biens + Maintenance ────────────── --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="chart-card h-100">
            <div class="chart-card__header">
                <h6 class="chart-card__title"><i class="fa-solid fa-house-chimney me-2 text-success"></i>Occupation</h6>
            </div>
            <div class="chart-card__body d-flex flex-column align-items-center" style="min-height:180px;">
                <canvas id="occupancyChart" style="max-height:160px;"></canvas>
                <div class="d-flex gap-3 mt-3">
                    <div class="text-center">
                        <div class="fw-800" style="font-size:1.4rem;color:#10b981;">{{ $stats['occupied_count'] }}</div>
                        <div class="small text-muted">Occupés</div>
                    </div>
                    <div class="text-center">
                        <div class="fw-800" style="font-size:1.4rem;color:#f97316;">{{ $stats['vacant_count'] }}</div>
                        <div class="small text-muted">Vacants</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart-card h-100">
            <div class="chart-card__header">
                <h6 class="chart-card__title"><i class="fa-solid fa-city me-2 text-primary"></i>Types de biens</h6>
            </div>
            <div class="chart-card__body d-flex align-items-center justify-content-center" style="min-height:180px;">
                <canvas id="propertyTypeChart" style="max-height:200px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart-card h-100">
            <div class="chart-card__header">
                <h6 class="chart-card__title"><i class="fa-solid fa-screwdriver-wrench me-2 text-danger"></i>Maintenance</h6>
            </div>
            <div class="chart-card__body d-flex flex-column align-items-center" style="min-height:180px;">
                <canvas id="maintenanceChart" style="max-height:160px;"></canvas>
                <div class="d-flex gap-3 mt-3 flex-wrap justify-content-center">
                    <div class="text-center">
                        <div class="fw-800" style="font-size:1.2rem;color:#8b5cf6;">{{ $maintenanceStatus['a_faire'] }}</div>
                        <div class="small text-muted">À faire</div>
                    </div>
                    <div class="text-center">
                        <div class="fw-800" style="font-size:1.2rem;color:#06b6d4;">{{ $maintenanceStatus['en_cours'] }}</div>
                        <div class="small text-muted">En cours</div>
                    </div>
                    <div class="text-center">
                        <div class="fw-800" style="font-size:1.2rem;color:#22c55e;">{{ $maintenanceStatus['termine'] }}</div>
                        <div class="small text-muted">Terminées</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── ROW 5 : Accès rapides ─────────────────────────────────────── --}}
<div class="data-table-wrap p-3">
    <h6 class="fw-700 mb-3"><i class="fa-solid fa-bolt me-2 text-warning"></i>{{ __('dashboard.quick_access') }}</h6>
    <div class="row g-3">
        @foreach([
            ['route'=>'properties.create','icon'=>'fa-building-circle-arrow-right','label'=>__('dashboard.add_property'), 'color'=>'#3b82f6'],
            ['route'=>'tenants.create',   'icon'=>'fa-user-plus',                  'label'=>__('dashboard.add_tenant'),   'color'=>'#10b981'],
            ['route'=>'payments.create',  'icon'=>'fa-coins',                      'label'=>'Saisir un paiement',         'color'=>'#f59e0b'],
            ['route'=>'maintenances.create','icon'=>'fa-screwdriver-wrench',       'label'=>'Nouvelle intervention',      'color'=>'#ef4444'],
            ['route'=>'contracts.create', 'icon'=>'fa-file-signature',             'label'=>'Nouveau contrat',            'color'=>'#8b5cf6'],
            ['route'=>'reports.index',    'icon'=>'fa-chart-line',                 'label'=>__('nav.reports'),            'color'=>'#06b6d4'],
        ] as $action)
        <div class="col-6 col-md-4 col-xl-2">
            <a href="{{ route($action['route']) }}" class="quick-action-card" style="color:{{ $action['color'] }};border-color:{{ $action['color'] }}22;background:{{ $action['color'] }}0d;">
                <i class="fa-solid {{ $action['icon'] }}" style="color:{{ $action['color'] }};"></i>
                <span>{{ $action['label'] }}</span>
            </a>
        </div>
        @endforeach
    </div>
</div>

@endsection

@push('scripts')
<script>
const COLORS = {
    primary:  '#1e3a8a',
    success:  '#22c55e',
    warning:  '#f59e0b',
    danger:   '#ef4444',
    purple:   '#8b5cf6',
    cyan:     '#06b6d4',
    orange:   '#f97316',
    emerald:  '#10b981',
    gray:     '#94a3b8',
};

Chart.defaults.font.family = "'Inter', sans-serif";
Chart.defaults.font.size   = 12;

/* ── 1. Revenue 12 mois (ligne) ─────────────── */
const revenueData = @json($monthlyRevenue);
new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels: revenueData.map(d => d.label),
        datasets: [{
            label: 'Revenus encaissés',
            data: revenueData.map(d => d.amount),
            borderColor: COLORS.primary,
            backgroundColor: 'rgba(30,58,138,.07)',
            borderWidth: 2.5,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: COLORS.primary,
            pointRadius: 3,
            pointHoverRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false }, tooltip: { mode: 'index', callbacks: { label: ctx => ' ' + ctx.parsed.y.toLocaleString('fr-FR') + ' €' } } },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#94a3b8' } },
            y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { color: '#94a3b8', callback: v => v.toLocaleString('fr-FR') + ' €' } }
        }
    }
});

/* ── 2. Encaissé vs Attendu (barres groupées) ── */
const rveData = @json($revenueVsExpected);
new Chart(document.getElementById('revenueVsChart'), {
    type: 'bar',
    data: {
        labels: rveData.map(d => d.label),
        datasets: [
            {
                label: 'Encaissé',
                data: rveData.map(d => d.paid),
                backgroundColor: 'rgba(34,197,94,.8)',
                borderRadius: 5,
                borderSkipped: false,
            },
            {
                label: 'Attendu',
                data: rveData.map(d => d.expected),
                backgroundColor: 'rgba(30,58,138,.15)',
                borderRadius: 5,
                borderSkipped: false,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 16 } }, tooltip: { mode: 'index', callbacks: { label: ctx => ' ' + ctx.dataset.label + ' : ' + ctx.parsed.y.toLocaleString('fr-FR') + ' €' } } },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#94a3b8' } },
            y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { color: '#94a3b8', callback: v => v.toLocaleString('fr-FR') + ' €' } }
        }
    }
});

/* ── 3. Paiements du mois (donut) ───────────── */
const ps = @json($paymentStatus);
new Chart(document.getElementById('paymentStatusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Encaissé', 'En attente', 'En retard'],
        datasets: [{
            data: [ps.paid, ps.pending, ps.late],
            backgroundColor: [COLORS.success, COLORS.warning, COLORS.danger],
            borderWidth: 2, borderColor: '#fff',
            hoverOffset: 6,
        }]
    },
    options: {
        cutout: '65%',
        plugins: {
            legend: { position: 'bottom', labels: { boxWidth: 12, padding: 14 } },
            tooltip: { callbacks: { label: ctx => ' ' + ctx.label + ' : ' + ctx.parsed.toLocaleString('fr-FR') + ' €' } }
        }
    }
});

/* ── 4. Occupation (donut) ───────────────────── */
const occ = @json($occupancy);
new Chart(document.getElementById('occupancyChart'), {
    type: 'doughnut',
    data: {
        labels: ['Occupés', 'Vacants'],
        datasets: [{
            data: [occ.occupied, occ.vacant],
            backgroundColor: [COLORS.emerald, COLORS.orange],
            borderWidth: 2, borderColor: '#fff',
            hoverOffset: 6,
        }]
    },
    options: {
        cutout: '65%',
        plugins: {
            legend: { display: false },
            tooltip: { callbacks: { label: ctx => ' ' + ctx.label + ' : ' + ctx.parsed + ' bien(s)' } }
        }
    }
});

/* ── 5. Types de biens (donut) ──────────────── */
const pt = @json($propertiesByType);
const ptLabels = Object.keys(pt).map(k => k.charAt(0).toUpperCase() + k.slice(1));
const ptValues = Object.values(pt);
const ptColors = [COLORS.primary, COLORS.cyan, COLORS.warning, COLORS.purple, COLORS.emerald];
new Chart(document.getElementById('propertyTypeChart'), {
    type: 'doughnut',
    data: {
        labels: ptLabels,
        datasets: [{
            data: ptValues,
            backgroundColor: ptColors.slice(0, ptLabels.length),
            borderWidth: 2, borderColor: '#fff',
            hoverOffset: 6,
        }]
    },
    options: {
        cutout: '60%',
        plugins: {
            legend: { position: 'bottom', labels: { boxWidth: 12, padding: 10 } },
            tooltip: { callbacks: { label: ctx => ' ' + ctx.label + ' : ' + ctx.parsed + ' bien(s)' } }
        }
    }
});

/* ── 6. Maintenance (donut) ─────────────────── */
const ms = @json($maintenanceStatus);
new Chart(document.getElementById('maintenanceChart'), {
    type: 'doughnut',
    data: {
        labels: ['À faire', 'En cours', 'Terminées'],
        datasets: [{
            data: [ms.a_faire, ms.en_cours, ms.termine],
            backgroundColor: [COLORS.purple, COLORS.cyan, COLORS.success],
            borderWidth: 2, borderColor: '#fff',
            hoverOffset: 6,
        }]
    },
    options: {
        cutout: '65%',
        plugins: {
            legend: { display: false },
            tooltip: { callbacks: { label: ctx => ' ' + ctx.label + ' : ' + ctx.parsed } }
        }
    }
});
</script>
@endpush
