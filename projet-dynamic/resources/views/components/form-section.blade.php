@props(['title','step'=>null])
<div class="form-section-card mb-4">
  <div class="form-section-header">
    @if($step !== null)
    <div class="form-section-step">{{ $step }}</div>
    @endif
    <h6 class="form-section-title">{{ $title }}</h6>
  </div>
  <div class="form-section-body">
    {{ $slot }}
  </div>
</div>
