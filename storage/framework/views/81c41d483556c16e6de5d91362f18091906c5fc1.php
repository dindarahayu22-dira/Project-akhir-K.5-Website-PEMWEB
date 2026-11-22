<?php $__env->startSection('title', 'Notifikasi · KantinGo'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .ntf-page-wrap {
        max-width: 960px !important;
        width: 100% !important;
    }

    .ntf-header-row {
        display: flex !important;
        align-items: flex-start !important;
        justify-content: space-between !important;
        gap: 14px !important;
        margin-bottom: 18px !important;
        flex-wrap: wrap !important;
    }

    .ntf-title {
        font-size: 30px !important;
        font-weight: 800 !important;
        color: #111827 !important;
        margin: 0 0 4px !important;
        letter-spacing: -0.02em !important;
        line-height: 1.15 !important;
    }

    .ntf-subtitle {
        font-size: 13px !important;
        color: #6b7280 !important;
        margin: 0 !important;
    }

    .ntf-mark-all-btn {
        background: transparent !important;
        border: none !important;
        color: #ff6a00 !important;
        font-size: 12.5px !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        padding: 4px 6px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 5px !important;
    }

    .ntf-mark-all-btn:hover {
        color: #ea580c !important;
        text-decoration: underline !important;
    }

    .ntf-list-card {
        background: #ffffff !important;
        border: 1px solid #eef0f4 !important;
        border-radius: 18px !important;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.03) !important;
        overflow: hidden !important;
    }

    .ntf-item {
        display: flex !important;
        align-items: flex-start !important;
        justify-content: space-between !important;
        gap: 14px !important;
        padding: 18px 22px !important;
        border-bottom: 1px solid #f1f5f9 !important;
        cursor: pointer !important;
        transition: background-color 0.15s ease !important;
    }

    .ntf-item:last-child {
        border-bottom: none !important;
    }

    .ntf-item:hover {
        background: #fafbfd !important;
    }

    .ntf-item-left {
        display: flex !important;
        align-items: flex-start !important;
        gap: 14px !important;
    }

    .ntf-icon-circle {
        width: 34px !important;
        height: 34px !important;
        border-radius: 50% !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
        margin-top: 2px !important;
    }

    .ntf-icon-circle.success {
        background: #dcfce7 !important;
        color: #16a34a !important;
    }

    .ntf-icon-circle.processing {
        background: #ffedd5 !important;
        color: #ea580c !important;
    }

    .ntf-icon-circle.ready {
        background: #ffedd5 !important;
        color: #c2410c !important;
    }

    .ntf-icon-circle.failed {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .ntf-item-title {
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #111827 !important;
        line-height: 1.35 !important;
        margin-bottom: 3px !important;
    }

    .ntf-item-title.is-failed {
        color: #dc2626 !important;
    }

    .ntf-item-desc {
        font-size: 12.5px !important;
        color: #6b7280 !important;
        line-height: 1.45 !important;
    }

    .ntf-item-meta {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        font-size: 11.5px !important;
        color: #6b7280 !important;
        white-space: nowrap !important;
        padding-top: 2px !important;
    }

    .ntf-unread-dot {
        width: 7px !important;
        height: 7px !important;
        border-radius: 50% !important;
        background: #ff6a00 !important;
        display: inline-block !important;
    }

    .ntf-item.is-read .ntf-unread-dot {
        display: none !important;
    }

    .ntf-help-card {
        margin-top: 14px !important;
        background: #eef3fa !important;
        border: 1px solid #e2e8f2 !important;
        border-radius: 16px !important;
        padding: 14px 20px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 14px !important;
        flex-wrap: wrap !important;
    }

    .ntf-help-left {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
    }

    .ntf-help-icon {
        width: 24px !important;
        height: 24px !important;
        border-radius: 50% !important;
        background: #ffedd5 !important;
        color: #ea580c !important;
        font-size: 12px !important;
        font-weight: 800 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
    }

    .ntf-help-btn {
        background: #ffffff !important;
        border: 1px solid #d1d5db !important;
        color: #111827 !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        padding: 7px 14px !important;
        border-radius: 9px !important;
        cursor: pointer !important;
        text-decoration: none !important;
    }

    .ntf-help-btn:hover {
        background: #f9fafb !important;
    }

    @media (max-width: 640px) {
        .ntf-item {
            padding: 15px 16px !important;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $notificationRows = $notifications ?? collect(); ?>

<div class="ntf-page-wrap">
    <div class="ntf-header-row">
        <div>
            <h1 class="ntf-title">Notifikasi</h1>
            <p class="ntf-subtitle">Pantau perubahan status pesanan dan pembayaran.</p>
        </div>

        <form method="POST" action="<?php echo e(route('buyer.notifications.read')); ?>" style="margin:0;"><?php echo csrf_field(); ?><button type="submit" class="ntf-mark-all-btn">
            <span>&#10003;</span>
            <span>Tandai semua dibaca</span>
        </button></form>
    </div>

    <div id="ntfToast" style="display:none;background:#fff7ed;border:1px solid #fed7aa;color:#9a3412;padding:10px 14px;border-radius:12px;font-size:12.5px;font-weight:600;margin-bottom:14px;"></div>

    <div class="ntf-list-card">
        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $type = $item->type ?? 'success';
                $isUnread = !empty($item->unread);
            ?>
            <div class="ntf-item <?php echo e($isUnread ? '' : 'is-read'); ?>" onclick="markSingleRead(this)">
                <div class="ntf-item-left">
                    <span class="ntf-icon-circle <?php echo e($type); ?>">
                        <?php if($type === 'success'): ?>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        <?php elseif($type === 'processing'): ?>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2v4"></path>
                                <path d="M5 10h14"></path>
                                <path d="M6 10a6 6 0 0 0 12 0"></path>
                                <path d="M9 16v4"></path>
                                <path d="M15 16v4"></path>
                            </svg>
                        <?php elseif($type === 'ready'): ?>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 11h18"></path>
                                <path d="M5 11v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7"></path>
                                <path d="M12 7a2 2 0 0 1 2 2v2h-4V9a2 2 0 0 1 2-2z"></path>
                            </svg>
                        <?php else: ?>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                        <?php endif; ?>
                    </span>

                    <div>
                        <div class="ntf-item-title <?php echo e($type === 'failed' ? 'is-failed' : ''); ?>">
                            <?php echo e($item->title); ?>

                        </div>
                        <div class="ntf-item-desc">
                            <?php echo e($item->description); ?>

                        </div>
                    </div>
                </div>

                <div class="ntf-item-meta">
                    <span><?php echo e($item->time); ?></span>
                    <span class="ntf-unread-dot" aria-hidden="true"></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="padding:30px;text-align:center;color:#6b7280;"><strong>Belum ada notifikasi</strong><p>Notifikasi pesanan dan pembayaran akan muncul di sini.</p></div>
        <?php endif; ?>
    </div>

    <div class="ntf-help-card">
        <div class="ntf-help-left">
            <span class="ntf-help-icon">?</span>
            <div>
                <div style="font-size:12.5px;font-weight:700;color:#111827;">Kendala dengan pesanan Anda?</div>
                <div style="font-size:11.5px;color:#6b7280;">Hubungi Pusat Bantuan atau staf kantin terdekat</div>
            </div>
        </div>

        <button type="button" class="ntf-help-btn" onclick="showHelpToast()">Bantuan</button>
    </div>
</div>

<script>
    function markSingleRead(el) {
        if (!el) return;
        el.classList.add('is-read');
    }

    function markAllNotificationsRead() {
        document.querySelectorAll('.ntf-item').forEach(el => el.classList.add('is-read'));
    }

    function showHelpToast() {
        const toast = document.getElementById('ntfToast');
        if (!toast) return;
        toast.textContent = 'Pusat Bantuan KantinGo — Hubungi konter kasir kantin terdekat atau cek halaman Riwayat Pesanan.';
        toast.style.display = 'block';
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.buyer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\katingox\resources\views/buyer/notifications/index.blade.php ENDPATH**/ ?>