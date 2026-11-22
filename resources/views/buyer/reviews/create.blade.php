@extends('layouts.buyer')

@section('title', 'Beri Ulasan · KantinGo')

@push('styles')
<style>
    .rev-page-wrap {
        max-width: 980px !important;
        width: 100% !important;
    }

    .rev-breadcrumb {
        font-size: 11.5px !important;
        color: #6b7280 !important;
        margin-bottom: 8px !important;
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
        flex-wrap: wrap !important;
    }

    .rev-breadcrumb a {
        color: #6b7280 !important;
        text-decoration: none !important;
    }

    .rev-top-row {
        display: flex !important;
        align-items: flex-start !important;
        justify-content: space-between !important;
        gap: 14px !important;
        margin-bottom: 18px !important;
        flex-wrap: wrap !important;
    }

    .rev-title {
        font-size: 28px !important;
        font-weight: 800 !important;
        color: #111827 !important;
        margin: 0 0 4px !important;
        letter-spacing: -0.02em !important;
        line-height: 1.15 !important;
    }

    .rev-subtitle {
        font-size: 13px !important;
        color: #6b7280 !important;
        margin: 0 !important;
    }

    .rev-koin-pill {
        background: #eef4ff !important;
        color: #1d4ed8 !important;
        border: 1px solid #dbeafe !important;
        border-radius: 999px !important;
        padding: 7px 14px !important;
        font-size: 11.5px !important;
        font-weight: 700 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
    }

    .rev-grid {
        display: grid !important;
        grid-template-columns: minmax(0, 1.38fr) minmax(0, 0.72fr) !important;
        gap: 18px !important;
        align-items: start !important;
    }

    .rev-main-card {
        position: relative !important;
        overflow: hidden !important;
        background: #ffffff !important;
        border: 1px solid #eef0f4 !important;
        border-radius: 18px !important;
        padding: 20px !important;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04) !important;
    }

    .rev-main-card::before {
        content: "" !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        height: 4px !important;
        background: linear-gradient(90deg, #ff6a00 0%, #f59e0b 55%, #22c55e 100%) !important;
    }

    .rev-order-banner {
        background: #f4f6fb !important;
        border-radius: 14px !important;
        padding: 12px 14px !important;
        display: flex !important;
        align-items: flex-start !important;
        justify-content: space-between !important;
        gap: 12px !important;
        margin-bottom: 18px !important;
    }

    .rev-food-img {
        width: 52px !important;
        height: 52px !important;
        border-radius: 12px !important;
        object-fit: cover !important;
        flex-shrink: 0 !important;
        border: 1px solid #e5e7eb !important;
        background: #dcfce7 !important;
    }

    .rev-side-img {
        width: 42px !important;
        height: 42px !important;
        border-radius: 10px !important;
        object-fit: cover !important;
        flex-shrink: 0 !important;
        border: 1px solid #e5e7eb !important;
        background: #ffedd5 !important;
    }

    .rev-done-badge {
        background: #dcfce7 !important;
        color: #15803d !important;
        font-size: 10.5px !important;
        font-weight: 700 !important;
        padding: 2px 8px !important;
        border-radius: 999px !important;
        margin-left: 6px !important;
    }

    .rev-rating-head {
        display: flex !important;
        align-items: baseline !important;
        justify-content: space-between !important;
        gap: 10px !important;
        margin-bottom: 4px !important;
        flex-wrap: wrap !important;
    }

    .rev-stars-box {
        display: grid !important;
        grid-template-columns: repeat(5, minmax(0, 1fr)) !important;
        gap: 10px !important;
        margin: 14px 0 !important;
    }

    .rev-star-btn {
        height: 56px !important;
        border-radius: 15px !important;
        border: 1px solid #e5e7eb !important;
        background: #f3f5f9 !important;
        color: #cbd5e1 !important;
        font-size: 21px !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.15s ease !important;
    }

    .rev-star-btn.is-active {
        background: #f9dec9 !important;
        border-color: #f3c6a5 !important;
        color: #b45309 !important;
    }

    .rev-chips-row {
        display: flex !important;
        align-items: center !important;
        gap: 7px !important;
        flex-wrap: wrap !important;
        margin-bottom: 18px !important;
    }

    .rev-chip-btn {
        background: #f1f5f9 !important;
        border: 1px solid #e6ebf2 !important;
        color: #374151 !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        padding: 5px 10px !important;
        border-radius: 999px !important;
        cursor: pointer !important;
    }

    .rev-chip-btn.is-selected {
        background: #eef2f7 !important;
        border-color: #cbd5e1 !important;
        color: #111827 !important;
        font-weight: 700 !important;
    }

    .rev-textarea-wrap {
        position: relative !important;
    }

    .rev-textarea {
        width: 100% !important;
        min-height: 112px !important;
        background: #f4f6fb !important;
        border: 1px solid #e6ebf5 !important;
        border-radius: 14px !important;
        padding: 12px 40px 28px 14px !important;
        font-size: 12.5px !important;
        color: #111827 !important;
        resize: vertical !important;
        outline: none !important;
        box-sizing: border-box !important;
    }

    .rev-textarea:focus {
        border-color: #ff6a00 !important;
        background: #ffffff !important;
    }

    .rev-photo-icon-btn {
        position: absolute !important;
        right: 12px !important;
        bottom: 10px !important;
        border: none !important;
        background: transparent !important;
        cursor: pointer !important;
        padding: 2px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .rev-actions-row {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
        gap: 12px !important;
        margin-top: 14px !important;
    }

    .rev-cancel-btn {
        background: transparent !important;
        border: none !important;
        color: #6b7280 !important;
        font-size: 12.5px !important;
        font-weight: 700 !important;
        padding: 9px 12px !important;
        text-decoration: none !important;
        cursor: pointer !important;
    }

    .rev-submit-btn {
        background: #ff6a00 !important;
        border: none !important;
        color: #ffffff !important;
        font-size: 12.5px !important;
        font-weight: 700 !important;
        padding: 10px 20px !important;
        border-radius: 12px !important;
        cursor: pointer !important;
        box-shadow: 0 8px 18px rgba(255, 106, 0, 0.25) !important;
    }

    .rev-submit-btn:hover {
        background: #ea580c !important;
    }

    .rev-privacy-note {
        background: #f4f6fb !important;
        border: 1px solid #e6ebf5 !important;
        border-radius: 14px !important;
        padding: 12px 16px !important;
        margin-top: 14px !important;
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
    }

    .rev-side-card {
        background: #ffffff !important;
        border: 1px solid #eef0f4 !important;
        border-radius: 16px !important;
        padding: 14px 16px !important;
        margin-bottom: 12px !important;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03) !important;
    }

    .rev-history-quote {
        background: #f4f6fb !important;
        border-radius: 10px !important;
        padding: 8px 12px !important;
        font-size: 11.5px !important;
        color: #374151 !important;
        margin-top: 8px !important;
    }

    .rev-hero-bar {
        height: 6px !important;
        border-radius: 999px !important;
        background: #e5e7eb !important;
        overflow: hidden !important;
        margin: 8px 0 6px !important;
    }

    .rev-hero-fill {
        height: 100% !important;
        width: 0%;
        background: #ff6a00 !important;
        transition: width 0.25s ease !important;
    }

    @media (max-width: 900px) {
        .rev-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush

@section('content')
@php
    $historyUrl = \Illuminate\Support\Facades\Route::has('buyer.orders.index')
        ? route('buyer.orders.index')
        : url('/riwayat');

    $storeAction = (isset($order) && \Illuminate\Support\Facades\Route::has('buyer.reviews.store'))
        ? route('buyer.reviews.store', $order)
        : url('/riwayat');

    $orderNumber = isset($order) && !empty($order->order_number) ? '#' . $order->order_number : '#' . ($order->order_number ?? $order->id);
    $canteenName = isset($order) && optional($order->tenant)->name ? $order->tenant->name : 'Kantin FEB';

    $itemsSummary = 'Jus Alpukat x2';$firstMenuImage = null;
    if (isset($order) && $order->items &&$order->items->count() > 0) {
        $itemsSummary =$order->items->map(function ($it) {$name = optional($it->menu)->name ?? ($it->name ?? 'Menu');
            $qty =$it->quantity ?? 1;
            return $name . ' x' .$qty;
        })->implode(', ');

        $firstMenu = optional($order->items->first())->menu;
        if ($firstMenu && !empty($firstMenu->image)) {
            $firstMenuImage = str_starts_with($firstMenu->image, 'http')
                ? $firstMenu->image
                : asset('storage/' . ltrim($firstMenu->image, '/'));
        }
    }

    $imgAlpukat = asset('assets/images/reviews/menu-alpukat.jpg');
    $imgSiomay = asset('assets/images/reviews/menu-siomay.jpg');$imgNasi = asset('assets/images/reviews/menu-nasi.jpg');

    $mainOrderImg = $firstMenuImage ?: $imgAlpukat;

    $currentRating = (int) old('rating', optional($review ?? null)->rating ?? 4);
    $currentRating = max(1, min(5,$currentRating));
    $currentComment = (string) old('comment', optional($review ?? null)->comment ?? 'Jusnya segar dan tidak terlalu manis. Pesanan siap tepat waktu.');

    $weeklyGoalVal = (int) ($weeklyGoal ?? 3);
    $rawWeeklyCount = (int) ($weeklyCount ?? 0);
    $weeklyCountVal = $rawWeeklyCount > 0 ?$rawWeeklyCount : 2;
    $weeklyPercent =$weeklyGoalVal > 0 ? min(100, round(($weeklyCountVal / $weeklyGoalVal) * 100)) : 66;
    $remainingReview = max(0, $weeklyGoalVal -$weeklyCountVal);

    $ratingLabels = [
        1 => '1 dari 5 Bintang (Kurang)',
        2 => '2 dari 5 Bintang (Cukup)',
        3 => '3 dari 5 Bintang (Lumayan)',
        4 => '4 dari 5 Bintang (Puas)',
        5 => '5 dari 5 Bintang (Sangat Puas)',
    ];
@endphp

<div class="rev-page-wrap">
    <div class="rev-breadcrumb">
        <a href="{{ url('/pesanan') }}">Pesanan</a>
        <span>&rsaquo;</span>
        <a href="{{ $historyUrl }}">Riwayat</a>
        <span>&rsaquo;</span>
        <strong style="color:#111827;">Beri Ulasan</strong>
    </div>

    <div class="rev-top-row">
        <div>
            <h1 class="rev-title">Beri Ulasan</h1>
            <p class="rev-subtitle">Ceritakan pengalamanmu agar pelayanan kantin kampus makin baik.</p>
        </div>

        <div class="rev-koin-pill">
            <span>&#11088;</span>
            <span>+15 Koin Poin didapatkan setelah review</span>
        </div>
    </div>

    @if (session('status'))
        <div style="background:#dcfce7;color:#15803d;padding:10px 14px;border-radius:10px;font-size:12.5px;font-weight:600;margin-bottom:14px;">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background:#fee2e2;color:#b91c1c;padding:10px 14px;border-radius:10px;font-size:12.5px;font-weight:600;margin-bottom:14px;">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="rev-grid">
        <div>
            <form action="{{ $storeAction }}" method="POST" enctype="multipart/form-data" class="rev-main-card">
                @csrf
                <input type="hidden" id="revRatingInput" name="rating" value="{{ $currentRating }}">
                <input type="file" id="revPhotoInput" name="photo" accept="image/*" style="display:none;">

                <div class="rev-order-banner">
                    <div style="display:flex;align-items:flex-start;gap:12px;">
                        <img src="{{ $mainOrderImg }}" alt="{{ $canteenName }}" class="rev-food-img">
                        <div>
                            <div style="display:flex;align-items:center;flex-wrap:wrap;">
                                <strong style="font-size:14px;font-weight:800;color:#111827;">{{ $canteenName }}</strong>
                                <span class="rev-done-badge">&#9679; Selesai</span>
                            </div>
                            <div style="font-size:11.5px;color:#374151;margin-top:2px;">
                                <strong>{{ $orderNumber }}</strong> &bull; {{$itemsSummary }} &bull;
                            </div>
                            <div style="font-size:11px;color:#6b7280;margin-top:2px;">
                                {{ isset($order) && $order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') . ' WIB' : '12 Mei 2025, 11:15 WIB' }}
                            </div>
                        </div>
                    </div>
                    <span style="color:#d97706;font-size:14px;font-weight:700;">&#9432;</span>
                </div>

                <div class="rev-rating-head">
                    <strong style="font-size:14px;font-weight:800;color:#111827;">Rating Pengalaman</strong>
                    <span id="revRatingLabel" style="font-size:12px;font-weight:700;color:#ea580c;">
                        {{ $ratingLabels[$currentRating] ?? ($currentRating . ' dari 5 Bintang') }}
                    </span>
                </div>
                <div style="font-size:12px;color:#6b7280;">Berapa tingkat kepuasan rasa makanan dan keramahan pelayanan warung?</div>

                <div class="rev-stars-box" role="group" aria-label="Rating bintang">
                    @for ($i = 1; $i <= 5; $i++)
                        <button
                            type="button"
                            class="rev-star-btn {{ $i <=$currentRating ? 'is-active' : '' }}"
                            data-star="{{ $i }}"
                            onclick="setRating({{ $i }})"
                        >{!! $i <=$currentRating ? '&#9733;' : '&#9734;' !!}</button>
                    @endfor
                </div>

                <div class="rev-chips-row">
                    <button type="button" class="rev-chip-btn is-selected" onclick="toggleChip(this, 'Rasa mantap')">&#10024; Rasa mantap</button>
                    <button type="button" class="rev-chip-btn" onclick="toggleChip(this, 'Porsi pas')">&#127836; Porsi pas</button>
                    <button type="button" class="rev-chip-btn" onclick="toggleChip(this, 'Cepat saji')">&#9889; Cepat saji</button>
                    <button type="button" class="rev-chip-btn" onclick="toggleChip(this, 'Kemasan rapi')">&#128230; Kemasan rapi</button>
                    <button type="button" class="rev-chip-btn" onclick="toggleChip(this, 'Ramah')">&#128522; Ramah</button>
                </div>

                <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:8px;">
                    <label for="revCommentArea" style="font-size:13.5px;font-weight:800;color:#111827;">Ulasan</label>
                    <span id="revCharCount" style="font-size:11.5px;color:#6b7280;">{{ mb_strlen($currentComment) }} / 300 karakter</span>
                </div>

                <div class="rev-textarea-wrap">
                    <textarea
                        id="revCommentArea"
                        name="comment"
                        maxlength="300"
                        class="rev-textarea"
                        oninput="updateRevCount()"
                    >{{ $currentComment }}</textarea>
                    <button
                        type="button"
                        class="rev-photo-icon-btn"
                        title="Lampirkan foto"
                        onclick="document.getElementById('revPhotoInput').click()"
                    >
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
        
                        <span id="revPhotoName" style="font-size:11px;color:#6b7280;margin-left:6px;"></span>
                    </button>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:20px;flex-wrap:wrap;">
                    <a href="{{ url()->previous() }}"
                       style="text-decoration:none;padding:11px 18px;border:1px solid #e5e7eb;border-radius:10px;color:#6b7280;font-size:12px;font-weight:700;">
                        Kembali
                    </a>

                    <button type="submit"
                            style="border:none;background:#ff6a00;color:#fff;padding:11px 22px;border-radius:10px;font-size:12px;font-weight:800;cursor:pointer;">
                        {{ isset($review) && $review ? 'Perbarui Ulasan' : 'Kirim Ulasan' }}
                    </button>
                </div>
            </form>
        </div>

        <div>
            <div class="rev-main-card" style="margin-bottom:16px;">
                <h3 style="font-size:15px;font-weight:800;color:#111827;margin:0 0 12px;">
                    Ulasan Saya
                </h3>

                <p style="font-size:12px;color:#6b7280;margin:0 0 14px;">
                    Terima kasih sudah berbagi pengalaman dan membantu pembeli lain.
                </p>

                <div style="display:flex;justify-content:space-between;gap:10px;padding:12px;background:#fff7ed;border-radius:12px;">
                    <div>
                        <div style="font-size:11px;color:#9ca3af;">Total ulasan</div>
                        <strong style="font-size:20px;color:#ea580c;">
                            {{ $myCount ?? 0 }}
                        </strong>
                    </div>

                    <div style="text-align:right;">
                        <div style="font-size:11px;color:#9ca3af;">Target mingguan</div>
                        <strong style="font-size:20px;color:#ea580c;">
                            {{ $weeklyCount ?? 0 }}/{{ $weeklyGoal ?? 3 }}
                        </strong>
                    </div>
                </div>
            </div>

            <div class="rev-main-card">
                <h3 style="font-size:14px;font-weight:800;color:#111827;margin:0 0 10px;">
                    Tips Memberi Ulasan
                </h3>

                <ul style="padding-left:18px;margin:0;color:#6b7280;font-size:12px;line-height:1.8;">
                    <li>Berikan rating sesuai pengalamanmu.</li>
                    <li>Pilih tag yang menggambarkan pesananmu.</li>
                    <li>Tulis ulasan dengan jelas dan sopan.</li>
                    <li>Lampirkan foto jika ingin membagikan tampilan makanan.</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function setRating(rating) {
            const ratingInput = document.getElementById('revRatingInput');
            const ratingLabel = document.getElementById('revRatingLabel');
            const stars = document.querySelectorAll('.rev-star-btn');

            ratingInput.value = rating;

            const labels = {
                1: '1 dari 5 Bintang',
                2: '2 dari 5 Bintang',
                3: '3 dari 5 Bintang',
                4: '4 dari 5 Bintang',
                5: '5 dari 5 Bintang'
            };

            ratingLabel.textContent = labels[rating];

            stars.forEach(function(star) {
                const value = Number(star.dataset.star);

                if (value <= rating) {
                    star.classList.add('is-active');
                    star.innerHTML = '&#9733;';
                } else {
                    star.classList.remove('is-active');
                    star.innerHTML = '&#9734;';
                }
            });
        }

        function toggleChip(button, tag) {
            button.classList.toggle('is-selected');
        }

        function updateRevCount() {
            const textarea = document.getElementById('revCommentArea');
            const counter = document.getElementById('revCharCount');

            counter.textContent = textarea.value.length + ' / 300 karakter';
        }

        document.getElementById('revPhotoInput').addEventListener('change', function() {
            const photoName = document.getElementById('revPhotoName');

            if (this.files.length > 0) {
                photoName.textContent = this.files[0].name;
            } else {
                photoName.textContent = '';
            }
        });

        document.querySelector('.rev-main-card form')?.addEventListener('submit', function() {
            this.querySelectorAll('input[name="tags[]"]').forEach(function(input) {
                input.remove();
            });

            this.querySelectorAll('.rev-chip-btn.is-selected').forEach(function(button) {
                const tagText = button.textContent.trim().replace(/^[^\w]+/u, '').trim();

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'tags[]';
                input.value = tagText;

                this.appendChild(input);
            }, this);
        });

        updateRevCount();
    </script>
</div>
@endsection
