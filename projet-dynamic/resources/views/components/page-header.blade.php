@props(['title', 'subtitle' => null, 'createRoute' => null, 'createLabel' => 'Nouveau'])
<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1>{{ $title }}</h1>
        @if($subtitle)<p>{{ $subtitle }}</p>@endif
    </div>
    @if($createRoute)
    <a href="{{ $createRoute }}" class="btn btn-primary-custom d-flex align-items-center gap-2">
        <i class="fas fa-plus"></i> {{ $createLabel }}
    </a>
    @endif
</div>
