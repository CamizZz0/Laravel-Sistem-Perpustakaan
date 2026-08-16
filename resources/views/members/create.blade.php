@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
    <main class="mx-auto max-w-2xl px-6 py-12">
        <a
            href="{{ route('members.index') }}"
            class="text-blue-600 hover:underline"
        >
            ← Kembali ke daftar anggota
        </a>

        <div class="mt-6 rounded-xl bg-white p-8 shadow">
            <h1 class="text-3xl font-bold text-slate-900">
                Tambah Anggota
            </h1>

            <form
                action="{{ route('members.store') }}"
                method="POST"
                class="mt-8 space-y-5"
            >
                @csrf

                <div>
                    <label for="nim" class="block font-semibold text-slate-700">
                        NIM
                    </label>

                    <input
                        type="text"
                        id="nim"
                        name="nim"
                        value="{{ old('nim') }}"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >

                    @error('nim')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="name" class="block font-semibold text-slate-700">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block font-semibold text-slate-700">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >

                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="major" class="block font-semibold text-slate-700">
                        Program Studi
                    </label>

                    <input
                        type="text"
                        id="major"
                        name="major"
                        value="{{ old('major') }}"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >

                    @error('major')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block font-semibold text-slate-700">
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >

                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block font-semibold text-slate-700">
                        Alamat
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="4"
                        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"
                    >{{ old('address') }}</textarea>

                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700"
                >
                    Simpan Anggota
                </button>
            </form>
        </div>
    </main>
@endsection