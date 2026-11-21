@extends('layouts.buyer')

@php
    $menuName = is_array($menu ?? null) ? ($menu['name'] ?? 'Menu') : ($menu->name ?? 'Menu');
    $menuId = is_array($menu ?? null) ? ($menu['id'] ?? 1) : ($menu->id ?? 1);
    $tenantName = is_array($menu ?? null)
        ? ($menu['tenant'] ?? 'Kantin')
        : ($menu->tenant->name ?? ($menu->tenant_name ?? 'Kantin'));
    $price = (int) (is_array($menu ?? null) ? ($menu['price'] ?? 0) : ($menu->price ?? 0));
    $originalPrice = (int) (is_array($menu ?? null) ? ($menu['original_price'] ?? 0) : ($menu->original_price ?? 15000));
    $discountPct = ($originalPrice > $price && $originalPrice > 0)
        ? round((($originalPrice - $price) / $originalPrice) * 100)
        : 0;
    $description = is_array($menu ?? null)
        ? ($menu['description'] ?? 'Belum ada deskripsi untuk menu ini.')
        : ($menu->description ?? 'Belum ada deskripsi untuk menu ini.');
    $stock = (int) (is_array($menu ?? null) ? ($menu['stock'] ?? 0) : ($menu->stock ?? 0));
    $isAvailable = $stock > 0 && (!is_array($menu ?? null)) && (($menu->status ?? '') === 'available') && (($menu->tenant->status ?? '') === 'open');
    $maxOrderQty = $isAvailable ? min(10, max(1, $stock)) : 0;
    $rawPhoto = is_array($menu ?? null) ? ($menu['image'] ?? null) : ($menu->image ?? ($menu->photo ?? null));

    if ($rawPhoto && file_exists(public_path($rawPhoto))) {
        $mainPhoto = asset($rawPhoto);
    } elseif ($rawPhoto && file_exists(public_path('storage/' . ltrim($rawPhoto, '/')))) {
        $mainPhoto = asset('storage/' . ltrim($rawPhoto, '/'));
    } else {
        $lowerName = strtolower($menuName);
        if (str_contains($lowerName, 'teh')) {
            $mainPhoto = asset('assets/images/figma/menu-teh.jpg');
        } elseif (str_contains($lowerName, 'alpukat')) {
            $mainPhoto = asset('assets/images/figma/menu-alpukat.jpg');
        } elseif (str_contains($lowerName, 'mie')) {
            $mainPhoto = asset('assets/images/figma/menu-mie.jpg');
        } elseif (str_contains($lowerName, 'siomay')) {
            $mainPhoto = asset('assets/images/figma/menu-siomay.jpg');
        } else {
            $mainPhoto = asset('assets/images/figma/menu-nasi.jpg');
        }
    }

    $galleryThumbs = [
        $mainPhoto,
        asset('assets/images/figma/hero-food.jpg'),
        asset('assets/images/figma/menu-mie.jpg'),
    ];
@endphp

@section('title', $menuName . ' · KantinGo')

