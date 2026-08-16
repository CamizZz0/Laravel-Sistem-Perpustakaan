@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
    <main class="mx-auto max-w-7xl px-6 py-12">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Daftar Peminjaman
                </h1>

                <p class="mt-2 text-slate-600">
                    Kelola transaksi peminjaman dan pengembalian buku.
                </p>
            </div>

            <a
                href="{{ route('loans.create') }}"
                class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700"
            >
                + Tambah Peminjaman
            </a>
        </div>

        @if (session('success'))
            <div class="mt-6 rounded-lg border border-green-200 bg-green-100 px-5 py-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mt-6 rounded-lg border border-red-200 bg-red-100 px-5 py-4 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-8 overflow-x-auto rounded-xl bg-white shadow">
            <table class="w-full text-left">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-5 py-4">No.</th>
                        <th class="px-5 py-4">Anggota</th>
                        <th class="px-5 py-4">Buku</th>
                        <th class="px-5 py-4">Tanggal Pinjam</th>
                        <th class="px-5 py-4">Jatuh Tempo</th>
                        <th class="px-5 py-4">Tanggal Kembali</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($loans as $loan)
                        <tr class="border-b border-slate-200 hover:bg-slate-50">
                            <td class="px-5 py-4">
                                {{ $loans->firstItem() + $loop->index }}
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-semibold text-slate-900">
                                    {{ $loan->member->name }}
                                </p>

                                <p class="text-sm text-slate-500">
                                    {{ $loan->member->nim }}
                                </p>
                            </td>

                            <td class="px-5 py-4">
                                {{ $loan->book->title }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $loan->loan_date->format('d-m-Y') }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $loan->due_date->format('d-m-Y') }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $loan->return_date?->format('d-m-Y') ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                @if ($loan->status === 'returned')
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">
                                        Dikembalikan
                                    </span>
                                @elseif ($loan->due_date->lt(today()))
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                                        Terlambat
                                    </span>
                                @else
                                    <span class="rounded-full bg-amber-100 px-3 py-1 text-sm font-semibold text-amber-700">
                                        Dipinjam
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                @if ($loan->status === 'borrowed')
                                    <form
                                        action="{{ route('loans.return', $loan) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700"
                                        >
                                            Kembalikan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-sm text-slate-500">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="8"
                                class="px-6 py-12 text-center text-slate-500"
                            >
                                Belum ada transaksi peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($loans->hasPages())
            <div class="mt-6">
                {{ $loans->links() }}
            </div>
        @endif
    </main>
@endsection