@props(['title' => 'Filtres', 'items' => [], 'addRoute' => null, 'addLabel' => 'Ajouter'])
<div class="sidebar">
    @if($addRoute)
    <a href="{{ $addRoute }}" class="btn btn-primary-custom w-100 mb-3 d-flex align-items-center justify-content-center gap-2">
        <i class="fas fa-plus"></i> {{ $addLabel }}
    </a>
    @endif
    <div class="sidebar-title">{{ $title }}</div>
    @foreach($items as $item)
    <a href="{{ $item['url'] }}" class="sidebar-link {{ $item['active'] ?? false ? 'active' : '' }}">
        <i class="fas fa-{{ $item['icon'] ?? 'circle' }}"></i>
        {{ $item['label'] }}
        @if(isset($item['count']))<span class="badge bg-secondary ms-auto">{{ $item['count'] }}</span>@endif
    </a>
    @endforeach
    {{ $slot }}
</div>
