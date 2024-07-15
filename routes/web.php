<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/staff/dashboard', [BookController::class, 'index'])->name('staff.dashboard');
    Route::get('/borrow/all', [BorrowController::class, 'allBorrow'])->name('borrow.all');
});

// web.php


Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

// routes/web.php

Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');



Route::get('/borrow/details/{book_id}', [BorrowController::class, 'showDetails'])->name('borrow.details');
Route::post('/borrow', [BorrowController::class, 'store'])->name('borrow.store');
Route::get('/borrow-status', [BorrowController::class, 'borrowStatus'])->name('borrow.status');
Route::get('/books/{book}/return', [BorrowController::class, 'returnBook'])->name('books.return');

Route::get('/borrow/history', [BorrowController::class, 'history'])->name('borrow.history')->middleware('auth');



require __DIR__.'/auth.php';
