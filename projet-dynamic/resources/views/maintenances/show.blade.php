@extends('layouts.app')
@section('title', $maintenance->title)
@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('maintenances.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
    <div class="flex-grow-1">
        <h1 class="mb-0" style="font-size:1.5rem;font-weight:800;">{{ $maintenance->title }}</h1>
        @if($maintenance->property)
        <small class="text-muted">
            <i class="fas fa-building me-1"></i>
            <a href="{{ route('properties.show', $maintenance->property) }}" class="text-decoration-none text-muted">{{ $maintenance->property->name }}</a>
        </small>
        @endif
    </div>
    <span class="badge bg-{{ $maintenance->priority_color ?? 'secondary' }} fs-6">{{ ucfirst($maintenance->priority ?? '—') }}</span>
    <x-status-badge :status="$maintenance->status" type="maintenance" />
    <a href="{{ route('maintenances.edit', $maintenance) }}" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-edit me-1"></i>Modifier
    </a>
    <form method="POST" action="{{ route('maintenances.destroy', $maintenance) }}" onsubmit="return confirm('Supprimer cette maintenance ?')">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
    </form>
</div>

{{-- Stats --}}
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <x-stat-card label="Avancement" :value="($maintenance->progress_percentage ?? 0).'%'" icon="tasks" variant="primary" />
    </div>
    <div class="col-md-3">
        <x-stat-card label="Coût estimé" :value="$maintenance->estimated_cost ? number_format($maintenance->estimated_cost, 0, ',', ' ').' €' : '—'" icon="euro-sign" variant="accent" />
    </div>
    <div class="col-md-3">
        <x-stat-card label="Coût réel" :value="$maintenance->actual_cost ? number_format($maintenance->actual_cost, 0, ',', ' ').' €' : '—'" icon="receipt" variant="warning" />
    </div>
    <div class="col-md-3">
        <x-stat-card label="Créé le" :value="$maintenance->created_at->format('d/m/Y')" icon="calendar-alt" variant="success" />
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        {{-- Description --}}
        <div class="data-table-wrap p-3 mb-4">
            <h6 class="fw-700 mb-3">Description</h6>
            @if($maintenance->description)
            <p class="mb-0">{{ $maintenance->description }}</p>
            @else
            <p class="text-muted small mb-0">Aucune description renseignée.</p>
            @endif
        </div>

        {{-- Progress bar --}}
        <div class="data-table-wrap p-3 mb-4">
            <h6 class="fw-700 mb-3">Avancement global</h6>
            <div class="mb-2 d-flex justify-content-between small">
                <span>Progression</span>
                <span class="fw-600">{{ $maintenance->progress_percentage ?? 0 }}%</span>
            </div>
            <div class="progress" style="height:12px;border-radius:8px;">
                <div class="progress-bar bg-{{ $maintenance->priority_color ?? 'primary' }}"
                     role="progressbar"
                     style="width:{{ $maintenance->progress_percentage ?? 0 }}%"
                     aria-valuenow="{{ $maintenance->progress_percentage ?? 0 }}"
                     aria-valuemin="0"
                     aria-valuemax="100">
                </div>
            </div>
            @if($maintenance->status !== 'termine')
            <div class="mt-3 small text-muted">
                <i class="fas fa-info-circle me-1"></i>Utilisez le formulaire ci-dessous pour mettre à jour l'avancement.
            </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Update Progress --}}
        @if($maintenance->status !== 'termine')
        <div class="data-table-wrap p-3 mb-4">
            <h6 class="fw-700 mb-3">Mettre à jour l'avancement</h6>
            <form method="POST" action="{{ route('maintenances.progress', $maintenance) }}">
                @csrf @method('PATCH')
                <div class="mb-3">
                    <label class="form-label-custom d-flex justify-content-between">
                        <span>Progression</span>
                        <span id="progressValue" class="fw-600">{{ $maintenance->progress_percentage ?? 0 }}%</span>
                    </label>
                    <input type="range" name="progress_percentage" class="form-range" min="0" max="100" step="5"
                           value="{{ $maintenance->progress_percentage ?? 0 }}"
                           oninput="document.getElementById('progressValue').textContent = this.value + '%'">
                </div>
                <div class="mb-3">
                    <label class="form-label-custom">Nouveau statut</label>
                    <select name="status" class="form-select">
                        <option value="a_faire" @selected($maintenance->status=='a_faire')>À faire</option>
                        <option value="en_cours" @selected($maintenance->status=='en_cours')>En cours</option>
                        <option value="termine" @selected($maintenance->status=='termine')>Terminé</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100 btn-sm">
                    <i class="fas fa-sync me-2"></i>Mettre à jour
                </button>
            </form>
        </div>
        @else
        <div class="data-table-wrap p-3 mb-4">
            <div class="text-center py-3">
                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                <div class="fw-700">Intervention terminée</div>
                <div class="small text-muted">Cette maintenance est clôturée.</div>
            </div>
            <form method="POST" action="{{ route('maintenances.progress', $maintenance) }}">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="en_cours">
                <input type="hidden" name="progress_percentage" value="{{ $maintenance->progress_percentage ?? 100 }}">
                <button type="submit" class="btn btn-outline-warning w-100 btn-sm">
                    <i class="fas fa-undo me-2"></i>Réouvrir
                </button>
            </form>
        </div>
        @endif

        {{-- Bien info --}}
        @if($maintenance->property)
        <div class="data-table-wrap p-3">
            <h6 class="fw-700 mb-3">Bien concerné</h6>
            <div class="fw-700">{{ $maintenance->property->name }}</div>
            <div class="small text-muted">{{ $maintenance->property->full_address }}</div>
            <a href="{{ route('properties.show', $maintenance->property) }}" class="btn btn-outline-secondary btn-sm mt-2 w-100">
                <i class="fas fa-building me-1"></i>Voir le bien
            </a>
        </div>
        @endif
    </div>
</div>

@endsection
