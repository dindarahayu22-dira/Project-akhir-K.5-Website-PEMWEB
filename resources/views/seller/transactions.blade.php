@extends('layouts.seller')

@section('title', 'Riwayat Transaksi · KantinGo')

@push('styles')
<style>
    .tx-wrap {
        max-width: 1020px;
        width: 100%;
    }

    .tx-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .tx-kpi-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 18px;
    }

    .tx-kpi-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        padding: 16px 18px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    }

    .tx-table-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        padding: 16px 18px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    }

    .tx-filter-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
        flex-wrap: wrap;
    }

    .tx-filter-pills {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .tx-pill-btn {
        border: none;
        background: transparent;
        color: #6b7280;
        font-size: 11.5px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        cursor: pointer;
    }

    .tx-pill-btn.is-active {
        background: #ffedd5;
        color: #ea580c;
    }

    .tx-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12.5px;
    }

    .tx-table th {
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: #9ca3af;
        padding: 10px 8px;
        border-bottom: 1px solid #f1f5f9;
    }

    .tx-table td {
        padding: 12px 8px;
        border-bottom: 1px solid #f8fafc;
        color: #111827;
        vertical-align: middle;
    }

    .tx-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #ffedd5;
        color: #ea580c;
        font-size: 10.5px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 8px;
    }

    .tx-st {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
        display: inline-block;
        background: #f1f5f9;
        color: #475569;
    }

    .tx-st.done {
        background: #dcfce7;
        color: #15803d;
    }

    .tx-st.processing {
        background: #ffedd5;
        color: #ea580c;
    }

    .tx-st.cancelled {
        background: #fee2e2;
        color: #dc2626;
    }

    @media (max-width: 900px) {
        .tx-kpi-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div style="max-width:1020px;"><h1 style="font-size:28px;font-weight:800;margin:0 0 6px;">Riwayat Transaksi</h1><p style="color:#6b7280;margin-bottom:20px;">Transaksi dari pesanan di kantin Anda.</p>
<div style="background:#fff;border:1px solid #eef0f4;border-radius:16px;overflow:auto;"><table style="width:100%;border-collapse:collapse;min-width:620px;"><thead><tr style="text-align:left;background:#f8fafc;"><th style="padding:14px;">Pesanan</th><th style="padding:14px;">Pembeli</th><th style="padding:14px;">Tanggal</th><th style="padding:14px;">Pembayaran</th><th style="padding:14px;">Total</th></tr></thead><tbody>
@forelse(($orders ?? collect()) as $order)<tr style="border-top:1px solid #eef0f4;"><td style="padding:14px;">#{{ $order->order_number }}</td><td style="padding:14px;">{{ $order->user->name ?? 'Pembeli' }}</td><td style="padding:14px;">{{ $order->created_at->format('d M Y') }}</td><td style="padding:14px;">{{ ucfirst($order->payment->status ?? 'pending') }}</td><td style="padding:14px;font-weight:700;">Rp {{ number_format($order->total,0,',','.') }}</td></tr>@empty<tr><td colspan="5" style="padding:30px;text-align:center;color:#6b7280;">Belum ada transaksi.</td></tr>@endforelse
</tbody></table></div></div>
@endsection