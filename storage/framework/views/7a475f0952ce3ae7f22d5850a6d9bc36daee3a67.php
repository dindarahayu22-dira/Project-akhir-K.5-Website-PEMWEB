<?php $__env->startSection('title', 'Riwayat Transaksi · KantinGo'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .tx-wrap {
        max-width: 1020px;
        width: 100%;
    }

    .tx-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .tx-kpi-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 18px;
    }

    .tx-kpi-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        padding: 16px 18px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    }

    .tx-table-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 18px;
        padding: 16px 18px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    }

    .tx-filter-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
        flex-wrap: wrap;
    }

    .tx-filter-pills {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .tx-pill-btn {
        border: none;
        background: transparent;
        color: #6b7280;
        font-size: 11.5px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        cursor: pointer;
    }

    .tx-pill-btn.is-active {
        background: #ffedd5;
        color: #ea580c;
    }

    .tx-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12.5px;
        min-width: 700px;
    }

    .tx-table th {
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: #9ca3af;
        padding: 10px 8px;
        border-bottom: 1px solid #f1f5f9;
        white-space: nowrap;
    }

    .tx-table td {
        padding: 12px 8px;
        border-bottom: 1px solid #f8fafc;
        color: #111827;
        vertical-align: middle;
    }

    .tx-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #ffedd5;
        color: #ea580c;
        font-size: 10.5px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 8px;
        flex-shrink: 0;
    }

    .tx-st {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
        display: inline-block;
        background: #f1f5f9;
        color: #475569;
        white-space: nowrap;
    }

    .tx-st.done {
        background: #dcfce7;
        color: #15803d;
    }

    .tx-st.processing {
        background: #ffedd5;
        color: #ea580c;
    }

    .tx-st.cancelled {
        background: #fee2e2;
        color: #dc2626;
    }

    .tx-table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .tx-kpi-label {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 8px;
    }

    .tx-kpi-value {
        font-size: 22px;
        font-weight: 800;
        color: #111827;
    }

    .tx-kpi-note {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 5px;
    }

    .tx-empty {
        padding: 30px;
        text-align: center;
        color: #6b7280;
    }

    @media (max-width: 900px) {
        .tx-kpi-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 520px) {
        .tx-table-card {
            padding: 14px 12px;
        }

        .tx-head h1 {
            font-size: 23px !important;
        }

        .tx-kpi-value {
            font-size: 20px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php
    // BAGIAN REVISI: Menghitung ringkasan transaksi
    $transactionList = $orders ?? collect();

    $totalTransactions = $transactionList->count();

    $completedTransactions = $transactionList
        ->where('status', 'completed');

    $totalCompleted = $completedTransactions->count();

    $totalIncome = $completedTransactions->sum('total');
?>

<div class="tx-wrap">

    <div class="tx-head">
        <div>
            <h1 style="font-size:28px;font-weight:800;margin:0 0 6px;color:#111827;">
                Riwayat Transaksi
            </h1>

            <p style="color:#6b7280;margin:0;font-size:13.5px;">
                Transaksi dari pesanan di kantin Anda.
            </p>
        </div>
    </div>

    <div class="tx-kpi-grid">

        <div class="tx-kpi-card">
            <div class="tx-kpi-label">
                Total Transaksi
            </div>

            <div class="tx-kpi-value">
                <?php echo e($totalTransactions); ?>

            </div>

            <div class="tx-kpi-note">
                Seluruh pesanan yang tercatat
            </div>
        </div>

        <div class="tx-kpi-card">
            <div class="tx-kpi-label">
                Transaksi Selesai
            </div>

            <div class="tx-kpi-value">
                <?php echo e($totalCompleted); ?>

            </div>

            <div class="tx-kpi-note">
                Pesanan dengan status selesai
            </div>
        </div>

        <div class="tx-kpi-card">
            <div class="tx-kpi-label">
                Total Pendapatan
            </div>

            <div class="tx-kpi-value">
                Rp <?php echo e(number_format($totalIncome, 0, ',', '.')); ?>

            </div>

            <div class="tx-kpi-note">
                Dari pesanan yang sudah selesai
            </div>
        </div>

    </div>

    <div class="tx-table-card">

        <div class="tx-filter-bar">
            <div>
                <strong style="font-size:15px;color:#111827;">
                    Daftar Transaksi
                </strong>

                <p style="font-size:11.5px;color:#9ca3af;margin:4px 0 0;">
                    Riwayat pesanan yang masuk ke kantin Anda.
                </p>
            </div>

            <div class="tx-filter-pills">
                <button type="button"
                        class="tx-pill-btn is-active"
                        data-filter="all">
                    Semua
                </button>

                <button type="button"
                        class="tx-pill-btn"
                        data-filter="completed">
                    Selesai
                </button>

                <button type="button"
                        class="tx-pill-btn"
                        data-filter="processing">
                    Diproses
                </button>

                <button type="button"
                        class="tx-pill-btn"
                        data-filter="cancelled">
                    Dibatalkan
                </button>
            </div>
        </div>

        <div class="tx-table-responsive">
            <table class="tx-table">

                <thead>
                    <tr>
                        <th>Pesanan</th>
                        <th>Pembeli</th>
                        <th>Tanggal</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody id="tx-table-body">

                    <?php $__empty_1 = true; $__currentLoopData = $transactionList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <?php
                            $orderStatus = $order->status;

                            $statusLabels = [
                                'new' => 'Menunggu',
                                'processing' => 'Diproses',
                                'ready' => 'Siap diambil',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ];

                            $statusLabel = $statusLabels[$orderStatus]
                                ?? ucfirst($orderStatus);

                            $statusClass = match($orderStatus) {
                                'completed' => 'done',
                                'processing', 'ready' => 'processing',
                                'cancelled' => 'cancelled',
                                default => '',
                            };

                            $filterStatus = match($orderStatus) {
                                'completed' => 'completed',
                                'processing', 'ready', 'new' => 'processing',
                                'cancelled' => 'cancelled',
                                default => 'other',
                            };

                            $buyerName = $order->user->name ?? 'Pembeli';

                            $buyerInitial = strtoupper(
                                substr($buyerName, 0, 1)
                            );
                        ?>

                        <tr data-status="<?php echo e($filterStatus); ?>">

                            <td>
                                <strong>
                                    #<?php echo e($order->order_number); ?>

                                </strong>
                            </td>

                            <td>
                                <div style="display:flex;align-items:center;white-space:nowrap;">
                                    <span class="tx-avatar">
                                        <?php echo e($buyerInitial); ?>

                                    </span>

                                    <?php echo e($buyerName); ?>

                                </div>
                            </td>

                            <td>
                                <?php echo e($order->created_at->format('d M Y')); ?>

                            </td>

                            <td>
                                <?php echo e(ucfirst($order->payment->status ?? 'pending')); ?>

                            </td>

                            <td>
                                <span class="tx-st <?php echo e($statusClass); ?>">
                                    <?php echo e($statusLabel); ?>

                                </span>
                            </td>

                            <td style="font-weight:700;white-space:nowrap;">
                                Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="6" class="tx-empty">
                                Belum ada transaksi.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>
            </table>
        </div>

        <p id="tx-filter-empty"
           style="display:none;text-align:center;color:#6b7280;font-size:12px;padding:20px;">
            Tidak ada transaksi dengan status tersebut.
        </p>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('.tx-pill-btn');
        const transactionRows = document.querySelectorAll('#tx-table-body tr[data-status]');
        const emptyMessage = document.getElementById('tx-filter-empty');

        filterButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const selectedFilter = this.dataset.filter;
                let visibleCount = 0;

                filterButtons.forEach(function (item) {
                    item.classList.remove('is-active');
                });

                this.classList.add('is-active');

                transactionRows.forEach(function (row) {
                    const rowStatus = row.dataset.status;

                    const shouldShow =
                        selectedFilter === 'all' ||
                        selectedFilter === rowStatus;

                    row.style.display = shouldShow ? '' : 'none';

                    if (shouldShow) {
                        visibleCount++;
                    }
                });

                if (emptyMessage) {
                    emptyMessage.style.display =
                        visibleCount === 0 ? 'block' : 'none';
                }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\WINDOWS 11\Herd\katingox\resources\views/seller/transactions.blade.php ENDPATH**/ ?>