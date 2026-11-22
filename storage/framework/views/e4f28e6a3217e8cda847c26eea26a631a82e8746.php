<?php $__env->startSection('title', ($isEdit ?? false) ? 'Ubah Menu · KantinGo' : 'Tambah Menu · KantinGo'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .mf-wrap {
        max-width: 1020px;
        width: 100%;
    }

    .mf-top-bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .mf-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.3fr) minmax(0, 0.78fr);
        gap: 18px;
        align-items: start;
    }

    .mf-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.03);
    }

    .mf-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }

    .mf-input,
    .mf-select {
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

    .mf-input:focus,
    .mf-select:focus {
        border-color: #ff6a00;
        background: #ffffff;
    }

    .mf-two-col {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin: 14px 0;
    }

    .mf-dropzone {
        background: #f4f6fb;
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
        padding: 22px 16px;
        text-align: center;
        cursor: pointer;
    }

    .mf-preview-box {
        border: 1px solid #eef0f4;
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
    }

    .mf-preview-img-wrap {
        position: relative;
        height: 175px;
    }

    .mf-preview-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .mf-preview-badges {
        position: absolute;
        left: 10px;
        top: 10px;
        display: flex;
        gap: 6px;
    }

    .mf-badge-dark {
        background: rgba(17, 24, 39, 0.72);
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 7px;
    }

    .mf-badge-green {
        background: #dcfce7;
        color: #15803d;
        font-size: 10.5px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 7px;
    }

    @media (max-width: 900px) {
        .mf-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $editing = (bool) ($isEdit ?? false);
    $menuModel = $menu ?? null;
    $tenantName = optional($tenant ?? null)->name ?: 'Kantin Anda';

    $valName = old('name', optional($menuModel)->name ?: '');
    $valPrice = old('price', optional($menuModel)->price ?? '');
    $valStock = old('stock', optional($menuModel)->stock ?? 0);
    $valCat = old('category', optional(optional($menuModel)->category)->name ?: 'Makanan');

    $previewImg = ($menuModel && !empty($menuModel->image))
        ? (str_starts_with($menuModel->image, 'http') ? $menuModel->image : asset('storage/' . ltrim($menuModel->image, '/')))
        : asset('assets/images/figma/menu-nasi.jpg');

    $actionUrl = $editing && $menuModel
        ? route('seller.menus.update', ['menu' => $menuModel->id])
        : route('seller.menus.store');
?>

<div class="mf-wrap">
    <div class="mf-top-bar">
        <div>
            <a href="<?php echo e(route('seller.menus.index')); ?>" style="font-size:12px;color:#6b7280;text-decoration:none;">
                &larr; Kelola Menu / <?php echo e($editing ? 'Ubah Menu' : 'Tambah Menu Baru'); ?>

            </a>
            <h1 style="font-size:28px;font-weight:800;color:#111827;margin:4px 0;">
                <?php echo e($editing ? 'Ubah menu' : 'Tambah menu'); ?>

            </h1>
            <p style="font-size:13px;color:#6b7280;margin:0;">
                Isi data menu dengan lengkap untuk mempermudah pemesanan oleh mahasiswa.
            </p>
        </div>

        <div style="font-size:12px;color:#16a34a;font-weight:700;">
            &#9679; Status Toko: Buka
        </div>
    </div>

    <?php if($errors->any()): ?>
        <div style="background:#fee2e2;color:#b91c1c;padding:10px 14px;border-radius:12px;font-size:12.5px;font-weight:700;margin-bottom:14px;">
            <?php echo e($errors->first()); ?>

        </div>
    <?php endif; ?>

    <div class="mf-grid">
        <form action="<?php echo e($actionUrl); ?>" method="POST" enctype="multipart/form-data" class="mf-card">
            <?php echo csrf_field(); ?>
            <?php if($editing): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>
            <input type="file" id="menuPhotoInput" name="photo" accept="image/png,image/jpeg,image/webp" style="display:none;">

            <div style="margin-bottom:14px;">
                <label for="mfNameInput" class="mf-label">Nama menu</label>
                <input id="mfNameInput" type="text" name="name" value="<?php echo e($valName); ?>" class="mf-input" oninput="syncMenuPreview()" required>
            </div>

            <div class="mf-two-col">
                <div>
                    <label for="mfPriceInput" class="mf-label">Harga (Rp)</label>
                    <input id="mfPriceInput" type="number" name="price" value="<?php echo e($valPrice); ?>" min="0" class="mf-input" oninput="syncMenuPreview()" required>
                </div>
                <div>
                    <label for="mfStockInput" class="mf-label">Stok</label>
                    <input id="mfStockInput" type="number" name="stock" value="<?php echo e($valStock); ?>" min="0" class="mf-input" oninput="syncMenuPreview()" required>
                </div>
            </div>

            <div style="margin-bottom:14px;">
                <label for="mfCatSelect" class="mf-label">Kategori</label>
                <select id="mfCatSelect" name="category" class="mf-select" onchange="syncMenuPreview()">
                    <?php $__currentLoopData = ['Makanan', 'Minuman', 'Snack']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($catOption); ?>" <?php echo e($valCat === $catOption ? 'selected' : ''); ?>><?php echo e($catOption); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                    <span class="mf-label" style="margin:0;">Foto menu (opsional, maks 2 MB)</span>
                    <span style="font-size:11px;color:#9ca3af;font-weight:600;">Rasio 16:10 disarankan</span>
                </div>
                <div class="mf-dropzone" onclick="document.getElementById('menuPhotoInput').click()">
                    <div style="font-size:18px;color:#ea580c;margin-bottom:4px;">&#9729;&#65039;</div>
                    <div style="font-size:12px;font-weight:700;color:#374151;">Pilih atau tarik foto ke sini</div>
                    <div style="font-size:11px;color:#9ca3af;margin-top:2px;">PNG, JPG, atau WEBP hingga 2MB</div>
                </div>
            </div>

            <div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;margin-top:18px;">
                <a href="<?php echo e(route('seller.menus.index')); ?>" style="font-size:12.5px;font-weight:700;color:#6b7280;text-decoration:none;padding:9px 14px;">Batal</a>
                <button type="submit" style="background:#ff6a00;color:#ffffff;border:none;border-radius:12px;padding:10px 22px;font-size:12.5px;font-weight:700;cursor:pointer;">
                    &#128190; Simpan
                </button>
            </div>
        </form>

        <div>
            <div class="mf-card" style="margin-bottom:14px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                    <strong style="font-size:13.5px;font-weight:800;color:#111827;">&#9673; Pratinjau di pembeli</strong>
                    <span style="background:#dcfce7;color:#15803d;font-size:10.5px;font-weight:700;padding:2px 8px;border-radius:999px;">Live Preview</span>
                </div>

                <div class="mf-preview-box">
                    <div class="mf-preview-img-wrap">
                        <img src="<?php echo e($previewImg); ?>" alt="<?php echo e($valName); ?>">
                        <div class="mf-preview-badges">
                            <span id="mfPreviewCatBadge" class="mf-badge-dark"><?php echo e($valCat); ?></span>
                            <span class="mf-badge-green">Halal</span>
                        </div>
                    </div>
                    <div style="padding:12px;">
                        <div id="mfPreviewName" style="font-size:14px;font-weight:800;color:#111827;"><?php echo e($valName); ?></div>
                        <div id="mfPreviewSub" style="font-size:11.5px;color:#6b7280;margin-top:2px;"><?php echo e($tenantName); ?> &bull; stok <?php echo e($valStock); ?></div>
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:10px;">
                            <div>
                                <div style="font-size:10.5px;color:#9ca3af;">Harga satuan</div>
                                <div id="mfPreviewPrice" style="font-size:15px;font-weight:800;color:#ea580c;">
                                    Rp <?php echo e(number_format((float) $valPrice, 0, ',', '.')); ?>

                                </div>
                            </div>
                            <span style="width:30px;height:30px;border-radius:50%;background:#ff6a00;color:#ffffff;display:inline-flex;align-items:center;justify-content:center;font-weight:800;">+</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mf-card" style="padding:14px;">
                <div style="font-size:12.5px;font-weight:800;color:#111827;margin-bottom:4px;">&#128161; Tips Foto Menu</div>
                <div style="font-size:11px;color:#6b7280;line-height:1.5;">
                    Gunakan foto makanan dengan pencahayaan terang alami. Menu dengan foto menarik mendapatkan pesanan hingga 3&times; lebih banyak saat jam istirahat kuliah.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function syncMenuPreview() {
        const name = document.getElementById('mfNameInput')?.value || 'Menu';
        const price = parseInt(document.getElementById('mfPriceInput')?.value || '0', 10) || 0;
        const stock = parseInt(document.getElementById('mfStockInput')?.value || '0', 10) || 0;
        const cat = document.getElementById('mfCatSelect')?.value || 'Makanan';

        document.getElementById('mfPreviewName').textContent = name;
        document.getElementById('mfPreviewCatBadge').textContent = cat;
        document.getElementById('mfPreviewSub').textContent = '<?php echo e($tenantName); ?> \u2022 stok ' + stock;
        document.getElementById('mfPreviewPrice').textContent = 'Rp ' + price.toLocaleString('id-ID');
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\katingox\resources\views/seller/menus/form.blade.php ENDPATH**/ ?>