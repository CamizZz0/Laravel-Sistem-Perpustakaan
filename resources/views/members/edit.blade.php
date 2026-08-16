@extends('layouts.app')

@section('title', 'Edit Anggota')

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
                Edit Anggota
            </h1>

            <form
                action="{{ route('members.update', $member) }}"
                method="POST"
                class="mt-8 space-y-5"
            >
                @csrf
                @method('PUT')

                <div>
                    <label for="nim" class="block font-semibold text-slate-700">
                        NIM
                    </label>

                    <input
                        type="text"
                        id="nim"
                        name="nim"
                        value="{{ old('nim', $member->nim) }}"
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
                        value="{{ old('name', $member->name) }}"
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
                        value="{{ old('email', $member->email) }}"
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
                        value="{{ old('major', $member->major) }}"
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
                        value="{{ old('phone', $member->phone) }}"
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
                    >{{ old('address', $member->address) }}</textarea>

                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full rounded-lg bg-amber-500 px-5 py-3 font-semibold text-white hover:bg-amber-600"
                >
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </main>
@endsection