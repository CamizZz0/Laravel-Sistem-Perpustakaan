@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <main class="mx-auto max-w-6xl px-6 py-12">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Daftar Buku
                </h1>

                <p class="mt-2 text-slate-600">
                    Kelola seluruh data buku perpustakaan.
                </p>
            </div>

            <a
                href="{{ route('books.create') }}"
                class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700"
            >
                + Tambah Buku
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

        <form
    action="{{ route('books.index') }}"
    method="GET"
    class="mt-6 flex gap-3"
>
    <input
        type="text"
        name="search"
        value="{{ $search }}"
        placeholder="Cari judul, penulis, atau ISBN..."
        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500"
    >

    <button
        type="submit"
        class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700"
    >
        Cari
    </button>

    @if ($search)
        <a
            href="{{ route('books.index') }}"
            class="rounded-lg bg-slate-500 px-6 py-3 font-semibold text-white hover:bg-slate-600"
        >
            Reset
        </a>
    @endif
</form>

        <div class="mt-8 overflow-x-auto rounded-xl bg-white shadow">
            <table class="w-full text-left">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-4">No.</th>
                        <th class="px-6 py-4">Judul</th>
                        <th class="px-6 py-4">Penulis</th>
                        <th class="px-6 py-4">ISBN</th>
                        <th class="px-6 py-4">Stok</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($books as $book)
                        <tr class="border-b border-slate-200 hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-600">
                                {{ $books->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-900">
                                {{ $book->title }}
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                {{ $book->author }}
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                {{ $book->isbn ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($book->stock > 0)
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">
                                        {{ $book->stock }} tersedia
                                    </span>
                                @else
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                                        Stok habis
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="{{ route('books.edit', $book) }}"
                                        class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-600"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('books.destroy', $book) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah kamu yakin ingin menghapus buku ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                                @if ($books->hasPages())
    <div class="mt-6">
        {{ $books->links() }}
    </div>
@endif
                            </td>
                        </tr>
                        @empty
    <tr>
        <td
            colspan="6"
            class="px-6 py-12 text-center text-slate-500"
        >
            @if ($search)
                Buku dengan kata kunci “{{ $search }}” tidak ditemukan.
            @else
                Belum ada buku yang tersimpan.
            @endif
        </td>
    </tr>
@endforelse
                </tbody>
            </table>
        </div>
    </main>
@endsection