@props(['percentage'=>0,'variant'=>'primary','showLabel'=>true])
@php $pct = min(100, max(0, (int)$percentage)); @endphp
<div class="progress-wrap">
  @if($showLabel)
  <div class="progress-label-row">
    <span class="progress-label-text">{{ __('maintenances.progress') }}</span>
    <span class="progress-label-value progress-label-value--{{ $variant }}">{{ $pct }}%</span>
  </div>
  @endif
  <div class="progress-track">
    <div class="progress-fill progress-fill--{{ $variant }}" style="width:{{ $pct }}%"></div>
  </div>
</div>
