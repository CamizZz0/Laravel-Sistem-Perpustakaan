<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

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