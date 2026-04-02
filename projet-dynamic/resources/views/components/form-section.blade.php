@props(['title', 'step' => null])
<div class="form-section">
    <div class="form-section-title">
        @if($step)<div class="form-section-step">{{ $step }}</div>@endif
        {{ $title }}
    </div>
    {{ $slot }}
</div>
