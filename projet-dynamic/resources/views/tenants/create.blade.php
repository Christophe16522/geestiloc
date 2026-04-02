@extends('layouts.app')
@section('title', 'Ajouter un locataire')
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('tenants.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">Ajouter un locataire</h1>
</div>

<form method="POST" action="{{ route('tenants.store') }}">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <x-form-section title="Informations personnelles" :step="1">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Prénom *</label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Nom *</label>
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Email *</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Téléphone</label>
                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Informations de location" :step="2">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Bien loué</label>
                        <select name="property_id" class="form-select @error('property_id') is-invalid @enderror">
                            <option value="">— Sélectionner un bien —</option>
                            @foreach($properties as $property)
                            <option value="{{ $property->id }}" @selected(old('property_id')==$property->id)>
                                {{ $property->name }} — {{ $property->full_address }}
                            </option>
                            @endforeach
                        </select>
                        @error('property_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Loyer mensuel (€) *</label>
                        <input type="number" name="monthly_rent" class="form-control @error('monthly_rent') is-invalid @enderror" value="{{ old('monthly_rent') }}" step="0.01" min="0" required>
                        @error('monthly_rent')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Date de début de bail</label>
                        <input type="date" name="lease_start_date" class="form-control @error('lease_start_date') is-invalid @enderror" value="{{ old('lease_start_date') }}">
                        @error('lease_start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Statut de paiement</label>
                        <select name="payment_status" class="form-select @error('payment_status') is-invalid @enderror">
                            <option value="attente" @selected(old('payment_status')=='attente')>En attente</option>
                            <option value="paye" @selected(old('payment_status')=='paye')>Payé</option>
                            <option value="retard" @selected(old('payment_status')=='retard')>En retard</option>
                        </select>
                        @error('payment_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>
        </div>
        <div class="col-lg-4">
            <div class="form-section">
                <div class="form-section-title">Actions</div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-2"></i>Enregistrer</button>
                    <a href="{{ route('tenants.index') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
