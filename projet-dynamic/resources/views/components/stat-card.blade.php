@props(['label', 'value', 'icon', 'variant' => 'primary', 'subtitle' => null])
<div class="stat-card h-100">
    <div class="stat-icon stat-icon-{{ $variant }}">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
    <div class="stat-value text-{{ $variant === 'accent' ? 'info' : $variant }}">{{ $value }}</div>
    <div class="stat-label">{{ $label }}</div>
    @if($subtitle)
        <small class="text-muted mt-1 d-block">{{ $subtitle }}</small>
    @endif
</div>
