@props(['label','value','icon'=>'fa-chart-bar','variant'=>'primary','trend'=>null,'trendLabel'=>null])
<div class="stat-card stat-card--{{ $variant }}">
  <div class="stat-card__body">
    <div class="stat-card__icon">
      <i class="fa-solid fa-{{ $icon }}"></i>
    </div>
    <div class="stat-card__content">
      <div class="stat-card__value">{{ $value }}</div>
      <div class="stat-card__label">{{ $label }}</div>
      @if($trend !== null)
      <div class="stat-card__trend {{ $trend >= 0 ? 'stat-card__trend--up' : 'stat-card__trend--down' }}">
        <i class="fa-solid fa-arrow-{{ $trend >= 0 ? 'up' : 'down' }}"></i>
        {{ abs($trend) }}% {{ $trendLabel }}
      </div>
      @endif
    </div>
  </div>
  <div class="stat-card__bar"></div>
</div>
