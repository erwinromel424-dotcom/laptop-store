<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CustomerOrderController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Halaman Katalog & Detail Produk (Publik)
Route::get('/katalog', [FrontController::class, 'catalog'])->name('catalog');
Route::get('/katalog/{product:slug}', [FrontController::class, 'show'])->name('product.show');

Route::get('/tentang-kami', function () {
    return view('about');
});

Route::get('/kontak', function () {
    return view('contact');
})->name('contact');

// Customer dashboard (Authenticated users)
Route::middleware(['auth'])->group(function () {

    // Keranjang Belanja
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/add', [CartController::class, 'store'])->name('cart.store');
    Route::put('/keranjang/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/keranjang/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout Transaksi
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // Halaman Sukses
    Route::get('/checkout/success/{order_number}', [CheckoutController::class, 'success'])->name('checkout.success');
    // Route khusus untuk handle upload bukti pembayaran (POST)
    Route::post('/checkout/upload-proof/{order_id}', [CheckoutController::class, 'uploadProof'])->name('checkout.uploadProof');

    Route::get('/pesanan', [CustomerOrderController::class, 'index'])->name('customer.orders');
    Route::get('/pesanan/{order_number}', [CustomerOrderController::class, 'show'])->name('customer.orders.show');
    Route::get('/pesanan/{id}/invoice', [CustomerOrderController::class, 'downloadInvoice'])->name('customer.orders.invoice');
    Route::post('/pesanan/{id}/cancel', [CheckoutController::class, 'cancelOrder'])->name('customer.orders.cancel');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export-pdf', [DashboardController::class, 'exportPDF'])->name('dashboard.pdf');

    // Route CRUD Products
    Route::resource('products', ProductController::class);
    // Route CRUD Categories
    Route::resource('categories', CategoryController::class)->except('show');
    // Route CRUD Users
    Route::resource('users', UserController::class);
    Route::put('/users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    // Route CRUD Orders
    // Route untuk export PDF daftar pesanan
    Route::get('/orders/export-pdf', [OrderController::class, 'exportPDF'])->name('orders.pdf');
    Route::get('/orders/{id}/invoice-pdf', [OrderController::class, 'exportDetailPDF'])->name('orders.detail.pdf');
    // Route resource untuk manajemen pesanan (index, show, update, destroy)
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::post('orders/{order}/confirm-payment', [OrderController::class, 'confirmPayment'])->name('orders.confirm-payment');
});

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Alamat
    Route::post('/address', [AddressController::class, 'store'])->name('address.store');
    Route::put('/address/{id}', [AddressController::class, 'update'])->name('address.update');
    Route::put('/address/{id}/primary', [AddressController::class, 'setPrimary'])->name('address.setPrimary');
    Route::delete('/address/{id}', [AddressController::class, 'destroy'])->name('address.destroy');
});

require __DIR__ . '/auth.php';
