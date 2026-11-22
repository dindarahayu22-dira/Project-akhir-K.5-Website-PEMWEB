@extends('layouts.buyer')

@section('title', 'Pembayaran · KantinGo')

@push('styles')
<style>
    .pay-header {
        margin-bottom: 18px;
    }

    .pay-title {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 4px;
        letter-spacing: -0.02em;
    }

    .pay-subtitle {
        font-size: 13.5px;
        color: #6b7280;
        margin: 0;
    }

    .pay-steps {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 22px;
        max-width: 980px;
    }

    .pay-step {
        background: #ff6a00;
        color: #ffffff;
        border-radius: 999px;
        padding: 10px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        font-size: 12.5px;
        font-weight: 700;
        box-shadow: 0 6px 16px rgba(255, 106, 0, 0.2);
    }

    .pay-step-left {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .pay-step-num {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.24);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
    }

    .pay-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.25fr) minmax(0, 0.78fr);
        gap: 20px;
        max-width: 980px;
        align-items: start;
    }

    .pay-method-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);
    }

    .pay-section-title {
        font-size: 18px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 10px;
    }

    .pay-section-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 12px;
    }

    .pay-method-active-card {
        background: #fff9f5;
        border: 1.5px solid #ff6a00;
        border-radius: 16px;
        padding: 18px;
        margin-bottom: 12px;
    }

    .pay-method-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
    }

    .pay-radio-dot {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 5px solid #ff6a00;
        background: #ffffff;
        display: inline-block;
    }

    .pay-radio-empty {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 2px solid #cbd5e1;
        background: #ffffff;
        display: inline-block;
    }

    .pay-va-box {
        background: #eef2ff;
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 12px;
    }

    .pay-va-number-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin: 8px 0;
        flex-wrap: wrap;
    }

    .pay-va-num {
        font-size: 24px;
        font-weight: 800;
        color: #9a3412;
        letter-spacing: 0.03em;
    }

    .pay-copy-btn {
        background: #ffffff;
        border: 1px solid #fed7aa;
        color: #ea580c;
        font-size: 11.5px;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 8px;
        cursor: pointer;
    }

    .pay-deadline-box {
        background: #fee2e2;
        color: #b91c1c;
        border-radius: 10px;
        padding: 9px 12px;
        font-size: 12px;
        font-weight: 700;
    }

    .pay-method-row {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 14px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
        cursor: pointer;
    }

    .pay-pickup-box {
        background: #f4f6fb;
        border: 1px solid #e6ebf5;
        border-radius: 14px;
        padding: 14px 16px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .pay-summary-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);
        margin-bottom: 14px;
    }

    .pay-waiting-pill {
        background: #ffedd5;
        color: #ea580c;
        font-size: 10.5px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
    }

    .pay-item-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 12px;
    }

    .pay-qty-box {
        background: #ffedd5;
        color: #ea580c;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 7px;
        border-radius: 6px;
        flex-shrink: 0;
    }

    .pay-totals-box {
        background: #f4f6fb;
        border-radius: 12px;
        padding: 12px 14px;
        margin: 14px 0 16px;
    }

    .pay-submit-btn {
        display: block;
        width: 100%;
        box-sizing: border-box;
        background: #ff6a00;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 13px 16px;
        font-size: 13.5px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        box-shadow: 0 8px 18px rgba(255, 106, 0, 0.24);
    }

    .pay-submit-btn:hover {
        background: #ea580c;
    }

    .pay-cancel-link {
        display: block;
        width: 100%;
        box-sizing: border-box;
        text-align: center;
        margin-top: 10px;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-decoration: none;
    }

    .pay-help-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 14px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        font-size: 12px;
    }

    @media (max-width: 900px) {
        .pay-steps,
        .pay-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
@php
    $tenant = $order?->tenant;
    $canteenName = $tenant?->name ?? 'Nama Kantin';
@endphp

<div class="pay-header">
    <h1 class="pay-title">Pembayaran</h1>
    <p class="pay-subtitle">
        Konfirmasi pembayaran untuk meneruskan pesanan ke kantin.
    </p>
</div>

@if(!$order || !$payment)
    <div class="pay-summary-card">
        <h3>Tidak ada pembayaran aktif</h3>
        <p>
            Silakan buat pesanan dari menu yang tersedia terlebih dahulu.
        </p>
        <a href="{{ route('buyer.menu.index') }}" class="pay-submit-btn">
            Cari menu
        </a>
    </div>
@else
    <div class="pay-grid">
        <div>
            <div class="pay-method-card">
                <h2 class="pay-section-title">Pilih metode pembayaran</h2>

                <p style="color:#6b7280;font-size:12px;">
                    Ini adalah simulasi pembayaran untuk proyek praktikum.
                    Tidak ada uang sungguhan yang ditarik.
                </p>

                <form method="POST" action="{{ route('buyer.payment.pay', $order) }}">
                    @csrf

                    <label
                        for="method"
                        style="display:block;margin:14px 0 6px;font-weight:700;"
                    >
                        Metode
                    </label>

                    <select
                        id="method"
                        name="method"
                        required
                        style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:10px;background:#fff;"
                    >
                        <option value="bank_transfer">
                            Transfer Bank (simulasi)
                        </option>
                        <option value="ewallet">
                            E-Wallet (simulasi)
                        </option>
                        <option value="virtual_account">
                            Virtual Account (simulasi)
                        </option>
                        <option value="cash">
                            Bayar di Kantin
                        </option>
                    </select>

                    <div class="pay-pickup-box" style="margin-top:16px;">
                        <div>
                            <strong>{{ $canteenName }}</strong>

                            <div style="font-size:12px;color:#6b7280;margin-top:4px;">
                                Waktu ambil: {{ $pickupTime ?? '-' }}
                                · Kode ambil: {{ $order->pickup_code ?? '-' }}
                            </div>

                            @if(!empty($notesText))
                                <div style="font-size:12px;margin-top:4px;">
                                    Catatan: {{ $notesText }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="pay-submit-btn"
                        style="margin-top:16px;"
                    >
                        Konfirmasi pembayaran simulasi
                    </button>
                </form>

                <form
                    method="POST"
                    action="{{ route('buyer.payment.cancel', $order) }}"
                    style="margin-top:10px;"
                >
                    @csrf

                    <button
                        type="submit"
                        class="pay-cancel-link"
                        style="border:0;background:transparent;cursor:pointer;"
                    >
                        Batalkan pesanan
                    </button>
                </form>
            </div>
        </div>

        <div>
            <div class="pay-summary-card">
                <div class="pay-section-top">
                    <strong>Ringkasan pesanan</strong>

                    <span class="pay-waiting-pill">
                        {{ ucfirst($payment->status ?? 'menunggu') }}
                    </span>
                </div>

                <div style="font-size:12px;font-weight:700;color:#374151;margin:12px 0;">
                    {{ $canteenName }} · #{{ $order->order_number ?? $order->id }}
                </div>

                @forelse($items ?? [] as $item)
                    <div class="pay-item-row">
                        <div>
                            <span class="pay-qty-box">
                                {{ $item['quantity'] ?? 0 }}x
                            </span>

                            <strong>{{ $item['name'] ?? 'Menu' }}</strong>
                        </div>

                        <strong>
                            Rp {{ number_format((float) ($item['subtotal'] ?? 0), 0, ',', '.') }}
                        </strong>
                    </div>
                @empty
                    <p style="font-size:13px;color:#6b7280;">
                        Tidak ada rincian item pesanan.
                    </p>
                @endforelse

                <div class="pay-totals-box">
                    <div style="display:flex;justify-content:space-between;border-top:1px solid #e5e7eb;padding-top:12px;font-weight:800;gap:12px;">
                        <span>Total pembayaran</span>

                        <span>
                            Rp {{ number_format((float) ($totalBayar ?? 0), 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
