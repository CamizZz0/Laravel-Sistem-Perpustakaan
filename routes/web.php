<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

//Route Pengguna yang belum login

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

//Login Route

Route::middleware('auth')->group(function () {

//Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('home');

//Book Route

    Route::get('/buku', [BookController::class, 'index'])
        ->name('books.index');

    Route::get('/buku/tambah', [BookController::class, 'create'])
        ->name('books.create');

    Route::post('/buku', [BookController::class, 'store'])
        ->name('books.store');

    Route::get('/buku/{book}/edit', [BookController::class, 'edit'])
        ->name('books.edit');

    Route::put('/buku/{book}', [BookController::class, 'update'])
        ->name('books.update');

    Route::delete('/buku/{book}', [BookController::class, 'destroy'])
        ->name('books.destroy');

// Anggota Route

    Route::get('/anggota', [MemberController::class, 'index'])
        ->name('members.index');

    Route::get('/anggota/tambah', [MemberController::class, 'create'])
        ->name('members.create');

    Route::post('/anggota', [MemberController::class, 'store'])
        ->name('members.store');

    Route::get('/anggota/{member}/edit', [MemberController::class, 'edit'])
        ->name('members.edit');

    Route::put('/anggota/{member}', [MemberController::class, 'update'])
        ->name('members.update');

    Route::delete('/anggota/{member}', [MemberController::class, 'destroy'])
        ->name('members.destroy');

// Peminjaman Route
    Route::get('/peminjaman', [LoanController::class, 'index'])
        ->name('loans.index');

    Route::get('/peminjaman/tambah', [LoanController::class, 'create'])
        ->name('loans.create');

    Route::post('/peminjaman', [LoanController::class, 'store'])
        ->name('loans.store');

    Route::patch(
        '/peminjaman/{loan}/kembalikan',
        [LoanController::class, 'returnBook']
    )->name('loans.return');

// Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});