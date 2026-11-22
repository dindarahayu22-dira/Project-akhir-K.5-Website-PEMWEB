
@extends('layouts.buyer')

@section('title', 'Riwayat Pesanan · KantinGo')

@push('styles')
<style>
    .rw-top-bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        max-width: 980px;
        margin-bottom: 20px;
    }

    .rw-title {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 4px;
        letter-spacing: -0.02em;
    }

    .rw-subtitle {
        font-size: 13.5px;
        color: #6b7280;
        margin: 0;
    }

    .rw-filter-pills {
        display: inline-flex;
        align-items: center;
        background: #eef2f7;
        padding: 4px;
        border-radius: 999px;
        gap: 2px;
        flex-wrap: wrap;
    }

    .rw-filter-btn {
        border: none;
        background: transparent;
        color: #4b5563;
        font-size: 12px;
        font-weight: 700;
        padding: 7px 14px;
        border-radius: 999px;
        cursor: pointer;
        text-decoration: none;
    }

    .rw-filter-btn.is-active {
        background: #ff6a00;
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(255, 106, 0, 0.22);
    }

    .rw-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        padding: 18px 20px;
        margin-bottom: 14px;
        max-width: 980px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
    }

    .rw-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
    }

    .rw-card-left {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        min-width: 0;
    }

    .rw-brand-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .rw-brand-icon.filkom {
        background: #ffedd5;
        color: #ea580c;
    }

    .rw-brand-icon.feb,
    .rw-brand-icon.ft {
        background: #dcfce7;
        color: #15803d;
    }

    .rw-stand-pill {
        background: #f1f5f9;
        color: #475569;
        font-size: 10.5px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 6px;
        margin-left: 6px;
    }

    .rw-status-pill {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .rw-status-pill.processing {
        background: #ffedd5;
        color: #ea580c;
    }

    .rw-status-pill.completed {
        background: #dcfce7;
        color: #15803d;
    }

    .rw-status-pill.waiting {
        background: #f1f5f9;
        color: #475569;
    }

    .rw-status-pill.cancelled {
        background: #fee2e2;
        color: #b91c1c;
    }

    .rw-price-main {
        font-size: 18px;
        font-weight: 800;
        color: #b45309;
        text-align: right;
    }

    .rw-progress-box {
        background: #f4f6fb;
        border-radius: 14px;
        padding: 14px 16px;
        margin: 14px 0;
    }

    .rw-progress-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        font-size: 11.5px;
        margin-bottom: 14px;
        flex-wrap: wrap;
    }

    .rw-stepper {
        position: relative;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 8px;
        align-items: center;
        text-align: center;
    }

    .rw-stepper::before {
        content: "";
        position: absolute;
        top: 14px;
        left: 12.5%;
        right: 12.5%;
        height: 3px;
        background: #dbe2ee;
        z-index: 0;
    }

    .rw-stepper-fill {
        position: absolute;
        top: 14px;
        left: 12.5%;
        width: var(--progress-width, 0%);
        height: 3px;
        background: #ff6a00;
        z-index: 1;
        transition: width 0.3s ease;
    }

    .rw-step-node {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }

    .rw-step-circle {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
    }

    .rw-step-circle.is-done,
    .rw-step-circle.is-current {
        background: #ff6a00;
        color: #ffffff;
    }

    .rw-step-circle.is-pending {
        background: #dde3ee;
        color: #94a3b8;
    }

    .rw-step-label {
        font-size: 11px;
        font-weight: 700;
        color: #111827;
    }

    .rw-step-label.muted {
        color: #6b7280;
        font-weight: 600;
    }

    .rw-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding-top: 10px;
        border-top: 1px solid #f1f5f9;
        flex-wrap: wrap;
    }

    .rw-btn-outline {
        display: inline-block;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #374151;
        font-size: 11.5px;
        font-weight: 700;
        padding: 7px 12px;
        border-radius: 9px;
        text-decoration: none;
        cursor: pointer;
    }

    .rw-btn-outline:hover {
        background: #e2e8f0;
    }

    .rw-btn-orange {
        display: inline-block;
        background: #ff6a00;
        border: none;
        color: #ffffff;
        font-size: 11.5px;
        font-weight: 700;
        padding: 7px 14px;
        border-radius: 9px;
        text-decoration: none;
        cursor: pointer;
    }

    .rw-btn-orange:hover {
        background: #ea580c;
        color: #ffffff;
    }

    .rw-stars {
        color: #f59e0b;
        font-size: 13px;
        letter-spacing: 1px;
    }

    .rw-help-banner {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        max-width: 980px;
        margin-top: 16px;
        flex-wrap: wrap;
    }

    .rw-pickup-info {
        display: flex;
        flex-wrap: wrap;
        gap: 10px 18px;
        margin: 12px 0;
        padding: 12px 14px;
        background: #fff7ed;
        border-radius: 12px;
        font-size: 12px;
        color: #374151;
    }

    .rw-pickup-info strong {
        color: #9a3412;
    }

    .rw-card-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 8px;
    }

    .rw-card-actions form {
        margin: 0;
    }

    @media (max-width: 720px) {
        .rw-card-header {
            flex-direction: column;
        }

        .rw-price-main {
            text-align: left;
        }
    }

    @media (max-width: 520px) {
        .rw-title {
            font-size: 23px;
        }

        .rw-card {
            padding: 15px;
        }

        .rw-step-label {
            font-size: 9px;
        }

        .rw-stepper {
            gap: 3px;
        }

        .rw-card-actions {
            justify-content: flex-start;
        }
    }
