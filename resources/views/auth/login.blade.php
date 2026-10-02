<!doctype html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin — Portofolio Muhammad Syarief</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="min-h-screen bg-[#060D1A] text-slate-100 flex items-center justify-center p-4">
    <div class="w-full max-w-md rounded-2xl bg-[#0B1528] border border-slate-800/90 p-6 sm:p-8 shadow-2xl space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-2xl font-extrabold tracking-tight">
                <span class="text-white">M</span><span class="text-sky-400">S</span>
            </a>
            <a href="{{ url('/') }}" class="text-xs text-slate-400 hover:text-sky-400 transition-colors">
                ← Kembali ke Beranda
            </a>
        </div>

        <div class="space-y-1">
            <p class="text-xs font-mono text-sky-400 uppercase tracking-wider">Authentication Required</p>
            <h1 class="text-2xl font-bold text-white">Login Dashboard Admin</h1>
            <p class="text-xs text-slate-400">
                Masukkan kredensial administrator untuk mengelola seluruh konten portofolio.
            </p>
        </div>

        @if ($errors->any())
            <div class="p-3.5 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.perform') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1.5">Email Admin</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', 'syariefmuhammad@gmail.com') }}"
                    required
                    autofocus
                    class="w-full px-3.5 py-2.5 rounded-xl bg-[#0F1B33] border border-slate-800 text-sm text-white focus:outline-none focus:border-sky-500"
                />
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1.5">Password</label>
                <input
                    type="password"
                    name="password"
                    required
                    placeholder="Masukkan password (default: password123)"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-[#0F1B33] border border-slate-800 text-sm text-white focus:outline-none focus:border-sky-500"
                />
            </div>

            <div class="flex items-center justify-between text-xs text-slate-400">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded bg-[#0F1B33] border-slate-700 text-sky-500" />
                    <span>Ingat sesi login saya</span>
                </label>
            </div>

            <button
                type="submit"
                class="w-full py-2.5 px-4 rounded-xl bg-sky-500 hover:bg-sky-400 text-white text-sm font-semibold shadow-lg shadow-sky-500/20 transition-colors cursor-pointer"
            >
                Masuk ke Dashboard Admin →
            </button>
        </form>

        <div class="p-3.5 rounded-xl bg-[#0F1B33] border border-slate-800/80 text-xs text-slate-400 space-y-1">
            <p class="font-semibold text-slate-300">Akun Default Seeder:</p>
            <p>Email: <code class="text-sky-400 font-mono">syariefmuhammad@gmail.com</code></p>
            <p>Password: <code class="text-sky-400 font-mono">password123</code></p>
        </div>
    </div>
</body>
</html>