@push('styles')
<style>
    .figma-detail-top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 16px;
        font-size: 13px;
        color: #6b7280;
    }

    .figma-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .figma-breadcrumb a {
        color: #4b5563;
        text-decoration: none;
        font-weight: 500;
    }

    .figma-breadcrumb a:hover {
        color: #ff6a00;
    }

    .figma-top-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .figma-circle-btn {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        color: #374151;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.15s ease;
    }

    .figma-circle-btn:hover {
        border-color: #ff6a00;
        color: #ff6a00;
    }

    .figma-circle-btn.is-fav {
        background: #fff7ed;
        border-color: #ff6a00;
        color: #ea580c;
    }

    .figma-detail-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
        gap: 24px;
        align-items: start;
        margin-bottom: 28px;
    }

    .figma-photo-hero {
        position: relative;
        width: 100%;
        height: 340px;
        border-radius: 18px;
        overflow: hidden;
        background: #f3f4f6;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
    }

    .figma-photo-hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .figma-hero-badges {
        position: absolute;
        top: 14px;
        left: 14px;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .figma-badge-bestseller {
        background: #fff7ed;
        color: #ea580c;
        border: 1px solid #fed7aa;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 999px;
    }

    .figma-badge-halal {
        background: #dcfce7;
        color: #15803d;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 999px;
    }

    .figma-hero-prep {
        position: absolute;
        bottom: 14px;
        right: 14px;
        background: rgba(17, 24, 39, 0.78);
        color: #ffffff;
        font-size: 11px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 999px;
    }

    .figma-thumb-strip {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        margin-top: 12px;
    }

    .figma-thumb-item {
        height: 64px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid transparent;
        padding: 0;
        background: #f9fafb;
        cursor: pointer;
    }

    .figma-thumb-item.active {
        border-color: #ff6a00;
    }

    .figma-thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .figma-booth-card {
        height: 64px;
        border-radius: 12px;
        border: 1px dashed #d1d5db;
        background: #f9fafb;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 2px;
        font-size: 11px;
        color: #6b7280;
    }

    .figma-right-panel {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 6px 24px rgba(15, 23, 42, 0.04);
    }

    .figma-title-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 6px;
    }

    .figma-menu-title {
        font-size: 26px;
        font-weight: 800;
        color: #111827;
        margin: 0;
    }

    .figma-available-pill {
        background: #dcfce7;
        color: #15803d;
        font-size: 11.5px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .figma-available-pill.is-empty {
        background: #fee2e2;
        color: #b91c1c;
    }

    .figma-submeta {
        font-size: 12.5px;
        color: #6b7280;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .figma-price-wrap {
        display: flex;
        align-items: baseline;
        gap: 10px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .figma-price-now {
        font-size: 26px;
        font-weight: 800;
        color: #ff6a00;
    }

    .figma-price-was {
        font-size: 14px;
        color: #9ca3af;
        text-decoration: line-through;
    }

    .figma-price-save {
        background: #ffedd5;
        color: #ea580c;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 999px;
    }

    .figma-desc-box {
        background: #f4f6fb;
        border-radius: 14px;
        padding: 14px 16px;
        margin-bottom: 16px;
    }

    .figma-desc-title {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.04em;
        color: #6b7280;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .figma-desc-body {
        font-size: 13px;
        line-height: 1.55;
        color: #374151;
        margin: 0 0 8px;
    }

    .figma-stock-text {
        font-size: 12px;
        font-weight: 600;
        color: #ea580c;
        margin: 0;
    }

    .figma-spicy-label-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .figma-spicy-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 8px;
        margin-bottom: 16px;
    }

    .figma-spicy-btn {
        border: 1px solid #e5e7eb;
        background: #ffffff;
        color: #374151;
        border-radius: 10px;
        padding: 8px 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .figma-spicy-btn.active {
        background: #ff6a00;
        border-color: #ff6a00;
        color: #ffffff;
    }

    .figma-qty-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
        gap: 12px;
    }

    .figma-subtotal-preview {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff7ed;
        border: 1px solid #ffedd5;
        border-radius: 10px;
        padding: 9px 12px;
        margin-bottom: 14px;
        font-size: 12.5px;
    }

    .figma-stepper {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #f3f4f6;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .figma-step-btn {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        border: none;
        font-weight: 700;
        cursor: pointer;
    }

    .figma-step-btn.minus {
        background: #ffffff;
        color: #374151;
    }

    .figma-step-btn.plus {
        background: #ff6a00;
        color: #ffffff;
    }

    .figma-cta-row {
        display: grid;
        grid-template-columns: 1.3fr 0.9fr;
        gap: 10px;
        margin-bottom: 12px;
    }

    .figma-btn-cart {
        background: #ff6a00;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
    }

    .figma-btn-cart:disabled,
    .figma-btn-buy:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .figma-btn-buy {
        background: #ffedd5;
        color: #ea580c;
        border: none;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
    }

    .figma-trust-row {
        display: flex;
        justify-content: center;
        gap: 18px;
        font-size: 11.5px;
        color: #6b7280;
    }

    .figma-reviews-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
        flex-wrap: wrap;
    }

    .figma-reviews-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }

    .figma-review-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 14px;
        padding: 16px;
    }

    .figma-review-chip {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        margin-top: 8px;
        margin-right: 4px;
    }

    .figma-pairing-panel {
        background: #f4f6fb;
        border: 1px solid #e8ecf5;
        border-radius: 16px;
        padding: 16px;
    }

    .figma-pairing-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-top: 12px;
    }

    .figma-pairing-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 12px;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .figma-pairing-add-btn {
        width: 26px;
        height: 26px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        color: #111827;
        font-weight: 700;
        cursor: pointer;
        flex-shrink: 0;
    }

    .figma-pairing-add-btn:hover,
    .figma-pairing-add-btn.is-added {
        background: #ff6a00;
        border-color: #ff6a00;
        color: #ffffff;
    }

    @media (max-width: 900px) {
        .figma-detail-grid,
        .figma-reviews-grid,
        .figma-pairing-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div id="figmaMenuConfig" data-unit-price="{{ $price }}" data-max-qty="{{ $maxOrderQty }}" hidden></div>

@if (session('status'))
    <div style="background:#dcfce7;color:#15803d;padding:10px 14px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:14px;">
        {{ session('status') }}
    </div>
@endif

<div id="figmaToast" style="display:none;background:#fff7ed;border:1px solid #fed7aa;color:#c2410c;padding:10px 14px;border-radius:10px;font-size:12.5px;font-weight:600;margin-bottom:14px;"></div>

<div class="figma-detail-top-bar">
    <div class="figma-breadcrumb">
        <a href="{{ url('/menu') }}">🍴 Menu</a>
        <span>&rsaquo;</span>
        <span>{{ $tenantName }}</span>
        <span>&rsaquo;</span>
        <strong style="color:#111827;">{{ $menuName }}</strong>
    </div>

    <div class="figma-top-actions">
        <button type="button" class="figma-circle-btn" title="Bagikan" onclick="shareMenuLink()">&#8599;</button>
        <button type="button" id="figmaFavBtn" class="figma-circle-btn" title="Favorit" onclick="toggleFavoriteMenu()">&#9825;</button>
    </div>
</div>

<div class="figma-detail-grid">
    <div>
        <div class="figma-photo-hero">
            <img id="figmaMainImage" src="{{ $mainPhoto }}" alt="{{ $menuName }}">
            <div class="figma-hero-badges">
                <span class="figma-badge-bestseller">&#128293; Terlaris di FIK</span>
                <span class="figma-badge-halal">&#10003; 100% Halal</span>
            </div>
            <div class="figma-hero-prep">&#128338; Estimasi siap: 7–10 mnt</div>
        </div>

        <div class="figma-thumb-strip">
            @foreach ($galleryThumbs as $idx => $thumbUrl)
                <button type="button"
                    class="figma-thumb-item {{ $idx === 0 ? 'active' : '' }}"
                    onclick="setFigmaThumb('{{ $thumbUrl }}', this)">
                    <img src="{{ $thumbUrl }}" alt="Foto {{ $idx + 1 }}">
                </button>
            @endforeach
            <div class="figma-booth-card">
                <span>&#127978;</span>
                <span>Booth FIK</span>
            </div>
        </div>
    </div>

    <div class="figma-right-panel">
        <div class="figma-title-head">
            <h1 class="figma-menu-title">{{ $menuName }}</h1>
            <span class="figma-available-pill {{ $isAvailable ? '' : 'is-empty' }}">
                {{ $isAvailable ? '• Tersedia' : '• Habis' }}
            </span>
        </div>

        <div class="figma-submeta">
            <span>&#127978; <strong style="color:#111827;">{{ $tenantName }}</strong></span>
            <span>&bull;</span>
            <span>&#128205; 50 m</span>
            <span>&bull;</span>
            <span>&#11088; <strong style="color:#111827;">4.5</strong> (120 ulasan)</span>
        </div>

        <div class="figma-price-wrap">
            <span class="figma-price-now">Rp {{ number_format($price, 0, ',', '.') }}</span>
            @if ($originalPrice > $price)
                <span class="figma-price-was">Rp {{ number_format($originalPrice, 0, ',', '.') }}</span>
                <span class="figma-price-save">Hemat {{ $discountPct }}%</span>
            @endif
        </div>

        <div class="figma-desc-box">
            <div class="figma-desc-title">DESKRIPSI HIDANGAN</div>
            <p class="figma-desc-body">{{ $description }}</p>
            <p class="figma-stock-text">
                &#128230; {{ $isAvailable ? "Stok tersisa {$stock} porsi hari ini" : "Stok habis untuk hari ini" }}
            </p>
        </div>

        <div class="figma-spicy-label-row">
            <strong style="color:#111827;">Tingkat Kepedasan:</strong>
            <span id="figmaSpicyLabel" style="color:#ea580c;font-weight:700;">Sedang (Level 2)</span>
        </div>
        <div class="figma-spicy-grid">
            <button type="button" class="figma-spicy-btn" data-spicy="Tidak Pedas (Level 0)" onclick="setFigmaSpicy(this)">Tidak Pedas</button>
            <button type="button" class="figma-spicy-btn active" data-spicy="Sedang (Level 2)" onclick="setFigmaSpicy(this)">Sedang</button>
            <button type="button" class="figma-spicy-btn" data-spicy="Pedas (Level 3)" onclick="setFigmaSpicy(this)">Pedas</button>
            <button type="button" class="figma-spicy-btn" data-spicy="Extra &#128293; (Level 4)" onclick="setFigmaSpicy(this)">Extra &#128293;</button>
        </div>

        <form action="{{ \Illuminate\Support\Facades\Route::has('buyer.cart.store') ? route('buyer.cart.store') : url('/keranjang') }}" method="POST">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $menuId }}">
            <input type="hidden" name="spicy_level" id="figmaSpicyInput" value="Sedang (Level 2)">

            <div class="figma-qty-row">
                <div>
                    <div style="font-size:13px;font-weight:700;color:#111827;">Jumlah Pesanan</div>
                    <div style="font-size:11px;color:#6b7280;">Maksimal 10 porsi per akun</div>
                </div>
                <div class="figma-stepper">
                    <button type="button" class="figma-step-btn minus" onclick="setFigmaQty(-1)" {{ $isAvailable ? '' : 'disabled' }}>&minus;</button>
                    <input type="number" id="figmaQtyInput" name="quantity" value="{{ $isAvailable ? 1 : 0 }}" min="{{ $isAvailable ? 1 : 0 }}" max="{{ $maxOrderQty }}" readonly
                        style="width:32px;text-align:center;border:none;background:transparent;font-weight:700;font-size:14px;">
                    <button type="button" class="figma-step-btn plus" onclick="setFigmaQty(1)" {{ $isAvailable ? '' : 'disabled' }}>+</button>
                </div>
            </div>

            <div class="figma-subtotal-preview">
                <span style="color:#6b7280;font-weight:600;">Subtotal item (<span id="figmaQtyText">{{ $isAvailable ? 1 : 0 }}</span> porsi)</span>
                <strong id="figmaSubtotalText" style="color:#ea580c;font-size:14px;">Rp {{ number_format($isAvailable ? $price : 0, 0, ',', '.') }}</strong>
            </div>

            <div class="figma-cta-row">
                <button type="submit" class="figma-btn-cart" {{ $isAvailable ? '' : 'disabled' }}>&#128717;&#65039; Tambah ke keranjang</button>
                <button type="submit" name="buy_now" value="1" class="figma-btn-buy" {{ $isAvailable ? '' : 'disabled' }}>&#9889; Beli sekarang</button>
            </div>
        </form>

        <div class="figma-trust-row">
            <span>&#128737;&#65039; Higienis &amp; Segar</span>
            <span>&#9889; Bebas Antre Fisik</span>
        </div>
    </div>
