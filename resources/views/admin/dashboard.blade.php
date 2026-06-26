<x-layout>
    <div class="min-h-screen bg-slate-50 px-6 py-10">
        <div class="mx-auto max-w-5xl">
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
                    <p class="mt-1 text-sm text-slate-500">Kelola sertifikat dan pesan masuk</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="/" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        Lihat Website
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-8 lg:grid-cols-2">
                {{-- Upload Sertifikat --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-slate-900">Upload Sertifikat</h2>
                    <p class="mt-1 text-sm text-slate-500">Sertifikat akan tampil di halaman depan</p>

                    <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label for="title" class="block text-sm font-medium text-slate-700">Judul</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                required
                                class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
                                placeholder="Contoh: Laravel Backend"
                            >
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="image" class="block text-sm font-medium text-slate-700">Gambar</label>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                required
                                class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-slate-100 file:px-3 file:py-1 file:text-sm file:font-medium file:text-slate-700"
                            >
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full rounded-lg bg-sky-500 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-600">
                            Upload
                        </button>
                    </form>

                    <div class="mt-8">
                        <h3 class="text-sm font-semibold text-slate-700">Sertifikat ({{ $certificates->count() }})</h3>
                        @if ($certificates->isEmpty())
                            <p class="mt-3 text-sm text-slate-400">Belum ada sertifikat.</p>
                        @else
                            <ul class="mt-3 space-y-3">
                                @foreach ($certificates as $certificate)
                                    <li class="flex items-center gap-3 rounded-lg border border-slate-100 bg-slate-50 p-3">
                                        <img
                                            src="{{ asset('storage/' . $certificate->image) }}"
                                            alt="{{ $certificate->title }}"
                                            class="h-14 w-20 rounded object-cover"
                                        >
                                        <div class="min-w-0 flex-1">
                                            <p class="truncate text-sm font-medium text-slate-900">{{ $certificate->title }}</p>
                                            <p class="text-xs text-slate-400">{{ $certificate->created_at->format('d M Y') }}</p>
                                        </div>
                                        <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" onsubmit="return confirm('Hapus sertifikat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-md px-2 py-1 text-xs font-medium text-red-600 hover:bg-red-50">
                                                Hapus
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </section>

                {{-- Pesan Masuk --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-slate-900">Pesan Masuk</h2>
                    <p class="mt-1 text-sm text-slate-500">Pesan dari form kontak halaman depan</p>

                    @if ($messages->isEmpty())
                        <p class="mt-6 text-sm text-slate-400">Belum ada pesan masuk.</p>
                    @else
                        <ul class="mt-6 space-y-4">
                            @foreach ($messages as $message)
                                <li class="rounded-lg border border-slate-100 bg-slate-50 p-4">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0">
                                            <p class="font-medium text-slate-900">{{ $message->name }}</p>
                                            <a href="mailto:{{ $message->email }}" class="text-sm text-sky-600 hover:underline">{{ $message->email }}</a>
                                        </div>
                                        <div class="flex shrink-0 flex-col items-end gap-1">
                                            <span class="text-xs text-slate-400">{{ $message->created_at->format('d M Y, H:i') }}</span>
                                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs font-medium text-red-600 hover:underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $message->message }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-layout>
