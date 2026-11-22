<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\CheckoutController;
use App\Http\Controllers\Buyer\HomeController;
use App\Http\Controllers\Buyer\MenuController;
use App\Http\Controllers\Buyer\NotificationController;
use App\Http\Controllers\Buyer\OrderHistoryController;
use App\Http\Controllers\Buyer\PaymentController;
use App\Http\Controllers\Buyer\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\SellerPortalController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/',fn()=>auth()->check()?redirect(auth()->user()->isSeller()?'/seller':'/home'):redirect()->route('login'));
Route::middleware('guest')->group(function(){Route::get('/login',[AuthController::class,'showLogin'])->name('login');Route::post('/login',[AuthController::class,'login']);Route::get('/register',[AuthController::class,'showRegister'])->name('register');Route::post('/register',[AuthController::class,'register']);});
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth')->name('logout');
Route::middleware(['auth',RoleMiddleware::class.':buyer'])->name('buyer.')->group(function(){
 Route::get('/home',[HomeController::class,'index'])->name('home'); Route::get('/menu',[MenuController::class,'index'])->name('menu.index'); Route::get('/menu/{menu}',[MenuController::class,'show'])->name('menu.show');
 Route::get('/keranjang',[CartController::class,'index'])->name('cart.index'); Route::post('/keranjang/tambah/{menu}',[CartController::class,'add'])->name('cart.add'); Route::post('/keranjang',[CartController::class,'store'])->name('cart.store'); Route::patch('/keranjang/{item}',[CartController::class,'update'])->name('cart.update'); Route::delete('/keranjang/{item}',[CartController::class,'destroy'])->name('cart.destroy');
 Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout.index'); Route::post('/checkout',[CheckoutController::class,'store'])->name('checkout.store');
 Route::get('/pesanan',[CheckoutController::class,'index'])->name('checkout.legacy'); Route::post('/pesanan',[CheckoutController::class,'store'])->name('checkout.legacy.store');
 Route::get('/pembayaran',[PaymentController::class,'index'])->name('payment.index'); Route::get('/pembayaran/{order}',[PaymentController::class,'show'])->name('payment.show'); Route::post('/pembayaran/{order}',[PaymentController::class,'pay'])->name('payment.pay'); Route::post('/pembayaran/{order}/batal',[PaymentController::class,'cancel'])->name('payment.cancel');
 Route::get('/riwayat',[OrderHistoryController::class,'index'])->name('orders.index'); Route::post('/riwayat/{order}/pesan-lagi',[OrderHistoryController::class,'reorder'])->name('orders.reorder'); Route::get('/riwayat/{order}/ulasan',[ReviewController::class,'create'])->name('reviews.create'); Route::post('/riwayat/{order}/ulasan',[ReviewController::class,'store'])->name('reviews.store');
 Route::get('/notifikasi',[NotificationController::class,'index'])->name('notifications.index'); Route::post('/notifikasi/baca',[NotificationController::class,'readAll'])->name('notifications.read'); Route::get('/profil',[ProfileController::class,'show'])->name('profile.show'); Route::patch('/profil',[ProfileController::class,'update'])->name('profile.update');
});
Route::middleware(['auth',RoleMiddleware::class.':seller'])->prefix('seller')->name('seller.')->group(function(){
 Route::get('/',[SellerPortalController::class,'dashboard'])->name('dashboard'); Route::get('/tenant',[SellerPortalController::class,'tenant'])->name('tenant'); Route::post('/tenant',[SellerPortalController::class,'updateTenant'])->name('tenant.update');
 Route::get('/menu',[SellerPortalController::class,'menus'])->name('menus.index'); Route::get('/menu/tambah',[SellerPortalController::class,'menuForm'])->name('menus.create'); Route::get('/menu/{menu}/ubah',[SellerPortalController::class,'menuForm'])->name('menus.edit'); Route::post('/menu/simpan',[SellerPortalController::class,'saveMenu'])->name('menus.store'); Route::put('/menu/{menu}/simpan',[SellerPortalController::class,'saveMenu'])->name('menus.update'); Route::delete('/menu/{menu}',[SellerPortalController::class,'deleteMenu'])->name('menus.destroy');
 Route::get('/pesanan',[SellerPortalController::class,'orders'])->name('orders.index'); Route::get('/pesanan/{order}',[SellerPortalController::class,'orderDetail'])->name('orders.show'); Route::patch('/pesanan/{order}/status',[SellerPortalController::class,'updateOrderStatus'])->name('orders.update'); Route::post('/pesanan/{order}/status',[SellerPortalController::class,'updateOrderStatus'])->name('orders.status');
 Route::get('/transaksi',[SellerPortalController::class,'transactions'])->name('transaksi'); Route::get('/notifikasi',[SellerPortalController::class,'notifications'])->name('notifikasi'); Route::get('/profil',[SellerPortalController::class,'profile'])->name('profil');
});
