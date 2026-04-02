@if(session('success') || session('error') || session('warning'))
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:1100;">
  @if(session('success'))
  <div class="gestiloc-toast gestiloc-toast--success show" id="toastSuccess">
    <div class="gestiloc-toast__icon"><i class="fa-solid fa-circle-check"></i></div>
    <div class="gestiloc-toast__body">{{ session('success') }}</div>
    <button class="gestiloc-toast__close" onclick="this.closest('.gestiloc-toast').remove()"><i class="fa-solid fa-xmark"></i></button>
  </div>
  @endif
  @if(session('error'))
  <div class="gestiloc-toast gestiloc-toast--error show" id="toastError">
    <div class="gestiloc-toast__icon"><i class="fa-solid fa-circle-xmark"></i></div>
    <div class="gestiloc-toast__body">{{ session('error') }}</div>
    <button class="gestiloc-toast__close" onclick="this.closest('.gestiloc-toast').remove()"><i class="fa-solid fa-xmark"></i></button>
  </div>
  @endif
  @if(session('warning'))
  <div class="gestiloc-toast gestiloc-toast--warning show" id="toastWarning">
    <div class="gestiloc-toast__icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
    <div class="gestiloc-toast__body">{{ session('warning') }}</div>
    <button class="gestiloc-toast__close" onclick="this.closest('.gestiloc-toast').remove()"><i class="fa-solid fa-xmark"></i></button>
  </div>
  @endif
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.gestiloc-toast').forEach(function(t) {
    setTimeout(function() { t.style.opacity='0'; t.style.transform='translateX(100%)'; setTimeout(function(){ t.remove(); }, 400); }, 4000);
  });
});
</script>
@endif
