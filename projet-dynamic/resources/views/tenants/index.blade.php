@extends('layouts.app')
@section('title', __('tenants.title'))
@section('content')

<x-page-header :title="__('tenants.title')" :subtitle="$tenants->total().' '.__('tenants.subtitle')" :createRoute="'tenants.create'" :createLabel="__('tenants.add')" />

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
                <span class="filter-label"><i class="fa-solid fa-sliders me-1"></i>{{ __('common.status') }}</span>
                <select name="status" class="form-select">
                    <option value="">{{ __('tenants.all_statuses') }}</option>
                    <option value="paye"    @selected(request('status')==='paye')>{{ __('common.status_paye') }}</option>
                    <option value="attente" @selected(request('status')==='attente')>{{ __('common.status_attente') }}</option>
                    <option value="retard"  @selected(request('status')==='retard')>{{ __('common.status_retard') }}</option>
                </select>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fa-solid fa-filter"></i> {{ __('common.filter') }}
                </button>
                @if(request()->anyFilled(['search','status']))
                <a href="{{ route('tenants.index') }}" class="btn btn-ghost-custom">
                    <i class="fa-solid fa-xmark"></i> {{ __('common.reset') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>

@if($tenants->isEmpty())
<x-empty-state icon="users" :title="__('tenants.empty_title')" :text="__('tenants.empty_text')" actionRoute="tenants.create" :actionLabel="__('tenants.add')" />
@else
<div class="row g-4">
    @foreach($tenants as $tenant)
    <div class="col-md-6 col-xl-4">
        <x-tenant-card :tenant="$tenant" />
    </div>
    @endforeach
</div>
<div class="mt-4">{{ $tenants->appends(request()->query())->links() }}</div>
@endif

@endsection
