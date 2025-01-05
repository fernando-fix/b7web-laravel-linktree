<?php
$menus = [
    [
        'icon' => '🏠',
        'text' => 'Dashboard',
        'url' => route('dashboard'),
        'submenu' => [],
    ],
    [
        'icon' => '👤',
        'text' => 'Minha conta',
        'url' => null,
        'open_menu_routes' => ['users.edit', 'links.index', 'links.create', 'links.edit'],
        'submenu' => [
            [
                'text' => 'Meu perfil',
                'url' => route('users.edit', Auth::user()->id),
                'active' => ['users.edit'],
            ],
            [
                'text' => 'Meus links',
                'url' => route('links.index'),
                'active' => ['links.index', 'links.create', 'links.edit'],
            ],
        ],
    ],
];
?>

<!-- Menus no topo -->
<ul>
    @foreach ($menus as $menu)
        <li>
            @if (isset($menu['submenu']) && count($menu['submenu']) > 0)
                <div class="menu-item
                    @if (request()->routeIs($menu['open_menu_routes'] ?? [])) open @endif
                    @if (in_array(request()->route()->getName(), $menu['open_menu_routes'] ?? [])) active @endif"
                    onclick="toggleSubmenu(this)">
                    <span class="icon">{{ $menu['icon'] }}</span>
                    <span class="text">{{ $menu['text'] }}</span>
                    <span class="chevron">❯</span>
                </div>
                <ul class="submenu @if (request()->routeIs($menu['open_menu_routes'] ?? [])) open @endif">
                    @foreach ($menu['submenu'] as $submenu)
                        <li
                            class="{{ in_array(true, array_map(fn($route) => request()->routeIs($route), $submenu['active'] ?? [])) ? 'active' : '' }}">
                            <a href="{{ $submenu['url'] }}">{{ $submenu['text'] }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <a href="{{ $menu['url'] }}" class="menu-item {{ request()->url() == $menu['url'] ? 'active' : '' }}">
                    <span class="icon">{{ $menu['icon'] }}</span>
                    <span class="text">{{ $menu['text'] }}</span>
                    <span></span>
                </a>
            @endif
        </li>
    @endforeach
</ul>
