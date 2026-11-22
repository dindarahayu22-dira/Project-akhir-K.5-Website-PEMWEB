@extends('layouts.buyer')
@section('title', 'Home')

@section('content')
<section class="banner">
    <div class="banner-copy">
        <span class="pill pill-white">✦ Paling Populer Hari Ini</span>
        <h1>Makan enak di kantin kampus jadi lebih mudah!</h1>
        <p>Pesan tanpa antre, lacak progres masakan secara real-time, dan ambil saat siap di warung favoritmu.</p>
        <a class="btn btn-white" href="{{ route('buyer.menu.index') }}">Pesan Sekarang <span>→</span></a>
    </div>
    <img class="banner-photo" src="{{ asset('assets/images/figma/hero-food.jpg') }}" alt="Hidangan makanan kantin">
</section>

<section class="stat-row">
    <div class="card stat"><div><small>Pesanan aktif</small><strong>{{ $stats['active'] }}</strong></div><span class="stat-icon stat-peach">♨</span></div>
    <div class="card stat"><div><small>Item di keranjang</small><strong>{{ $stats['cart'] }}</strong></div><span class="stat-icon stat-blue">🛒</span></div>
    <div class="card stat"><div><small>Total pesanan</small><strong>{{ $stats['total'] }}</strong></div><span class="stat-icon stat-green">▣</span></div>
</section>

<div class="sec-head"><h2 class="sec-title">Kantin Terdekat</h2><a class="link-orange small" href="{{ route('buyer.menu.index') }}">Lihat Semua ›</a></div>
<section class="grid-3 tenant-grid">
    @forelse ($tenants as $t)
        <a class="card tenant-card" href="{{ route('buyer.menu.index', ['tenant' => $t->id]) }}">
            <div class="tenant-photo">
                <img src="{{ asset('assets/images/figma/tenant-' . ['fik','feb','ft'][$loop->index % 3] . '.jpg') }}" alt="Suasana {{ $t->name }}">
                <span class="pill {{ ($t->status === 'open') ? 'tone-green' : 'tone-red' }}">{{ ($t->status === 'open') ? 'Buka' : 'Tutup' }}</span>
                <em>★ {{ number_format((float) $t->rating, 1) }}</em>
            </div>
            <h3>{{ $t->name }}</h3>
            <p class="muted small">▣ Lt {{ $t->stand ?? 'G' }} · ◉ {{ $t->distance ?? '—' }} · {{ $t->menus_count }} Menu</p>
        </a>
    @empty
        <div class="card" style="grid-column:1/-1;padding:24px;text-align:center;color:#6b7280;">Belum ada kantin yang membuka menu. Silakan cek kembali nanti.</div>
    @endforelse
</section>


<div class="sec-head menu-section-head">
    <h2 class="sec-title">Menu Populer</h2>
    <a class="link-orange small" href="{{ route('buyer.menu.index') }}">
        Semua Menu ›
    </a>
</div>

<section class="grid-5 menu-grid">
    @forelse ($popular as $menu)
        <article class="menu-card">
            <a href="{{ route('buyer.menu.show', $menu) }}" class="menu-thumb">
                @php
                    $imagePath = $menu->image
                        ? public_path('storage/' . $menu->image)
                        : null;

                    $fallbackImages = [
                        'nasi',
                        'mie',
                        'teh',
                        'alpukat',
                        'siomay',
                    ];

                    $fallbackImage = asset(
                        'assets/images/figma/menu-' .
                        $fallbackImages[$loop->index % count($fallbackImages)] .
                        '.jpg'
                    );
                @endphp

                @if ($menu->image && file_exists($imagePath))
                    <img
                        src="{{ asset('storage/' . $menu->image) }}"
                        alt="{{ $menu->name }}"
                        loading="lazy"
                    >
                @else
                    <img
                        src="{{ $fallbackImage }}"
                        alt="{{ $menu->name }}"
                        loading="lazy"
                    >
                @endif
            </a>
            <h3>{{ $menu->name }}</h3>
            <p class="muted small">{{ $menu->tenant->name }}</p>
            <div class="menu-foot">
                <strong class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</strong>
                @if ($menu->isOrderable())
                    <form method="POST" action="{{ route('buyer.cart.add', $menu) }}">@csrf<button class="add-btn" aria-label="Tambah {{ $menu->name }} ke keranjang">+</button></form>
                @else
                    <span class="pill tone-red">Habis</span>
                @endif
            </div>
        </article>
    @empty
        <div class="card" style="grid-column:1/-1;padding:24px;text-align:center;color:#6b7280;">Belum ada menu tersedia saat ini.</div>
    @endforelse
</section>
@endsection
