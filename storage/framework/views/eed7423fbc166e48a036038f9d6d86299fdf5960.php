<?php $__env->startSection('title', 'Kelola Menu · KantinGo'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .mn-wrap {
        max-width: 1020px;
        width: 100%;
    }

    .mn-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .mn-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        padding: 14px 18px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
        flex-wrap: wrap;
    }

    .mn-thumb {
        width: 82px;
        height: 62px;
        border-radius: 12px;
        object-fit: cover;
        flex-shrink: 0;
        border: 1px solid #e5e7eb;
    }

    .mn-btn-add {
        background: #ff6a00;
        color: #ffffff;
        border-radius: 999px;
        padding: 9px 18px;
        font-size: 12.5px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 6px 16px rgba(255, 106, 0, 0.24);
    }

    .mn-btn-edit {
        background: #ffedd5;
        color: #ea580c;
        border: none;
        border-radius: 9px;
        padding: 6px 13px;
        font-size: 11.5px;
        font-weight: 700;
        text-decoration: none;
    }

    .mn-btn-del {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: 9px;
        padding: 6px 13px;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $tenantName = optional($tenant ?? null)->name ?: 'Kantin';
    $rows = (isset($menus) ? $menus : collect())->map(function ($m) {
        return (object)['id'=>$m->id,'name'=>$m->name,'category'=>optional($m->category)->name ?: 'Belum dikategorikan','stock'=>$m->stock,'price'=>$m->price,'image'=>$m->image ? asset('storage/'.ltrim($m->image,'/')) : asset('assets/images/figma/menu-nasi.jpg'),'status'=>$m->status];
    });
?>

<div class="mn-wrap">
    <div class="mn-head">
        <div>
            <h1 style="font-size:28px;font-weight:800;color:#111827;margin:0 0 4px;">Daftar Menu</h1>
            <p style="font-size:13px;color:#6b7280;margin:0;">Kelola menu <?php echo e($tenantName); ?></p>
        </div>

        <a href="<?php echo e(route('seller.menus.create')); ?>" class="mn-btn-add">+ Tambah menu</a>
    </div>

    <?php if(session('status')): ?>
        <div style="background:#dcfce7;color:#15803d;padding:10px 14px;border-radius:12px;font-size:12.5px;font-weight:700;margin-bottom:14px;">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mn-card">
            <div style="display:flex;align-items:center;gap:14px;">
                <img src="<?php echo e($item->image); ?>" alt="<?php echo e($item->name); ?>" class="mn-thumb">
                <div>
                    <div style="font-size:15px;font-weight:800;color:#111827;"><?php echo e($item->name); ?></div>
                    <div style="font-size:12px;color:#6b7280;margin-top:2px;">
                        <?php echo e($item->category); ?> &bull; stok <?php echo e($item->stock); ?>

                    </div>
                    <div style="font-size:14px;font-weight:800;color:#ea580c;margin-top:4px;">
                        Rp <?php echo e(number_format((int) $item->price, 0, ',', '.')); ?>

                    </div>
                </div>
            </div>

            <div style="display:flex;align-items:center;gap:8px;">
                <a href="<?php echo e(route('seller.menus.edit', ['menu' => $item->id])); ?>" class="mn-btn-edit">Ubah</a>
                <form action="<?php echo e(route('seller.menus.destroy', ['menu' => $item->id])); ?>" method="POST" onsubmit="return confirm('Hapus menu ini?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="mn-btn-del">Hapus</button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\katingox\resources\views/seller/menus/index.blade.php ENDPATH**/ ?>