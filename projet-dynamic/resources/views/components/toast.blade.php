@if(session('success') || session('error') || session('warning'))
<div class="toast-gestiloc">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible alert-gestiloc shadow d-flex align-items-center gap-2" role="alert">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible alert-gestiloc shadow d-flex align-items-center gap-2" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('warning'))
    <div class="alert alert-warning alert-dismissible alert-gestiloc shadow d-flex align-items-center gap-2" role="alert">
        <i class="fas fa-exclamation-triangle"></i>
        <span>{{ session('warning') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
</div>
<script>
    setTimeout(() => {
        document.querySelectorAll('.toast-gestiloc .alert').forEach(a => {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(a);
            bsAlert.close();
        });
    }, 4000);
</script>
@endif
