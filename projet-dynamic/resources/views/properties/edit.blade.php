@extends('layouts.app')
@section('title', 'Modifier — ' . $property->name)
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('properties.show', $property) }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">Modifier — {{ $property->name }}</h1>
</div>

<form method="POST" action="{{ route('properties.update', $property) }}">
    @csrf
    @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <x-form-section title="Informations générales" :step="1">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Nom du bien *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $property->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Type *</label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                            @foreach(['appartement','maison','studio','commercial','autre'] as $t)
                            <option value="{{ $t }}" @selected(old('type', $property->type)==$t)>{{ ucfirst($t) }}</option>
                            @endforeach
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label-custom">Adresse *</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $property->address) }}" required>
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Code postal</label>
                        <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $property->postal_code) }}">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label-custom">Ville *</label>
                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $property->city) }}" required>
                        @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Informations financières" :step="2">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Loyer mensuel (€) *</label>
                        <input type="number" name="monthly_rent" class="form-control @error('monthly_rent') is-invalid @enderror" value="{{ old('monthly_rent', $property->monthly_rent) }}" step="0.01" min="0" required>
                        @error('monthly_rent')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Charges (€)</label>
                        <input type="number" name="charges" class="form-control" value="{{ old('charges', $property->charges) }}" step="0.01" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Dépôt de garantie (€)</label>
                        <input type="number" name="deposit" class="form-control" value="{{ old('deposit', $property->deposit) }}" step="0.01" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Surface (m²)</label>
                        <input type="number" name="surface_m2" class="form-control" value="{{ old('surface_m2', $property->surface_m2) }}" step="0.01" min="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Statut *</label>
                        <select name="status" class="form-select" required>
                            <option value="vacante" @selected(old('status', $property->status)=='vacante')>Vacant</option>
                            <option value="occupee" @selected(old('status', $property->status)=='occupee')>Occupé</option>
                        </select>
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Description" :step="3">
                <textarea name="description" class="form-control" rows="4" placeholder="Description du bien...">{{ old('description', $property->description) }}</textarea>
            </x-form-section>
        </div>
        <div class="col-lg-4">
            <div class="form-section">
                <div class="form-section-title">Actions</div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-2"></i>Mettre à jour</button>
                    <a href="{{ route('properties.show', $property) }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </div>
            <div class="form-section mt-3">
                <div class="form-section-title text-danger">Zone de danger</div>
                <form method="POST" action="{{ route('properties.destroy', $property) }}" onsubmit="return confirm('Supprimer définitivement ce bien ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100 btn-sm"><i class="fas fa-trash me-2"></i>Supprimer ce bien</button>
                </form>
            </div>
        </div>
    </div>
</form>
@endsection
