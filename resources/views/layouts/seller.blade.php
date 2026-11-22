<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') · KantinGo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/buyer-shell.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/buyer-orders.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages.css') }}">
    @stack('styles')
</head>
<body>
@php
    $nav = [
        ['Dashboard',         'home',    'seller.dashboard',     null],
        ['Kelola Tenant',     'bag',     'seller.tenant',        null],
        ['Kelola Menu',       'menu',    'seller.menus.index',          null],
        ['Pesanan Masuk',     'orders',  'seller.orders.index',  null],
        ['Riwayat Transaksi', 'history', 'seller.transaksi',     null],
        ['Notifikasi',        'bell',    'seller.notifikasi',    null],
        ['Profile',           'user',    'seller.profil',        null],
    ];
    $active = $active ?? 'Dashboard';
    $href = fn ($name) => \Illuminate\Support\Facades\Route::has($name) ? route($name) : '#';
@endphp

<div class="shell">
    <aside class="sidebar">
        <a class="brand" href="{{ $href('seller.dashboard') }}">
            <span class="brand-mark">K</span>
            <span class="brand-text"><strong>KantinGo</strong><small>Portal Penjual</small></span>
        </a>

        <nav class="nav">
            @foreach ($nav as [$label, $icon, $route, $badge])
                <a href="{{ $href($route) }}" class="nav-link {{ $label === $active ? 'is-active' : '' }}">
                    <x-icon :name="$icon"/> <span>{{ $label }}</span>
                    @if ($badge) <span class="nav-badge">{{ $badge }}</span> @endif
                </a>
            @endforeach
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="logout">
            @csrf
            <button type="submit"><x-icon name="logout"/> Keluar</button>
        </form>
    </aside>

    <div class="main">
        <header class="topbar">
            <form class="search" method="GET" action="{{ $href('seller.orders.index') }}">
                <x-icon name="search"/>
                <input type="search" name="q" placeholder="Cari makanan, minuman, atau kantin...">
            </form>
            <span class="role-pill"><i></i> Penjual</span>
            <span class="avatar" title="{{ auth()->user()->name }}">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
        </header>

        <main class="content">
            @if (session('status')) <div class="flash" role="status">{{ session('status') }}</div> @endif
            @if ($errors->any() && ! View::hasSection('own-errors')) <div class="flash flash-error" role="alert">{{ $errors->first() }}</div> @endif
            @yield('content')
        </main>
    </div>
</div>


</body>
</html>
