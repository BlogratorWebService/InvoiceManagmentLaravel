<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">

            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">GKTAX</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach ($menus as $menu)
            @php
                $isActive =
                    request()->routeIs($menu['link']) ||
                    (isset($menu['submenu']) &&
                        collect($menu['submenu'])
                            ->pluck('link')
                            ->contains(function ($link) {
                                return request()->routeIs($link);
                            }));
            @endphp

            @if (!isset($menu['submenu']))
                <li class="menu-item {{ $isActive ? 'active' : '' }}">
                    <a href="{{ route($menu['link']) }}" class="menu-link">
                        <i class="menu-icon tf-icons {{ $menu['icon'] }}"></i>
                        <div class="text-truncate" data-i18n="{{ $menu['title'] }}">{{ $menu['title'] }}</div>
                    </a>
                </li>
            @endif

            @if (isset($menu['submenu']))
                <li class="menu-item {{ $isActive ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons {{ $menu['icon'] }}"></i>
                        <div class="text-truncate" data-i18n="{{ $menu['title'] }}">{{ $menu['title'] }}</div>
                    </a>
                    <ul class="menu-sub">
                        @foreach ($menu['submenu'] as $submenu)
                            <li class="menu-item {{ request()->routeIs($submenu['link']) ? 'active' : '' }}">
                                <a href="{{ route($submenu['link']) }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="{{ $submenu['title'] }}">
                                        {{ $submenu['title'] }}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach

    </ul>
</aside>
