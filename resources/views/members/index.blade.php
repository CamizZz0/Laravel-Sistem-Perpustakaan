@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
    <main class="mx-auto max-w-6xl px-6 py-12">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Daftar Anggota
                </h1>

                <p class="mt-2 text-slate-600">
                    Kelola data anggota perpustakaan.
                </p>
            </div>

            <a
                href="{{ route('members.create') }}"
                class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700"
            >
                + Tambah Anggota
            </a>
        </div>

        @if (session('success'))
            <div class="mt-6 rounded-lg border border-green-200 bg-green-100 px-5 py-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form
            action="{{ route('members.index') }}"
            method="GET"
            class="mt-6 flex gap-3"
        >
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Cari NIM, nama, atau program studi..."
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
                    href="{{ route('members.index') }}"
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
                        <th class="px-6 py-4">NIM</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Program Studi</th>
                        <th class="px-6 py-4">Telepon</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($members as $member)
                        <tr class="border-b border-slate-200 hover:bg-slate-50">
                            <td class="px-6 py-4">
                                {{ $members->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $member->nim }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-900">
                                {{ $member->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $member->major }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $member->phone ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <a
                                        href="{{ route('members.edit', $member) }}"
                                        class="rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('members.destroy', $member) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-600 px-4 py-2 font-semibold text-white hover:bg-red-700"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="6"
                                class="px-6 py-12 text-center text-slate-500"
                            >
                                @if ($search)
                                    Anggota dengan kata kunci “{{ $search }}” tidak ditemukan.
                                @else
                                    Belum ada anggota yang tersimpan.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($members->hasPages())
            <div class="mt-6">
                {{ $members->links() }}
            </div>
        @endif
    </main>
@endsection