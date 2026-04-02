@extends('layouts.app')
@section('title', __('properties.title'))
@section('content')

<x-page-header :title="__('properties.title')" :subtitle="$properties->total().' '.__('properties.subtitle')" :createRoute="'properties.create'" :createLabel="__('properties.add')" />

{{-- Filters --}}
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
                    <option value="">{{ __('properties.all_statuses') }}</option>
                    <option value="occupee" @selected(request('status')==='occupee')>{{ __('common.status_occupee') }}</option>
                    <option value="vacante" @selected(request('status')==='vacante')>{{ __('common.status_vacant') }}</option>
                </select>
            </div>
            <div class="filter-group">
                <span class="filter-label"><i class="fa-solid fa-tag me-1"></i>{{ __('properties.type') }}</span>
                <select name="type" class="form-select">
                    <option value="">{{ __('properties.all_types') }}</option>
                    @foreach(['appartement','maison','garage','commercial','terrain'] as $t)
                    <option value="{{ $t }}" @selected(request('type')===$t)>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fa-solid fa-filter"></i> {{ __('common.filter') }}
                </button>
                @if(request()->anyFilled(['search','status','type']))
                <a href="{{ route('properties.index') }}" class="btn btn-ghost-custom">
                    <i class="fa-solid fa-xmark"></i> {{ __('common.reset') }}
                </a>
                @endif
            </div>
        </div>
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
