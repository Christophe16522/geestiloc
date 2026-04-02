@extends('layouts.app')
@section('title', __('contracts.title'))
@section('content')

<x-page-header :title="__('contracts.title')" :subtitle="__('contracts.subtitle')" :createRoute="'contracts.create'" :createLabel="__('contracts.add')" />

<div class="filters-bar mb-4">
    <form method="GET">
        <div class="d-flex flex-wrap gap-3 align-items-end">
            <div class="filter-group filter-group--search">
                <span class="filter-label"><i class="fa-solid fa-magnifying-glass me-1"></i>{{ __('common.search') }}</span>
                <div class="search-input-wrap">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" class="form-control search-input" placeholder="{{ __('common.search') }}…" value="{{ request('search') }}">
                </div>
            </div>
            <div class="filter-group">
                <span class="filter-label"><i class="fa-solid fa-circle-dot me-1"></i>{{ __('common.status') }}</span>
                <select name="status" class="form-select">
                    <option value="">{{ __('contracts.all_statuses') }}</option>
                    <option value="actif"   @selected(request('status')==='actif')>{{ __('common.status_actif') }}</option>
                    <option value="expire"  @selected(request('status')==='expire')>{{ __('common.status_expire') }}</option>
                    <option value="archive" @selected(request('status')==='archive')>{{ __('common.status_archive') }}</option>
                </select>
            </div>
            <div class="filter-group">
                <span class="filter-label"><i class="fa-solid fa-tag me-1"></i>{{ __('contracts.type') }}</span>
                <select name="type" class="form-select">
                    <option value="">{{ __('contracts.all_types') }}</option>
                    <option value="vide"       @selected(request('type')==='vide')>{{ __('contracts.type_vide') }}</option>
                    <option value="meuble"     @selected(request('type')==='meuble')>{{ __('contracts.type_meuble') }}</option>
                    <option value="commercial" @selected(request('type')==='commercial')>{{ __('contracts.type_commercial') }}</option>
                </select>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fa-solid fa-filter"></i> {{ __('common.filter') }}
                </button>
                @if(request()->anyFilled(['search','status','type']))
                <a href="{{ route('contracts.index') }}" class="btn btn-ghost-custom">
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
                    <th>{{ __('contracts.tenant') }}</th>
                    <th>{{ __('contracts.property') }}</th>
                    <th>{{ __('contracts.type') }}</th>
                    <th>{{ __('contracts.start_date') }}</th>
                    <th>{{ __('contracts.end_date') }}</th>
                    <th class="text-end">{{ __('contracts.monthly_rent') }}</th>
                    <th>{{ __('common.status') }}</th>
                    <th class="text-end">{{ __('common.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contracts as $contract)
                <tr>
                    <td><span class="fw-600 small">{{ $contract->tenant->getFullNameAttribute() }}</span></td>
                    <td><span class="small text-muted">{{ $contract->property->name }}</span></td>
                    <td><span class="small">{{ ucfirst($contract->type) }}</span></td>
                    <td><span class="small">{{ \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') }}</span></td>
                    <td>
                        <span class="small {{ $contract->getIsExpiringAttribute() ? 'text-danger fw-600' : '' }}">
                            {{ $contract->end_date ? \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') : '—' }}
                        </span>
                    </td>
                    <td class="text-end fw-700 small">{{ number_format($contract->monthly_rent, 0, ',', ' ') }} €</td>
                    <td><x-status-badge :status="$contract->status" type="contract" /></td>
                    <td class="text-end">
                        <div class="d-flex gap-1 justify-content-end">
                            @if($contract->status === 'actif')
                            <form method="POST" action="{{ route('contracts.archive', $contract) }}">
                                @csrf @method('PATCH')
                                <button class="action-btn" title="{{ __('contracts.archive') }}" style="color:#64748b;"><i class="fa-solid fa-box-archive"></i></button>
                            </form>
                            @endif
                            <x-action-buttons :showRoute="route('contracts.show', $contract)" :editRoute="route('contracts.edit', $contract)" :deleteRoute="route('contracts.destroy', $contract)" :confirmMessage="__('contracts.delete_confirm')" />
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8"><x-empty-state icon="file-contract" :title="__('contracts.empty_title')" :text="__('contracts.empty_text')" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $contracts->appends(request()->query())->links() }}</div>

@endsection