</div>

<div class="figma-reviews-head">
    <div>
        <h2 style="margin:0;font-size:18px;font-weight:800;color:#111827;">Ulasan Pembeli</h2>
        <p style="margin:2px 0 0;font-size:12px;color:#6b7280;">Pendapat mahasiswa dan dosen mengenai menu ini</p>
    </div>
    <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:6px 12px;font-size:12px;font-weight:700;">
        &#11088; 4.5 <span style="color:#6b7280;font-weight:500;">/ 5.0</span> &nbsp;|&nbsp; <span style="color:#15803d;">98% Menyukai</span>
    </div>
</div>

<div class="figma-reviews-grid">
    @forelse(($reviews ?? collect()) as $review)
    <div class="figma-review-card"><div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;"><div style="display:flex;align-items:center;gap:10px;"><span style="width:32px;height:32px;border-radius:50%;background:#ffedd5;color:#ea580c;font-weight:700;display:inline-flex;align-items:center;justify-content:center;font-size:12px;">{{ strtoupper(substr($review->user->name ?? 'P',0,1)) }}</span><div><div style="font-size:13px;font-weight:700;color:#111827;">{{ $review->user->name ?? 'Pembeli' }}</div><div style="font-size:11px;color:#6b7280;">{{ $review->created_at->diffForHumans() }}</div></div></div><span style="color:#f59e0b;font-size:12px;">{{ str_repeat('★',(int)$review->rating) }}{{ str_repeat('☆',5-(int)$review->rating) }}</span></div><p style="margin:0;font-size:13px;color:#374151;">{{ $review->comment ?: 'Pembeli memberikan rating untuk menu ini.' }}</p>@foreach(($review->tags ?? []) as $tag)<span class="figma-review-chip">{{ $tag }}</span>@endforeach</div>
    @empty
    <div class="figma-review-card" style="grid-column:1/-1;text-align:center;color:#6b7280;">Belum ada ulasan untuk menu ini.</div>
    @endforelse
