@extends('layouts.buyer')

@section('title', 'Keranjang Saya · KantinGo')

@push('styles')
<style>
    .cart-step-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.04em;
        color: #ea580c;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .cart-main-title {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 4px;
    }

    .cart-sub-desc {
        font-size: 13.5px;
        color: #6b7280;
        margin: 0 0 20px;
    }

    .cart-tenant-banner {
        background: #eff6ff;
        border: 1px solid #dbeafe;
        border-radius: 12px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
        max-width: 860px;
    }

    .cart-open-badge {
        background: #dcfce7;
        color: #15803d;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 999px;
    }

    .cart-item-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 12px;
        max-width: 860px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    }

    .cart-item-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .cart-item-thumb {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .cart-item-right {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .cart-qty-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f3f4f6;
        padding: 4px 8px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
    }

    .cart-qty-btn {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        border: none;
        background: #ffffff;
        color: #111827;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .cart-qty-btn:hover {
        background: #ff6a00;
        color: #ffffff;
    }

    .cart-info-banner {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 11px 16px;
        font-size: 12px;
        color: #475569;
        max-width: 860px;
        margin-bottom: 14px;
    }

    .cart-summary-bar {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        max-width: 860px;
        flex-wrap: wrap;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);
    }

    .cart-total-amount {
        font-size: 26px;
        font-weight: 800;
        color: #ff6a00;
        line-height: 1.1;
    }

    .cart-btn-continue {
        background: #ffedd5;
        color: #ea580c;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 16px;
        border-radius: 10px;
        text-decoration: none;
    }

    .cart-btn-checkout {
        background: #ff6a00;
        color: #ffffff;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 18px;
        border-radius: 10px;
        text-decoration: none;
    }
</style>
@endpush

@section('content')
@php
    $cart = $cart ?? auth()->user()->cart?->load('tenant','items.menu.tenant');
    $items = collect($cart?->items ?? [])->map(function ($item) use ($cart) {
        $menu = $item->menu;
        return ['id'=>$item->id,'name'=>$menu?->name ?? $item->menu_name ?? 'Menu tidak tersedia','tenant'=>$menu?->tenant?->name ?? $cart?->tenant?->name ?? 'Kantin','price'=>(int)($menu?->price ?? 0),'quantity'=>(int)$item->quantity,'subtotal'=>(int)($menu?->price ?? 0)*(int)$item->quantity,'image'=>$menu?->image ? asset('storage/'.$menu->image) : asset('assets/images/figma/menu-nasi.jpg'),'is_dummy'=>false];
    });
@endphp

@php $activeTenant = $cart?->tenant?->name ?? 'Belum ada kantin dipilih'; $grandTotal = $items->sum('subtotal'); @endphp
@php $activeTenant = $cart?->tenant?->name ?? 'Belum ada kantin dipilih'; $grandTotal = $items->sum('subtotal'); @endphp
@if (session('status'))
    <div style="background:#dcfce7;color:#15803d;padding:10px 14px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:14px;max-width:860px;">
        {{ session('status') }}
    </div>
@endif

<div class="cart-step-tag">&#128717;&#65039; LANGKAH 1 DARI 3</div>
<h1 class="cart-main-title">Keranjang Saya</h1>
<p class="cart-sub-desc">Cek kembali pesananmu sebelum melanjutkan pembayaran.</p>

@if ($items->isNotEmpty())
<div class="cart-tenant-banner"><div style="font-size:13px;font-weight:700;color:#111827;">&#127978; {{ $activeTenant }}</div><span class="cart-open-badge">{{ $cart?->tenant?->status === 'open' ? 'Buka' : 'Tutup' }}</span></div>
@else
<div class="cart-info-banner" style="padding:28px;text-align:center;"><strong>Keranjangmu masih kosong</strong><p style="margin:8px 0 14px;">Pilih menu yang tersedia dari kantin yang sedang buka untuk mulai memesan.</p><a href="{{ route('buyer.menu.index') }}" class="cart-btn-checkout">Jelajahi menu</a></div>
@endif

@foreach ($items as $row)
    <div class="cart-item-card">
        <div class="cart-item-left">
            <img src="{{ $row['image'] }}" alt="{{ $row['name'] }}" class="cart-item-thumb">
            <div>
                <div style="font-size:15px;font-weight:700;color:#111827;">{{ $row['name'] }}</div>
                <div style="font-size:12px;color:#6b7280;">
                    {{ $row['tenant'] }} &bull; Rp {{ number_format($row['price'], 0, ',', '.') }}
                    @if (!empty($row['spicy_level']))
                        &bull; {{ $row['spicy_level'] }}
                    @endif
                </div>
                <div style="font-size:11.5px;color:#15803d;font-weight:600;margin-top:3px;">&#10003; Siap dimasak</div>
            </div>
        </div>

        <div class="cart-item-right">
            @if (!$row['is_dummy'])
                <div class="cart-qty-pill">
                    <form action="{{ \Illuminate\Support\Facades\Route::has('buyer.cart.update') ? route('buyer.cart.update', $row['id']) : url('/keranjang/' . $row['id']) }}" method="POST" style="margin:0;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="action" value="decrease">
                        <input type="hidden" name="quantity" value="{{ max(1, $row['quantity'] - 1) }}">
                        <input type="hidden" name="quantity" value="{{ max(1, $row['quantity'] - 1) }}">
                        <button type="submit" class="cart-qty-btn">&minus;</button>
                    </form>

                    <span>{{ $row['quantity'] }}</span>

                    <form action="{{ \Illuminate\Support\Facades\Route::has('buyer.cart.update') ? route('buyer.cart.update', $row['id']) : url('/keranjang/' . $row['id']) }}" method="POST" style="margin:0;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="action" value="increase">
                        <input type="hidden" name="quantity" value="{{ min(10, $row['quantity'] + 1) }}">
                        <input type="hidden" name="quantity" value="{{ min(10, $row['quantity'] + 1) }}">
                        <button type="submit" class="cart-qty-btn">+</button>
                    </form>
                </div>
            @else
                <div class="cart-qty-pill">
                    <span>&minus;</span>
                    <span>{{ $row['quantity'] }}</span>
                    <span>+</span>
                </div>
            @endif

            <div style="font-size:15px;font-weight:800;color:#111827;min-width:84px;text-align:right;">
                Rp {{ number_format($row['subtotal'], 0, ',', '.') }}
            </div>
        </div>
    </div>
@endforeach

@if ($items->isNotEmpty())
<div class="cart-info-banner">
    &#9432; Pesanan akan disiapkan oleh mitra kantin segera setelah kamu menyelesaikan proses checkout. Estimasi waktu ambil <strong>10–15 menit</strong>.
</div>

<div class="cart-summary-bar">
    <div>
        <div style="font-size:10.5px;font-weight:700;letter-spacing:0.04em;color:#6b7280;text-transform:uppercase;">TOTAL PEMBAYARAN</div>
        <div class="cart-total-amount">Rp {{ number_format($grandTotal, 0, ',', '.') }}</div>
    </div>

    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
        <a href="{{ url('/menu') }}" class="cart-btn-continue">Lanjutkan belanja</a>
        <a href="{{ \Illuminate\Support\Facades\Route::has('buyer.cart.checkout') ? route('buyer.checkout.index') : url('/checkout') }}" class="cart-btn-checkout">Checkout &rarr;</a>
    </div>
</div>
@endif
@endsection