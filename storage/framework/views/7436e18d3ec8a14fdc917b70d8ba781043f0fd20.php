<?php $__env->startSection('title', 'Riwayat Pesanan · KantinGo'); ?>

<?php $__env->startPush('styles'); ?>
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
        width: 37.5%;
        height: 3px;
        background: #ff6a00;
        z-index: 1;
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

    .rw-btn-orange {
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

    @media (max-width: 720px) {
        .rw-card-header {
            flex-direction: column;
        }

        .rw-price-main {
            text-align: left;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="rw-top-bar"><div><h1 class="rw-title">Riwayat Pesanan</h1><p class="rw-subtitle">Pantau status pesanan dan ulas pesanan yang sudah selesai.</p></div></div>
<?php if(session('status')): ?><div class="rw-card"><?php echo e(session('status')); ?></div><?php endif; ?>
<?php if(($orders ?? collect())->isEmpty()): ?>
<div class="rw-card" style="text-align:center;padding:44px 20px;"><h3>Belum ada riwayat pesanan</h3><p style="color:#6b7280;">Pesanan yang kamu buat akan muncul di sini.</p><a href="<?php echo e(route('buyer.menu.index')); ?>" class="rw-btn-orange">Cari menu</a></div>
<?php else: ?>
<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="rw-card" data-status="<?php echo e($order->status); ?>"><div class="rw-card-header"><div class="rw-card-left"><div class="rw-brand-icon filkom">&#127860;</div><div><strong style="font-size:15px;font-weight:800;color:#111827;"><?php echo e($order->tenant->name ?? 'Kantin'); ?></strong><div style="font-size:12px;color:#6b7280;margin-top:4px;">#<?php echo e($order->order_number); ?> · <?php echo e($order->created_at->format('d M Y, H:i')); ?></div><div style="font-size:12.5px;color:#374151;margin-top:5px;"><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($item->menu_name ?? $item->menu?->name ?? 'Menu dihapus'); ?> ×<?php echo e($item->quantity); ?><?php if(!$loop->last): ?>, <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div></div></div><div style="text-align:right;"><span class="rw-status-pill <?php echo e(in_array($order->status,['completed'])?'completed':(in_array($order->status,['processing','ready'])?'processing':'waiting')); ?>"><?php echo e(ucfirst($order->status)); ?></span><div class="rw-price-main" style="margin-top:6px;">Rp <?php echo e(number_format($order->total,0,',','.')); ?></div><div style="font-size:11px;color:#6b7280;">Pembayaran: <?php echo e(ucfirst($order->payment->status ?? 'pending')); ?></div></div></div>
<?php if($order->status==='completed' && !$order->review): ?><div style="display:flex;justify-content:flex-end;margin-top:10px;"><a class="rw-btn-outline" href="<?php echo e(route('buyer.reviews.create',$order)); ?>">Beri Ulasan</a></div><?php endif; ?>
<?php if(in_array($order->status,['new']) && ($order->payment?->status==='pending')): ?><div style="display:flex;justify-content:flex-end;margin-top:10px;"><a class="rw-btn-orange" href="<?php echo e(route('buyer.payment.show',$order)); ?>">Lanjutkan pembayaran</a><form method="POST" action="<?php echo e(route('buyer.payment.cancel',$order)); ?>" style="margin-left:8px;"><?php echo csrf_field(); ?><button class="rw-btn-outline" type="submit">Batalkan</button></form></div><?php endif; ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.buyer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\kantingo-app\resources\views/buyer/orders/index.blade.php ENDPATH**/ ?>