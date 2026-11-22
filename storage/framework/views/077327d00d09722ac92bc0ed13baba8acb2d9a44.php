<?php $__env->startSection('title', 'Detail Pesanan · KantinGo'); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:900px;"><a href="<?php echo e(route('seller.orders.index')); ?>" style="color:#ea580c;">← Kembali ke pesanan</a><h1 style="font-size:28px;font-weight:800;margin:14px 0;">Detail Pesanan #<?php echo e($order->order_number); ?></h1><div style="background:#fff;border:1px solid #eef0f4;border-radius:16px;padding:20px;margin-bottom:16px;"><p><strong>Pembeli:</strong> <?php echo e($order->user->name ?? '-'); ?></p><p><strong>Kantin:</strong> <?php echo e($order->tenant->name ?? '-'); ?></p><p><strong>Status:</strong> <?php echo e(ucfirst($order->status)); ?></p><p><strong>Waktu ambil:</strong> <?php echo e($order->pickup_time ?? '-'); ?></p><p><strong>Kode ambil:</strong> <?php echo e($order->pickup_code ?? '-'); ?></p><p><strong>Catatan:</strong> <?php echo e($order->note ?: 'Tidak ada catatan'); ?></p><hr><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div style="display:flex;justify-content:space-between;padding:10px 0;"><span><?php echo e($item->menu_name ?? $item->menu?->name ?? 'Menu dihapus'); ?> ×<?php echo e($item->quantity); ?></span><strong>Rp <?php echo e(number_format($item->price*$item->quantity,0,',','.')); ?></strong></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><hr><h3>Total Rp <?php echo e(number_format($order->total,0,',','.')); ?></h3><p>Pembayaran: <?php echo e(ucfirst($order->payment->status ?? 'pending')); ?></p>
<?php if($order->status==='new'): ?><form method="POST" action="<?php echo e(route('seller.orders.update',$order)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?><input type="hidden" name="status" value="processing"><button class="po-btn-orange">Terima & proses</button></form><?php elseif($order->status==='processing'): ?><form method="POST" action="<?php echo e(route('seller.orders.update',$order)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?><input type="hidden" name="status" value="ready"><button class="po-btn-orange">Tandai siap diambil</button></form><?php elseif($order->status==='ready'): ?><form method="POST" action="<?php echo e(route('seller.orders.update',$order)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?><input type="hidden" name="status" value="completed"><button class="po-btn-orange">Selesaikan pesanan</button></form><?php endif; ?>
</div></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\kantingo-app\resources\views/seller/orders/show.blade.php ENDPATH**/ ?>