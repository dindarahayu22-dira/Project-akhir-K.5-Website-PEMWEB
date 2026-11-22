<?php

use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\OrderHistoryController;
use App\Http\Controllers\Buyer\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route Riwayat & Ulasan
Route::get('/riwayat', [OrderHistoryController::class, 'index'])->name('orders.index');
Route::post('/riwayat/{order}/pesan-lagi', [OrderHistoryController::class, 'reorder'])->name('orders.reorder');

Route::get('/riwayat/{order}/ulasan', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/riwayat/{order}/ulasan', [ReviewController::class, 'store'])->name('reviews.store');

// Route Keranjang
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang', [CartController::class, 'store'])->name('cart.store');
Route::patch('/keranjang/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

// Route Checkout
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.checkout.process');

// Route Update Profil
Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');