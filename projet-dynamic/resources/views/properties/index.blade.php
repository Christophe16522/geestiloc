@extends('layouts.app')
@section('title', __('properties.title'))
@section('content')

<x-page-header :title="__('properties.title')" :subtitle="$properties->total().' '.__('properties.subtitle')" :createRoute="'properties.create'" :createLabel="__('properties.add')" />

{{-- Filters --}}
<div class="filters-bar mb-4">
    <form method="GET" class="d-flex flex-wrap gap-2 align-items-center">
        <div class="search-input-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" class="form-control form-control-sm search-input" placeholder="{{ __('common.search') }}" value="{{ request('search') }}">
        </div>
        <select name="status" class="form-select form-select-sm filter-select">
            <option value="">{{ __('properties.all_statuses') }}</option>
            <option value="occupee" @selected(request('status')==='occupee')>{{ __('common.status_occupee') }}</option>
            <option value="vacante" @selected(request('status')==='vacante')>{{ __('common.status_vacant') }}</option>
        </select>
        <select name="type" class="form-select form-select-sm filter-select">
            <option value="">{{ __('properties.all_types') }}</option>
            @foreach(['appartement','maison','garage','commercial','terrain'] as $t)
            <option value="{{ $t }}" @selected(request('type')===$t)>{{ ucfirst($t) }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary-custom btn-sm">{{ __('common.filter') }}</button>
        @if(request()->anyFilled(['search','status','type']))
        <a href="{{ route('properties.index') }}" class="btn btn-ghost-custom btn-sm">{{ __('common.reset') }}</a>
        @endif
    </form>
</div>

@if($properties->isEmpty())
<x-empty-state icon="building" :title="__('properties.empty_title')" :text="__('properties.empty_text')" actionRoute="properties.create" :actionLabel="__('properties.add')" />
@else
<div class="row g-4">
    @foreach($properties as $property)
    <div class="col-md-6 col-xl-4">
        <x-property-card :property="$property" />
    </div>
    @endforeach
</div>
<div class="mt-4">{{ $properties->appends(request()->query())->links() }}</div>
@endif

@endsection
