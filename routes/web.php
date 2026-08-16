<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;

Route::get('/', function () {
    return view('home');
})->name('home');

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

//Member routes

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

//Loan routes
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