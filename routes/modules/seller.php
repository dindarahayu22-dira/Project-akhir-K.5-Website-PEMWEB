<?php

use App\Http\Controllers\Seller\SellerPortalController;
use Illuminate\Support\Facades\Route;

Route::prefix('penjual')->name('seller.')->group(function () {
    Route::get('/', [SellerPortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [SellerPortalController::class, 'dashboard'])->name('dashboard.alt');

    Route::get('/tenant', [SellerPortalController::class, 'tenant'])->name('tenant.index');
    Route::post('/tenant', [SellerPortalController::class, 'updateTenant'])->name('tenant.update');

    Route::get('/menu', [SellerPortalController::class, 'menus'])->name('menus.index');
    Route::get('/menu/tambah', [SellerPortalController::class, 'menuForm'])->name('menus.create');
    Route::get('/menu/{menu}/ubah', [SellerPortalController::class, 'menuForm'])->name('menus.edit');
    Route::post('/menu/simpan', [SellerPortalController::class, 'saveMenu'])->name('menus.store');
    Route::put('/menu/{menu}/simpan', [SellerPortalController::class, 'saveMenu'])->name('menus.update');
    Route::delete('/menu/{menu}', [SellerPortalController::class, 'deleteMenu'])->name('menus.destroy');

    Route::get('/pesanan-masuk', [SellerPortalController::class, 'orders'])->name('orders.index');
    Route::post('/pesanan/{order}/status', [SellerPortalController::class, 'updateOrderStatus'])->name('orders.status');
    Route::get('/pesanan/{order}', [SellerPortalController::class, 'orderDetail'])->name('orders.show');

    Route::get('/riwayat-transaksi', [SellerPortalController::class, 'transactions'])->name('transactions.index');
    Route::get('/notifikasi', [SellerPortalController::class, 'notifications'])->name('notifications.index');
    Route::get('/profil', [SellerPortalController::class, 'profile'])->name('profile.show');
});