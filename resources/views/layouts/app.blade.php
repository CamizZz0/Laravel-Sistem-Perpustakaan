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
        <nav class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
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
            </div>
        </nav>
    </header>

    @yield('content')
</body>
</html>