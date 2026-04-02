@extends('layouts.app')
@section('title', 'Modifier le contrat')
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('contracts.show', $contract) }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">{{ __('contracts.edit_title') }}</h1>
</div>

<form method="POST" action="{{ route('contracts.update', $contract) }}">
    @csrf
    @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <x-form-section :title="__('contracts.section_parties')" :step="1">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('contracts.tenant') }}</label>
                        <select name="tenant_id" class="form-select @error('tenant_id') is-invalid @enderror" required>
                            <option value="">— Sélectionner un locataire —</option>
                            @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" @selected(old('tenant_id', $contract->tenant_id)==$tenant->id)>
                                {{ $tenant->full_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('tenant_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('contracts.property') }}</label>
                        <select name="property_id" class="form-select @error('property_id') is-invalid @enderror" required>
                            <option value="">— Sélectionner un bien —</option>
                            @foreach($properties as $property)
                            <option value="{{ $property->id }}" @selected(old('property_id', $contract->property_id)==$property->id)>
                                {{ $property->name }} — {{ $property->full_address }}
                            </option>
                            @endforeach
                        </select>
                        @error('property_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <x-form-section :title="__('contracts.section_details')" :step="2">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('contracts.contract_type') }}</label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="bail" @selected(old('type', $contract->type)=='bail')>{{ __('contracts.type_bail') }}</option>
                            <option value="meuble" @selected(old('type', $contract->type)=='meuble')>{{ __('contracts.type_meuble') }}</option>
                            <option value="sous-location" @selected(old('type', $contract->type)=='sous-location')>{{ __('contracts.type_sous_location') }}</option>
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('contracts.start_date') }}</label>
                        <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $contract->start_date?->format('Y-m-d')) }}" required>
                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('contracts.end_date') }}</label>
                        <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $contract->end_date?->format('Y-m-d')) }}">
                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('contracts.monthly_rent') }}</label>
                        <input type="number" name="monthly_rent" class="form-control @error('monthly_rent') is-invalid @enderror" value="{{ old('monthly_rent', $contract->monthly_rent) }}" step="0.01" min="0" required>
                        @error('monthly_rent')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('contracts.charges') }}</label>
                        <input type="number" name="charges" class="form-control" value="{{ old('charges', $contract->charges ?? 0) }}" step="0.01" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('contracts.deposit') }}</label>
                        <input type="number" name="deposit" class="form-control" value="{{ old('deposit', $contract->deposit ?? 0) }}" step="0.01" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('common.status') }}</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="actif" @selected(old('status', $contract->status)=='actif')>{{ __('common.status_actif') }}</option>
                            <option value="expire" @selected(old('status', $contract->status)=='expire')>{{ __('common.status_expire') }}</option>
                            <option value="archive" @selected(old('status', $contract->status)=='archive')>{{ __('common.status_archive') }}</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>
        </div>
        <div class="col-lg-4">
            <div class="form-section">
                <div class="form-section-title">{{ __('common.actions') }}</div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-2"></i>{{ __('common.update') }}</button>
                    <a href="{{ route('contracts.show', $contract) }}" class="btn btn-outline-secondary">{{ __('common.cancel') }}</a>
                </div>
            </div>
            <div class="form-section mt-3">
                <div class="form-section-title text-danger">Zone de danger</div>
                <form method="POST" action="{{ route('contracts.destroy', $contract) }}" onsubmit="return confirm('{{ __('contracts.delete_confirm') }}')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100 btn-sm"><i class="fas fa-trash me-2"></i>{{ __('common.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</form>
@endsection
