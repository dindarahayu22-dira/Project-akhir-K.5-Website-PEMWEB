<?php $__env->startSection('title', 'Pembayaran · KantinGo'); ?>

<?php $__env->startPush('styles'); ?>
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

    .pay-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.25fr) minmax(0, .78fr);
        gap: 20px;
        max-width: 980px;
        align-items: start;
    }

    .pay-method-card,
    .pay-summary-card {
        background: #fff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 6px 20px rgba(15, 23, 42, .04);
        margin-bottom: 14px;
    }

    .pay-section-title {
        font-size: 18px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 10px;
    }

    .pay-pickup-box {
        background: #f4f6fb;
        border: 1px solid #e6ebf5;
        border-radius: 14px;
        padding: 14px 16px;
        margin-top: 16px;
    }

    .pay-waiting-pill {
        background: #ffedd5;
        color: #ea580c;
        font-size: 10.5px;
        font-weight: 700;
        padding: 4px 9px;
        border-radius: 999px;
    }

    .pay-item-row,
    .pay-section-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
    }

    .pay-item-row {
        margin-bottom: 12px;
    }

    .pay-section-top {
        align-items: center;
        margin-bottom: 12px;
    }

    .pay-qty-box {
        background: #ffedd5;
        color: #ea580c;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 7px;
        border-radius: 6px;
        margin-right: 5px;
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
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 13px 16px;
        font-size: 13.5px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
    }

    .pay-submit-btn:hover {
        background: #ea580c;
    }

    .pay-cancel-link {
        display: block;
        width: 100%;
        text-align: center;
        margin-top: 10px;
        padding: 8px;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        border: 0;
        background: transparent;
        cursor: pointer;
    }

    .pay-alert {
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 16px;
        font-size: 13px;
    }

    .pay-alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .pay-alert-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
    }

    @media (max-width: 900px) {
        .pay-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $tenant = $order?->tenant;
    $canteenName = $tenant?->name ?? 'Nama Kantin';
    $isPaymentActive = $order
        && $payment
        && $order->status === 'new'
        && $payment->status === 'pending';
?>

<div class="pay-header">
    <h1 class="pay-title">Pembayaran</h1>
    <p class="pay-subtitle">
        Konfirmasi pembayaran untuk meneruskan pesanan ke kantin.
    </p>
</div>

<?php if(session('status')): ?>
    <div class="pay-alert pay-alert-success">
        <?php echo e(session('status')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="pay-alert pay-alert-error">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="pay-alert pay-alert-error">
        <ul style="margin:0;padding-left:18px;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if(!$order || !$payment): ?>
    <div class="pay-summary-card">
        <h3>Tidak ada pembayaran</h3>
        <p>Silakan buat pesanan dari menu yang tersedia terlebih dahulu.</p>
        <a href="<?php echo e(route('buyer.menu.index')); ?>" class="pay-submit-btn">
            Cari menu
        </a>
    </div>
<?php else: ?>
    <?php if(!$isPaymentActive): ?>
        <div class="pay-alert pay-alert-error">
            <strong>Pembayaran tidak tersedia.</strong>
            <p style="margin:6px 0 0;">
                Status pesanan:
                <strong><?php echo e(ucfirst($order->status)); ?></strong>
            </p>
            <p style="margin:4px 0 0;">
                Status pembayaran:
                <strong><?php echo e(ucfirst($payment->status)); ?></strong>
            </p>
            <p style="margin:8px 0 0;">
                Pesanan yang sudah dibatalkan atau selesai dibayar
                tidak dapat dibayar kembali dari halaman ini.
            </p>
        </div>
    <?php endif; ?>

    <div class="pay-grid">
        <div>
            <div class="pay-method-card">
                <h2 class="pay-section-title">Pilih metode pembayaran</h2>

                <p style="color:#6b7280;font-size:12px;">
                    Ini adalah simulasi pembayaran untuk proyek praktikum.
                    Tidak ada uang sungguhan yang ditarik.
                </p>

                <?php if($isPaymentActive): ?>
                    <form method="POST"
                          action="<?php echo e(route('buyer.payment.pay', $order)); ?>">
                        <?php echo csrf_field(); ?>

                        <label for="method"
                               style="display:block;margin:14px 0 6px;font-weight:700;">
                            Metode pembayaran
                        </label>

                        <select id="method"
                                name="method"
                                required
                                style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:10px;background:#fff;">
                            <option value="bank_transfer">Transfer Bank (simulasi)</option>
                            <option value="ewallet">E-Wallet (simulasi)</option>
                            <option value="virtual_account">Virtual Account (simulasi)</option>
                            <option value="cash">Bayar di Kantin</option>
                        </select>

                        <div class="pay-pickup-box">
                            <strong><?php echo e($canteenName); ?></strong>

                            <div style="font-size:12px;color:#6b7280;margin-top:6px;">
                                Waktu ambil: <?php echo e($pickupTime ?? $order->pickup_time ?? '-'); ?>

                                <br>
                                Kode ambil: <?php echo e($order->pickup_code ?? '-'); ?>

                            </div>

                            <?php if(!empty($notesText ?? $order->note)): ?>
                                <div style="font-size:12px;margin-top:6px;">
                                    Catatan: <?php echo e($notesText ?? $order->note); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit"
                                class="pay-submit-btn"
                                style="margin-top:16px;">
                            Konfirmasi pembayaran simulasi
                        </button>
                    </form>

                    <form method="POST"
                          action="<?php echo e(route('buyer.payment.cancel', $order)); ?>"
                          onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="pay-cancel-link">
                            Batalkan pesanan
                        </button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('buyer.orders.index')); ?>"
                       class="pay-submit-btn"
                       style="margin-top:16px;">
                        Kembali ke pesanan
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div>
            <div class="pay-summary-card">
                <div class="pay-section-top">
                    <strong>Ringkasan pesanan</strong>
                    <span class="pay-waiting-pill">
                        <?php echo e(ucfirst($payment->status ?? 'pending')); ?>

                    </span>
                </div>

                <div style="font-size:12px;font-weight:700;color:#374151;margin:12px 0;">
                    <?php echo e($canteenName); ?> · #<?php echo e($order->order_number ?? $order->id); ?>

                </div>

                <?php $__empty_1 = true; $__currentLoopData = $items ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="pay-item-row">
                        <div>
                            <span class="pay-qty-box">
                                <?php echo e($item['quantity'] ?? 0); ?>x
                            </span>
                            <strong><?php echo e($item['name'] ?? 'Menu'); ?></strong>
                        </div>

                        <strong>
                            Rp <?php echo e(number_format((float) ($item['subtotal'] ?? 0), 0, ',', '.')); ?>

                        </strong>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p style="font-size:13px;color:#6b7280;">
                        Tidak ada rincian item pesanan.
                    </p>
                <?php endif; ?>

                <div class="pay-totals-box">
                    <div style="display:flex;justify-content:space-between;border-top:1px solid #e5e7eb;padding-top:12px;font-weight:800;gap:12px;">
                        <span>Total pembayaran</span>
                        <span>
                            Rp <?php echo e(number_format((float) ($totalBayar ?? $order->total ?? 0), 0, ',', '.')); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.buyer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\kantingo-app\resources\views/buyer/payment/show.blade.php ENDPATH**/ ?>