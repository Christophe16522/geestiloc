@extends('layouts.app')
@section('title', __('maintenances.title'))
@section('content')

<x-page-header :title="__('maintenances.title')" :subtitle="__('maintenances.empty_text')" :createRoute="'maintenances.create'" :createLabel="__('maintenances.add')" />

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
                    <option value="">{{ __('maintenances.all_statuses') }}</option>
                    <option value="a_faire"  @selected(request('status')==='a_faire')>{{ __('common.status_a_faire') }}</option>
                    <option value="en_cours" @selected(request('status')==='en_cours')>{{ __('common.status_en_cours') }}</option>
                    <option value="termine"  @selected(request('status')==='termine')>{{ __('common.status_termine') }}</option>
                </select>
            </div>
            <div class="filter-group">
                <span class="filter-label"><i class="fa-solid fa-arrow-up-wide-short me-1"></i>{{ __('maintenances.priority') }}</span>
                <select name="priority" class="form-select">
                    <option value="">{{ __('maintenances.all_priorities') }}</option>
                    <option value="haute"   @selected(request('priority')==='haute')>{{ __('common.priority_haute') }}</option>
                    <option value="moyenne" @selected(request('priority')==='moyenne')>{{ __('common.priority_moyenne') }}</option>
                    <option value="basse"   @selected(request('priority')==='basse')>{{ __('common.priority_basse') }}</option>
                </select>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fa-solid fa-filter"></i> {{ __('common.filter') }}
                </button>
                @if(request()->anyFilled(['search','status','priority']))
                <a href="{{ route('maintenances.index') }}" class="btn btn-ghost-custom">
                    <i class="fa-solid fa-xmark"></i> {{ __('common.reset') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>

@if($maintenances->isEmpty())
<x-empty-state icon="wrench" :title="__('maintenances.empty_title')" :text="__('maintenances.empty_text')" actionRoute="maintenances.create" :actionLabel="__('maintenances.add')" />
@else
<div class="row g-4">
    @foreach($maintenances as $m)
    <div class="col-md-6 col-xl-4">
        <div class="maintenance-card">
            <div class="maintenance-card__header">
                <div class="d-flex gap-2">
                    <x-status-badge :status="$m->status" type="maintenance" />
                    <x-status-badge :status="$m->priority" type="priority" />
                </div>
                <x-action-buttons :showRoute="route('maintenances.show', $m)" :editRoute="route('maintenances.edit', $m)" :deleteRoute="route('maintenances.destroy', $m)" :confirmMessage="__('maintenances.delete_confirm')" />
            </div>
            <h6 class="maintenance-card__title">{{ $m->title }}</h6>
            @if($m->property)
            <p class="maintenance-card__property"><i class="fa-solid fa-building me-1"></i>{{ $m->property->name }}</p>
            @endif
            <x-progress-bar :percentage="$m->progress_percentage" variant="primary" :showLabel="true" />
            @if($m->estimated_cost)
            <div class="maintenance-card__cost">
                <span class="text-muted small">{{ __('maintenances.estimated_cost') }}</span>
                <span class="fw-700 small">{{ number_format($m->estimated_cost, 0, ',', ' ') }} €</span>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
<div class="mt-4">{{ $maintenances->appends(request()->query())->links() }}</div>
@endif

@endsection
