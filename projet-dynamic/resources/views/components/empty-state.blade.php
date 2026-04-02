@props(['icon' => 'inbox', 'title' => 'Aucun résultat', 'text' => '', 'actionRoute' => null, 'actionLabel' => 'Créer'])
<div class="empty-state">
    <div class="empty-icon"><i class="fas fa-{{ $icon }}"></i></div>
    <h5>{{ $title }}</h5>
    @if($text)<p>{{ $text }}</p>@endif
    @if($actionRoute)
    <a href="{{ $actionRoute }}" class="btn btn-primary-custom mt-2">
        <i class="fas fa-plus me-1"></i> {{ $actionLabel }}
    </a>
    @endif
</div>
