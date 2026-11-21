@extends('layouts.seller')

@section('title', 'Detail Pesanan · KantinGo')

@push('styles')
<style>
    .od-wrap {
        max-width: 1020px;
        width: 100%;
    }

    .od-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .od-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.38fr) minmax(0, 0.72fr);
        gap: 18px;
        align-items: start;
    }

    .od-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        padding: 18px 20px;
        margin-bottom: 14px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    }

    .od-item-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .od-item-row:last-of-type {
        border-bottom: none;
    }

    .od-note-box {
        background: #f4f6fb;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 12.5px;
        font-style: italic;
        color: #374151;
    }

    .od-stepper {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 8px;
        text-align: center;
        margin: 16px 0 18px;
    }

    .od-step-dot {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        margin: 0 auto 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
    }

    .od-step-dot.done {
        background: #ff6a00;
        color: #ffffff;
    }

    .od-step-dot.active {
        background: #ffedd5;
        border: 2px solid #ff6a00;
        color: #ea580c;
    }

    .od-step-dot.idle {
        background: #f1f5f9;
        color: #94a3b8;
    }

    @media (max-width: 900px) {
        .od-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div style="max-width:900px;"><a href="{{ route('seller.orders.index') }}" style="color:#ea580c;">← Kembali ke pesanan</a><h1 style="font-size:28px;font-weight:800;margin:14px 0;">Detail Pesanan #{{ $order->order_number }}</h1><div style="background:#fff;border:1px solid #eef0f4;border-radius:16px;padding:20px;margin-bottom:16px;"><p><strong>Pembeli:</strong> {{ $order->user->name ?? '-' }}</p><p><strong>Kantin:</strong> {{ $order->tenant->name ?? '-' }}</p><p><strong>Status:</strong> {{ ucfirst($order->status) }}</p><p><strong>Waktu ambil:</strong> {{ $order->pickup_time ?? '-' }}</p><p><strong>Kode ambil:</strong> {{ $order->pickup_code ?? '-' }}</p><p><strong>Catatan:</strong> {{ $order->note ?: 'Tidak ada catatan' }}</p><hr>@foreach($order->items as $item)<div style="display:flex;justify-content:space-between;padding:10px 0;"><span>{{ $item->menu_name ?? $item->menu?->name ?? 'Menu dihapus' }} ×{{ $item->quantity }}</span><strong>Rp {{ number_format($item->price*$item->quantity,0,',','.') }}</strong></div>@endforeach<hr><h3>Total Rp {{ number_format($order->total,0,',','.') }}</h3><p>Pembayaran: {{ ucfirst($order->payment->status ?? 'pending') }}</p>
@if($order->status==='new')<form method="POST" action="{{ route('seller.orders.update',$order) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="processing"><button class="po-btn-orange">Terima & proses</button></form>@elseif($order->status==='processing')<form method="POST" action="{{ route('seller.orders.update',$order) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="ready"><button class="po-btn-orange">Tandai siap diambil</button></form>@elseif($order->status==='ready')<form method="POST" action="{{ route('seller.orders.update',$order) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="completed"><button class="po-btn-orange">Selesaikan pesanan</button></form>@endif
</div></div>
@endsection
@endsection