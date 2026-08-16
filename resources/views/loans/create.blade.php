@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
    <main class="mx-auto max-w-2xl px-6 py-12">
        <a
            href="{{ route('loans.index') }}"
            class="text-blue-600 hover:underline"
        >
            ← Kembali ke daftar peminjaman
        </a>

        <div class="mt-6 rounded-xl bg-white p-8 shadow">
            <h1 class="text-3xl font-bold text-slate-900">
                Tambah Peminjaman
            </h1>

            @if ($members->isEmpty())
                <div class="mt-6 rounded-lg bg-amber-100 p-4 text-amber-700">
                    Belum ada anggota. Tambahkan anggota terlebih dahulu.
                </div>
            @endif

            @if ($books->isEmpty())
                <div class="mt-6 rounded-lg bg-amber-100 p-4 text-amber-700">
                    Tidak ada buku dengan stok tersedia.
                </div>
            @endif

            <form
                action="{{ route('loans.store') }}"
                method="POST"
                class="mt-8 space-y-5"
            >
                @csrf

                <div>
                    <label for="member_id" class="block font-semibold text-slate-700">
                        Anggota
                    </label>

                    <select
                        id="member_id"
                        name="member_id"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >
                        <option value="">Pilih anggota</option>

                        @foreach ($members as $member)
                            <option
                                value="{{ $member->id }}"
                                @selected(old('member_id') == $member->id)
                            >
                                {{ $member->nim }} — {{ $member->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('member_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="book_id" class="block font-semibold text-slate-700">
                        Buku
                    </label>

                    <select
                        id="book_id"
                        name="book_id"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >
                        <option value="">Pilih buku</option>

                        @foreach ($books as $book)
                            <option
                                value="{{ $book->id }}"
                                @selected(old('book_id') == $book->id)
                            >
                                {{ $book->title }} — stok {{ $book->stock }}
                            </option>
                        @endforeach
                    </select>

                    @error('book_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="loan_date" class="block font-semibold text-slate-700">
                        Tanggal Peminjaman
                    </label>

                    <input
                        type="date"
                        id="loan_date"
                        name="loan_date"
                        value="{{ old('loan_date', now()->format('Y-m-d')) }}"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >

                    @error('loan_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="due_date" class="block font-semibold text-slate-700">
                        Tanggal Jatuh Tempo
                    </label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date', now()->addDays(7)->format('Y-m-d')) }}"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >

                    @error('due_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    @disabled($members->isEmpty() || $books->isEmpty())
                    class="w-full rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-slate-400"
                >
                    Simpan Peminjaman
                </button>
            </form>
        </div>
    </main>
@endsection