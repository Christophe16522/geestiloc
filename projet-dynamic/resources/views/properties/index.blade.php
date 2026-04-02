@extends('layouts.app')
@section('title', __('properties.title'))
@section('content')

<x-page-header
    :title="__('properties.title')"
    :subtitle="__('properties.subtitle', ['count' => $properties->total()])"
    :createRoute="route('properties.create')"
    :createLabel="__('properties.add')"
/>

{{-- Filters --}}
<div class="data-table-wrap p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="{{ __('common.search') }}..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">{{ __('properties.all_statuses') }}</option>
                <option value="occupee" @selected(request('status')=='occupee')>{{ __('common.status_occupee') }}</option>
                <option value="vacante" @selected(request('status')=='vacante')>{{ __('common.status_vacante') }}</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="type" class="form-select">
                <option value="">{{ __('properties.all_types') }}</option>
                <option value="appartement" @selected(request('type')=='appartement')>{{ __('common.type_appartement') }}</option>
                <option value="maison" @selected(request('type')=='maison')>{{ __('common.type_maison') }}</option>
                <option value="studio" @selected(request('type')=='studio')>{{ __('common.type_studio') }}</option>
                <option value="commercial" @selected(request('type')=='commercial')>{{ __('common.type_commercial') }}</option>
                <option value="autre" @selected(request('type')=='autre')>{{ __('common.type_autre') }}</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary-custom w-100">{{ __('common.filter') }}</button>
        </div>
        @if(request()->hasAny(['search','status','type','city']))
        <div class="col-md-2">
            <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary w-100">{{ __('common.reset') }}</a>
        </div>
        @endif
    </form>
</div>

@if($properties->isEmpty())
    <x-empty-state icon="building" :title="__('properties.empty_title')" :text="__('properties.empty_text')" :actionRoute="route('properties.create')" :actionLabel="__('properties.add')" />
@else
<div class="row g-4">
    @foreach($properties as $property)
    <div class="col-sm-6 col-xl-4">
        <x-property-card :property="$property" />
    </div>
    @endforeach
</div>
<div class="mt-4">{{ $properties->links() }}</div>
@endif

@endsection
