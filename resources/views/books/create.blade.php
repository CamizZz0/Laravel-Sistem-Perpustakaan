@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <main class="mx-auto max-w-2xl px-6 py-12">
        <a
            href="{{ route('books.index') }}"
            class="text-blue-600 hover:underline"
        >
            ← Kembali ke daftar buku
        </a>

        <div class="mt-6 rounded-xl bg-white p-8 shadow">
            <h1 class="text-3xl font-bold text-slate-900">
                Tambah Buku
            </h1>

            <form
                action="{{ route('books.store') }}"
                method="POST"
                class="mt-8 space-y-5"
            >
                @csrf

                <div>
                    <label for="title" class="block font-semibold text-slate-700">
                        Judul Buku
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >

                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="author" class="block font-semibold text-slate-700">
                        Penulis
                    </label>

                    <input
                        type="text"
                        id="author"
                        name="author"
                        value="{{ old('author') }}"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >

                    @error('author')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="isbn" class="block font-semibold text-slate-700">
                        ISBN
                    </label>

                    <input
                        type="text"
                        id="isbn"
                        name="isbn"
                        value="{{ old('isbn') }}"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >

                    @error('isbn')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block font-semibold text-slate-700">
                        Stok
                    </label>

                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        value="{{ old('stock', 0) }}"
                        min="0"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >

                    @error('stock')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700"
                >
                    Simpan Buku
                </button>
            </form>
        </div>
    </main>
@endsection