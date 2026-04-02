@extends('layouts.app')
@section('title', __('dashboard.title'))
@section('content')

<x-page-header :title="__('dashboard.title')" :subtitle="__('dashboard.subtitle')" />

{{-- KPI Cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <x-stat-card :label="__('dashboard.total_properties')" :value="$stats['total_properties']" icon="building" variant="primary" />
    </div>
    <div class="col-6 col-xl-3">
        <x-stat-card :label="__('dashboard.occupancy_rate')" :value="$stats['occupancy_rate'].'%'" icon="house-circle-check" variant="success" />
    </div>
    <div class="col-6 col-xl-3">
        <x-stat-card :label="__('dashboard.monthly_revenue')" :value="number_format($stats['monthly_revenue'], 0, ',', ' ').' €'" icon="euro-sign" variant="accent" />
    </div>
    <div class="col-6 col-xl-3">
        <x-stat-card :label="__('dashboard.late_rents')" :value="$stats['late_rents']" icon="triangle-exclamation" variant="danger" />
    </div>
</div>

<div class="row g-4 mb-4">
    {{-- Revenue Chart --}}
    <div class="col-lg-8">
        <div class="chart-card">
            <div class="chart-card__header">
                <div>
                    <h6 class="chart-card__title">{{ __('dashboard.revenue_chart') }}</h6>
                    <p class="chart-card__subtitle">{{ now()->year }}</p>
                </div>
            </div>
            <div class="chart-card__body">
                <canvas id="revenueChart" height="90"></canvas>
            </div>
        </div>
    </div>

    {{-- Alerts --}}
    <div class="col-lg-4">
        <div class="data-table-wrap h-100">
            <div class="p-3 border-bottom d-flex align-items-center gap-2">
                <i class="fa-solid fa-bell text-warning"></i>
                <h6 class="fw-600 mb-0">{{ __('dashboard.alerts') }}</h6>
            </div>
            <div class="p-2">
                @forelse($alerts as $alert)
                <div class="alert-item alert-item--{{ $alert['type'] }}">
                    <i class="fa-solid fa-{{ $alert['icon'] }}"></i>
                    <span>{{ $alert['message'] }}</span>
                </div>
                @empty
                <div class="text-center py-4 text-muted">
                    <i class="fa-solid fa-circle-check fa-2x mb-2 text-success"></i>
                    <p class="small mb-0">{{ __('dashboard.no_alerts') }}</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="data-table-wrap p-3">
    <h6 class="fw-600 mb-3">{{ __('dashboard.quick_access') }}</h6>
    <div class="row g-3">
        @foreach([
            ['route'=>'properties.create','icon'=>'fa-plus','label'=>__('dashboard.add_property'),'color'=>'#3b82f6'],
            ['route'=>'tenants.create','icon'=>'fa-user-plus','label'=>__('dashboard.add_tenant'),'color'=>'#10b981'],
            ['route'=>'payments.index','icon'=>'fa-euro-sign','label'=>__('nav.payments'),'color'=>'#f59e0b'],
            ['route'=>'reports.index','icon'=>'fa-chart-bar','label'=>__('nav.reports'),'color'=>'#8b5cf6'],
        ] as $action)
        <div class="col-6 col-md-3">
            <a href="{{ route($action['route']) }}" class="quick-action-card" style="--qa-color:{{ $action['color'] }};">
                <i class="fa-solid {{ $action['icon'] }}"></i>
                <span>{{ $action['label'] }}</span>
            </a>
        </div>
        @endforeach
    </div>
</div>

@endsection
@push('scripts')
<script>
const ctx = document.getElementById('revenueChart');
const chartData = @json($monthlyRevenue ?? []);
new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData.map(d => d.month),
        datasets: [{
            label: '{{ __("dashboard.revenue") }}',
            data: chartData.map(d => d.amount),
            borderColor: '#1e3a8a',
            backgroundColor: 'rgba(30,58,138,.08)',
            borderWidth: 2.5,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#1e3a8a',
            pointRadius: 4,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false } },
            y: { beginAtZero: true, grid: { color: '#f1f5f9' } }
        }
    }
});
</script>
@endpush
