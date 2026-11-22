<?php $__env->startSection('title', 'Buat Pesanan · KantinGo'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .figma-co-header {
        margin-bottom: 18px;
    }

    .figma-co-title {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 4px;
        letter-spacing: -0.02em;
    }

    .figma-co-subtitle {
        font-size: 13.5px;
        color: #6b7280;
        margin: 0;
    }

    .figma-co-steps {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 22px;
        max-width: 980px;
    }

    .figma-co-step {
        border-radius: 999px;
        padding: 10px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        font-size: 12.5px;
        font-weight: 700;
    }

    .figma-co-step.is-done,
    .figma-co-step.is-active {
        background: #ff6a00;
        color: #ffffff;
        box-shadow: 0 6px 16px rgba(255, 106, 0, 0.22);
    }

    .figma-co-step.is-locked {
        background: #e9eef7;
        color: #9ca3af;
    }

    .figma-co-step-left {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .figma-co-step-num {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
        background: rgba(255, 255, 255, 0.22);
        color: #ffffff;
    }

    .figma-co-step.is-locked .figma-co-step-num {
        background: #dbe2ee;
        color: #9ca3af;
    }

    .figma-co-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.25fr) minmax(0, 0.78fr);
        gap: 20px;
        max-width: 980px;
        align-items: start;
    }

    .figma-co-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 18px 20px;
        margin-bottom: 16px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
    }

    .figma-co-card-heading {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13.5px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 12px;
    }

    .figma-canteen-box {
        background: #f4f6fb;
        border: 1px solid #e6ebf5;
        border-radius: 12px;
        padding: 12px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .figma-canteen-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #ffedd5;
        color: #ea580c;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .figma-dist-pill {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 4px 8px;
        font-size: 11px;
        font-weight: 700;
        color: #374151;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .figma-time-select-wrap {
        position: relative;
        background: #f4f6fb;
        border: 1px solid #e6ebf5;
        border-radius: 12px;
        padding: 10px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .figma-time-select {
        width: 100%;
        min-width: 0;
        border: none;
        background: transparent;
        font-size: 13px;
        font-weight: 600;
        color: #111827;
        outline: none;
        cursor: pointer;
    }

    .figma-time-tag {
        background: #dcfce7;
        color: #15803d;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 9px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .figma-co-helper {
        font-size: 11.5px;
        color: #6b7280;
        margin: 8px 0 0;
    }

    .figma-notes-textarea {
        width: 100%;
        min-height: 92px;
        background: #f4f6fb;
        border: 1px solid #e6ebf5;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 13px;
        color: #111827;
        resize: vertical;
        outline: none;
        box-sizing: border-box;
    }

    .figma-notes-textarea:focus {
        border-color: #ff6a00;
        background: #ffffff;
    }

    .figma-notes-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-top: 8px;
        font-size: 11px;
        color: #6b7280;
    }

    .figma-summary-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);
    }

    .figma-summary-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 14px;
    }

    .figma-menu-count-pill {
        background: #ffedd5;
        color: #ea580c;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
    }

    .figma-summary-item {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 12px;
    }

    .figma-qty-badge {
        background: #ffedd5;
        color: #ea580c;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 7px;
        border-radius: 6px;
        line-height: 1.2;
        flex-shrink: 0;
    }

    .figma-totals-box {
        background: #f4f6fb;
        border-radius: 12px;
        padding: 12px 14px;
        margin: 14px 0 16px;
    }

    .figma-totals-line {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 6px;
    }

    .figma-totals-final {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        border-top: 1px solid #e5e7eb;
        padding-top: 10px;
        margin-top: 8px;
    }

    .figma-co-submit {
        width: 100%;
        background: #ff6a00;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 13px 16px;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 8px 18px rgba(255, 106, 0, 0.24);
    }

    .figma-co-submit:hover {
        background: #ea580c;
    }

    .figma-co-secure {
        margin-top: 10px;
        text-align: center;
        font-size: 11px;
        color: #6b7280;
    }

    @media (max-width: 900px) {
        .figma-co-steps,
        .figma-co-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $cart = $cart ?? auth()->user()->cart?->load('tenant', 'items.menu');

    $items = collect($cart?->items ?? [])->map(function ($item) use ($cart) {
        return [
            'name' => $item->menu?->name ?? 'Menu tidak tersedia',
            'tenant' => $cart?->tenant?->name ?? 'Kantin',
            'quantity' => (int) $item->quantity,
            'subtotal' => (int) ($item->menu?->price ?? 0) * (int) $item->quantity,
        ];
    });

    $menuCount = $items->count();
    $subtotal = $items->sum('subtotal');
    $totalBayar = $subtotal;
    $coAction = route('buyer.checkout.store');
?>

<div class="figma-co-header">
    <h1 class="figma-co-title">Buat Pesanan</h1>
    <p class="figma-co-subtitle">
        Atur waktu ambil dan catatan pesananmu.
    </p>
</div>

<div class="figma-co-steps">
    <div class="figma-co-step is-done">
        <span class="figma-co-step-left">
            <span class="figma-co-step-num">1</span>
            <span>1 Keranjang</span>
        </span>
        <span>&#10003;</span>
    </div>

    <div class="figma-co-step is-active">
        <span class="figma-co-step-left">
            <span class="figma-co-step-num">2</span>
            <span>2 Waktu &amp; Catatan</span>
        </span>
        <span>&#128338;</span>
    </div>

    <div class="figma-co-step is-locked">
        <span class="figma-co-step-left">
            <span class="figma-co-step-num">3</span>
            <span>3 Pembayaran</span>
        </span>
        <span>&#128274;</span>
    </div>
</div>

<?php if($errors->any()): ?>
    <div style="background:#fee2e2;color:#b91c1c;padding:10px 14px;border-radius:10px;font-size:12.5px;margin-bottom:14px;max-width:980px;">
        <ul style="margin:0;padding-left:18px;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($err); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e($coAction); ?>" method="POST" class="figma-co-grid">
    <?php echo csrf_field(); ?>

    <div>
        <div class="figma-co-card">
            <h2 class="figma-co-card-heading">
                <span style="color:#ea580c;">&#127978;</span>
                <span>Pilih kantin</span>
            </h2>

            <div class="figma-canteen-box">
                <div style="display:flex;align-items:center;gap:12px;">
                    <div class="figma-canteen-icon">&#127860;</div>

                    <div>
                        <div style="font-size:13.5px;font-weight:700;color:#111827;">
                            <?php echo e($cart?->tenant?->name ?? 'Kantin'); ?>

                        </div>

                        <div style="font-size:11.5px;color:#6b7280;">
                            Fakultas Ilmu Komputer, Lantai 1
                        </div>
                    </div>
                </div>

                <span class="figma-dist-pill">50 m &rsaquo;</span>
            </div>
        </div>

        <div class="figma-co-card">
            <h2 class="figma-co-card-heading">
                <span style="color:#ea580c;">&#128338;</span>
                <span>Waktu ambil</span>
            </h2>

            <div class="figma-time-select-wrap">
                <select
                    name="pickup_time"
                    id="pickup_time"
                    class="figma-time-select"
                    data-previous-value="<?php echo e(old('pickup_time')); ?>"
                    required
                >
                    <option value="">Pilih waktu pengambilan</option>
                </select>

                <span class="figma-time-tag">Min. 10 menit</span>
            </div>

            <p class="figma-co-helper">
                Pilih waktu pengambilan minimal 10 menit setelah pemesanan.
            </p>
        </div>

        <div class="figma-co-card">
            <h2 class="figma-co-card-heading">
                <span style="color:#ea580c;">&#128221;</span>
                <span>Catatan (opsional)</span>
            </h2>

            <textarea
                id="figmaCoNotes"
                name="note"
                maxlength="150"
                placeholder="Contoh: tanpa sambal, tanpa es"
                class="figma-notes-textarea"
                oninput="updateNotesCounter()"
            ><?php echo e(old('note')); ?></textarea>

            <div class="figma-notes-footer">
                <span>Kantin akan berusaha menyesuaikan permintaanmu.</span>
                <span id="figmaNotesCount">0/150</span>
            </div>
        </div>
    </div>

    <div class="figma-summary-card">
        <div class="figma-summary-top">
            <strong style="font-size:15px;font-weight:800;color:#111827;">
                Ringkasan pesanan
            </strong>

            <span class="figma-menu-count-pill">
                <?php echo e($menuCount); ?> Menu
            </span>
        </div>

        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="figma-summary-item">
                <div style="display:flex;align-items:flex-start;gap:10px;">
                    <span class="figma-qty-badge">
                        <?php echo e($item['quantity']); ?>x
                    </span>

                    <div>
                        <div style="font-size:13px;font-weight:700;color:#111827;">
                            <?php echo e($item['name']); ?>

                        </div>

                        <div style="font-size:11px;color:#6b7280;">
                            <?php echo e($item['tenant']); ?>

                        </div>
                    </div>
                </div>

                <div style="font-size:13px;font-weight:700;color:#111827;white-space:nowrap;">
                    Rp <?php echo e(number_format($item['subtotal'], 0, ',', '.')); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="figma-totals-box">
            <div class="figma-totals-line">
                <span>Subtotal item</span>

                <span style="color:#111827;font-weight:600;">
                    Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?>

                </span>
            </div>

            <div class="figma-totals-line">
                <span>Biaya layanan kantin</span>
                <span style="color:#15803d;font-weight:700;">Gratis</span>
            </div>

            <div class="figma-totals-final">
                <div>
                    <div style="font-size:13px;font-weight:700;color:#111827;">
                        Total
                    </div>

                    <div style="font-size:10.5px;color:#6b7280;">
                        Termasuk pajak
                    </div>
                </div>

                <div style="font-size:22px;font-weight:800;color:#ff6a00;">
                    Rp <?php echo e(number_format($totalBayar, 0, ',', '.')); ?>

                </div>
            </div>
        </div>

        <input type="hidden" name="payment_method" value="QRIS">

        <button type="submit" class="figma-co-submit">
            Lanjut ke pembayaran &rarr;
        </button>

        <div class="figma-co-secure">
            &#128737;&#65039; Pembayaran aman dengan QRIS &amp; Saldo Mahasiswa
        </div>
    </div>
</form>

<script>
    function updateNotesCounter() {
        const textarea = document.getElementById('figmaCoNotes');
        const counter = document.getElementById('figmaNotesCount');

        if (!textarea || !counter) {
            return;
        }

        counter.textContent = textarea.value.length + '/150';
    }

    function populatePickupTimes() {
        const select = document.getElementById('pickup_time');

        if (!select) {
            return;
        }

        // Ambil nilai lama dari atribut HTML, bukan sintaks Blade di JavaScript.
        const previousValue = select.dataset.previousValue || '';

        const now = new Date();

        // Waktu pengambilan minimal 10 menit dari sekarang.
        const minimum = new Date(now.getTime() + 10 * 60 * 1000);

        // Bulatkan ke kelipatan 5 menit berikutnya.
        minimum.setSeconds(0, 0);

        const remainder = minimum.getMinutes() % 5;

        if (remainder !== 0) {
            minimum.setMinutes(
                minimum.getMinutes() + (5 - remainder)
            );
        }

        // Pilihan waktu dibatasi sampai akhir hari ini.
        const endOfToday = new Date(now);
        endOfToday.setHours(24, 0, 0, 0);

        select.replaceChildren(
            new Option('Pilih waktu pengambilan', '')
        );

        for (
            let time = new Date(minimum);
            time < endOfToday;
            time.setMinutes(time.getMinutes() + 5)
        ) {
            const hours = String(time.getHours()).padStart(2, '0');
            const minutes = String(time.getMinutes()).padStart(2, '0');
            const value = hours + ':' + minutes;

            const option = new Option(value, value);

            if (value === previousValue) {
                option.selected = true;
            }

            select.add(option);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        populatePickupTimes();
        updateNotesCounter();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.buyer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\kantingo-app\resources\views/buyer/checkout/index.blade.php ENDPATH**/ ?>