<x-layouts.public title="Pengumuman">
    <section class="bg-white">
        <div class="public-container grid gap-6 py-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-end">
            <div>
                <p class="public-eyebrow mb-3">Pengumuman</p>
                <h1 class="max-w-3xl text-4xl font-extrabold leading-tight text-[var(--color-text)] sm:text-5xl">
                    Informasi resmi terbaru dari rumah sakit.
                </h1>
            </div>
            <p class="max-w-2xl leading-7 text-[var(--color-muted)] lg:justify-self-end">
                Pantau pengumuman layanan, informasi operasional, dan pemberitahuan penting untuk pasien serta keluarga.
            </p>
        </div>
    </section>

    <section class="border-y border-[var(--color-border)] bg-[var(--color-primary-soft)] py-6">
        <div class="public-container">
            <form method="GET" action="{{ route('announcements.index') }}" class="public-card grid gap-4 p-5 md:grid-cols-[1fr_auto] md:items-end">
                <label class="grid gap-2 text-sm font-bold">
                    Cari Pengumuman
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control-public" placeholder="Cari judul atau isi pengumuman">
                </label>
                <div class="flex flex-col gap-2 sm:flex-row">
                    <button class="public-btn-primary" type="submit">Cari</button>
                    <a href="{{ route('announcements.index') }}" class="public-btn-outline text-sm">Reset</a>
                </div>
            </form>
        </div>
    </section>

    <section class="public-section bg-[linear-gradient(180deg,#ffffff_0%,#fff7e0_52%,#ffffff_100%)]">
        <div class="public-container">
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="public-eyebrow mb-3">Daftar Pengumuman</p>
                    <h2 class="text-3xl font-extrabold">Pengumuman dipublikasikan</h2>
                </div>
                <a href="{{ route('home') }}" class="public-btn-outline text-sm">Kembali ke Beranda</a>
            </div>

            <div class="grid gap-5 lg:grid-cols-3">
                @forelse ($announcements as $announcement)
                    <article class="public-card relative overflow-hidden p-5">
                        @if ($announcement->is_pinned)
                            <span class="mb-4 inline-flex rounded-full bg-[var(--color-accent)]/18 px-3 py-1 text-xs font-extrabold text-[#7A5F09]">Disematkan</span>
                        @endif

                        <p class="text-xs font-bold uppercase text-[var(--color-muted)]">
                            {{ $announcement->published_at?->translatedFormat('d F Y') ?? 'Tanggal belum diisi' }}
                        </p>
                        <h3 class="mt-3 text-xl font-extrabold text-[var(--color-primary-strong)]">{{ $announcement->title }}</h3>
                        <p class="mt-3 line-clamp-5 text-sm leading-6 text-[var(--color-muted)]">{{ $announcement->content }}</p>

                        <div class="mt-5 flex flex-wrap gap-3">
                            <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex text-sm font-extrabold text-[var(--color-primary)] hover:text-[var(--color-primary-strong)]">
                                Baca Selengkapnya
                            </a>
                            @if ($announcement->attachment)
                                <a href="{{ asset('storage/' . $announcement->attachment) }}" target="_blank" class="inline-flex text-sm font-extrabold text-[var(--color-primary)] hover:text-[var(--color-primary-strong)]">
                                    Buka Lampiran
                                </a>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="public-card col-span-full p-6 text-[var(--color-muted)]">Pengumuman belum tersedia.</div>
                @endforelse
            </div>

            @if ($announcements instanceof \Illuminate\Contracts\Pagination\Paginator && $announcements->hasPages())
                <div class="mt-8">
                    {{ $announcements->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layouts.public>
