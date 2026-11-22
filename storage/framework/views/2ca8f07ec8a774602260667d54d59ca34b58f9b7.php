<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name']); ?>
<?php foreach (array_filter((['name']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php
    $paths = [
        'home'    => 'M3 11l9-8 9 8v10a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z',
        'menu'    => 'M7 3v8M4 3v5a3 3 0 0 0 6 0V3M7 11v10M17 3c-2 2-3 5-3 8h3v10',
        'cart'    => 'M6 7h12l1 14H5zM9 7a3 3 0 0 1 6 0',
        'orders'  => 'M6 3h12v18l-3-2-3 2-3-2-3 2zM9 8h6M9 12h6',
        'payment' => 'M3 6h18v12H3zM3 10h18',
        'history' => 'M3 12a9 9 0 1 0 3-6.7M3 4v5h5M12 8v4l3 2',
        'bell'    => 'M6 16v-5a6 6 0 0 1 12 0v5l2 2H4zM10 21h4',
        'user'    => 'M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM4 21a8 8 0 0 1 16 0',
        'logout'  => 'M9 4H5v16h4M16 8l4 4-4 4M20 12H9',
        'search'  => 'M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14zM21 21l-5-5',
        'image'   => 'M4 5h16v14H4zM4 16l5-5 4 4 3-3 4 4M9 9h.01',
        'receipt' => 'M6 3h12v18l-3-2-3 2-3-2-3 2zM9 8h6M9 12h4',
        'bag'     => 'M6 7h12l1 14H5zM9 10a3 3 0 0 0 6 0',
        'help'    => 'M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18zM9.5 9.5a2.5 2.5 0 1 1 3.5 2.3c-.6.3-1 .9-1 1.5M12 17h.01',
        'idcard'  => 'M3 5h18v14H3zM7 10h4M7 14h2M14 10h3M14 14h3',
        'lock'    => 'M6 11h12v9H6zM8 11V8a4 4 0 0 1 8 0v3',
        'eye'     => 'M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12zM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z',
        'eyeoff'  => 'M2 12s4-7 10-7c2 0 3.8.7 5.3 1.7M22 12s-4 7-10 7c-2 0-3.8-.7-5.3-1.7M4 4l16 16',
        'cap'     => 'M2 9l10-5 10 5-10 5zM6 11v5c0 1.5 3 3 6 3s6-1.5 6-3v-5',
        'store'   => 'M4 9l1-5h14l1 5M4 9v11h16V9M4 9a2.7 2.7 0 0 0 5.3 0 2.7 2.7 0 0 0 5.4 0A2.7 2.7 0 0 0 20 9M10 20v-5h4v5',
        'hash'    => 'M5 9h14M5 15h14M10 4L8 20M16 4l-2 16',
        'mail'    => 'M3 6h18v12H3zM3 7l9 7 9-7',
        'arrow'   => 'M5 12h14M13 6l6 6-6 6',
        'check'   => 'M5 12l5 5 9-10',
    ];
?>
<svg <?php echo e($attributes->merge(['class' => 'icon'])); ?> viewBox="0 0 24 24" fill="none" stroke="currentColor"
     stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    <path d="<?php echo e($paths[$name] ?? ''); ?>"/>
</svg>
<?php /**PATH C:\Users\WINDOWS 11\Herd\katingox\resources\views/components/icon.blade.php ENDPATH**/ ?>