</div>

@if(($relatedMenus ?? collect())->isNotEmpty())
<div class="figma-pairing-panel"><div style="display:flex;justify-content:space-between;align-items:center;"><strong style="font-size:14px;color:#111827;">Menu lain dari kantin ini</strong><span style="font-size:11px;color:#ea580c;font-weight:600;">{{ $tenantName }}</span></div><div class="figma-pairing-grid">
@foreach($relatedMenus as $related)<div class="figma-pairing-card"><div style="display:flex;align-items:center;gap:10px;"><img src="{{ $related->image ? asset('storage/'.$related->image) : asset('assets/images/figma/menu-nasi.jpg') }}" alt="{{ $related->name }}" style="width:42px;height:42px;border-radius:8px;object-fit:cover;"><div><div style="font-size:12px;font-weight:700;color:#111827;">{{ $related->name }}</div><div style="font-size:11px;color:#ea580c;font-weight:700;">Rp {{ number_format($related->price,0,',','.') }}</div></div></div><a href="{{ route('buyer.menu.show',$related) }}" class="figma-pairing-add-btn" title="Lihat menu">+</a></div>@endforeach
</div></div>
@endif

<script>
    const _menuCfg = document.getElementById('figmaMenuConfig');
    const MENU_UNIT_PRICE = _menuCfg ? parseInt(_menuCfg.dataset.unitPrice || '0', 10) : 0;
    const MAX_ORDER_QTY = _menuCfg ? parseInt(_menuCfg.dataset.maxQty || '0', 10) : 0;

    function formatRupiah(num) {
        return 'Rp ' + Number(num || 0).toLocaleString('id-ID');
    }

    function showFigmaToast(msg) {
        const toast = document.getElementById('figmaToast');
        if (!toast) return;
        toast.textContent = msg;
        toast.style.display = 'block';
        clearTimeout(window._figmaToastTimer);
        window._figmaToastTimer = setTimeout(() => {
            toast.style.display = 'none';
        }, 2800);
    }

    function updateSubtotalPreview() {
        const inp = document.getElementById('figmaQtyInput');
        const qtyText = document.getElementById('figmaQtyText');
        const subText = document.getElementById('figmaSubtotalText');
        const qty = inp ? parseInt(inp.value || '0', 10) : 0;
        if (qtyText) qtyText.textContent = qty;
        if (subText) subText.textContent = formatRupiah(qty * MENU_UNIT_PRICE);
    }

    function setFigmaThumb(url, el) {
        const img = document.getElementById('figmaMainImage');
        if (img) img.src = url;
        document.querySelectorAll('.figma-thumb-item').forEach(btn => btn.classList.remove('active'));
        if (el) el.classList.add('active');
    }

    function setFigmaSpicy(btn) {
        document.querySelectorAll('.figma-spicy-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const val = btn.getAttribute('data-spicy') || 'Sedang (Level 2)';
        const lbl = document.getElementById('figmaSpicyLabel');
        const inp = document.getElementById('figmaSpicyInput');
        if (lbl) lbl.textContent = val;
        if (inp) inp.value = val;
    }

    function setFigmaQty(delta) {
        const inp = document.getElementById('figmaQtyInput');
        if (!inp || MAX_ORDER_QTY <= 0) return;
        const curr = parseInt(inp.value || '1', 10);
        const next = Math.min(MAX_ORDER_QTY, Math.max(1, curr + delta));
        inp.value = next;
        updateSubtotalPreview();
    }

    function pickPairingItem(name, price, btn) {
        setFigmaQty(1);
        if (btn) {
            btn.classList.add('is-added');
            btn.textContent = '✓';
        }
        showFigmaToast(name + ' (' + formatRupiah(price) + ') dipilih sebagai pasangan menu.');
    }

    function shareMenuLink() {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(window.location.href).catch(() => {});
        }
        showFigmaToast('Tautan menu berhasil disalin.');
    }

    function toggleFavoriteMenu() {
        const btn = document.getElementById('figmaFavBtn');
        if (!btn) return;
        const fav = btn.classList.toggle('is-fav');
        btn.innerHTML = fav ? '&#9829;' : '&#9825;';
        showFigmaToast(fav ? 'Ditambahkan ke menu favorit.' : 'Dihapus dari menu favorit.');
    }

    updateSubtotalPreview();
</script>
@endsection