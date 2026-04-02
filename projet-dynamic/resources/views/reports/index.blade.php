@extends('layouts.app')
@section('title', __('reports.title'))
@section('content')

<x-page-header :title="__('reports.title')" :subtitle="__('reports.subtitle')" />

{{-- Year Selector --}}
<div class="data-table-wrap p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label-custom">{{ __('reports.year') }}</label>
            <select name="year" class="form-select" onchange="this.form.submit()">
                @foreach($availableYears as $y)
                <option value="{{ $y }}" @selected($year==$y)>{{ $y }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>

{{-- Annual Summary --}}
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <x-stat-card :label="__('reports.annual_revenue')" :value="number_format($financials['annual_total'] ?? 0, 0, ',', ' ').' €'" icon="euro-sign" variant="primary" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card :label="__('common.status_paye')" :value="number_format($financials['annual_paid'] ?? 0, 0, ',', ' ').' €'" icon="check-circle" variant="success" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card :label="__('common.status_attente')" :value="number_format($financials['annual_pending'] ?? 0, 0, ',', ' ').' €'" icon="clock" variant="accent" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card :label="__('common.status_retard')" :value="number_format($financials['annual_late'] ?? 0, 0, ',', ' ').' €'" icon="exclamation-triangle" variant="danger" />
    </div>
</div>

{{-- Financial Table --}}
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="data-table-wrap">
            <div class="p-3 border-bottom">
                <h6 class="fw-700 mb-0">{{ __('reports.monthly_revenue') }} {{ $year }}</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('reports.month') }}</th>
                            <th class="text-end">{{ __('common.status_paye') }}</th>
                            <th class="text-end">{{ __('common.status_attente') }}</th>
                            <th class="text-end">{{ __('common.status_retard') }}</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($financials['monthly'] ?? [] as $row)
                        <tr>
                            <td class="fw-600 small">{{ $row['label'] }}</td>
                            <td class="text-end small text-success">{{ number_format($row['paid'] ?? 0, 0, ',', ' ') }} €</td>
                            <td class="text-end small text-warning">{{ number_format($row['pending'] ?? 0, 0, ',', ' ') }} €</td>
                            <td class="text-end small text-danger">{{ number_format($row['late'] ?? 0, 0, ',', ' ') }} €</td>
                            <td class="text-end small fw-700">{{ number_format($row['total'] ?? 0, 0, ',', ' ') }} €</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td class="fw-700">Total {{ $year }}</td>
                            <td class="text-end fw-700 text-success">{{ number_format($financials['annual_paid'] ?? 0, 0, ',', ' ') }} €</td>
                            <td class="text-end fw-700 text-warning">{{ number_format($financials['annual_pending'] ?? 0, 0, ',', ' ') }} €</td>
                            <td class="text-end fw-700 text-danger">{{ number_format($financials['annual_late'] ?? 0, 0, ',', ' ') }} €</td>
                            <td class="text-end fw-700">{{ number_format($financials['annual_total'] ?? 0, 0, ',', ' ') }} €</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- Occupancy Stats --}}
    <div class="col-lg-4">
        <div class="data-table-wrap p-3 mb-4">
            <h6 class="fw-700 mb-3">{{ __('reports.occupancy') }}</h6>
            <div class="mb-3">
                <div class="d-flex justify-content-between small mb-1">
                    <span>{{ __('dashboard.occupancy_rate') }}</span>
                    <span class="fw-700">{{ $occupancy['rate'] ?? 0 }}%</span>
                </div>
                <div class="progress" style="height:10px;border-radius:8px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width:{{ $occupancy['rate'] ?? 0 }}%" aria-valuenow="{{ $occupancy['rate'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="row g-2 text-center">
                <div class="col-4">
                    <div class="data-table-wrap p-2">
                        <div class="fw-700 fs-5">{{ $occupancy['total'] ?? 0 }}</div>
                        <div class="small text-muted">Total</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="data-table-wrap p-2">
                        <div class="fw-700 fs-5 text-success">{{ $occupancy['occupied'] ?? 0 }}</div>
                        <div class="small text-muted">{{ __('dashboard.occupied') }}</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="data-table-wrap p-2">
                        <div class="fw-700 fs-5 text-warning">{{ $occupancy['vacant'] ?? 0 }}</div>
                        <div class="small text-muted">{{ __('dashboard.vacant') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Maintenance Stats --}}
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">{{ __('nav.maintenances') }}</h6>
            <div class="row g-2 text-center">
                <div class="col-6">
                    <div class="data-table-wrap p-2">
                        <div class="fw-700 fs-5 text-secondary">{{ $maintenanceStats['a_faire'] ?? 0 }}</div>
                        <div class="small text-muted">{{ __('common.status_a_faire') }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="data-table-wrap p-2">
                        <div class="fw-700 fs-5 text-primary">{{ $maintenanceStats['en_cours'] ?? 0 }}</div>
                        <div class="small text-muted">{{ __('common.status_en_cours') }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="data-table-wrap p-2">
                        <div class="fw-700 fs-5 text-success">{{ $maintenanceStats['termine'] ?? 0 }}</div>
                        <div class="small text-muted">{{ __('common.status_termine') }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="data-table-wrap p-2">
                        <div class="fw-700 fs-5 text-danger">{{ $maintenanceStats['urgent'] ?? 0 }}</div>
                        <div class="small text-muted">{{ __('maintenances.priority_urgente') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Revenue Chart --}}
<div class="data-table-wrap p-3">
    <h6 class="fw-700 mb-3">{{ __('reports.revenue_evolution') }} — {{ $year }}</h6>
    <canvas id="revenueReportChart" height="80"></canvas>
</div>

@endsection

@push('scripts')
<script>
const reportCtx = document.getElementById('revenueReportChart');
const reportData = @json($financials['monthly'] ?? []);
new Chart(reportCtx, {
    type: 'bar',
    data: {
        labels: reportData.map(d => d.label),
        datasets: [
            {
                label: '{{ __('common.status_paye') }}',
                data: reportData.map(d => d.paid ?? 0),
                backgroundColor: 'rgba(34,197,94,.7)',
                borderRadius: 4,
            },
            {
                label: '{{ __('common.status_attente') }}',
                data: reportData.map(d => d.pending ?? 0),
                backgroundColor: 'rgba(234,179,8,.7)',
                borderRadius: 4,
            },
            {
                label: '{{ __('common.status_retard') }}',
                data: reportData.map(d => d.late ?? 0),
                backgroundColor: 'rgba(239,68,68,.7)',
                borderRadius: 4,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' }
        },
        scales: {
            x: { stacked: true, grid: { display: false } },
            y: { stacked: true, beginAtZero: true, grid: { color: '#f1f5f9' } }
        }
    }
});
</script>
@endpush
