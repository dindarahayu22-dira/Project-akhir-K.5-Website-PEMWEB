<?php $__env->startSection('title', 'Profil · KantinGo'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .profile-page-wrap {
        max-width: 920px;
    }

    .profile-page-title {
        font-size: 28px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 4px;
        letter-spacing: -0.02em;
    }

    .profile-page-subtitle {
        font-size: 14px;
        color: #6b7280;
        margin: 0 0 24px;
    }

    .profile-main-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 6px 24px rgba(15, 23, 42, 0.04);
    }

    .profile-banner {
        height: 112px;
        background: linear-gradient(100deg, #ff6a00 0%, #ea580c 62%, #b44306 100%);
    }

    .profile-card-body {
        padding: 0 28px 24px;
    }

    .profile-identity-row {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
        margin-top: -36px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .profile-identity-left {
        display: flex;
        align-items: flex-end;
        gap: 16px;
    }

    .profile-avatar-lg {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #ff6a00;
        color: #ffffff;
        border: 4px solid #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(234, 88, 12, 0.25);
    }

    .profile-name-heading {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin: 0 0 4px;
        padding-top: 38px;
    }

    .profile-verified-icon {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #16a34a;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
    }

    .profile-nim-text {
        font-size: 13px;
        color: #6b7280;
        margin: 0;
    }

    .profile-nim-text span.status-active {
        color: #ea580c;
        font-weight: 500;
    }

    .profile-hub-pill {
        background: #dcfce7;
        color: #15803d;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 38px;
    }

    .profile-stats-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }

    .profile-stat-box {
        background: #f4f6fb;
        border-radius: 12px;
        padding: 16px 18px;
    }

    .profile-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 8px;
    }

    .profile-stat-value-wrap {
        display: flex;
        align-items: baseline;
        gap: 6px;
    }

    .profile-stat-num {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        line-height: 1;
    }

    .profile-stat-caption {
        font-size: 12px;
        color: #6b7280;
    }

    .profile-info-box {
        background: #fafbfe;
        border: 1px solid #eef0f5;
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 18px;
    }

    .profile-info-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 18px;
        border-bottom: 1px solid #eef0f5;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.04em;
        color: #6b7280;
        text-transform: uppercase;
    }

    .profile-verified-badge {
        background: #dcfce7;
        color: #15803d;
        font-size: 11px;
        font-weight: 600;
        text-transform: none;
        letter-spacing: 0;
        padding: 4px 10px;
        border-radius: 999px;
    }

    .profile-info-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 14px 18px;
        border-bottom: 1px solid #f1f3f7;
        font-size: 13px;
    }

    .profile-info-row:last-child {
        border-bottom: none;
    }

    .profile-info-label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #6b7280;
    }

    .profile-info-value-wrap {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #111827;
        font-weight: 500;
        text-align: right;
    }

    .profile-change-pass-link {
        color: #ea580c;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
    }

    .profile-change-pass-link:hover {
        text-decoration: underline;
    }

    .btn-edit-profile-lg {
        width: 100%;
        background: #ff6a00;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 13px 18px;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.15s ease;
    }

    .btn-edit-profile-lg:hover {
        background: #ea580c;
    }

    .profile-security-note {
        margin-top: 10px;
        text-align: center;
        font-size: 11.5px;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .profile-shortcuts-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-top: 18px;
    }

    .profile-shortcut-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 14px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        text-decoration: none;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
        transition: transform 0.15s ease, border-color 0.15s ease;
    }

    .profile-shortcut-card:hover {
        transform: translateY(-1px);
        border-color: #fed7aa;
    }

    .profile-shortcut-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profile-shortcut-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .profile-shortcut-icon.tenant {
        background: #ffedd5;
        color: #ea580c;
    }

    .profile-shortcut-icon.payment {
        background: #dcfce7;
        color: #16a34a;
    }

    .profile-shortcut-title {
        font-size: 14px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 2px;
    }

    .profile-shortcut-sub {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }

    .profile-shortcut-arrow {
        color: #9ca3af;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .profile-stats-grid,
        .profile-shortcuts-grid {
            grid-template-columns: 1fr;
        }

        .profile-card-body {
            padding: 0 18px 20px;
        }

        .profile-hub-pill {
            margin-top: 0;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $user = $user ?? auth()->user();
    $name = $user->name ?? 'Pengguna';
    $initial = strtoupper(mb_substr($name, 0, 1));
    $nim = $user->nim ?? ($user->student_id ?? '-');
    $email = $user->email ?? '-';
    $phone = $user->phone ?? ($user->no_hp ?? '-');
    $completedOrdersCount = (int)($done ?? 0);
    $cartItemsCount = (int)($cart ?? 0);
    $favoriteTenantsCount = $favoriteTenantsCount ?? 0;
    $primaryTenantName = $primaryTenantName ?? 'Belum ada kantin favorit';

    if (\Illuminate\Support\Facades\Route::has('buyer.profile.update')) {
        $profileUpdateAction = route('buyer.profile.update');
    } elseif (\Illuminate\Support\Facades\Route::has('profile.update')) {
        $profileUpdateAction = route('profile.update');
    } else {
        $profileUpdateAction = url('/profil');
    }
?>

<div class="profile-page-wrap">
    <h1 class="profile-page-title">Profil Pengguna</h1>
    <p class="profile-page-subtitle">Kelola informasi akunmu.</p>

    <div class="profile-main-card">
        <div class="profile-banner"></div>

        <div class="profile-card-body">
            <div class="profile-identity-row">
                <div class="profile-identity-left">
                    <div class="profile-avatar-lg"><?php echo e($initial); ?></div>
                    <div>
                        <h2 class="profile-name-heading">
                            <?php echo e($name); ?>

                            <span class="profile-verified-icon" title="Terverifikasi">✓</span>
                        </h2>
                        <p class="profile-nim-text">
                            NIM <?php echo e($nim); ?> • <span class="status-active">Mahasiswa Aktif</span>
                        </p>
                    </div>
                </div>

                <div class="profile-hub-pill">
                    <span>• <?php echo e($primaryTenantName); ?> • Utama</span>
                </div>
            </div>

            <div class="profile-stats-grid">
                <div class="profile-stat-box">
                    <div class="profile-stat-top">
                        <span>Total pesanan</span>
                        <span>🧾</span>
                    </div>
                    <div class="profile-stat-value-wrap">
                        <span class="profile-stat-num"><?php echo e($completedOrdersCount); ?></span>
                        <span class="profile-stat-caption">kali selesai</span>
                    </div>
                </div>

                <div class="profile-stat-box">
                    <div class="profile-stat-top">
                        <span>Item di keranjang</span>
                        <span>🛍️</span>
                    </div>
                    <div class="profile-stat-value-wrap">
                        <span class="profile-stat-num"><?php echo e($cartItemsCount); ?></span>
                        <span class="profile-stat-caption">siap dipesan</span>
                    </div>
                </div>
            </div>

            <div class="profile-info-box">
                <div class="profile-info-header">
                    <span>DETAIL INFORMASI PRIBADI</span>
                    <span class="profile-verified-badge">• Akun Terverifikasi</span>
                </div>

                <div class="profile-info-row">
                    <span class="profile-info-label">
                        <span>🪪</span>
                        <span>Nama lengkap</span>
                    </span>
                    <span class="profile-info-value-wrap"><?php echo e($name); ?></span>
                </div>

                <div class="profile-info-row">
                    <span class="profile-info-label">
                        <span>✉️</span>
                        <span>Email</span>
                    </span>
                    <span class="profile-info-value-wrap">
                        <span><?php echo e($email); ?></span>
                        <?php if(\Illuminate\Support\Facades\Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request')); ?>" class="profile-change-pass-link">Ubah password &gt;</a>
                        <?php else: ?>
                            <a href="javascript:void(0)" onclick="window.openEditProfileModal?.()" class="profile-change-pass-link">Ubah password &gt;</a>
                        <?php endif; ?>
                    </span>
                </div>

                <div class="profile-info-row">
                    <span class="profile-info-label">
                        <span>📞</span>
                        <span>No. HP</span>
                    </span>
                    <span class="profile-info-value-wrap"><?php echo e($phone); ?></span>
                </div>

                <div class="profile-info-row">
                    <span class="profile-info-label">
                        <span>🔒</span>
                        <span>Password</span>
                    </span>
                    <span class="profile-info-value-wrap">••••••••••••</span>
                </div>
            </div>

            <?php if(session('status')): ?>
                <div style="background:#dcfce7;color:#15803d;padding:10px 14px;border-radius:10px;font-size:13px;font-weight:500;margin-bottom:14px;">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div style="background:#fee2e2;color:#b91c1c;padding:10px 14px;border-radius:10px;font-size:13px;margin-bottom:14px;">
                    <ul style="margin:0;padding-left:18px;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <button type="button" id="openEditProfileModal" class="btn-edit-profile-lg">
                <span>✎</span>
                <span>Edit profil</span>
            </button>

            <p class="profile-security-note">
                <span>🛡️</span>
                <span>Data kamu dilindungi oleh enkripsi KantinGo Hub</span>
            </p>
        </div>
    </div>

    <div class="profile-shortcuts-grid">
        <a href="<?php echo e(\Illuminate\Support\Facades\Route::has('buyer.home') ? route('buyer.home') : url('/home')); ?>" class="profile-shortcut-card">
            <div class="profile-shortcut-left">
                <div class="profile-shortcut-icon tenant">🏪</div>
                <div>
                    <p class="profile-shortcut-title">Warung Langganan</p>
                    <p class="profile-shortcut-sub"><?php echo e($favoriteTenantsCount); ?> stan sering dikunjungi</p>
                </div>
            </div>
            <span class="profile-shortcut-arrow">&rsaquo;</span>
        </a>

        <a href="<?php echo e(\Illuminate\Support\Facades\Route::has('buyer.payment.index') ? route('buyer.payment.index') : url('/pembayaran')); ?>" class="profile-shortcut-card">
            <div class="profile-shortcut-left">
                <div class="profile-shortcut-icon payment">💳</div>
                <div>
                    <p class="profile-shortcut-title">Metode Pembayaran</p>
                    <p class="profile-shortcut-sub">QRIS &amp; Transfer Otomatis</p>
                </div>
            </div>
            <span class="profile-shortcut-arrow">&rsaquo;</span>
        </a>
    </div>

    
    <div id="editProfileModal" data-has-errors="<?php echo e($errors->any() ? '1' : '0'); ?>" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,0.45);z-index:999;align-items:center;justify-content:center;padding:16px;">
        <div style="background:#ffffff;border-radius:16px;width:100%;max-width:460px;padding:24px;box-shadow:0 20px 40px rgba(15,23,42,0.2);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <h3 style="margin:0;font-size:18px;font-weight:700;color:#111827;">Edit Profil Pengguna</h3>
                <button type="button" id="closeEditProfileModal" style="background:none;border:none;font-size:20px;color:#6b7280;cursor:pointer;">&times;</button>
            </div>

            <form action="<?php echo e($profileUpdateAction); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <div style="margin-bottom:14px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:#374151;margin-bottom:6px;">Nama lengkap</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $name)); ?>" required
                        style="width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:10px;font-size:14px;box-sizing:border-box;">
                </div>

                <div style="margin-bottom:14px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:#374151;margin-bottom:6px;">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $email)); ?>" required
                        style="width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:10px;font-size:14px;box-sizing:border-box;">
                </div>

                <div style="margin-bottom:18px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:#374151;margin-bottom:6px;">No. HP</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone', $phone === '-' ? '' : $phone)); ?>"
                        style="width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:10px;font-size:14px;box-sizing:border-box;">
                </div>

                <div style="display:flex;justify-content:flex-end;gap:10px;">
                    <button type="button" id="cancelEditProfileModal"
                        style="padding:10px 16px;border-radius:10px;border:1px solid #d1d5db;background:#ffffff;color:#374151;font-weight:600;cursor:pointer;">
                        Batal
                    </button>
                    <button type="submit"
                        style="padding:10px 18px;border-radius:10px;border:none;background:#ff6a00;color:#ffffff;font-weight:600;cursor:pointer;">
                        Simpan perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function () {
            const modal = document.getElementById('editProfileModal');
            const openBtn = document.getElementById('openEditProfileModal');
            const closeBtn = document.getElementById('closeEditProfileModal');
            const cancelBtn = document.getElementById('cancelEditProfileModal');

            function openModal() {
                if (modal) modal.style.display = 'flex';
            }

            function closeModal() {
                if (modal) modal.style.display = 'none';
            }

            window.openEditProfileModal = openModal;

            if (openBtn) openBtn.addEventListener('click', openModal);
            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

            if (modal) {
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) closeModal();
                });

                if (modal.dataset.hasErrors === '1') {
                    openModal();
                }
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeModal();
            });
        })();
    </script>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.buyer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\katingox\resources\views/buyer/profile/show.blade.php ENDPATH**/ ?>