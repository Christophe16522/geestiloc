@extends('layouts.app')
@section('title', 'Ajouter un document')
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('documents.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">Ajouter un document</h1>
</div>

<form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <x-form-section title="Informations du document" :step="1">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label-custom">Nom du document *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Catégorie *</label>
                        <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                            <option value="">— Choisir —</option>
                            @foreach(['contrat','quittance','attestation','assurance','facture','autre'] as $cat)
                            <option value="{{ $cat }}" @selected(old('category')==$cat)>{{ ucfirst($cat) }}</option>
                            @endforeach
                        </select>
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Bien associé</label>
                        <select name="property_id" class="form-select @error('property_id') is-invalid @enderror">
                            <option value="">— Aucun bien —</option>
                            @foreach($properties as $property)
                            <option value="{{ $property->id }}" @selected(old('property_id')==$property->id)>
                                {{ $property->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('property_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Date d'expiration</label>
                        <input type="date" name="expiration_date" class="form-control @error('expiration_date') is-invalid @enderror" value="{{ old('expiration_date') }}">
                        @error('expiration_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Fichier" :step="2">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">Fichier *</label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text text-muted">Formats acceptés : PDF, DOC, DOCX, JPG, PNG. Taille max : 10 Mo.</div>
                    </div>
                </div>
            </x-form-section>
        </div>
        <div class="col-lg-4">
            <div class="form-section">
                <div class="form-section-title">Actions</div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom"><i class="fas fa-upload me-2"></i>Enregistrer</button>
                    <a href="{{ route('documents.index') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </div>
            <div class="form-section mt-3">
                <div class="form-section-title">Informations</div>
                <ul class="list-unstyled small text-muted mb-0">
                    <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Taille max : 10 Mo</li>
                    <li class="mb-1"><i class="fas fa-check text-success me-2"></i>PDF, DOC, DOCX acceptés</li>
                    <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Images JPG, PNG acceptées</li>
                </ul>
            </div>
        </div>
    </div>
</form>
@endsection
