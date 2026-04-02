@extends('layouts.app')
@section('title', __('tenants.title'))
@section('content')

<x-page-header
    :title="__('tenants.title')"
    :subtitle="__('tenants.subtitle', ['count' => $tenants->total()])"
    :createRoute="route('tenants.create')"
    :createLabel="__('tenants.add')"
/>

{{-- Filters --}}
<div class="data-table-wrap p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" placeholder="{{ __('common.search') }}..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="payment_status" class="form-select">
                <option value="">{{ __('tenants.all_statuses') }}</option>
                <option value="paye" @selected(request('payment_status')=='paye')>{{ __('common.status_paye') }}</option>
                <option value="attente" @selected(request('payment_status')=='attente')>{{ __('common.status_attente') }}</option>
                <option value="retard" @selected(request('payment_status')=='retard')>{{ __('common.status_retard') }}</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary-custom w-100">{{ __('common.filter') }}</button>
        </div>
        @if(request()->hasAny(['search','payment_status']))
        <div class="col-md-2">
            <a href="{{ route('tenants.index') }}" class="btn btn-outline-secondary w-100">{{ __('common.reset') }}</a>
        </div>
        @endif
    </form>
</div>

@if($tenants->isEmpty())
    <x-empty-state icon="users" :title="__('tenants.empty_title')" :text="__('tenants.empty_text')" :actionRoute="route('tenants.create')" :actionLabel="__('tenants.add')" />
@else
<div class="row g-4">
    @foreach($tenants as $tenant)
    <div class="col-sm-6 col-xl-4">
        <x-tenant-card :tenant="$tenant" />
    </div>
    @endforeach
</div>
<div class="mt-4">{{ $tenants->links() }}</div>
@endif

@endsection
