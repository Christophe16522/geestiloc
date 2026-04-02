@extends('layouts.app')
@section('title', __('maintenances.title'))
@section('content')

<x-page-header
    :title="__('maintenances.title')"
    :subtitle="__('maintenances.subtitle', ['count' => $maintenances->total()])"
    :createRoute="route('maintenances.create')"
    :createLabel="__('maintenances.add')"
/>

{{-- Filters --}}
<div class="data-table-wrap p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="{{ __('common.search') }}..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">{{ __('maintenances.all_statuses') }}</option>
                <option value="a_faire" @selected(request('status')=='a_faire')>{{ __('common.status_a_faire') }}</option>
                <option value="en_cours" @selected(request('status')=='en_cours')>{{ __('common.status_en_cours') }}</option>
                <option value="termine" @selected(request('status')=='termine')>{{ __('common.status_termine') }}</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="priority" class="form-select">
                <option value="">{{ __('maintenances.all_priorities') }}</option>
                <option value="faible" @selected(request('priority')=='faible')>{{ __('common.priority_basse') }}</option>
                <option value="normale" @selected(request('priority')=='normale')>{{ __('common.priority_moyenne') }}</option>
                <option value="haute" @selected(request('priority')=='haute')>{{ __('common.priority_haute') }}</option>
                <option value="urgente" @selected(request('priority')=='urgente')>{{ __('maintenances.priority_urgente') }}</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="property_id" class="form-select">
                <option value="">{{ __('maintenances.all_properties') }}</option>
                @foreach($properties as $property)
                <option value="{{ $property->id }}" @selected(request('property_id')==$property->id)>{{ $property->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary-custom w-100">OK</button>
        </div>
        @if(request()->hasAny(['search','status','priority','property_id']))
        <div class="col-md-2">
            <a href="{{ route('maintenances.index') }}" class="btn btn-outline-secondary w-100">{{ __('common.reset') }}</a>
        </div>
        @endif
    </form>
</div>

@if($maintenances->isEmpty())
    <x-empty-state icon="wrench" :title="__('maintenances.empty_title')" :text="__('maintenances.empty_text')" :actionRoute="route('maintenances.create')" :actionLabel="__('maintenances.add')" />
@else
<div class="data-table-wrap">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>{{ __('maintenances.title_col') }}</th>
                    <th>{{ __('maintenances.property') }}</th>
                    <th>{{ __('maintenances.priority') }}</th>
                    <th>{{ __('common.status') }}</th>
                    <th>{{ __('maintenances.progress') }}</th>
                    <th>{{ __('maintenances.estimated_cost') }}</th>
                    <th class="text-end">{{ __('common.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($maintenances as $maintenance)
                <tr>
                    <td>
                        <a href="{{ route('maintenances.show', $maintenance) }}" class="fw-600 text-decoration-none small">
                            {{ $maintenance->title }}
                        </a>
                        @if($maintenance->description)
                        <div class="small text-muted text-truncate" style="max-width:200px;">{{ $maintenance->description }}</div>
                        @endif
                    </td>
                    <td>
                        @if($maintenance->property)
                        <a href="{{ route('properties.show', $maintenance->property) }}" class="text-decoration-none small">
                            {{ $maintenance->property->name }}
                        </a>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $maintenance->priority_color ?? 'secondary' }}">
                            {{ ucfirst($maintenance->priority ?? '—') }}
                        </span>
                    </td>
                    <td><x-status-badge :status="$maintenance->status" type="maintenance" /></td>
                    <td style="min-width:120px;">
                        <x-progress-bar :percentage="$maintenance->progress_percentage ?? 0" :showLabel="true" />
                    </td>
                    <td class="small fw-600">
                        {{ $maintenance->estimated_cost ? number_format($maintenance->estimated_cost, 0, ',', ' ').' €' : '—' }}
                    </td>
                    <td class="text-end">
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{ route('maintenances.show', $maintenance) }}" class="btn btn-xs btn-outline-secondary btn-sm py-0 px-2" title="{{ __('common.edit') }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('maintenances.edit', $maintenance) }}" class="btn btn-xs btn-outline-primary btn-sm py-0 px-2" title="{{ __('common.edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('maintenances.destroy', $maintenance) }}" onsubmit="return confirm('{{ __('maintenances.delete_confirm') }}')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger btn-sm py-0 px-2" title="{{ __('common.delete') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $maintenances->links() }}</div>
@endif

@endsection
