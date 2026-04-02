@extends('layouts.app')
@section('title', __('payments.edit_title'))
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">{{ __('payments.edit_title') }}</h1>
</div>

<form method="POST" action="{{ route('payments.update', $payment) }}">
    @csrf
    @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <x-form-section :title="__('payments.section_info')" :step="1">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('payments.tenant') }}</label>
                        <select name="tenant_id" class="form-select @error('tenant_id') is-invalid @enderror" required>
                            <option value="">— Sélectionner un locataire —</option>
                            @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" @selected(old('tenant_id', $payment->tenant_id)==$tenant->id)>
                                {{ $tenant->full_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('tenant_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('payments.property') }}</label>
                        <select name="property_id" class="form-select @error('property_id') is-invalid @enderror" required>
                            <option value="">— Sélectionner un bien —</option>
                            @foreach($properties as $property)
                            <option value="{{ $property->id }}" @selected(old('property_id', $payment->property_id)==$property->id)>
                                {{ $property->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('property_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('payments.amount') }}</label>
                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $payment->amount) }}" step="0.01" min="0" required>
                        @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('payments.month') }}</label>
                        <select name="period_month" class="form-select @error('period_month') is-invalid @enderror" required>
                            @foreach(range(1,12) as $m)
                            <option value="{{ $m }}" @selected(old('period_month', $payment->period_month)==$m)>
                                {{ \Carbon\Carbon::create()->month($m)->isoFormat('MMMM') }}
                            </option>
                            @endforeach
                        </select>
                        @error('period_month')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">{{ __('payments.year') }}</label>
                        <input type="number" name="period_year" class="form-control @error('period_year') is-invalid @enderror" value="{{ old('period_year', $payment->period_year) }}" min="2000" max="2100" required>
                        @error('period_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('payments.payment_date') }}</label>
                        <input type="date" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" value="{{ old('payment_date', $payment->payment_date?->format('Y-m-d')) }}">
                        @error('payment_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">{{ __('common.status') }}</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="attente" @selected(old('status', $payment->status)=='attente')>{{ __('common.status_attente') }}</option>
                            <option value="paye" @selected(old('status', $payment->status)=='paye')>{{ __('common.status_paye') }}</option>
                            <option value="retard" @selected(old('status', $payment->status)=='retard')>{{ __('common.status_retard') }}</option>
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
                    <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">{{ __('common.cancel') }}</a>
                </div>
            </div>
            <div class="form-section mt-3">
                <div class="form-section-title text-danger">Zone de danger</div>
                <form method="POST" action="{{ route('payments.destroy', $payment) }}" onsubmit="return confirm('{{ __('payments.delete_confirm') }}')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100 btn-sm"><i class="fas fa-trash me-2"></i>{{ __('common.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</form>
@endsection
