<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> · KantinGo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/buyer-shell.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/buyer-orders.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/pages.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<?php
    $nav = [
        ['Dashboard',         'home',    'seller.dashboard',     null],
        ['Kelola Tenant',     'bag',     'seller.tenant',        null],
        ['Kelola Menu',       'menu',    'seller.menus.index',          null],
        ['Pesanan Masuk',     'orders',  'seller.orders.index',  null],
        ['Riwayat Transaksi', 'history', 'seller.transaksi',     null],
        ['Notifikasi',        'bell',    'seller.notifikasi',    null],
        ['Profile',           'user',    'seller.profil',        null],
    ];
    $active = $active ?? 'Dashboard';
    $href = fn ($name) => \Illuminate\Support\Facades\Route::has($name) ? route($name) : '#';
?>

<div class="shell">
    <aside class="sidebar">
        <a class="brand" href="<?php echo e($href('seller.dashboard')); ?>">
            <span class="brand-mark">K</span>
            <span class="brand-text"><strong>KantinGo</strong><small>Portal Penjual</small></span>
        </a>

        <nav class="nav">
            <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $icon, $route, $badge]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($href($route)); ?>" class="nav-link <?php echo e($label === $active ? 'is-active' : ''); ?>">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $icon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?> <span><?php echo e($label); ?></span>
                    <?php if($badge): ?> <span class="nav-badge"><?php echo e($badge); ?></span> <?php endif; ?>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>

        <form method="POST" action="<?php echo e(route('logout')); ?>" class="logout">
            <?php echo csrf_field(); ?>
            <button type="submit"><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'logout']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'logout']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?> Keluar</button>
        </form>
    </aside>

    <div class="main">
        <header class="topbar">
            <form class="search" method="GET" action="<?php echo e($href('seller.orders.index')); ?>">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'search']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'search']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <input type="search" name="q" placeholder="Cari makanan, minuman, atau kantin...">
            </form>
            <span class="role-pill"><i></i> Penjual</span>
            <span class="avatar" title="<?php echo e(auth()->user()->name); ?>"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></span>
        </header>

        <main class="content">
            <?php if(session('status')): ?> <div class="flash" role="status"><?php echo e(session('status')); ?></div> <?php endif; ?>
            <?php if($errors->any() && ! View::hasSection('own-errors')): ?> <div class="flash flash-error" role="alert"><?php echo e($errors->first()); ?></div> <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</div>


</body>
</html>
<?php /**PATH C:\Users\WINDOWS 11\Herd\katingox\resources\views/layouts/seller.blade.php ENDPATH**/ ?>