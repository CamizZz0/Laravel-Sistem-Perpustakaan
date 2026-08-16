@extends('layouts.app')

@section('title', 'Dashboard Perpustakaan')

@section('content')
    <main class="mx-auto max-w-7xl px-6 py-12">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Dashboard Perpustakaan
            </h1>

            <p class="mt-2 text-slate-600">
                Ringkasan data dan aktivitas sistem perpustakaan.
            </p>
        </div>

        <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            <div class="rounded-xl bg-blue-600 p-6 text-white shadow">
                <p class="text-sm font-semibold text-blue-100">
                    Jumlah Judul Buku
                </p>

                <p class="mt-3 text-4xl font-bold">
                    {{ $totalBooks }}
                </p>
            </div>

            <div class="rounded-xl bg-indigo-600 p-6 text-white shadow">
                <p class="text-sm font-semibold text-indigo-100">
                    Total Stok Buku
                </p>

                <p class="mt-3 text-4xl font-bold">
                    {{ $totalStock }}
                </p>
            </div>

            <div class="rounded-xl bg-violet-600 p-6 text-white shadow">
                <p class="text-sm font-semibold text-violet-100">
                    Jumlah Anggota
                </p>

                <p class="mt-3 text-4xl font-bold">
                    {{ $totalMembers }}
                </p>
            </div>

            <div class="rounded-xl bg-amber-500 p-6 text-white shadow">
                <p class="text-sm font-semibold text-amber-100">
                    Sedang Dipinjam
                </p>

                <p class="mt-3 text-4xl font-bold">
                    {{ $activeLoans }}
                </p>
            </div>

            <div class="rounded-xl bg-red-600 p-6 text-white shadow">
                <p class="text-sm font-semibold text-red-100">
                    Terlambat
                </p>

                <p class="mt-3 text-4xl font-bold">
                    {{ $overdueLoans }}
                </p>
            </div>

            <div class="rounded-xl bg-slate-700 p-6 text-white shadow">
                <p class="text-sm font-semibold text-slate-200">
                    Stok Habis
                </p>

                <p class="mt-3 text-4xl font-bold">
                    {{ $outOfStockBooks }}
                </p>
            </div>
        </div>

        <section class="mt-10">
            <h2 class="text-xl font-bold text-slate-900">
                Aksi Cepat
            </h2>

            <div class="mt-4 flex flex-wrap gap-3">
                <a
                    href="{{ route('books.create') }}"
                    class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700"
                >
                    + Tambah Buku
                </a>

                <a
                    href="{{ route('members.create') }}"
                    class="rounded-lg bg-violet-600 px-5 py-3 font-semibold text-white hover:bg-violet-700"
                >
                    + Tambah Anggota
                </a>

                <a
                    href="{{ route('loans.create') }}"
                    class="rounded-lg bg-amber-500 px-5 py-3 font-semibold text-white hover:bg-amber-600"
                >
                    + Tambah Peminjaman
                </a>
            </div>
        </section>

        <section class="mt-10">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-slate-900">
                    Peminjaman Terbaru
                </h2>

                <a
                    href="{{ route('loans.index') }}"
                    class="text-sm font-semibold text-blue-600 hover:underline"
                >
                    Lihat Semua
                </a>
            </div>

            <div class="mt-4 overflow-x-auto rounded-xl bg-white shadow">
                <table class="w-full text-left">
                    <thead class="bg-slate-800 text-white">
                        <tr>
                            <th class="px-5 py-4">Anggota</th>
                            <th class="px-5 py-4">Buku</th>
                            <th class="px-5 py-4">Tanggal</th>
                            <th class="px-5 py-4">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($recentLoans as $loan)
                            <tr class="border-b border-slate-200">
                                <td class="px-5 py-4">
                                    {{ $loan->member->name }}
                                </td>

                                <td class="px-5 py-4">
                                    {{ $loan->book->title }}
                                </td>

                                <td class="px-5 py-4">
                                    {{ $loan->loan_date->format('d-m-Y') }}
                                </td>

                                <td class="px-5 py-4">
                                    @if ($loan->status === 'returned')
                                        <span class="font-semibold text-green-600">
                                            Dikembalikan
                                        </span>
                                    @elseif ($loan->due_date->lt(today()))
                                        <span class="font-semibold text-red-600">
                                            Terlambat
                                        </span>
                                    @else
                                        <span class="font-semibold text-amber-600">
                                            Dipinjam
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td
                                    colspan="4"
                                    class="px-6 py-10 text-center text-slate-500"
                                >
                                    Belum ada transaksi peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
@endsection