</style>
@endpush

@section('content')

<div class="rw-top-bar">
    <div>
        <h1 class="rw-title">Riwayat Pesanan</h1>
        <p class="rw-subtitle">
            Pantau status pesanan dan ulas pesanan yang sudah selesai.
        </p>
    </div>

    <div class="rw-filter-pills">
        <a href="{{ request()->fullUrlWithQuery(['tab' => 'all']) }}"
           class="rw-filter-btn {{ $tab === 'all' ? 'is-active' : '' }}">
            Semua
        </a>

        <a href="{{ request()->fullUrlWithQuery(['tab' => 'processing']) }}"
           class="rw-filter-btn {{ $tab === 'processing' ? 'is-active' : '' }}">
            Diproses
        </a>

        <a href="{{ request()->fullUrlWithQuery(['tab' => 'completed']) }}"
           class="rw-filter-btn {{ $tab === 'completed' ? 'is-active' : '' }}">
            Selesai
        </a>
    </div>
</div>

@if(session('status'))
    <div class="rw-card">
        {{ session('status') }}
    </div>
@endif

@if(($orders ?? collect())->isEmpty())

    <div class="rw-card" style="text-align:center;padding:44px 20px;">
        <h3>Belum ada riwayat pesanan</h3>

        <p style="color:#6b7280;">
            Pesanan yang kamu buat akan muncul di sini.
        </p>

        <a href="{{ route('buyer.menu.index') }}" class="rw-btn-orange">
            Cari menu
        </a>
    </div>

