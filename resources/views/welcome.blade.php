<x-layout>
    <x-navbar />

    <section id="home" class="relative overflow-hidden bg-transparent pt-28 sm:pt-32 lg:pt-36">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.18),_transparent_35%),radial-gradient(circle_at_bottom_right,_rgba(99,102,241,0.16),_transparent_30%)]"></div>

        <div class="mx-auto flex min-h-screen max-w-7xl items-center px-6 py-16 lg:px-8 lg:py-24">
            <div class="grid items-center gap-16 lg:grid-cols-[1.1fr_0.9fr] lg:gap-20">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 rounded-full border border-sky-200 bg-white/70 px-4 py-2 text-sm font-medium text-sky-700 shadow-sm backdrop-blur">
                        <span class="h-2.5 w-2.5 rounded-full bg-sky-500"></span>
                        Halo, Selamat Datang
                    </div>

                    <h1 class="mt-6 text-5xl font-black leading-[0.95] tracking-tight text-slate-900 sm:text-6xl lg:text-7xl">
                        Saya Agung <span class="block bg-gradient-to-r from-sky-600 via-cyan-500 to-indigo-600 bg-clip-text text-transparent">
                            Setiawan
                        </span> <br>
                    </h1>

                    <p class="mt-5 text-xl font-semibold text-slate-700 sm:text-2xl">
                        Fresh Graduate · D3 Manajemen Informatika
                    </p>

                    <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                        Saya adalah lulusan baru yang tertarik membangun aplikasi web modern,
                        responsif, dan nyaman digunakan dengan Laravel serta teknologi frontend terkini.
                    </p>

                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="#projects" class="rounded-full bg-slate-900 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-slate-800">
                            Lihat Project
                        </a>
                        <a href="#contact" class="rounded-full border border-slate-300 bg-white/70 px-7 py-3.5 text-sm font-semibold text-slate-700 backdrop-blur transition hover:-translate-y-0.5 hover:border-slate-400 hover:bg-white">
                            Hubungi Saya
                        </a>
                    </div>

                    <div class="mt-10 flex flex-wrap gap-3 text-sm text-slate-500">
                        <span class="rounded-full border border-slate-200 bg-white/70 px-3 py-1.5">Laravel</span>
                        <span class="rounded-full border border-slate-200 bg-white/70 px-3 py-1.5">Tailwind CSS</span>
                        <span class="rounded-full border border-slate-200 bg-white/70 px-3 py-1.5">Web Development</span>
                    </div>
                </div>

                <div class="flex justify-center lg:justify-end">
                    <div class="relative w-full max-w-lg">
                        <div class="absolute inset-0 rounded-[2rem] bg-gradient-to-br from-sky-400/30 via-cyan-400/20 to-indigo-500/30 blur-3xl"></div>
                        <div class="absolute -left-6 top-8 h-24 w-24 rounded-full border border-sky-200 bg-white/60"></div>
                        <div class="absolute -bottom-5 right-6 h-20 w-20 rounded-full border border-indigo-200 bg-slate-900/10"></div>
                        <div
                            id="lanyard-container"
                            class="relative aspect-[3/4] w-full min-h-[480px] sm:min-h-[560px] lg:min-h-[600px]"
                            data-photo="{{ asset('images/foto2.jpeg') }}"
                            aria-label="Kartu profil 3D interaktif — tarik untuk memutar"
                        ></div>
                        <p class="relative mt-3 text-center text-xs text-slate-400">
                            Tarik kartu untuk interaksi 3D
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="bg-slate-50 py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mb-12 max-w-3xl">
                <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm">
                    <span class="h-2.5 w-2.5 rounded-full bg-slate-900"></span>
                    Tentang Saya
                </p>
                <h2 class="mt-6 text-4xl font-black tracking-tight text-slate-900 sm:text-5xl">
                    Siapa saya dan apa yang saya kerjakan.
                </h2>
                <p class="mt-5 text-lg leading-8 text-slate-600">
                    Saya Agung Setiawan, seorang Fresh Graduate dari D3 Manajemen Informatika dengan pengalaman membangun website modern menggunakan Laravel dan Tailwind CSS.
                    Saya suka menggabungkan desain intuitif dengan kode yang rapi untuk menciptakan pengalaman pengguna yang lebih baik.
                </p>
            </div>

            <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-start">
                <div class="space-y-8 rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                    <div>
                        <h3 class="text-2xl font-semibold text-slate-900">Saya fokus pada:</h3>
                        <ul class="mt-6 space-y-4 text-slate-600">
                            <li class="flex gap-3">
                                <span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-sky-500"></span>
                                <span>Membangun antarmuka web yang responsif dan modern.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-sky-500"></span>
                                <span>Menulis kode backend yang bersih dan maintainable.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-sky-500"></span>
                                <span>Mengoptimalkan performa dan pengalaman pengguna.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-sky-500"></span>
                                <span>Menggunakan kolaborasi tim dan version control untuk hasil terbaik.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Pendidikan</p>
                            <p class="mt-3 text-2xl font-bold text-slate-900">Manajemen Informatika</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Status</p>
                            <p class="mt-4 text-3xl font-bold text-slate-900">Fresh Graduate</p>
                            <p class="mt-2 text-sm text-slate-600">Siap berkontribusi di proyek nyata.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-[2rem] border border-slate-200 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 p-8 text-white shadow-lg shadow-slate-900/20">
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Certified</p>
                        <div class="mt-8 grid gap-5 sm:grid-cols-1">
                            <div class="rounded-[1.75rem] border border-slate-700 bg-slate-950/80 p-6">
                                <p class="text-xs uppercase tracking-[0.3em] text-sky-400">Web Development</p>
                                <p class="mt-4 text-2xl font-semibold text-white">Backend & API</p>
                                <p class="mt-3 text-sm leading-6 text-slate-400">Sertifikat yang memperkuat keahlian dalam membangun sistem web, REST API, dan aplikasi yang scalable.</p>
                            </div>
                            <div class="rounded-[1.75rem] border border-slate-700 bg-slate-950/80 p-6">
                                <p class="text-xs uppercase tracking-[0.3em] text-sky-400">UI/UX</p>
                                <p class="mt-4 text-2xl font-semibold text-white">Desain Modern</p>
                                <p class="mt-3 text-sm leading-6 text-slate-400">Sertifikat untuk kemampuan menciptakan antarmuka yang rapi, responsive, dan mudah digunakan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Tentang Saya</p>
                        <div class="mt-6 space-y-4 text-slate-600">
                            <p>Saya percaya bahwa aplikasi yang baik lahir dari ide yang jelas, desain yang bersih, dan eksekusi teknis yang rapi.</p>
                            <p>Saya gemar belajar teknologi baru dan selalu berusaha meningkatkan kualitas setiap proyek yang saya kerjakan.</p>
                        </div>
                        <a href="#contact" class="mt-8 inline-flex rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                            Kontak Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="certified" class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mb-12 max-w-3xl">
                <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 shadow-sm">
                    <span class="h-2.5 w-2.5 rounded-full bg-slate-900"></span>
                    Certified
                </p>
                <h2 class="mt-6 text-4xl font-black tracking-tight text-slate-900 sm:text-5xl">
                    Sertifikat dan bukti keahlian saya
                </h2>
                <p class="mt-5 text-lg leading-8 text-slate-600">
                    Berikut adalah beberapa sertifikat yang mendukung kemampuan saya dalam membangun aplikasi web, UI design, dan kerja tim menggunakan teknologi modern.
                </p>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                @forelse ($certificates as $certificate)
                    <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ $certificate->title }}</p>
                        <div class="mt-4 overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white">
                            <img
                                src="{{ asset('storage/' . $certificate->image) }}"
                                alt="{{ $certificate->title }}"
                                class="h-48 w-full object-cover"
                            >
                        </div>
                    </div>
                @empty
                    <div class="col-span-full rounded-[2rem] border border-dashed border-slate-300 bg-slate-50 p-10 text-center">
                        <p class="text-slate-500">Belum ada sertifikat. Upload melalui dashboard admin.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="contact" class="bg-slate-950 py-24 text-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div>
                    <p class="inline-flex items-center gap-2 rounded-full bg-white/5 px-4 py-2 text-sm font-medium uppercase tracking-[0.35em] text-slate-300">
                        Contact
                    </p>
                    <h2 class="mt-6 text-4xl font-black tracking-tight text-white sm:text-5xl">
                        Ayo bicara tentang proyek Anda.
                    </h2>
                    <p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">
                        Silakan hubungi saya melalui email atau formulir di bawah jika Anda membutuhkan bantuan membangun website, aplikasi web, atau membuat desain digital yang modern.
                    </p>

                    <div class="mt-10 space-y-4 text-slate-300">
                        <p><span class="font-semibold text-white">Email:</span> agungawan355@gmail.com</p>
                        <p><span class="font-semibold text-white">Telepon:</span> +62 8989 9327 955</p>
                        <p><span class="font-semibold text-white">Lokasi:</span> Pekanbaru, Indonesia</p>
                    </div>                    <div class="mt-8 grid gap-3 sm:grid-cols-3">
                        <a href="https://instagram.com/as.setiawanxz_" target="_blank" rel="noreferrer" class="rounded-3xl border border-white/10 bg-slate-800/80 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-slate-700">
                            Instagram
                        </a>
                        <a href="https://tiktok.com/@as.011111" target="_blank" rel="noreferrer" class="rounded-3xl border border-white/10 bg-slate-800/80 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-slate-700">
                            TikTok
                        </a>
                        <a href="https://www.linkedin.com/in/agung-setiawan-as-8808732a0/" target="_blank" rel="noreferrer" class="rounded-3xl border border-white/10 bg-slate-800/80 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-slate-700">
                            LinkedIn
                        </a>
                    </div>                </div>

                <form class="rounded-[2rem] border border-white/10 bg-white/5 p-8 shadow-[0_30px_80px_rgba(15,23,42,0.35)] backdrop-blur" action="{{ route('contact.store') }}" method="POST">
                    @csrf

                    @if (session('contact_success'))
                        <div class="mb-6 rounded-2xl border border-green-400/30 bg-green-500/10 px-4 py-3 text-sm text-green-200">
                            {{ session('contact_success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-red-400/30 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                            <ul class="space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid gap-6">
                        <label class="space-y-3">
                            <span class="text-sm font-semibold text-slate-200">Nama</span>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-3xl border border-white/10 bg-slate-900/70 px-4 py-3 text-slate-100 outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-500/20" placeholder="Nama Anda">
                        </label>
                        <label class="space-y-3">
                            <span class="text-sm font-semibold text-slate-200">Email</span>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-3xl border border-white/10 bg-slate-900/70 px-4 py-3 text-slate-100 outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-500/20" placeholder="Email Anda">
                        </label>
                        <label class="space-y-3">
                            <span class="text-sm font-semibold text-slate-200">Pesan</span>
                            <textarea name="message" rows="5" required class="w-full rounded-3xl border border-white/10 bg-slate-900/70 px-4 py-3 text-slate-100 outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-500/20" placeholder="Tinggalkan pesan Anda">{{ old('message') }}</textarea>
                        </label>
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-sky-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-sky-400">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer class="border-t border-slate-200/10 bg-slate-900 py-10 text-slate-400">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
            <p>© 2026 Agung Setiawan. All rights reserved.</p>
            <div class="flex flex-wrap items-center gap-4 text-sm">
                <a href="#home" class="transition hover:text-white">Home</a>
                <a href="#about" class="transition hover:text-white">About</a>
                <a href="#certified" class="transition hover:text-white">Certified</a>
                <a href="#contact" class="transition hover:text-white">Contact</a>
            </div>
        </div>
    </footer>
</x-layout>