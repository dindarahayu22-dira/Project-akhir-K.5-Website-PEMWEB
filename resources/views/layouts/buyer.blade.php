<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'KantinGo') · KantinGo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/buyer-shell.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/buyer-orders.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages.css') }}">
    @stack('styles')
</head>
<body>
<div class="shell">
    <aside class="sidebar">
        <a class="brand" href="{{ route('buyer.home') }}">
            <span class="brand-mark">K</span>
            <span class="brand-text"><strong>KantinGo</strong><small>Universitas Hub</small></span>
        </a>
        <nav class="nav" aria-label="Navigasi utama">
            <a class="nav-link {{ request()->is('home') ? 'is-active' : '' }}" href="{{ route('buyer.home') }}">⌂ <span>Home</span></a>
            <a class="nav-link {{ request()->is('menu*') ? 'is-active' : '' }}" href="{{ route('buyer.menu.index') }}">⚒ <span>Menu</span></a>
            <a class="nav-link {{ request()->is('keranjang*') ? 'is-active' : '' }}" href="{{ route('buyer.cart.index') }}">♧ <span>Keranjang</span><span class="nav-badge">{{ auth()->user()?->cart?->items?->sum('quantity') ?? 0 }}</span></a>
            <a class="nav-link {{ request()->is('pesanan*') ? 'is-active' : '' }}" href="{{ route('buyer.checkout.index') }}">▣ <span>Pesanan</span></a>
            <a class="nav-link {{ request()->is('pembayaran*') ? 'is-active' : '' }}" href="{{ route('buyer.payment.index') }}">▤ <span>Pembayaran</span></a>
            <a class="nav-link {{ request()->is('riwayat*') ? 'is-active' : '' }}" href="{{ route('buyer.orders.index') }}">◷ <span>Riwayat</span></a>
            <a class="nav-link {{ request()->is('notifikasi*') ? 'is-active' : '' }}" href="{{ route('buyer.notifications.index') }}">♧ <span>Notifikasi</span></a>
            <a class="nav-link {{ request()->is('profil*') ? 'is-active' : '' }}" href="{{ route('buyer.profile.show') }}">♙ <span>Profile</span></a>
        </nav>
        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit">⇥ <span>Keluar</span></button>
            </form>
        </div>
    </aside>
    <div class="main">
        <header class="topbar">
            <label class="search">⌕ <input type="search" placeholder="Cari makanan, minuman, atau kantin..." aria-label="Cari makanan, minuman, atau kantin"></label>
            <span class="role-pill"><i></i> Pembeli</span>
            <span class="avatar">{{ mb_substr(auth()->user()->name ?? 'P', 0, 1) }}</span>
        </header>
        <main class="content">@yield('content')</main>
    </div>
</div>
@stack('scripts')
</body>
</html>
