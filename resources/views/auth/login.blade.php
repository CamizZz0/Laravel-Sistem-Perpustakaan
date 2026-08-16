<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen items-center justify-center bg-slate-100 px-6">
    <div class="w-full max-w-md rounded-2xl bg-white p-8 shadow-xl">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-slate-900">
                Login Admin
            </h1>

            <p class="mt-2 text-slate-600">
                Masuk ke Sistem Perpustakaan
            </p>
        </div>

        <form
            action="{{ route('login.process') }}"
            method="POST"
            class="mt-8 space-y-5"
        >
            @csrf

            <div>
                <label for="email" class="block font-semibold text-slate-700">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    autofocus
                    class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500"
                >

                @error('email')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-semibold text-slate-700">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500"
                >

                @error('password')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                    class="rounded border-slate-300"
                >

                Ingat saya
            </label>

            <button
                type="submit"
                class="w-full rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700"
            >
                Masuk
            </button>
        </form>
    </div>
</body>
</html>