@extends('layouts.buyer')

@section('title', 'Menu Kantin · KantinGo')

@push('styles')
<style>
    .menu-page-header {
        margin-bottom: 16px;
    }

    .menu-page-title {
        font-size: 26px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 4px;
        letter-spacing: -0.02em;
    }

    .menu-page-subtitle {
        font-size: 13.5px;
        color: #6b7280;
        margin: 0;
    }

    .menu-filter-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .menu-search-input {
        flex: 1;
        min-width: 220px;
        height: 38px;
        padding: 0 12px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background: #ffffff;
        font-size: 13px;
        color: #111827;
        outline: none;
    }

    .menu-search-input:focus {
        border-color: #ff6a00;
    }

    .menu-tenant-select {
        height: 38px;
        padding: 0 12px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background: #ffffff;
        font-size: 13px;
        color: #111827;
        outline: none;
    }

    .menu-search-btn {
        height: 38px;
        padding: 0 16px;
        border: none;
        border-radius: 10px;
        background: #e5e7eb;
        color: #111827;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .menu-search-btn:hover {
        background: #ff6a00;
        color: #ffffff;
    }

    .menu-cards-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 14px;
    }

    .menu-item-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 14px;
        padding: 10px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .menu-photo-frame {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 3;
        max-height: 145px;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 8px;
        background: #f3f4f6;
    }

    .menu-photo-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .menu-tenant-tag {
        position: absolute;
        top: 6px;
        left: 6px;
        background: rgba(255, 255, 255, 0.92);
        color: #374151;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 6px;
    }

    .menu-card-title {
        font-size: 13px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 2px;
        text-decoration: none;
        display: block;
    }

    .menu-card-title:hover {
        color: #ff6a00;
    }

    .menu-card-tenant {
        font-size: 11px;
        color: #6b7280;
        margin: 0 0 8px;
    }

    .menu-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 6px;
    }

    .menu-card-price {
        font-size: 12px;
        font-weight: 800;
        color: #ea580c;
    }

    .menu-add-btn {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: none;
        background: #ff6a00;
        color: #ffffff;
        font-size: 14px;
        line-height: 1;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        text-decoration: none;
    }

    .menu-add-btn:hover {
        background: #ea580c;
    }

    @media (max-width: 1100px) {
        .menu-cards-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .menu-cards-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
</style>
@endpush

@section('content')
@php
    $resolveMenuImage = function ($name, $rawPhoto = null) {
        if ($rawPhoto && file_exists(public_path($rawPhoto))) {
            return asset($rawPhoto);
        }
        if ($rawPhoto && file_exists(public_path('storage/' . ltrim($rawPhoto, '/')))) {
            return asset('storage/' . ltrim($rawPhoto, '/'));
        }

        $lower = strtolower($name ?? '');
        if (str_contains($lower, 'teh')) {
            return asset('assets/images/figma/menu-teh.jpg');
        }
        if (str_contains($lower, 'alpukat')) {
            return asset('assets/images/figma/menu-alpukat.jpg');
        }
        if (str_contains($lower, 'mie')) {
            return asset('assets/images/figma/menu-mie.jpg');
        }
        if (str_contains($lower, 'nasi')) {
            return asset('assets/images/figma/menu-nasi.jpg');
        }
        if (str_contains($lower, 'siomay')) {
            return asset('assets/images/figma/menu-siomay.jpg');
        }

        return asset('assets/images/figma/hero-food.jpg');
    };

    $defaultItems = [];

    $displayMenus = collect();
    if (isset($menus) && count($menus) > 0) {
        foreach ($menus as $m) {
            $mName = is_array($m) ? ($m['name'] ?? 'Menu') : ($m->name ?? 'Menu');
            $mTenant = is_array($m) ? ($m['tenant'] ?? 'Kantin FILKOM') : ($m->tenant->name ?? ($m->tenant_name ?? 'Kantin FIK'));
            $mPrice = is_array($m) ? ($m['price'] ?? 0) : ($m->price ?? 0);
            $mRawImg = is_array($m) ? ($m['image'] ?? null) : ($m->image ?? ($m->photo ?? null));
            $mId = is_array($m) ? ($m['id'] ?? 1) : ($m->id ?? 1);

            $badgeText = 'FILKOM';
            if (str_contains(strtolower($mTenant), 'feb')) {
                $badgeText = 'FEB';
            } elseif (str_contains(strtolower($mTenant), 'ft')) {
                $badgeText = 'FT';
            }

            $displayMenus->push([
                'id' => $mId,
                'tenant_id' => is_array($m) ? ($m['tenant_id'] ?? '') : ($m->tenant_id ?? ''),
                'name' => $mName,
                'tenant' => $mTenant,
                'badge' => $badgeText,
                'price' => $mPrice,
                'image' => $resolveMenuImage($mName, $mRawImg),
            ]);
        }
    } else {
        $displayMenus = collect($defaultItems);
    }

    $searchQuery = request('q', '');
    $selectedTenant = request('tenant', '');

    if ($searchQuery !== '') {
        $displayMenus = $displayMenus->filter(fn ($item) =>
            str_contains(strtolower($item['name']), strtolower($searchQuery))
            || str_contains(strtolower($item['tenant']), strtolower($searchQuery))
        );
    }

    if ($selectedTenant !== '' && $selectedTenant !== 'all') {
        $displayMenus = $displayMenus->filter(fn ($item) =>
            (string)($item['tenant_id'] ?? '') === (string)$selectedTenant || (string)($item['tenant_id'] ?? '') === (string)$selectedTenant || strtolower($item['tenant']) === strtolower($selectedTenant)
        );
    }
@endphp

<div class="menu-page-header">
    <h1 class="menu-page-title">Menu Kantin</h1>
    <p class="menu-page-subtitle">Pilih makanan dan minuman favoritmu.</p>
</div>

<form method="GET" action="{{ url('/menu') }}" class="menu-filter-bar">
    <input type="text" name="q" value="{{ $searchQuery }}" placeholder="Cari menu atau kantin..." class="menu-search-input">

    <select name="tenant" class="menu-tenant-select">
        <option value="all" {{ $selectedTenant === '' || $selectedTenant === 'all' ? 'selected' : '' }}>Semua kantin</option>
        @foreach(($tenants ?? collect()) as $tenantOption)
            <option value="{{ $tenantOption->id }}" {{ (string)$selectedTenant === (string)$tenantOption->id ? 'selected' : '' }}>{{ $tenantOption->name }}</option>
        @endforeach
    </select>

    <button type="submit" class="menu-search-btn">Cari</button>
</form>

<div class="menu-cards-grid">
    @forelse ($displayMenus as $item)
        <div class="menu-item-card">
            <div>
                <div class="menu-photo-frame">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                    <span class="menu-tenant-tag">{{ $item['badge'] }}</span>
                </div>

                <a href="{{ \Illuminate\Support\Facades\Route::has('buyer.menu.show') ? route('buyer.menu.show', $item['id']) : url('/menu/' . $item['id']) }}" class="menu-card-title">
                    {{ $item['name'] }}
                </a>
                <p class="menu-card-tenant">{{ $item['tenant'] }}</p>
            </div>

            <div class="menu-card-footer">
                <span class="menu-card-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>

                @if (\Illuminate\Support\Facades\Route::has('buyer.cart.store'))
                    <form action="{{ route('buyer.cart.store') }}" method="POST" style="margin:0;">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $item['id'] }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="menu-add-btn" title="Tambah ke keranjang">+</button>
                    </form>
                @else
                    <a href="{{ \Illuminate\Support\Facades\Route::has('buyer.menu.show') ? route('buyer.menu.show', $item['id']) : url('/menu/' . $item['id']) }}" class="menu-add-btn" title="Lihat detail">+</a>
                @endif
            </div>
        </div>
    @empty
        <div style="grid-column:1/-1;background:#ffffff;border:1px solid #eef0f4;border-radius:14px;padding:20px;text-align:center;color:#6b7280;font-size:13px;">
            Menu tidak ditemukan.
        </div>
    @endforelse
</div>
@endsection