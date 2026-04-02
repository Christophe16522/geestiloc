@props(['percentage' => 0, 'variant' => 'primary', 'showLabel' => true])
@php $pct = min(100, max(0, (int)$percentage)); @endphp
<div class="d-flex align-items-center gap-2">
    <div class="progress-gestiloc flex-grow-1">
        <div class="progress-bar progress-bar-{{ $variant }}" style="width: {{ $pct }}%"></div>
    </div>
    @if($showLabel)<small class="text-muted fw-600" style="min-width:35px;text-align:right">{{ $pct }}%</small>@endif
</div>
