@extends('layouts.app')
@section('title', __('documents.title'))
@section('content')

<x-page-header :title="__('documents.title')" :subtitle="__('documents.subtitle')" :createRoute="'documents.create'" :createLabel="__('documents.add')" />

<div class="filters-bar mb-4">
    <form method="GET" class="d-flex flex-wrap gap-2 align-items-center">
        <select name="category" class="form-select form-select-sm filter-select">
            <option value="">{{ __('documents.all_categories') }}</option>
            @foreach(['contrat','diagnostic','quittance','assurance','autre'] as $cat)
            <option value="{{ $cat }}" @selected(request('category')===$cat)>{{ ucfirst($cat) }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary-custom btn-sm">{{ __('common.filter') }}</button>
        @if(request()->filled('category'))
        <a href="{{ route('documents.index') }}" class="btn btn-ghost-custom btn-sm">{{ __('common.reset') }}</a>
        @endif
    </form>
</div>

<div class="data-table-wrap">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>{{ __('documents.name') }}</th>
                    <th>{{ __('documents.category') }}</th>
                    <th>{{ __('documents.property') }}</th>
                    <th>{{ __('documents.upload_date') }}</th>
                    <th>{{ __('documents.expiration_date') }}</th>
                    <th>{{ __('documents.size') }}</th>
                    <th class="text-end">{{ __('common.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $document)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="doc-icon doc-icon--{{ $document->category }}"><i class="fa-solid fa-file-{{ in_array($document->category,['contrat','quittance']) ? 'contract' : 'alt' }}"></i></div>
                            <span class="fw-600 small">{{ $document->name }}</span>
                        </div>
                    </td>
                    <td><span class="small">{{ ucfirst($document->category) }}</span></td>
                    <td><span class="small text-muted">{{ $document->property->name ?? '—' }}</span></td>
                    <td><span class="small">{{ \Carbon\Carbon::parse($document->upload_date)->format('d/m/Y') }}</span></td>
                    <td>
                        @if($document->expiration_date)
                        <span class="small {{ $document->getIsExpiredAttribute() ? 'text-danger fw-600' : '' }}">
                            {{ \Carbon\Carbon::parse($document->expiration_date)->format('d/m/Y') }}
                            @if($document->getIsExpiredAttribute()) <i class="fa-solid fa-circle-exclamation ms-1"></i> @endif
                        </span>
                        @else
                        <span class="small text-muted">—</span>
                        @endif
                    </td>
                    <td><span class="small text-muted">{{ $document->getFileSizeFormattedAttribute() }}</span></td>
                    <td class="text-end">
                        <x-action-buttons :showRoute="route('documents.show', $document)" :downloadRoute="route('documents.show', $document)" :deleteRoute="route('documents.destroy', $document)" :confirmMessage="__('documents.delete_confirm')" />
                    </td>
                </tr>
                @empty
                <tr><td colspan="7"><x-empty-state icon="folder-open" :title="__('documents.empty_title')" :text="__('documents.empty_text')" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $documents->appends(request()->query())->links() }}</div>

@endsection