@else

    @foreach($orders as $order)

        @php
            $steps = [
                'Dibuat',
                'Diproses',
                'Siap diambil',
                'Selesai',
            ];

            $stepIndex = match($order->status) {
                'new' => 0,
                'processing' => 1,
                'ready' => 2,
                'completed' => 3,
                default => -1,
            };

            $statusLabels = [
                'new' => 'Menunggu',
                'processing' => 'Diproses',
                'ready' => 'Siap diambil',
                'completed' => 'Selesai',
                'cancelled' => 'Dibatalkan',
            ];

            $statusLabel = $statusLabels[$order->status]
                ?? ucfirst($order->status);

            $statusClass = match($order->status) {
                'completed' => 'completed',
                'processing', 'ready' => 'processing',
                'cancelled' => 'cancelled',
                default => 'waiting',
            };
        @endphp

        <div class="rw-card" data-status="{{ $order->status }}">

            <div class="rw-card-header">

                <div class="rw-card-left">
                    <div class="rw-brand-icon filkom">
                        &#127860;
                    </div>

                    <div>
                        <strong style="font-size:15px;font-weight:800;color:#111827;">
                            {{ $order->tenant->name ?? 'Kantin' }}
                        </strong>

                        <div style="font-size:12px;color:#6b7280;margin-top:4px;">
                            #{{ $order->order_number }}
                            ·
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </div>

                        <div style="font-size:12.5px;color:#374151;margin-top:5px;">
                            @forelse($order->items as $item)
                                {{ $item->menu_name ?? $item->menu?->name ?? 'Menu dihapus' }}
                                ×{{ $item->quantity }}@if(!$loop->last), @endif
                            @empty
                                Tidak ada detail menu.
                            @endforelse
                        </div>
                    </div>
                </div>

                <div style="text-align:right;">
                    <span class="rw-status-pill {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>

                    <div class="rw-price-main" style="margin-top:6px;">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </div>

                    <div style="font-size:11px;color:#6b7280;">
                        Pembayaran:
                        {{ ucfirst($order->payment->status ?? 'pending') }}
                    </div>
                </div>

            </div>

            @if($stepIndex >= 0)
                <div class="rw-progress-box">

                    <div class="rw-progress-top">
                        <strong style="color:#111827;">
                            Progres Pesanan
                        </strong>

                        <span style="color:#6b7280;">
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div class="rw-stepper">

                        <div
                            class="rw-stepper-fill"
                            style="--progress-width: {{ $stepIndex * 25 }}%;"
                        ></div>

                        @foreach($steps as $index => $step)
                            <div class="rw-step-node">

                                <div class="rw-step-circle {{ $index < $stepIndex ? 'is-done' : ($index === $stepIndex ? 'is-current' : 'is-pending') }}">
                                    @if($index < $stepIndex)
                                        &#10003;
                                    @else
                                        {{ $index + 1 }}
                                    @endif
                                </div>

                                <span class="rw-step-label {{ $index > $stepIndex ? 'muted' : '' }}">
                                    {{ $step }}
                                </span>

                            </div>
                        @endforeach

                    </div>
                </div>
            @endif

            {{-- Informasi pengambilan --}}
            @if($order->pickup_time || $order->pickup_code)
                <div class="rw-pickup-info">

                    @if($order->pickup_time)
                        <div>
                            <strong>Waktu pengambilan:</strong>
                            {{ $order->pickup_time }}
                        </div>
                    @endif

                    @if($order->pickup_code)
                        <div>
                            <strong>Kode pengambilan:</strong>
                            {{ $order->pickup_code }}
                        </div>
                    @endif

                </div>
            @endif

            <div class="rw-card-footer">

                <div style="font-size:11.5px;color:#6b7280;">
                    <strong style="color:#374151;">
                        {{ $order->items->count() }} jenis menu
                    </strong>
                    · Total pesanan
                </div>

                <div class="rw-card-actions">

                    {{-- Pembayaran yang belum diselesaikan --}}
                    @if($order->status === 'new' && ($order->payment?->status === 'pending'))

                        <a class="rw-btn-orange"
                           href="{{ route('buyer.payment.show', $order) }}">
                            Lanjutkan pembayaran
                        </a>

                        <form method="POST"
                              action="{{ route('buyer.payment.cancel', $order) }}"
                              onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                            @csrf

                            <button class="rw-btn-outline" type="submit">
                                Batalkan
                            </button>
                        </form>

                    @endif

                    {{-- Ulasan pesanan yang sudah selesai --}}
                    @if($order->status === 'completed' && !$order->review)

                        <a class="rw-btn-orange"
                           href="{{ route('buyer.reviews.create', $order) }}">
                            Beri Ulasan
                        </a>

                    @elseif($order->status === 'completed' && $order->review)

                        <span class="rw-stars" aria-label="Sudah memberikan ulasan">
                            &#9733;&#9733;&#9733;&#9733;&#9733;
                        </span>

                        <span style="font-size:11px;color:#15803d;font-weight:700;">
                            Sudah diulas
                        </span>

                    @endif

                </div>
            </div>

        </div>

    @endforeach

@endif

<div class="rw-help-banner">
    <div>
        <strong style="font-size:14px;color:#111827;">
            Butuh bantuan dengan pesananmu?
        </strong>

        <p style="font-size:12px;color:#6b7280;margin:5px 0 0;">
            Jika ada kendala pada pesanan, silakan hubungi pihak kantin.
        </p>
    </div>

    <span style="font-size:22px;">&#128222;</span>
</div>

@endsection