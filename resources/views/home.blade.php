@extends('layouts.app')

@section('title', 'Beranda - Sistem Perpustakaan')

@section('content')
    <main class="mx-auto max-w-5xl px-6 py-20">
        <div class="rounded-2xl bg-white p-10 shadow-lg">
            <p class="mb-2 font-semibold text-blue-600">
                Selamat Datang
            </p>

            <h1 class="text-4xl font-bold text-slate-900">
                Sistem Perpustakaan
            </h1>

            <p class="mt-4 max-w-2xl text-slate-600">
                Aplikasi untuk mengelola buku, anggota, dan transaksi
                peminjaman buku.
            </p>

            <a
                href="{{ route('books.index') }}"
                class="mt-8 inline-block rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700"
            >
                Lihat Daftar Buku
            </a>
        </div>
    </main>
@endsection