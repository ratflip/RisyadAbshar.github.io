<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pelanggan\KateringController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes - Rute Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [KateringController::class, 'landingPage'])->name('pelanggan.landing');
Route::get('/katalog', [KateringController::class, 'katalog'])->name('pelanggan.katalog');
Route::get('/katalog/{slug}', [KateringController::class, 'detail'])->name('pelanggan.katalog.detail');
Route::post('/midtrans-callback', [PaymentController::class, 'callback'])->name('midtrans.callback');

/*
|--------------------------------------------------------------------------
| Autentikasi / Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Pelanggan)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Proses Order
    Route::get('/order/{id?}', [OrderController::class, 'showPage'])->name('pelanggan.order');
    Route::post('/order/proses', [OrderController::class, 'prosesOrder'])->name('pelanggan.order.proses');
    

    
    // Halaman Pembayaran (Token Midtrans)
    // Tambahkan route ini ke dalam group middleware auth yang sudah ada --
 
    // Halaman Pembayaran Manual
    Route::get('/pembayaran/{id}', [OrderController::class, 'pembayaran'])->name('pelanggan.pembayaran');
    Route::post('/pembayaran/{id}/upload', [OrderController::class, 'uploadBukti'])->name('pelanggan.pembayaran.upload');
    Route::get('/pembayaran/detail/{id}', [OrderController::class, 'detailPesanan'])->name('pelanggan.pembayaran.detail');
    // Keranjang & Rating
    Route::post('/keranjang/tambah/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/keranjang/hapus/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/katalog/{id}/rate', [KateringController::class, 'simpanRating'])->name('pelanggan.katalog.rate');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/manajemen-menu', [AdminController::class, 'menu'])->name('menu');
    Route::post('/manajemen-menu', [AdminController::class, 'storeMenu'])->name('menu.store');
    Route::put('/manajemen-menu/{id}', [AdminController::class, 'updateMenu'])->name('menu.update');
    Route::delete('/manajemen-menu/{id}', [AdminController::class, 'destroyMenu'])->name('menu.destroy');
    Route::patch('/manajemen-menu/{id}/toggle', [AdminController::class, 'toggleStatus'])->name('menu.toggle');
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
    Route::patch('/laporan/{id}/status', [AdminController::class, 'updateStatus'])->name('laporan.updateStatus');
    Route::get('/laporan/ekspor', [AdminController::class, 'eksporCsv'])->name('laporan.ekspor');
});

