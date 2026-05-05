<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');


Route::get('/', [BookController::class, 'home'])->name('home');

// Košík
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/basket/add/{bookId}', [BasketController::class, 'add'])->name('basket.add');
Route::patch('/basket/update/{bookId}', [BasketController::class, 'update'])->name('basket.update');
Route::delete('/basket/remove/{bookId}', [BasketController::class, 'remove'])->name('basket.remove');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/account', [AccountController::class, 'update'])->name('account.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Order routes — dostupné aj pre neprihlásených
Route::get('/order/customer-info', [OrderController::class, 'customerInfo'])->name('order.customer-info');
Route::post('/order/customer-info', [OrderController::class, 'saveCustomerInfo'])->name('order.save-customer-info');
Route::get('/order/shipping', [OrderController::class, 'shipping'])->name('order.shipping');
Route::post('/order/shipping', [OrderController::class, 'saveShipping'])->name('order.save-shipping');
Route::get('/order/payment', [OrderController::class, 'payment'])->name('order.payment');
Route::post('/order/payment', [OrderController::class, 'savePayment'])->name('order.save-payment');
Route::get('/order/summary', [OrderController::class, 'summary'])->name('order.summary');
Route::post('/order/confirm', [OrderController::class, 'confirm'])->name('order.confirm');

require __DIR__.'/auth.php';

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminBookController;

// Admin routes
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'home'])->name('home');
    Route::get('/books', [AdminBookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [AdminBookController::class, 'create'])->name('books.create');
    Route::post('/books', [AdminBookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}', [AdminBookController::class, 'show'])->name('books.show');
    Route::put('/books/{id}', [AdminBookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [AdminBookController::class, 'destroy'])->name('books.destroy');
});
