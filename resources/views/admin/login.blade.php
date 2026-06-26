<x-layout>
    <div class="min-h-screen bg-slate-950 px-6 py-20 text-white">
        <div class="mx-auto max-w-xl rounded-[2rem] border border-slate-800 bg-slate-900/80 p-10 shadow-2xl shadow-slate-900/40">
            <div class="mb-8 text-center">
                <p class="text-sm uppercase tracking-[0.35em] text-slate-400">Admin Access</p>
                <h1 class="mt-4 text-4xl font-black text-white">Masuk lewat link</h1>
                <p class="mt-4 text-slate-400">Masukkan kode rahasia untuk membuka dashboard admin.</p>
            </div>

            @if (session('error'))
                <div class="mb-6 rounded-3xl border border-red-500/20 bg-red-500/10 px-5 py-4 text-sm text-red-200">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                @csrf
                <label class="block">
                    <span class="text-sm font-semibold text-slate-300">Password Rahasia</span>
                    <input type="password" name="password" autocomplete="current-password"
                        class="mt-3 w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-white outline-none transition focus:border-sky-400 focus:ring-2 focus:ring-sky-500/20"
                        placeholder="Masukkan password..." />
                </label>

                <button type="submit" class="w-full rounded-full bg-sky-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-sky-400">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</x-layout>
