@extends('layouts.app')
@section('title', 'Mes biens')
@section('content')

<x-page-header
    title="Mes biens immobiliers"
    subtitle="{{ $properties->total() }} bien(s) dans votre portefeuille"
    :createRoute="route('properties.create')"
    createLabel="Ajouter un bien"
/>

{{-- Filters --}}
<div class="data-table-wrap p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">Tous statuts</option>
                <option value="occupee" @selected(request('status')=='occupee')>Occupé</option>
                <option value="vacante" @selected(request('status')=='vacante')>Vacant</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="type" class="form-select">
                <option value="">Tous types</option>
                @foreach(['appartement','maison','studio','commercial','autre'] as $t)
                <option value="{{ $t }}" @selected(request('type')==$t)>{{ ucfirst($t) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary-custom w-100">Filtrer</button>
        </div>
        @if(request()->hasAny(['search','status','type','city']))
        <div class="col-md-2">
            <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary w-100">Réinitialiser</a>
        </div>
        @endif
    </form>
</div>

@if($properties->isEmpty())
    <x-empty-state icon="building" title="Aucun bien trouvé" text="Commencez par ajouter votre premier bien immobilier." :actionRoute="route('properties.create')" actionLabel="Ajouter un bien" />
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
