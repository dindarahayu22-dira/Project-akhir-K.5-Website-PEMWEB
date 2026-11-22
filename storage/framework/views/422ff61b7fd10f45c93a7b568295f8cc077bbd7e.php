<?php $__env->startSection('title', 'Pembayaran · KantinGo'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:920px;">
    <h1 style="font-size:28px;font-weight:800;color:#111827;margin:0 0 4px;">Pembayaran</h1>
    <p style="font-size:13.5px;color:#6b7280;margin:0 0 22px;">Selesaikan pembayaran agar pesanan diproses.</p>

    <div style="background:#ffffff;border:1px solid #eef0f4;border-radius:18px;padding:42px 24px;text-align:center;box-shadow:0 4px 16px rgba(15,23,42,0.03);">
        <div style="font-size:17px;font-weight:700;color:#111827;margin-bottom:6px;">
            Tidak ada pembayaran yang menunggu
        </div>
        <div style="font-size:13px;color:#6b7280;margin-bottom:20px;">
            Semua pesananmu sudah dibayar. Lihat statusnya di Riwayat.
        </div>

        <a href="<?php echo e(\Illuminate\Support\Facades\Route::has('buyer.orders.index') ? route('buyer.orders.index') : url('/riwayat')); ?>"
           style="display:inline-block;background:#ff6a00;color:#ffffff;font-size:13px;font-weight:700;padding:10px 20px;border-radius:10px;text-decoration:none;">
            Buka Riwayat
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.buyer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\kantingo-app\resources\views/buyer/payment/empty.blade.php ENDPATH**/ ?>