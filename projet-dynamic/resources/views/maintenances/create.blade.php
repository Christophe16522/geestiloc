@extends('layouts.app')
@section('title', 'Nouvelle maintenance')
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('maintenances.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">Nouvelle maintenance</h1>
</div>

<form method="POST" action="{{ route('maintenances.store') }}">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <x-form-section title="Informations de l'intervention" :step="1">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">Titre *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required placeholder="Ex : Fuite robinet salle de bain">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label-custom">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Décrivez l'intervention en détail...">{{ old('description') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Bien concerné *</label>
                        <select name="property_id" class="form-select @error('property_id') is-invalid @enderror" required>
                            <option value="">— Sélectionner un bien —</option>
                            @foreach($properties as $property)
                            <option value="{{ $property->id }}" @selected(old('property_id')==$property->id)>
                                {{ $property->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('property_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Priorité *</label>
                        <select name="priority" class="form-select @error('priority') is-invalid @enderror" required>
                            <option value="faible" @selected(old('priority')=='faible')>Faible</option>
                            <option value="normale" @selected(old('priority', 'normale')=='normale')>Normale</option>
                            <option value="haute" @selected(old('priority')=='haute')>Haute</option>
                            <option value="urgente" @selected(old('priority')=='urgente')>Urgente</option>
                        </select>
                        @error('priority')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Coût estimé (€)</label>
                        <input type="number" name="estimated_cost" class="form-control @error('estimated_cost') is-invalid @enderror" value="{{ old('estimated_cost') }}" step="0.01" min="0">
                        @error('estimated_cost')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Statut *</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="a_faire" @selected(old('status', 'a_faire')=='a_faire')>À faire</option>
                            <option value="en_cours" @selected(old('status')=='en_cours')>En cours</option>
                            <option value="termine" @selected(old('status')=='termine')>Terminé</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Avancement (%)</label>
                        <input type="number" name="progress_percentage" class="form-control" value="{{ old('progress_percentage', 0) }}" min="0" max="100">
                    </div>
                </div>
            </x-form-section>
        </div>
        <div class="col-lg-4">
            <div class="form-section">
                <div class="form-section-title">Actions</div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-2"></i>Enregistrer</button>
                    <a href="{{ route('maintenances.index') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </div>
            <div class="form-section mt-3">
                <div class="form-section-title">Niveaux de priorité</div>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><span class="badge bg-success me-2">Faible</span>Pas urgent</li>
                    <li class="mb-1"><span class="badge bg-primary me-2">Normale</span>Standard</li>
                    <li class="mb-1"><span class="badge bg-warning me-2">Haute</span>À traiter rapidement</li>
                    <li class="mb-1"><span class="badge bg-danger me-2">Urgente</span>Intervention immédiate</li>
                </ul>
            </div>
        </div>
    </div>
</form>
@endsection
