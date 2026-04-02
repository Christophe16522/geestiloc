@extends('layouts.app')
@section('title', __('tenants.create_title'))
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('tenants.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">{{ __('tenants.create_title') }}</h1>
</div>

<form method="POST" action="{{ route('tenants.store') }}">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <x-form-section title="Informations personnelles" :step="1">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('tenants.first_name') }}</label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('tenants.last_name') }}</label>
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('common.email') }}</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('common.phone') }}</label>
                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Informations de location" :step="2">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">{{ __('tenants.property') }}</label>
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
                        <label class="form-label-custom">{{ __('tenants.monthly_rent') }}</label>
                        <input type="number" name="monthly_rent" class="form-control @error('monthly_rent') is-invalid @enderror" value="{{ old('monthly_rent') }}" step="0.01" min="0" required>
                        @error('monthly_rent')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('tenants.lease_start') }}</label>
                        <input type="date" name="lease_start_date" class="form-control @error('lease_start_date') is-invalid @enderror" value="{{ old('lease_start_date') }}">
                        @error('lease_start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('tenants.payment_status') }}</label>
                        <select name="payment_status" class="form-select @error('payment_status') is-invalid @enderror">
                            <option value="attente" @selected(old('payment_status')=='attente')>{{ __('common.status_attente') }}</option>
                            <option value="paye" @selected(old('payment_status')=='paye')>{{ __('common.status_paye') }}</option>
                            <option value="retard" @selected(old('payment_status')=='retard')>{{ __('common.status_retard') }}</option>
                        </select>
                        @error('payment_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>
        </div>
        <div class="col-lg-4">
            <div class="form-section">
                <div class="form-section-title">{{ __('common.actions') }}</div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-2"></i>{{ __('common.save') }}</button>
                    <a href="{{ route('tenants.index') }}" class="btn btn-outline-secondary">{{ __('common.cancel') }}</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
