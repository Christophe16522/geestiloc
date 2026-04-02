@extends('layouts.app')
@section('title', __('contracts.title'))
@section('content')

<x-page-header
    :title="__('contracts.title')"
    :subtitle="__('contracts.subtitle', ['count' => $contracts->total()])"
    :createRoute="route('contracts.create')"
    :createLabel="__('contracts.add')"
/>

{{-- Filters --}}
<div class="data-table-wrap p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="{{ __('common.search') }}..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">{{ __('contracts.all_statuses') }}</option>
                <option value="actif" @selected(request('status')=='actif')>{{ __('common.status_actif') }}</option>
                <option value="expire" @selected(request('status')=='expire')>{{ __('common.status_expire') }}</option>
                <option value="archive" @selected(request('status')=='archive')>{{ __('common.status_archive') }}</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="type" class="form-select">
                <option value="">{{ __('contracts.all_types') }}</option>
                <option value="bail" @selected(request('type')=='bail')>{{ __('contracts.type_bail') }}</option>
                <option value="sous-location" @selected(request('type')=='sous-location')>{{ __('contracts.type_sous_location') }}</option>
                <option value="meuble" @selected(request('type')=='meuble')>{{ __('contracts.type_meuble') }}</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary-custom w-100">{{ __('common.filter') }}</button>
        </div>
        @if(request()->hasAny(['search','status','type']))
        <div class="col-md-2">
            <a href="{{ route('contracts.index') }}" class="btn btn-outline-secondary w-100">{{ __('common.reset') }}</a>
        </div>
        @endif
    </form>
</div>

@if($contracts->isEmpty())
    <x-empty-state icon="file-contract" :title="__('contracts.empty_title')" :text="__('contracts.empty_text')" :actionRoute="route('contracts.create')" :actionLabel="__('contracts.add')" />
@else
<div class="data-table-wrap">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>{{ __('contracts.tenant') }}</th>
                    <th>{{ __('contracts.property') }}</th>
                    <th>{{ __('common.type') }}</th>
                    <th>{{ __('contracts.start_date') }}</th>
                    <th>{{ __('contracts.end_date') }}</th>
                    <th>{{ __('contracts.monthly_rent') }}</th>
                    <th>{{ __('common.status') }}</th>
                    <th class="text-end">{{ __('common.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contracts as $contract)
                <tr>
                    <td>
                        @if($contract->tenant)
                        <a href="{{ route('tenants.show', $contract->tenant) }}" class="fw-600 text-decoration-none small">
                            {{ $contract->tenant->full_name }}
                        </a>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td>
                        @if($contract->property)
                        <a href="{{ route('properties.show', $contract->property) }}" class="text-decoration-none small">
                            {{ $contract->property->name }}
                        </a>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ ucfirst($contract->type ?? '—') }}</span>
                    </td>
                    <td class="small text-muted">{{ $contract->start_date?->format('d/m/Y') ?? '—' }}</td>
                    <td class="small text-muted">{{ $contract->end_date?->format('d/m/Y') ?? '—' }}</td>
                    <td class="small fw-600">{{ number_format($contract->monthly_rent, 0, ',', ' ') }} €</td>
                    <td><x-status-badge :status="$contract->status" type="contract" /></td>
                    <td class="text-end">
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{ route('contracts.show', $contract) }}" class="btn btn-xs btn-outline-secondary btn-sm py-0 px-2" title="{{ __('common.edit') }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-xs btn-outline-primary btn-sm py-0 px-2" title="{{ __('common.edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($contract->status !== 'archive')
                            <form method="POST" action="{{ route('contracts.archive', $contract) }}">
                                @csrf @method('PATCH')
                                <button class="btn btn-xs btn-outline-warning btn-sm py-0 px-2" title="{{ __('contracts.archive') }}" onclick="return confirm('{{ __('contracts.archive_confirm') }}')">
                                    <i class="fas fa-archive"></i>
                                </button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('contracts.destroy', $contract) }}" onsubmit="return confirm('{{ __('contracts.delete_confirm') }}')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger btn-sm py-0 px-2" title="{{ __('common.delete') }}">
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
<div class="mt-4">{{ $contracts->links() }}</div>
@endif

@endsection
