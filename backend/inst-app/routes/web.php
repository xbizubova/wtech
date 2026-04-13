<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BasketController;

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');


Route::get('/', [BookController::class, 'home'])->name('home');

// Košík
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::get('/basket/add/{bookId}', [BasketController::class, 'add'])->name('basket.add');
Route::patch('/basket/update/{bookId}', [BasketController::class, 'update'])->name('basket.update');
Route::delete('/basket/remove/{bookId}', [BasketController::class, 'remove'])->name('basket.remove');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
