@props(['tenant'])
@php
$colors=['#3b82f6','#10b981','#f59e0b','#ef4444','#8b5cf6','#06b6d4','#ec4899'];
$color=$colors[abs(crc32($tenant->getFullNameAttribute()))%count($colors)];
@endphp
<div class="tenant-card">
  <div class="tenant-card__header">
    <div class="tenant-card__avatar" style="background:{{ $color }};">{{ $tenant->getInitialsAttribute() }}</div>
    <div class="tenant-card__info">
      <h6 class="tenant-card__name">{{ $tenant->getFullNameAttribute() }}</h6>
      <p class="tenant-card__email">{{ $tenant->email }}</p>
    </div>
    <x-status-badge :status="$tenant->payment_status" type="payment" />
  </div>
  <div class="tenant-card__body">
    @if($tenant->property)
    <div class="tenant-card__property"><i class="fa-solid fa-building me-1 text-muted"></i>{{ $tenant->property->name }}</div>
    @endif
    <div class="tenant-card__rent">{{ number_format($tenant->monthly_rent, 0, ',', ' ') }} €<span>/mois</span></div>
  </div>
  <div class="tenant-card__footer">
    <a href="{{ route('tenants.show', $tenant) }}" class="btn btn-sm btn-outline-primary rounded-pill flex-fill">Voir</a>
    <a href="{{ route('tenants.edit', $tenant) }}" class="btn btn-sm btn-ghost-custom rounded-pill flex-fill">Modifier</a>
  </div>
</div>
