@extends('layouts.seller')

@section('title', 'Notifikasi Penjual · KantinGo')

@push('styles')
<style>
    .sn-wrap {
        max-width: 960px;
        width: 100%;
    }

    .sn-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .sn-card {
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
        cursor: pointer;
    }

    .sn-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 14px;
        font-weight: 800;
    }

    .sn-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #ff6a00;
        display: inline-block;
    }

    .sn-card.is-read .sn-dot {
        display: none;
    }
</style>
@endpush

@section('content')
<div style="max-width:980px;"><h1 style="font-size:28px;font-weight:800;margin:0 0 6px;">Notifikasi</h1><p style="color:#6b7280;margin-bottom:20px;">Pembaruan pesanan dan aktivitas kantin Anda.</p>
@forelse(($notifications ?? collect()) as $notification)<div style="background:#fff;border:1px solid #eef0f4;border-radius:14px;padding:16px 18px;margin-bottom:10px;"><strong>{{ $notification->title }}</strong><p style="margin:6px 0;color:#4b5563;">{{ $notification->message }}</p><small style="color:#9ca3af;">{{ $notification->created_at->format('d M Y, H:i') }}</small></div>@empty<div style="background:#fff;border:1px solid #eef0f4;border-radius:14px;padding:36px;text-align:center;"><strong>Belum ada notifikasi</strong><p style="color:#6b7280;margin-bottom:0;">Notifikasi pesanan akan muncul di sini.</p></div>@endforelse</div>
@endsection