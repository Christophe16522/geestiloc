@extends('layouts.app')
@section('title', $document->name)

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('documents.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <div class="flex-grow-1">
        <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">{{ $document->name }}</h1>
        <small class="text-muted">{{ ucfirst($document->category) }} · {{ $document->file_size_formatted }}</small>
    </div>
    <x-status-badge :status="$document->is_expired ? 'expire' : 'actif'" type="contract" />
    <form method="POST" action="{{ route('documents.destroy', $document) }}" onsubmit="return confirm('{{ __('documents.delete_confirm') }}')">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
    </form>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">{{ __('documents.info_title') }}</h6>
            <table class="table table-sm mb-0">
                <tr><td class="text-muted">{{ __('documents.category') }}</td><td><x-status-badge :status="$document->category" type="document" /></td></tr>
                <tr><td class="text-muted">{{ __('documents.upload_date') }}</td><td>{{ $document->upload_date->format('d/m/Y') }}</td></tr>
                <tr><td class="text-muted">{{ __('documents.expiration') }}</td><td class="{{ $document->is_expired ? 'text-danger fw-bold' : '' }}">{{ $document->expiration_date ? $document->expiration_date->format('d/m/Y') : '—' }}</td></tr>
                <tr><td class="text-muted">{{ __('documents.size') }}</td><td>{{ $document->file_size_formatted }}</td></tr>
                <tr><td class="text-muted">{{ __('documents.mime_type') }}</td><td>{{ $document->mime_type ?? '—' }}</td></tr>
                @if($document->property)
                <tr><td class="text-muted">{{ __('documents.associated_property') }}</td><td><a href="{{ route('properties.show', $document->property) }}">{{ $document->property->name }}</a></td></tr>
                @endif
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="data-table-wrap p-3 text-center" style="padding: 3rem 1.5rem !important;">
            <i class="fas fa-file-lines" style="font-size:4rem;color:var(--border);"></i>
            <h6 class="mt-3 fw-700">{{ $document->name }}</h6>
            <p class="text-muted small">{{ $document->file_size_formatted }}</p>
            @if($document->is_expired)
            <div class="alert alert-danger alert-gestiloc">
                <i class="fas fa-exclamation-circle me-2"></i>{{ __('documents.expired_alert') }}
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
