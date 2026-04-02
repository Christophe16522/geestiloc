@extends('layouts.app')
@section('title', __('payments.title'))
@section('content')

<x-page-header :title="__('payments.title')" :subtitle="__('payments.subtitle')" :createRoute="'payments.create'" :createLabel="__('payments.add')" />

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <x-stat-card :label="__('common.status_paye')" :value="number_format($stats['paid'] ?? 0, 0, ',', ' ').' €'" icon="circle-check" variant="success" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card :label="__('common.status_attente')" :value="number_format($stats['pending'] ?? 0, 0, ',', ' ').' €'" icon="hourglass-half" variant="accent" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card :label="__('common.status_retard')" :value="number_format($stats['late'] ?? 0, 0, ',', ' ').' €'" icon="circle-exclamation" variant="danger" />
    </div>
    <div class="col-6 col-lg-3">
        <x-stat-card :label="__('payments.total')" :value="number_format(($stats['paid']??0)+($stats['pending']??0)+($stats['late']??0), 0, ',', ' ').' €'" icon="coins" variant="primary" />
    </div>
</div>

{{-- Filters --}}
<div class="filters-bar mb-3">
    <form method="GET">
        <div class="d-flex flex-wrap gap-3 align-items-end">
            <div class="filter-group">
                <span class="filter-label"><i class="fa-solid fa-sliders me-1"></i>{{ __('common.status') }}</span>
                <select name="status" class="form-select">
                    <option value="">{{ __('payments.all_statuses') }}</option>
                    <option value="paye"    @selected(request('status')==='paye')>{{ __('common.status_paye') }}</option>
                    <option value="attente" @selected(request('status')==='attente')>{{ __('common.status_attente') }}</option>
                    <option value="retard"  @selected(request('status')==='retard')>{{ __('common.status_retard') }}</option>
                </select>
            </div>
            <div class="filter-group">
                <span class="filter-label"><i class="fa-solid fa-calendar-week me-1"></i>{{ __('payments.period') }}</span>
                <select name="month" class="form-select">
                    <option value="">{{ __('payments.all_months') }}</option>
                    @foreach(range(1,12) as $m)
                    <option value="{{ $m }}" @selected(request('month')==(string)$m)>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group" style="min-width:90px;">
                <span class="filter-label"><i class="fa-solid fa-calendar-alt me-1"></i>{{ __('reports.year') }}</span>
                <select name="year" class="form-select">
                    @foreach(range(now()->year, now()->year-3) as $y)
                    <option value="{{ $y }}" @selected(request('year')==(string)$y || (!request('year') && $y===now()->year))>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fa-solid fa-filter"></i> {{ __('common.filter') }}
                </button>
                @if(request()->anyFilled(['status','month','year']))
                <a href="{{ route('payments.index') }}" class="btn btn-ghost-custom">
                    <i class="fa-solid fa-xmark"></i> {{ __('common.reset') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>

<div class="data-table-wrap">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>{{ __('payments.tenant') }}</th>
                    <th>{{ __('payments.property') }}</th>
                    <th>{{ __('payments.period') }}</th>
                    <th class="text-end">{{ __('payments.amount') }}</th>
                    <th>{{ __('common.status') }}</th>
                    <th>{{ __('payments.payment_date') }}</th>
                    <th class="text-end">{{ __('common.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td>
                        <div class="fw-600 small">{{ $payment->tenant->getFullNameAttribute() }}</div>
                    </td>
                    <td><span class="small text-muted">{{ $payment->property->name ?? '—' }}</span></td>
                    <td><span class="small">{{ $payment->getPeriodLabelAttribute() }}</span></td>
                    <td class="text-end fw-700">{{ number_format($payment->amount, 0, ',', ' ') }} €</td>
                    <td><x-status-badge :status="$payment->status" type="payment" /></td>
                    <td><span class="small text-muted">{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') : '—' }}</span></td>
                    <td class="text-end">
                        <div class="d-flex gap-1 justify-content-end align-items-center">
                            @if($payment->status !== 'paye')
                            <form method="POST" action="{{ route('payments.markPaid', $payment) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="action-btn action-btn--success" title="{{ __('payments.mark_paid') }}">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </form>
                            @endif
                            <x-action-buttons :showRoute="route('payments.show', $payment)" :editRoute="route('payments.edit', $payment)" :deleteRoute="route('payments.destroy', $payment)" :confirmMessage="__('payments.delete_confirm')" />
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7"><x-empty-state icon="euro-sign" :title="__('payments.empty_title')" :text="__('payments.empty_text')" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $payments->appends(request()->query())->links() }}</div>

@endsection
