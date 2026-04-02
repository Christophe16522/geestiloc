@props(['property'])
@php
$typeColors = ['appartement'=>'#3b82f6','maison'=>'#10b981','garage'=>'#f59e0b','commercial'=>'#8b5cf6','terrain'=>'#06b6d4'];
$color = $typeColors[$property->type] ?? '#64748b';
@endphp
<div class="property-card">
  <div class="property-card__swatch" style="background:linear-gradient(135deg, {{ $color }}22 0%, {{ $color }}44 100%); border-bottom:3px solid {{ $color }};">
    <i class="fa-solid fa-building" style="color:{{ $color }};font-size:2rem;"></i>
    <span class="property-card__ref">{{ $property->reference }}</span>
  </div>
  <div class="property-card__body">
    <div class="d-flex justify-content-between align-items-start mb-2">
      <h6 class="property-card__name">{{ $property->name }}</h6>
      <x-status-badge :status="$property->status" type="property" />
    </div>
    <p class="property-card__address"><i class="fa-solid fa-location-dot me-1"></i>{{ $property->address }}, {{ $property->city }}</p>
    <div class="property-card__chips">
      <span class="prop-chip"><i class="fa-solid fa-tag me-1"></i>{{ ucfirst($property->type) }}</span>
      <span class="prop-chip"><i class="fa-solid fa-ruler-combined me-1"></i>{{ $property->surface_m2 }} m²</span>
    </div>
    <div class="property-card__price">{{ number_format($property->monthly_rent, 0, ',', ' ') }} €<span>/mois</span></div>
    <div class="property-card__actions">
      <a href="{{ route('properties.show', $property) }}" class="btn btn-sm btn-outline-primary rounded-pill">Voir</a>
      <a href="{{ route('properties.edit', $property) }}" class="btn btn-sm btn-ghost-custom rounded-pill">Modifier</a>
    </div>
  </div>
</div>
