<ul class="menu-sub">
  @foreach ($menu as $submenu)
    @php
      $activeClass = '';
      $currentRouteName = Route::currentRouteName();
      $slugs = (array)($submenu['slug'] ?? []);

      foreach ($slugs as $slug) {
        if (str_starts_with($currentRouteName, $slug)) {
          $activeClass = 'active';
          break;
        }
      }
    @endphp

    <li class="menu-item {{ $activeClass }}">
      <a href="{{ isset($submenu['url']) ? url($submenu['url']) : 'javascript:void(0);' }}" class="menu-link">
        <div>{{ $submenu['name'] ?? '' }}</div>
      </a>

      {{-- Recursive submenu jika masih ada level dalamnya --}}
      @if (isset($submenu['submenu']))
        @include('layouts.sections.menu.submenu', ['menu' => $submenu['submenu']])
      @endif
    </li>
  @endforeach
</ul>
