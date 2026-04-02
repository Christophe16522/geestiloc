@extends('layouts.app')
@section('title', 'Modifier — ' . $maintenance->title)
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('maintenances.show', $maintenance) }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">Modifier — {{ $maintenance->title }}</h1>
</div>

<form method="POST" action="{{ route('maintenances.update', $maintenance) }}">
    @csrf
    @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <x-form-section title="Informations de l'intervention" :step="1">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">Titre *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $maintenance->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label-custom">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $maintenance->description) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Bien concerné *</label>
                        <select name="property_id" class="form-select @error('property_id') is-invalid @enderror" required>
                            <option value="">— Sélectionner un bien —</option>
                            @foreach($properties as $property)
                            <option value="{{ $property->id }}" @selected(old('property_id', $maintenance->property_id)==$property->id)>
                                {{ $property->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('property_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Priorité *</label>
                        <select name="priority" class="form-select @error('priority') is-invalid @enderror" required>
                            <option value="faible" @selected(old('priority', $maintenance->priority)=='faible')>Faible</option>
                            <option value="normale" @selected(old('priority', $maintenance->priority)=='normale')>Normale</option>
                            <option value="haute" @selected(old('priority', $maintenance->priority)=='haute')>Haute</option>
                            <option value="urgente" @selected(old('priority', $maintenance->priority)=='urgente')>Urgente</option>
                        </select>
                        @error('priority')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Coût estimé (€)</label>
                        <input type="number" name="estimated_cost" class="form-control @error('estimated_cost') is-invalid @enderror" value="{{ old('estimated_cost', $maintenance->estimated_cost) }}" step="0.01" min="0">
                        @error('estimated_cost')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Coût réel (€)</label>
                        <input type="number" name="actual_cost" class="form-control" value="{{ old('actual_cost', $maintenance->actual_cost) }}" step="0.01" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Statut *</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="a_faire" @selected(old('status', $maintenance->status)=='a_faire')>À faire</option>
                            <option value="en_cours" @selected(old('status', $maintenance->status)=='en_cours')>En cours</option>
                            <option value="termine" @selected(old('status', $maintenance->status)=='termine')>Terminé</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom d-flex justify-content-between">
                            <span>Avancement (%)</span>
                            <span id="editProgressValue" class="fw-600">{{ old('progress_percentage', $maintenance->progress_percentage ?? 0) }}%</span>
                        </label>
                        <input type="range" name="progress_percentage" class="form-range" min="0" max="100" step="5"
                               value="{{ old('progress_percentage', $maintenance->progress_percentage ?? 0) }}"
                               oninput="document.getElementById('editProgressValue').textContent = this.value + '%'">
                    </div>
                </div>
            </x-form-section>
        </div>
        <div class="col-lg-4">
            <div class="form-section">
                <div class="form-section-title">Actions</div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-2"></i>Mettre à jour</button>
                    <a href="{{ route('maintenances.show', $maintenance) }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </div>
            <div class="form-section mt-3">
                <div class="form-section-title text-danger">Zone de danger</div>
                <form method="POST" action="{{ route('maintenances.destroy', $maintenance) }}" onsubmit="return confirm('Supprimer définitivement cette maintenance ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100 btn-sm"><i class="fas fa-trash me-2"></i>Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</form>
@endsection
