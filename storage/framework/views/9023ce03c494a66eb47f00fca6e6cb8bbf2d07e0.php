<?php $__env->startSection('title', 'Profil Penjual · KantinGo'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .sp-wrap {
        max-width: 980px;
        width: 100%;
    }

    .sp-main-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.03);
        margin-bottom: 16px;
    }

    .sp-cover {
        background: linear-gradient(100deg, #ff6a00 0%, #ff8200 100%);
        padding: 16px 22px 52px;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .sp-body {
        padding: 0 22px 22px;
    }

    .sp-avatar-row {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 14px;
        margin-top: -36px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .sp-avatar-circle {
        position: relative;
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #ff6a00;
        color: #ffffff;
        border: 4px solid #ffffff;
        font-size: 26px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .sp-check-badge {
        position: absolute;
        right: -2px;
        bottom: -2px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #16a34a;
        color: #ffffff;
        font-size: 11px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #ffffff;
    }

    .sp-two-stats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 18px;
    }

    .sp-stat-box {
        background: #f4f6fb;
        border-radius: 14px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sp-info-box {
        background: #fafbfd;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 16px;
        margin-bottom: 18px;
    }

    .sp-info-row {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 11px;
        padding: 11px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 8px;
        font-size: 12.5px;
    }

    .sp-bottom-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .sp-note-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 14px 16px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    @media (max-width: 820px) {
        .sp-two-stats,
        .sp-bottom-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="sp-wrap">
    <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
        <h1 style="font-size:28px;font-weight:800;color:#111827;margin:0;">Profil Pengguna</h1>
        <span style="background:#dcfce7;color:#15803d;font-size:11px;font-weight:700;padding:2px 9px;border-radius:999px;">Aktif</span>
    </div>
    <p style="font-size:13px;color:#6b7280;margin:0 0 18px;">Kelola informasi akun dan pengaturan identitas penjual Anda.</p>

    <div class="sp-main-card">
        <div class="sp-cover">
            <span style="font-size:12px;font-weight:700;">&#128737;&#65039; Akun Terverifikasi Kantin Kampus</span>
            <span style="background:rgba(255,255,255,0.22);border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;">
                &#127978; <?php echo e($tenant->name ?? 'Kantin Anda'); ?>

            </span>
        </div>

        <div class="sp-body">
            <div class="sp-avatar-row">
                <div style="display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap;">
                    <div class="sp-avatar-circle">
                        <?php echo e(strtoupper(substr(auth()->user()->name,0,1))); ?>

                        <span class="sp-check-badge">&#10003;</span>
                    </div>
                    <div>
                        <div style="font-size:22px;font-weight:800;color:#111827;"><?php echo e(auth()->user()->name); ?></div>
                        <div style="font-size:12px;color:#6b7280;margin-top:2px;">
                            &#127978; Pemilik <?php echo e($tenant->name ?? 'Kantin Anda'); ?> &bull; <?php echo e($tenant->location ?? 'Lokasi belum diatur'); ?>

                        </div>
                    </div>
                </div>

                <span style="background:#dcfce7;color:#15803d;font-size:11.5px;font-weight:700;padding:5px 12px;border-radius:999px;">
                    &#128338; <?php echo e($tenant->status === 'open' ? 'Buka' : 'Tutup'); ?> (<?php echo e(substr((string)$tenant->opens_at,0,5)); ?> - <?php echo e(substr((string)$tenant->closes_at,0,5)); ?>)
                </span>
            </div>

            <div class="sp-two-stats">
                <div class="sp-stat-box">
                    <div>
                        <div style="font-size:11.5px;color:#6b7280;">Pesanan diterima</div>
                        <div style="font-size:22px;font-weight:800;color:#111827;margin-top:2px;"><?php echo e($orderCount ?? 0); ?></div>
                    </div>
                    <span style="width:36px;height:36px;border-radius:10px;background:#ffedd5;color:#ea580c;display:inline-flex;align-items:center;justify-content:center;">&#128203;</span>
                </div>

                <div class="sp-stat-box">
                    <div>
                        <div style="font-size:11.5px;color:#6b7280;">Menu aktif</div>
                        <div style="font-size:22px;font-weight:800;color:#111827;margin-top:2px;"><?php echo e($menuCount ?? 0); ?></div>
                    </div>
                    <span style="width:36px;height:36px;border-radius:10px;background:#dcfce7;color:#16a34a;display:inline-flex;align-items:center;justify-content:center;">&#127860;</span>
                </div>
            </div>

            <div class="sp-info-box">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                    <strong style="font-size:13.5px;font-weight:800;color:#111827;">Rincian Informasi Akun</strong>
                    <span style="font-size:11px;color:#9ca3af;">Data terdaftar di sistem</span>
                </div>

                <div class="sp-info-row">
                    <span style="color:#6b7280;">&#128194; Nama lengkap</span>
                    <strong><?php echo e(auth()->user()->name); ?></strong>
                </div>

                <div class="sp-info-row">
                    <span style="color:#6b7280;">&#9993; Email</span>
                    <span>
                        <strong><?php echo e(auth()->user()->email); ?></strong>
                        <a href="<?php echo e(route('seller.tenant')); ?>" style="color:#ea580c;font-weight:700;text-decoration:none;margin-left:6px;">Ubah &#9998;</a>
                    </span>
                </div>

                <div class="sp-info-row">
                    <span style="color:#6b7280;">&#128222; No. HP</span>
                    <strong><?php echo e(auth()->user()->phone ?? 'Belum diatur'); ?></strong>
                </div>

                <div class="sp-info-row">
                    <span style="color:#6b7280;">&#128274; Password</span>
                    <span>
                        <strong style="letter-spacing:2px;">••••••••••••</strong>
                        <a href="<?php echo e(route('seller.tenant')); ?>" style="color:#ea580c;font-weight:700;text-decoration:none;margin-left:6px;">Ubah password &#8599;</a>
                    </span>
                </div>
            </div>

            <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                <a href="<?php echo e(route('seller.tenant')); ?>" style="flex:1;min-width:220px;text-align:center;background:#ff6a00;color:#ffffff;border-radius:12px;padding:11px 18px;font-size:13px;font-weight:700;text-decoration:none;">
                    &#9998; Edit profil
                </a>
                <button type="button" onclick="alert('Fitur QR akan tersedia setelah tautan kantin diaktifkan.')" style="background:#f4f6fb;color:#111827;border:1px solid #e2e8f0;border-radius:12px;padding:11px 18px;font-size:12.5px;font-weight:700;cursor:pointer;">
                    &#9635; QR Kantin
                </button>
            </div>
        </div>
    </div>

    <div class="sp-bottom-grid">
        <div class="sp-note-card">
            <span style="width:32px;height:32px;border-radius:9px;background:#ffedd5;color:#ea580c;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">&#128276;</span>
            <div>
                <div style="font-size:12.5px;font-weight:800;color:#111827;">Notifikasi Pesanan</div>
                <div style="font-size:11px;color:#6b7280;margin-top:2px;">Suara bel pesanan baru aktif dan terhubung ke printer dapur.</div>
            </div>
        </div>

        <div class="sp-note-card">
            <span style="width:32px;height:32px;border-radius:9px;background:#dcfce7;color:#16a34a;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">&#128179;</span>
            <div>
                <div style="font-size:12.5px;font-weight:800;color:#111827;">Pencairan Otomatis</div>
                <div style="font-size:11px;color:#6b7280;margin-top:2px;">Saldo e-wallet ditransfer setiap sore pukul 17.00 WIB.</div>
            </div>
        </div>

        <div class="sp-note-card">
            <span style="width:32px;height:32px;border-radius:9px;background:#eef4ff;color:#2563eb;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">&#128100;</span>
            <div>
                <div style="font-size:12.5px;font-weight:800;color:#111827;">Pusat Bantuan FILKOM</div>
                <div style="font-size:11px;color:#6b7280;margin-top:2px;">Hubungi pengelola kantin fakultas jika terdapat kendala stan.</div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\kantingo-app\resources\views/seller/profile.blade.php ENDPATH**/ ?>