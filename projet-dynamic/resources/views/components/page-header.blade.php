@props(['title','subtitle'=>null,'createRoute'=>null,'createLabel'=>null])
<div class="page-header-custom mb-4">
  <div>
    <h1 class="page-header-title">{{ $title }}</h1>
    @if($subtitle)<p class="page-header-subtitle">{{ $subtitle }}</p>@endif
  </div>
  @if($createRoute)
  <a href="{{ route($createRoute) }}" class="btn btn-primary-custom">
    <i class="fa-solid fa-plus me-2"></i>{{ $createLabel }}
  </a>
  @endif
</div>
