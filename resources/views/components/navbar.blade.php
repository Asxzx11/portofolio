<nav class="fixed top-0 left-0 z-50 w-full px-4 pt-4 sm:px-6 lg:px-8 bg-transparent">
    <div class="mx-auto flex max-w-6xl items-center justify-between py-2">
        <a href="/" class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white/80 text-sm font-semibold text-slate-800 shadow-sm backdrop-blur">
                AS
            </div>
            <div class="leading-tight">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-800">Agung</p>
                <p class="text-xs text-slate-500">Portfolio</p>
            </div>
        </a>

        <ul class="hidden items-center gap-8 md:flex">
            <li>
                <a href="#about" class="text-sm font-medium text-slate-600 transition hover:text-slate-900">
                    Tentang Saya
                </a>
            </li>
            <li>
                <a href="#projects" class="text-sm font-medium text-slate-600 transition hover:text-slate-900">
                    Proyek
                </a>
            </li>
            <li>
                <a href="#certified" class="text-sm font-medium text-slate-600 transition hover:text-slate-900">
                    Sertifikat
                </a>
            </li>
            <li>
                <a href="#contact" class="text-sm font-medium text-slate-600 transition hover:text-slate-900">
                    Kontak
                </a>
            </li>
        </ul>

        <div class="flex items-center gap-3">
            <a href="#contact" class="hidden rounded-full border border-slate-200 bg-white/70 px-5 py-2.5 text-sm font-semibold text-slate-700 backdrop-blur transition hover:border-slate-300 hover:bg-white sm:inline-flex">
                Let's Talk
            </a>

            <!-- Mobile menu button -->
            <button id="mobile-menu-button" aria-expanded="false" aria-controls="mobile-menu" class="md:hidden inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white/90 p-2 text-slate-800 shadow-sm">
                <svg id="hamburger-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 5h14a1 1 0 010 2H3a1 1 0 110-2zm0 4h14a1 1 0 010 2H3a1 1 0 110-2zm0 4h14a1 1 0 010 2H3a1 1 0 110-2z" clip-rule="evenodd" />
                </svg>
                <svg id="hamburger-close" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu (hidden by default) -->
    <div id="mobile-menu" class="md:hidden hidden border-t border-slate-200 bg-white shadow-lg">
        <div class="mx-auto max-w-6xl px-4 py-4">
            <ul class="space-y-2">
                <li><a href="#about" class="block rounded-md px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Tentang Saya</a></li>
                <li><a href="#projects" class="block rounded-md px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Proyek</a></li>
                <li><a href="#certified" class="block rounded-md px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Sertifikat</a></li>
                <li><a href="#contact" class="block rounded-md px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Kontak</a></li>
            </ul>
        </div>
    </div>

    <script>
        (function() {
            var btn = document.getElementById('mobile-menu-button');
            var menu = document.getElementById('mobile-menu');
            var openIcon = document.getElementById('hamburger-open');
            var closeIcon = document.getElementById('hamburger-close');
            if (!btn || !menu) return;

            btn.addEventListener('click', function() {
                var isHidden = menu.classList.toggle('hidden');
                btn.setAttribute('aria-expanded', !isHidden);
                openIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        })();
    </script>
</nav>
