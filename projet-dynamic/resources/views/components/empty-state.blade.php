@props(['icon'=>'folder-open','title','text'=>null,'actionRoute'=>null,'actionLabel'=>null])
<div class="empty-state">
  <div class="empty-state__icon"><i class="fa-solid fa-{{ $icon }}"></i></div>
  <h5 class="empty-state__title">{{ $title }}</h5>
  @if($text)<p class="empty-state__text">{{ $text }}</p>@endif
  @if($actionRoute)
  <a href="{{ route($actionRoute) }}" class="btn btn-primary-custom mt-2">
    <i class="fa-solid fa-plus me-2"></i>{{ $actionLabel }}
  </a>
  @endif
</div>
