@extends('layouts.app')
@section('title', 'Mes locataires')
@section('content')

<x-page-header
    title="Mes locataires"
    subtitle="{{ $tenants->total() }} locataire(s) enregistré(s)"
    :createRoute="route('tenants.create')"
    createLabel="Ajouter un locataire"
/>

{{-- Filters --}}
<div class="data-table-wrap p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par nom, email..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="payment_status" class="form-select">
                <option value="">Tous statuts</option>
                <option value="paye" @selected(request('payment_status')=='paye')>Payé</option>
                <option value="attente" @selected(request('payment_status')=='attente')>En attente</option>
                <option value="retard" @selected(request('payment_status')=='retard')>En retard</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary-custom w-100">Filtrer</button>
        </div>
        @if(request()->hasAny(['search','payment_status']))
        <div class="col-md-2">
            <a href="{{ route('tenants.index') }}" class="btn btn-outline-secondary w-100">Réinitialiser</a>
        </div>
        @endif
    </form>
</div>

@if($tenants->isEmpty())
    <x-empty-state icon="users" title="Aucun locataire trouvé" text="Commencez par ajouter votre premier locataire." :actionRoute="route('tenants.create')" actionLabel="Ajouter un locataire" />
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
