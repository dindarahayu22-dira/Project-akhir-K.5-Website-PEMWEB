@extends('layouts.seller')

@section('title', 'Dashboard Penjual · KantinGo')

@push('styles')
<style>
    .sl-dash-wrap {
        max-width: 1020px;
        width: 100%;
    }

    .sl-hero-banner {
        background: linear-gradient(100deg, #ff6a00 0%, #ff7b00 65%, #ff8c1a 100%);
        border-radius: 20px;
        padding: 22px 24px;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 18px;
        box-shadow: 0 10px 24px rgba(255, 106, 0, 0.18);
        flex-wrap: wrap;
    }

    .sl-live-pill {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 10px;
    }

    .sl-hero-title {
        font-size: 28px;
        font-weight: 800;
        margin: 0 0 4px;
        letter-spacing: -0.02em;
    }

    .sl-hero-sub {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.92);
        margin: 0;
    }

    .sl-hero-photo-box {
        position: relative;
        width: 210px;
        height: 112px;
        border-radius: 14px;
        overflow: hidden;
        border: 2px solid rgba(255, 255, 255, 0.35);
        flex-shrink: 0;
    }

    .sl-hero-photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .sl-hero-photo-tag {
        position: absolute;
        left: 8px;
        bottom: 8px;
        background: rgba(17, 24, 39, 0.72);
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 6px;
    }

    .sl-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 22px;
    }

    .sl-stat-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 15px 16px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    }

    .sl-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 8px;
    }

    .sl-stat-label {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
    }

    .sl-stat-icon {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .sl-stat-val {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
        line-height: 1.2;
    }

    .sl-stat-meta {
        font-size: 11px;
        color: #6b7280;
        margin-top: 4px;
    }

    .sl-section-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 12px;
    }

    .sl-section-title {
        font-size: 16px;
        font-weight: 800;
        color: #111827;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }

    .sl-badge-new {
        background: #ffedd5;
        color: #ea580c;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 999px;
    }

    .sl-order-row {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 16px 20px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
        flex-wrap: wrap;
    }

    .sl-status-chip {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
        margin-left: 6px;
    }

    .sl-status-chip.processing {
        background: #ffedd5;
        color: #ea580c;
    }

    .sl-status-chip.created {
        background: #f1f5f9;
        color: #374151;
    }

    .sl-action-orange {
        background: #ff6a00;
        color: #ffffff;
        border: none;
        border-radius: 11px;
        padding: 9px 16px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 6px 14px rgba(255, 106, 0, 0.22);
    }

    .sl-action-orange:hover {
        background: #ea580c;
    }

    @media (max-width: 900px) {
        .sl-stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .sl-stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
@php $tenantName=$tenant->name ?? 'Kantin Anda'; $stats=$stats ?? ['today'=>0,'pending'=>0,'revenue'=>0,'menus'=>0]; $orders=$orders ?? collect(); @endphp
<div class="sl-dash-wrap">
 @if(session('status'))<div style="background:#dcfce7;color:#15803d;padding:10px 14px;border-radius:12px;margin-bottom:14px;">{{ session('status') }}</div>@endif
 <div class="sl-hero-banner"><div><div class="sl-live-pill"><span>&#9679;</span><span>Kantin {{ $tenant->status==='open'?'Buka':'Tutup' }}</span></div><h1 class="sl-hero-title">Halo, {{ auth()->user()->name }}!</h1><p class="sl-hero-sub">Ringkasan aktivitas {{ $tenantName }}.</p></div><div class="sl-hero-photo-box"><img src="{{ $tenant->photo ? asset('storage/'.$tenant->photo) : asset('assets/images/kantin.png') }}" alt="{{ $tenantName }}"><span class="sl-hero-photo-tag">{{ $tenantName }}</span></div></div>
 <div class="sl-stats-grid">
  <div class="sl-stat-card"><div class="sl-stat-top"><span class="sl-stat-label">Pesanan hari ini</span><span class="sl-stat-icon">&#128196;</span></div><div class="sl-stat-val">{{ $stats['today'] }}</div></div>
  <div class="sl-stat-card"><div class="sl-stat-top"><span class="sl-stat-label">Perlu diproses</span><span class="sl-stat-icon">&#8987;</span></div><div class="sl-stat-val">{{ $stats['pending'] }}</div></div>
  <div class="sl-stat-card"><div class="sl-stat-top"><span class="sl-stat-label">Pendapatan dibayar</span><span class="sl-stat-icon">&#128181;</span></div><div class="sl-stat-val">Rp {{ number_format($stats['revenue'],0,',','.') }}</div></div>
  <div class="sl-stat-card"><div class="sl-stat-top"><span class="sl-stat-label">Jumlah menu</span><span class="sl-stat-icon">&#127860;</span></div><div class="sl-stat-val">{{ $stats['menus'] }}</div></div>
 </div>
 <div class="sl-section-head"><h2 class="sl-section-title">Pesanan terbaru</h2><a href="{{ route('seller.orders.index') }}">Lihat semua &rarr;</a></div>
 @forelse($orders as $order)<div class="sl-order-row"><div><div style="font-size:14px;font-weight:800;color:#111827;">#{{ $order->order_number }} · {{ $order->user->name ?? 'Pembeli' }} <span class="sl-status-chip">{{ ucfirst($order->status) }}</span></div><div style="font-size:11.5px;color:#6b7280;margin-top:3px;">{{ $order->created_at->format('d M Y, H:i') }}</div><div style="font-size:12.5px;color:#374151;margin-top:6px;">@foreach($order->items as $item){{ $item->menu_name ?? $item->menu?->name ?? 'Menu dihapus' }} ×{{ $item->quantity }}@if(!$loop->last), @endif @endforeach</div><div style="font-weight:800;color:#ea580c;margin-top:4px;">Rp {{ number_format($order->total,0,',','.') }}</div></div><a class="sl-action-orange" href="{{ route('seller.orders.show',$order) }}">Detail</a></div>@empty<div class="sl-order-row"><div><strong>Belum ada pesanan</strong><p style="color:#6b7280;margin-bottom:0;">Pesanan pembeli akan muncul di sini.</p></div></div>@endforelse
</div>
@endsection