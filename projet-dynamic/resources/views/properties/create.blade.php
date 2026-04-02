@extends('layouts.app')
@section('title', __('properties.create_title'))
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('properties.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">{{ __('properties.create_title') }}</h1>
</div>

<form method="POST" action="{{ route('properties.store') }}">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <x-form-section :title="__('properties.section_general')" :step="1">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('properties.property_name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('common.type') }}</label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="appartement" @selected(old('type')=='appartement')>{{ __('common.type_appartement') }}</option>
                            <option value="maison" @selected(old('type')=='maison')>{{ __('common.type_maison') }}</option>
                            <option value="studio" @selected(old('type')=='studio')>{{ __('common.type_studio') }}</option>
                            <option value="commercial" @selected(old('type')=='commercial')>{{ __('common.type_commercial') }}</option>
                            <option value="autre" @selected(old('type')=='autre')>{{ __('common.type_autre') }}</option>
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label-custom">{{ __('common.address') }}</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('common.postal_code') }}</label>
                        <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label-custom">{{ __('common.city') }}</label>
                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" required>
                        @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <x-form-section :title="__('properties.section_financial')" :step="2">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('properties.monthly_rent') }}</label>
                        <input type="number" name="monthly_rent" class="form-control @error('monthly_rent') is-invalid @enderror" value="{{ old('monthly_rent') }}" step="0.01" min="0" required>
                        @error('monthly_rent')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('properties.charges') }}</label>
                        <input type="number" name="charges" class="form-control" value="{{ old('charges', 0) }}" step="0.01" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('properties.deposit') }}</label>
                        <input type="number" name="deposit" class="form-control" value="{{ old('deposit', 0) }}" step="0.01" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('properties.surface') }}</label>
                        <input type="number" name="surface_m2" class="form-control" value="{{ old('surface_m2') }}" step="0.01" min="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('common.status') }}</label>
                        <select name="status" class="form-select" required>
                            <option value="vacante" @selected(old('status')=='vacante')>{{ __('common.status_vacante') }}</option>
                            <option value="occupee" @selected(old('status')=='occupee')>{{ __('common.status_occupee') }}</option>
                        </select>
                    </div>
                </div>
            </x-form-section>

            <x-form-section :title="__('properties.section_description')" :step="3">
                <textarea name="description" class="form-control" rows="4" placeholder="{{ __('properties.section_description') }}...">{{ old('description') }}</textarea>
            </x-form-section>
        </div>
        <div class="col-lg-4">
            <div class="form-section">
                <div class="form-section-title">{{ __('common.actions') }}</div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-2"></i>{{ __('common.save') }}</button>
                    <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary">{{ __('common.cancel') }}</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
