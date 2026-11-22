@extends('layouts.seller')

@section('title', 'Pesanan Masuk · KantinGo')

@push('styles')
<style>
    .po-wrap {
        max-width: 1020px;
        width: 100%;
    }

    .po-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .po-tabs {
        display: inline-flex;
        background: #f1f5f9;
        padding: 4px;
        border-radius: 999px;
        gap: 4px;
    }

    .po-tab-btn {
        border: none;
        background: transparent;
        color: #4b5563;
        font-size: 11.5px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        cursor: pointer;
    }

    .po-tab-btn.is-active {
        background: #ffffff;
        color: #111827;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.06);
    }

    .po-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        padding: 18px 20px;
        margin-bottom: 12px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    }

    .po-items-strip {
        background: #f4f6fb;
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 12px;
        color: #374151;
        margin: 10px 0 12px;
    }

    .po-pill {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
    }

    .po-pill.processing {
        background: #ffedd5;
        color: #ea580c;
    }

    .po-pill.waiting {
        background: #f1f5f9;
        color: #374151;
    }

    .po-pill.done {
        background: #dcfce7;
        color: #15803d;
    }

    .po-total-val {
        font-size: 16px;
        font-weight: 800;
        color: #ea580c;
    }

    .po-total-val.is-done {
        color: #111827;
    }

    .po-btn-orange {
        background: #ff6a00;
        color: #ffffff;
        border: none;
        border-radius: 11px;
        padding: 9px 16px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
    }
</style>
@endpush

@section('content')
<div class="po-wrap">
 <div class="po-head"><div><h1 style="font-size:28px;font-weight:800;color:#111827;margin:0 0 4px;">Pesanan Masuk</h1><p style="font-size:13px;color:#6b7280;margin:0;">Pesanan yang ditujukan ke {{ $tenant->name ?? 'kantin Anda' }}.</p></div></div>
 @if(($orders ?? collect())->isEmpty())
  <div class="po-card" style="text-align:center;padding:42px 20px;"><h3 style="margin:0 0 8px;">Belum ada pesanan</h3><p style="color:#6b7280;margin:0;">Pesanan baru dari pembeli akan muncul di sini.</p></div>
 @else
  @foreach($orders as $order)
   <div class="po-card"><div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;"><a href="{{ route('seller.orders.show',$order) }}" style="font-weight:800;color:#111827;text-decoration:none;">#{{ $order->order_number }} · {{ $order->user->name ?? 'Pembeli' }}</a><span class="po-pill {{ in_array($order->status,['completed'])?'done':(in_array($order->status,['processing','ready'])?'processing':'waiting') }}">{{ ucfirst($order->status) }}</span></div>
   <div style="font-size:12px;color:#6b7280;margin-top:6px;">{{ $order->created_at?->format('d M Y, H:i') }} · Ambil {{ $order->pickup_time ?? 'belum ditentukan' }}</div>
   <div class="po-items-strip">@foreach($order->items as $item){{ $item->menu_name ?? $item->menu?->name ?? 'Menu dihapus' }} ×{{ $item->quantity }}@if(!$loop->last), @endif @endforeach</div>
   <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;"><strong style="color:#ea580c;">Rp {{ number_format($order->total,0,',','.') }}</strong>
   @if($order->status==='new')<form method="POST" action="{{ route('seller.orders.update',$order) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="processing"><button class="po-btn-orange">Terima & proses</button></form>
   @elseif($order->status==='processing')<form method="POST" action="{{ route('seller.orders.update',$order) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="ready"><button class="po-btn-orange">Tandai siap diambil</button></form>
   @elseif($order->status==='ready')<form method="POST" action="{{ route('seller.orders.update',$order) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="completed"><button class="po-btn-orange">Selesaikan pesanan</button></form>@endif
   </div></div>
  @endforeach
 @endif
</div>
@endsection