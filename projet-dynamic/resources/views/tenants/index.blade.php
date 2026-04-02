@extends('layouts.app')
@section('title', __('tenants.title'))
@section('content')

<x-page-header :title="__('tenants.title')" :subtitle="$tenants->total().' '.__('tenants.subtitle')" :createRoute="'tenants.create'" :createLabel="__('tenants.add')" />

<div class="filters-bar mb-4">
    <form method="GET" class="d-flex flex-wrap gap-2 align-items-center">
        <div class="search-input-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" class="form-control form-control-sm search-input" placeholder="{{ __('common.search') }}" value="{{ request('search') }}">
        </div>
        <select name="status" class="form-select form-select-sm filter-select">
            <option value="">{{ __('tenants.all_statuses') }}</option>
            <option value="paye" @selected(request('status')==='paye')>{{ __('common.status_paye') }}</option>
            <option value="attente" @selected(request('status')==='attente')>{{ __('common.status_attente') }}</option>
            <option value="retard" @selected(request('status')==='retard')>{{ __('common.status_retard') }}</option>
        </select>
        <button type="submit" class="btn btn-primary-custom btn-sm">{{ __('common.filter') }}</button>
        @if(request()->anyFilled(['search','status']))
        <a href="{{ route('tenants.index') }}" class="btn btn-ghost-custom btn-sm">{{ __('common.reset') }}</a>
        @endif
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
