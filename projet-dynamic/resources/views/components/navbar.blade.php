@php
$navItems = [
    ['route'=>'dashboard','icon'=>'fa-gauge-high','label'=>__('nav.dashboard')],
    ['route'=>'properties.index','icon'=>'fa-building','label'=>__('nav.properties')],
    ['route'=>'tenants.index','icon'=>'fa-users','label'=>__('nav.tenants')],
    ['route'=>'contracts.index','icon'=>'fa-file-contract','label'=>__('nav.contracts')],
    ['route'=>'payments.index','icon'=>'fa-euro-sign','label'=>__('nav.payments')],
    ['route'=>'documents.index','icon'=>'fa-folder-open','label'=>__('nav.documents')],
    ['route'=>'maintenances.index','icon'=>'fa-wrench','label'=>__('nav.maintenances')],
    ['route'=>'reports.index','icon'=>'fa-chart-bar','label'=>__('nav.reports')],
];
@endphp
<nav class="navbar navbar-expand-lg gestiloc-navbar">
  <div class="container-fluid px-4">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
      <div class="navbar-logo-icon"><i class="fa-solid fa-building"></i></div>
      <div>
        <div class="navbar-logo-text">GestiLoc</div>
        <div class="navbar-logo-sub">Gestion immobilière</div>
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa-solid fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav mx-auto gap-1">
        @foreach($navItems as $item)
        <li class="nav-item">
          <a class="nav-link-custom {{ request()->routeIs(str_replace('.index', '', $item['route']).'*') ? 'active' : '' }}" href="{{ route($item['route']) }}">
            <i class="fa-solid {{ $item['icon'] }}"></i>
            <span>{{ $item['label'] }}</span>
          </a>
        </li>
        @endforeach
      </ul>
      <div class="d-flex align-items-center gap-2">
        <!-- Language switcher -->
        <div class="lang-switcher">
          <a href="{{ route('lang.switch', 'fr') }}" class="lang-btn {{ app()->getLocale() === 'fr' ? 'active' : '' }}">🇫🇷 FR</a>
          <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ app()->getLocale() === 'en' ? 'active' : '' }}">🇬🇧 EN</a>
        </div>
        <!-- User dropdown -->
        <div class="dropdown">
          <button class="user-avatar-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width:180px;border-radius:10px;">
            <li>
              <div class="px-3 py-2 border-bottom">
                <div class="fw-semibold small">{{ Auth::user()->name }}</div>
                <div class="text-muted" style="font-size:.75rem;">{{ Auth::user()->email }}</div>
              </div>
            </li>
            <li>
              <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                <i class="fa-solid fa-user me-2 text-muted"></i>{{ __('nav.profile') }}
              </a>
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item py-2 text-danger">
                  <i class="fa-solid fa-right-from-bracket me-2"></i>{{ __('nav.logout') }}
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
