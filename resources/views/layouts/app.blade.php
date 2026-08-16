<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistem Perpustakaan')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100">
    <header class="border-b border-slate-200 bg-white shadow-sm">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <a
                href="{{ route('home') }}"
                class="text-xl font-bold text-blue-600"
            >
                Perpustakaan
            </a>

            <div class="flex items-center gap-6">
                <a
                    href="{{ route('home') }}"
                    class="{{ request()->routeIs('home')
                        ? 'font-semibold text-blue-600'
                        : 'text-slate-600 hover:text-blue-600' }}"
                >
                    Beranda
                </a>

                <a
                    href="{{ route('books.index') }}"
                    class="{{ request()->routeIs('books.*')
                        ? 'font-semibold text-blue-600'
                        : 'text-slate-600 hover:text-blue-600' }}"
                >
                    Buku
                </a>

                <a
                    href="{{ route('members.index') }}"
                    class="{{ request()->routeIs('members.*')
                        ? 'font-semibold text-blue-600'
                        : 'text-slate-600 hover:text-blue-600' }}"
                >
                    Anggota
                </a>

                <a
                    href="{{ route('loans.index') }}"
                    class="{{ request()->routeIs('loans.*')
                        ? 'font-semibold text-blue-600'
                        : 'text-slate-600 hover:text-blue-600' }}"
                >
                    Peminjaman
                </a>

                <a
                    href="{{ route('reports.index') }}"
                    class="{{ request()->routeIs('reports.*')
                        ? 'font-semibold text-blue-600'
                        : 'text-slate-600 hover:text-blue-600' }}"
                >
                    Laporan
                </a>

                @auth
                    <div class="flex items-center gap-3 border-l border-slate-200 pl-6">
                        <span class="text-sm text-slate-600">
                            {{ auth()->user()->name }}
                        </span>

                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="text-sm font-semibold text-red-600 hover:text-red-700"
                            >
                                Keluar
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </nav>
    </header>

    @yield('content')
</body>
</html>