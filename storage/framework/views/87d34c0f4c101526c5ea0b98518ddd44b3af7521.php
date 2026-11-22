<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<section class="banner">
    <div class="banner-copy">
        <span class="pill pill-white">✦ Paling Populer Hari Ini</span>
        <h1>Makan enak di kantin kampus jadi lebih mudah!</h1>
        <p>Pesan tanpa antre, lacak progres masakan secara real-time, dan ambil saat siap di warung favoritmu.</p>
        <a class="btn btn-white" href="<?php echo e(route('buyer.menu.index')); ?>">Pesan Sekarang <span>→</span></a>
    </div>
    <img class="banner-photo" src="<?php echo e(asset('assets/images/figma/hero-food.jpg')); ?>" alt="Hidangan makanan kantin">
</section>

<section class="stat-row">
    <div class="card stat"><div><small>Pesanan aktif</small><strong><?php echo e($stats['active']); ?></strong></div><span class="stat-icon stat-peach">♨</span></div>
    <div class="card stat"><div><small>Item di keranjang</small><strong><?php echo e($stats['cart']); ?></strong></div><span class="stat-icon stat-blue">🛒</span></div>
    <div class="card stat"><div><small>Total pesanan</small><strong><?php echo e($stats['total']); ?></strong></div><span class="stat-icon stat-green">▣</span></div>
</section>

<div class="sec-head"><h2 class="sec-title">Kantin Terdekat</h2><a class="link-orange small" href="<?php echo e(route('buyer.menu.index')); ?>">Lihat Semua ›</a></div>
<section class="grid-3 tenant-grid">
    <?php $__empty_1 = true; $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a class="card tenant-card" href="<?php echo e(route('buyer.menu.index', ['tenant' => $t->id])); ?>">
            <div class="tenant-photo">
                <img src="<?php echo e(asset('assets/images/figma/tenant-' . ['fik','feb','ft'][$loop->index % 3] . '.jpg')); ?>" alt="Suasana <?php echo e($t->name); ?>">
                <span class="pill <?php echo e(($t->status === 'open') ? 'tone-green' : 'tone-red'); ?>"><?php echo e(($t->status === 'open') ? 'Buka' : 'Tutup'); ?></span>
                <em>★ <?php echo e(number_format((float) $t->rating, 1)); ?></em>
            </div>
            <h3><?php echo e($t->name); ?></h3>
            <p class="muted small">▣ Lt <?php echo e($t->stand ?? 'G'); ?> · ◉ <?php echo e($t->distance ?? '—'); ?> · <?php echo e($t->menus_count); ?> Menu</p>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="card" style="grid-column:1/-1;padding:24px;text-align:center;color:#6b7280;">Belum ada kantin yang membuka menu. Silakan cek kembali nanti.</div>
    <?php endif; ?>
</section>

<div class="sec-head menu-section-head"><h2 class="sec-title">Menu Populer</h2><a class="link-orange small" href="<?php echo e(route('buyer.menu.index')); ?>">Semua Menu ›</a></div>
<section class="grid-5 menu-grid">
    <?php $__empty_1 = true; $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <article class="menu-card">
            <a href="<?php echo e(route('buyer.menu.show', $menu)); ?>" class="menu-thumb">
                <?php if($menu->image): ?>
                    <img src="<?php echo e(asset('storage/' . $menu->image)); ?>" alt="<?php echo e($menu->name); ?>">
                <?php else: ?>
                    <img src="<?php echo e(asset('assets/images/figma/menu-' . ['nasi','mie','teh','alpukat','siomay'][$loop->index % 5] . '.jpg')); ?>" alt="<?php echo e($menu->name); ?>">
                <?php endif; ?>
                <em class="pill tone-peach"><?php echo e(str_replace('Kantin ', '', $menu->tenant->name)); ?></em>
            </a>
            <h3><?php echo e($menu->name); ?></h3>
            <p class="muted small"><?php echo e($menu->tenant->name); ?></p>
            <div class="menu-foot">
                <strong class="price">Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?></strong>
                <?php if($menu->isOrderable()): ?>
                    <form method="POST" action="<?php echo e(route('buyer.cart.add', $menu)); ?>"><?php echo csrf_field(); ?><button class="add-btn" aria-label="Tambah <?php echo e($menu->name); ?> ke keranjang">+</button></form>
                <?php else: ?>
                    <span class="pill tone-red">Habis</span>
                <?php endif; ?>
            </div>
        </article>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="card" style="grid-column:1/-1;padding:24px;text-align:center;color:#6b7280;">Belum ada menu tersedia saat ini.</div>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.buyer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\kantingo-app\resources\views/buyer/home/index.blade.php ENDPATH**/ ?>