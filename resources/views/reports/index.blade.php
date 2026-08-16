@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

@section('content')
    <main class="mx-auto max-w-7xl px-6 py-12">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Laporan Peminjaman
                </h1>

                <p class="mt-2 text-slate-600">
                    Lihat laporan peminjaman buku perpustakaan.
                </p>
            </div>

        
            <a
                href="{{ route('reports.pdf', request()->query()) }}"
                target="_blank"
                class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700"
            >
                Unduh PDF
            </a>
        </div>

        <form
            action="{{ route('reports.index') }}"
            method="GET"
            class="mt-8 grid gap-4 rounded-xl bg-white p-6 shadow md:grid-cols-4"
        >
            <div>
                <label
                    for="start_date"
                    class="block text-sm font-semibold text-slate-700"
                >
                    Tanggal Mulai
                </label>

                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="{{ request('start_date') }}"
                    class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                >
            </div>

            <div>
                <label
                    for="end_date"
                    class="block text-sm font-semibold text-slate-700"
                >
                    Tanggal Akhir
                </label>

                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    value="{{ request('end_date') }}"
                    class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                >
            </div>

            <div>
                <label
                    for="status"
                    class="block text-sm font-semibold text-slate-700"
                >
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                >
                    <option value="">Semua Status</option>

                    <option
                        value="borrowed"
                        @selected(request('status') === 'borrowed')
                    >
                        Dipinjam
                    </option>

                    <option
                        value="overdue"
                        @selected(request('status') === 'overdue')
                    >
                        Terlambat
                    </option>

                    <option
                        value="returned"
                        @selected(request('status') === 'returned')
                    >
                        Dikembalikan
                    </option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700"
                >
                    Tampilkan
                </button>

                <a
                    href="{{ route('reports.index') }}"
                    class="rounded-lg bg-slate-200 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-300"
                >
                    Reset
                </a>
            </div>
        </form>

        @error('end_date')
            <div class="mt-4 rounded-lg bg-red-100 px-5 py-4 text-red-700">
                {{ $message }}
            </div>
        @enderror

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
                                colspan="7"
                                class="px-6 py-12 text-center text-slate-500"
                            >
                                Data peminjaman tidak ditemukan.
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