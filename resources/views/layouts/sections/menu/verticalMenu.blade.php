@php
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

// Ambil role user dari session
$role = Session::get('role_kerja');

// Ambil isi file JSON
$menuJson = file_get_contents(resource_path('menu/verticalMenu.json'));
$menuArray = json_decode($menuJson, true);

// Pastikan bentuk array menu sesuai struktur JSON
$menuItems = $menuArray['menu'] ?? $menuArray;

// Filter menu
$filteredMenu = collect($menuItems)->filter(function ($item) use ($role) {
    // Jika menuHeader bernama "Master" dan role bukan admin → sembunyikan
    if (isset($item['menuHeader']) && $item['menuHeader'] === 'Master' && $role !== 'admin') {
        return false;
    }

    // Jika menu biasa bernama "Master Data" atau "User Management" dan role bukan admin → sembunyikan
    if (isset($item['name']) && in_array($item['name'], ['Master Data', 'User Management']) && $role !== 'admin') {
        return false;
    }

    return true; // selain itu tampilkan
})->values()->toArray();

$currentRouteName = Route::currentRouteName();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- Logo dan judul -->
  <div class="app-brand demo">
    <a href="{{ url('/') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('assets/itera_bulet.png') }}" alt="Logo" width="50">
      </span>
      <span class="app-brand-text demo menu-text fw-bold ms-2 text-uppercase">
        {{ config('variables.templateName') }}
      </span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    @foreach ($filteredMenu as $menu)
      {{-- Menu Header --}}
      @if (isset($menu['menuHeader']))
        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">{{ $menu['menuHeader'] }}</span>
        </li>

      @else
        {{-- Tentukan aktif / open --}}
        @php
          $activeClass = '';
          $slugs = (array)($menu['slug'] ?? []);
          foreach ($slugs as $slug) {
            if (str_starts_with($currentRouteName, $slug)) {
              $activeClass = 'active open';
              break;
            }
          }
        @endphp

        <li class="menu-item {{ $activeClass }}">
          <a href="{{ isset($menu['url']) ? url($menu['url']) : 'javascript:void(0);' }}"
             class="{{ isset($menu['submenu']) ? 'menu-link menu-toggle' : 'menu-link' }}"
             @if (isset($menu['target'])) target="_blank" @endif>
            @isset($menu['icon'])
              <i class="{{ $menu['icon'] }}"></i>
            @endisset
            <div>{{ $menu['name'] ?? '' }}</div>
          </a>

          {{-- Submenu --}}
          @if (isset($menu['submenu']))
            @include('layouts.sections.menu.submenu', ['menu' => $menu['submenu']])
          @endif
        </li>
      @endif
    @endforeach
  </ul>
</aside>
