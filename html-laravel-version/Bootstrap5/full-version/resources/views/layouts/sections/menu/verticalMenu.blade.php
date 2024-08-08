@php
$configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  @if(!isset($navbarFull))
  <div class="app-brand demo">
    <a href="{{ url('/') }}" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-bold">Maturanti</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>
  @endif

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    @if (auth()->user()->hasRole('admin'))
      @foreach ($menuData[0]->menu as $menu)
        @if (isset($menu->name) && $menu->name === 'Kuizet')
          {{-- Active menu method --}}
          @php
          $activeClass = null;
          $currentRouteName = Route::currentRouteName();

          if (isset($menu->slug)) {
            if ($currentRouteName === $menu->slug) {
              $activeClass = 'active';
            } elseif (isset($menu->submenu)) {
              if (is_array($menu->slug)) {
                foreach ($menu->slug as $slug) {
                  if (str_contains($currentRouteName, $slug) && strpos($currentRouteName, $slug) === 0) {
                    $activeClass = 'active open';
                  }
                }
              } else {
                if (str_contains($currentRouteName, $menu->slug) && strpos($currentRouteName, $menu->slug) === 0) {
                  $activeClass = 'active open';
                }
              }
            }
          }
          @endphp

          {{-- Main menu --}}
          <li class="menu-item {{ $activeClass }}">
            <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}" class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($menu->target) && !empty($menu->target)) target="_blank" @endif>
              @isset($menu->icon)
              <i class="{{ $menu->icon }}"></i>
              @endisset
              <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
              @isset($menu->badge)
              <div class="badge bg-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>
              @endisset
            </a>

            {{-- Submenu --}}
            @isset($menu->submenu)
            @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
            @endisset
          </li>
        @endif
      @endforeach
    @else
      @foreach ($menuData[0]->menu as $menu)
        @if (!isset($menu->name) || $menu->name !== 'Kuizet')
          {{-- Active menu method --}}
          @php
          $activeClass = null;
          $currentRouteName = Route::currentRouteName();

          if (isset($menu->slug)) {
            if ($currentRouteName === $menu->slug) {
              $activeClass = 'active';
            } elseif (isset($menu->submenu)) {
              if (is_array($menu->slug)) {
                foreach ($menu->slug as $slug) {
                  if (str_contains($currentRouteName, $slug) && strpos($currentRouteName, $slug) === 0) {
                    $activeClass = 'active open';
                  }
                }
              } else {
                if (str_contains($currentRouteName, $menu->slug) && strpos($currentRouteName, $menu->slug) === 0) {
                  $activeClass = 'active open';
                }
              }
            }
          }
          @endphp

          {{-- Main menu --}}
          <li class="menu-item {{ $activeClass }}">
            <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}" class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($menu->target) && !empty($menu->target)) target="_blank" @endif>
              @isset($menu->icon)
              <i class="{{ $menu->icon }}"></i>
              @endisset
              <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
              @isset($menu->badge)
              <div class="badge bg-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>
              @endisset
            </a>

            {{-- Submenu --}}
            @isset($menu->submenu)
            @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
            @endisset
          </li>
        @endif
      @endforeach
    @endif
  </ul>

</aside>
