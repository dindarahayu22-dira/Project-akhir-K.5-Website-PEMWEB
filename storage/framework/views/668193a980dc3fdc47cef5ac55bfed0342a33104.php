<?php $__env->startSection('title', 'Kelola Tenant · KantinGo'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .tn-wrap {
        max-width: 1020px;
        width: 100%;
    }

    .tn-top-bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .tn-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(0, 0.78fr);
        gap: 18px;
        align-items: start;
    }

    .tn-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.03);
    }

    .tn-label-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }

    .tn-input,
    .tn-textarea {
        width: 100%;
        background: #f4f6fb;
        border: 1px solid #e6ebf5;
        border-radius: 12px;
        padding: 10px 12px;
        font-size: 13px;
        color: #111827;
        box-sizing: border-box;
        outline: none;
    }

    .tn-input:focus,
    .tn-textarea:focus {
        border-color: #ff6a00;
        background: #ffffff;
    }

    .tn-two-col {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin: 14px 0;
    }

    .tn-banner-box {
        position: relative;
        border-radius: 14px;
        overflow: hidden;
        height: 190px;
        margin-top: 8px;
        border: 1px solid #e5e7eb;
    }

    .tn-banner-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .tn-banner-tag {
        position: absolute;
        left: 10px;
        bottom: 10px;
        background: rgba(17, 24, 39, 0.72);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 8px;
    }

    .tn-change-btn {
        position: absolute;
        right: 10px;
        bottom: 10px;
        background: #ffffff;
        color: #111827;
        border: 1px solid #e5e7eb;
        border-radius: 9px;
        padding: 6px 12px;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
    }

    .tn-preview-card {
        border: 1px solid #eef0f4;
        border-radius: 14px;
        overflow: hidden;
        background: #ffffff;
    }

    .tn-preview-top {
        position: relative;
        height: 120px;
    }

    .tn-preview-top img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .tn-mini-stats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-top: 14px;
    }

    @media (max-width: 900px) {
        .tn-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $tName = old('name', optional($tenant ?? null)->name ?: '');
    $tLocation = old('location', optional($tenant ?? null)->location ?: '');
    $tHours = old('opens_at', optional($tenant ?? null)->opens_at ?: '07:00');
    $tDesc = old('description', optional($tenant ?? null)->description ?: '');
    $tPhoto = file_exists(public_path('assets/images/figma/tenant-fik.jpg'))
        ? asset('assets/images/figma/tenant-fik.jpg')
        : asset('assets/images/kantin.png');
?>

<div class="tn-wrap">
    <div class="tn-top-bar">
        <div>
            <div style="font-size:11.5px;color:#6b7280;margin-bottom:4px;">Pengaturan Toko &rsaquo; Kelola Tenant</div>
            <h1 style="font-size:28px;font-weight:800;color:#111827;margin:0 0 4px;">Kelola Tenant</h1>
            <p style="font-size:13px;color:#6b7280;margin:0;">Informasi kantin yang tampil ke pembeli.</p>
        </div>

        <div style="font-size:12px;color:#6b7280;display:inline-flex;align-items:center;gap:6px;">
            <span style="color:#16a34a;font-weight:700;">&#9679; Kantin <?php echo e(($tenant->status ?? 'open') === 'open' ? 'Buka' : 'Tutup'); ?></span>
            <span>&bull; Terlihat oleh mahasiswa</span>
        </div>
    </div>

    <?php if(session('status')): ?>
        <div style="background:#dcfce7;color:#15803d;padding:10px 14px;border-radius:12px;font-size:12.5px;font-weight:700;margin-bottom:14px;">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <div class="tn-grid">
        <form action="<?php echo e(route('seller.tenant.update')); ?>" method="POST" enctype="multipart/form-data" class="tn-card">
            <?php echo csrf_field(); ?>
            <input type="file" id="tenantPhotoInput" name="photo" accept="image/*" style="display:none;">

            <div class="tn-label-row">
                <label for="tenantNameInput">Nama Tenant</label>
                <span style="font-size:11px;color:#9ca3af;font-weight:600;">Wajib diisi</span>
            </div>
            <input id="tenantNameInput" type="text" name="name" value="<?php echo e($tName); ?>" class="tn-input" required>

            <div class="tn-two-col">
                <div>
                    <div class="tn-label-row"><label for="tenantLocInput">Lokasi / Jarak</label></div>
                    <input id="tenantLocInput" type="text" name="location" value="<?php echo e($tLocation); ?>" class="tn-input">
                </div>
                <div>
                    <div class="tn-label-row"><label for="tenantHoursInput">Jam Operasional</label></div>
                    <input id="tenantHoursInput" type="time" name="opens_at" value="<?php echo e($tHours); ?>" class="tn-input">
                    <label for="tenantCloseInput" class="tn-label-row" style="margin-top:8px;">Jam tutup</label><input id="tenantCloseInput" type="time" name="closes_at" value="<?php echo e(old('closes_at',$tenant->closes_at ?? '16:00')); ?>" class="tn-input">
                </div>
            </div>

            <div class="tn-label-row"><label for="tenantStatus">Status Kantin</label></div><select id="tenantStatus" name="status" class="tn-input"><option value="open" <?php echo e(old('status',$tenant->status ?? 'open')==='open'?'selected':''); ?>>Buka</option><option value="closed" <?php echo e(old('status',$tenant->status ?? 'open')==='closed'?'selected':''); ?>>Tutup</option></select>
            <div class="tn-label-row">
                <label for="tenantDescArea">Deskripsi Singkat</label>
                <span style="font-size:11px;color:#9ca3af;font-weight:600;">Maks. 120 karakter</span>
            </div>
            <textarea id="tenantDescArea" name="description" maxlength="120" rows="3" class="tn-textarea"><?php echo e($tDesc); ?></textarea>

            <div style="margin-top:14px;">
                <div class="tn-label-row">
                    <span>Foto Tenant</span>
                    <span style="font-size:11px;color:#9ca3af;font-weight:600;">Format JPG, PNG (Maks 2MB)</span>
                </div>
                <div class="tn-banner-box">
                    <img src="<?php echo e($tPhoto); ?>" alt="<?php echo e($tName); ?>">
                    <span class="tn-banner-tag">&#128247; Banner Utama Aktif</span>
                    <button type="button" class="tn-change-btn" onclick="document.getElementById('tenantPhotoInput').click()">
                        &#11014; Ganti Foto
                    </button>
                </div>
            </div>

            <div style="display:flex;align-items:center;justify-content:flex-end;gap:14px;margin-top:18px;">
                <a href="<?php echo e(route('seller.dashboard')); ?>" style="font-size:12.5px;font-weight:700;color:#6b7280;text-decoration:none;">Batal</a>
                <button type="submit" style="background:#ff6a00;color:#ffffff;border:none;border-radius:12px;padding:10px 20px;font-size:12.5px;font-weight:700;cursor:pointer;">
                    &#10003; Simpan Perubahan
                </button>
            </div>
        </form>

        <div>
            <div class="tn-card" style="margin-bottom:14px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;">
                    <strong style="font-size:14px;font-weight:800;color:#111827;">Tampilan di Pembeli</strong>
                    <span style="background:#ffedd5;color:#ea580c;font-size:10.5px;font-weight:700;padding:2px 8px;border-radius:999px;">&#9673; Live</span>
                </div>
                <div style="font-size:11.5px;color:#6b7280;margin-bottom:12px;">
                    Pratinjau kartu tenant seperti yang dilihat mahasiswa pada aplikasi KantinGo.
                </div>

                <div class="tn-preview-card">
                    <div class="tn-preview-top">
                        <img src="<?php echo e($tPhoto); ?>" alt="<?php echo e($tName); ?>">
                    </div>
                    <div style="padding:12px;">
                        <div style="font-size:14px;font-weight:800;color:#111827;"><?php echo e($tName); ?></div>
                        <div style="font-size:11.5px;color:#6b7280;margin-top:2px;">
                            <span style="color:#f59e0b;font-weight:700;">&#9733; 4.5</span> (120) &bull; <?php echo e($tLocation); ?>

                        </div>
                        <div style="font-size:11.5px;color:#374151;margin-top:4px;"><?php echo e($tDesc); ?></div>
                        <div style="display:flex;align-items:center;justify-content:space-between;font-size:11px;margin-top:10px;padding-top:8px;border-top:1px solid #f1f5f9;">
                            <span style="color:#6b7280;">&#128338; <?php echo e($tHours); ?></span>
                            <a href="<?php echo e(route('seller.menus.index')); ?>" style="color:#ea580c;font-weight:700;text-decoration:none;">Menu Lengkap &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tn-mini-stats">
                <div class="tn-card" style="padding:14px;">
                    <div style="font-size:11.5px;color:#6b7280;">Total menu aktif</div>
                    <div style="font-size:22px;font-weight:800;color:#111827;margin:4px 0;"><?php echo e($activeMenusCount ?? 3); ?></div>
                    <a href="<?php echo e(route('seller.menus.index')); ?>" style="font-size:11px;font-weight:700;color:#ea580c;text-decoration:none;">Kelola menu &rarr;</a>
                </div>
                <div class="tn-card" style="padding:14px;">
                    <div style="font-size:11.5px;color:#6b7280;">Rating tenant</div>
                    <div style="font-size:22px;font-weight:800;color:#111827;margin:4px 0;">4.5 <span style="font-size:11px;color:#6b7280;font-weight:600;">/5.0</span></div>
                    <div style="font-size:11px;color:#15803d;font-weight:600;">&#128077; Sangat Baik</div>
                </div>
            </div>

            <div class="tn-card" style="margin-top:14px;padding:14px;">
                <div style="font-size:12.5px;font-weight:800;color:#111827;margin-bottom:4px;">&#128161; Tips Memikat Pembeli</div>
                <div style="font-size:11px;color:#6b7280;line-height:1.5;">
                    Gunakan foto booth yang terang dan tulis menu andalan di deskripsi singkat agar mahasiswa cepat memutuskan pesanan.
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\katingox\resources\views/seller/tenant.blade.php ENDPATH**/ ?>