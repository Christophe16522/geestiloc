@extends('layouts.app')
@section('title', __('documents.title'))
@section('content')

<x-page-header
    :title="__('documents.title')"
    :subtitle="__('documents.subtitle', ['count' => $documents->total()])"
    :createRoute="route('documents.create')"
    :createLabel="__('documents.add')"
/>

{{-- Filters --}}
<div class="data-table-wrap p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="{{ __('common.search') }}..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="category" class="form-select">
                <option value="">{{ __('documents.all_categories') }}</option>
                @foreach(['contrat','quittance','attestation','assurance','facture','autre'] as $cat)
                <option value="{{ $cat }}" @selected(request('category')==$cat)>{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="property_id" class="form-select">
                <option value="">{{ __('documents.all_properties') }}</option>
                @foreach($properties as $property)
                <option value="{{ $property->id }}" @selected(request('property_id')==$property->id)>{{ $property->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary-custom w-100">{{ __('common.filter') }}</button>
        </div>
        @if(request()->hasAny(['search','category','property_id']))
        <div class="col-md-2">
            <a href="{{ route('documents.index') }}" class="btn btn-outline-secondary w-100">{{ __('common.reset') }}</a>
        </div>
        @endif
    </form>
</div>

@if($documents->isEmpty())
    <x-empty-state icon="folder-open" :title="__('documents.empty_title')" :text="__('documents.empty_text')" :actionRoute="route('documents.create')" :actionLabel="__('documents.add')" />
@else
<div class="data-table-wrap">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>{{ __('documents.name') }}</th>
                    <th>{{ __('documents.category') }}</th>
                    <th>{{ __('documents.property') }}</th>
                    <th>{{ __('documents.upload_date') }}</th>
                    <th>{{ __('documents.expiration') }}</th>
                    <th>{{ __('documents.size') }}</th>
                    <th class="text-end">{{ __('common.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-file-alt text-muted"></i>
                            <span class="fw-600 small">{{ $document->name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ ucfirst($document->category ?? '—') }}</span>
                    </td>
                    <td>
                        @if($document->property)
                        <a href="{{ route('properties.show', $document->property) }}" class="text-decoration-none small">
                            {{ $document->property->name }}
                        </a>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td class="small text-muted">{{ $document->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if($document->expiration_date)
                            @if($document->expiration_date->isPast())
                            <span class="small text-danger fw-600">
                                <i class="fas fa-exclamation-triangle me-1"></i>{{ $document->expiration_date->format('d/m/Y') }}
                            </span>
                            @elseif($document->expiration_date->diffInDays(now()) <= 30)
                            <span class="small text-warning fw-600">
                                <i class="fas fa-clock me-1"></i>{{ $document->expiration_date->format('d/m/Y') }}
                            </span>
                            @else
                            <span class="small text-muted">{{ $document->expiration_date->format('d/m/Y') }}</span>
                            @endif
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td class="small text-muted">{{ $document->file_size_formatted ?? '—' }}</td>
                    <td class="text-end">
                        <div class="d-flex gap-1 justify-content-end">
                            @if($document->file_path)
                            <a href="{{ route('documents.download', $document) }}" class="btn btn-xs btn-outline-success btn-sm py-0 px-2" title="{{ __('documents.download') }}">
                                <i class="fas fa-download"></i>
                            </a>
                            @endif
                            <a href="{{ route('documents.edit', $document) }}" class="btn btn-xs btn-outline-primary btn-sm py-0 px-2" title="{{ __('common.edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('documents.destroy', $document) }}" onsubmit="return confirm('{{ __('documents.delete_confirm') }}')">
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
<div class="mt-4">{{ $documents->links() }}</div>
@endif

@endsection
