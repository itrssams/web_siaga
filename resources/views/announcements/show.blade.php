<x-layouts.public title="{{ $announcement->title }}">
    <section class="bg-white">
        <div class="public-container max-w-4xl py-10">
            <a href="{{ route('announcements.index') }}" class="mb-6 inline-flex text-sm font-extrabold text-[var(--color-primary)] hover:text-[var(--color-primary-strong)]">
                Kembali ke Pengumuman
            </a>
            <p class="public-eyebrow mb-3">Pengumuman</p>
            <h1 class="text-4xl font-extrabold leading-tight text-[var(--color-text)] sm:text-5xl">
                {{ $announcement->title }}
            </h1>
            <div class="mt-5 flex flex-wrap items-center gap-3 text-sm font-bold text-[var(--color-muted)]">
                <span>{{ $announcement->published_at?->translatedFormat('d F Y') ?? 'Tanggal belum diisi' }}</span>
                @if ($announcement->is_pinned)
                    <span class="rounded-full bg-[var(--color-accent)]/18 px-3 py-1 text-xs font-extrabold text-[#7A5F09]">Disematkan</span>
                @endif
            </div>
        </div>
    </section>

    <section class="public-section bg-[linear-gradient(180deg,#ffffff_0%,#fff7e0_52%,#ffffff_100%)]">
        <div class="public-container grid gap-8 lg:grid-cols-[1fr_20rem]">
            <article class="public-card p-6 lg:p-8">
                <div class="space-y-5 text-base leading-8 text-[var(--color-text)]">
                    @foreach (preg_split('/\r\n|\r|\n/', $announcement->content) as $paragraph)
                        @if (filled(trim($paragraph)))
                            <p>{{ $paragraph }}</p>
                        @endif
                    @endforeach
                </div>

                @if ($announcement->attachment)
                    <div class="mt-8 rounded-md border border-[var(--color-border)] bg-[var(--color-primary-soft)] p-4">
                        <p class="text-sm font-extrabold text-[var(--color-primary-strong)]">Lampiran Pengumuman</p>
                        <a href="{{ asset('storage/' . $announcement->attachment) }}" target="_blank" class="mt-2 inline-flex text-sm font-extrabold text-[var(--color-primary)] hover:text-[var(--color-primary-strong)]">
                            Buka Lampiran
                        </a>
                    </div>
                @endif
            </article>

            <aside>
                <div class="public-card p-5">
                    <p class="mb-4 font-extrabold text-[var(--color-primary-strong)]">Pengumuman Lainnya</p>
                    <div class="grid gap-4">
                        @forelse ($otherAnnouncements as $otherAnnouncement)
                            <a href="{{ route('announcements.show', $otherAnnouncement) }}" class="block rounded-md border border-[var(--color-border)] p-4 transition hover:border-[var(--color-accent)]/60 hover:bg-[var(--color-primary-soft)]">
                                <p class="text-xs font-bold uppercase text-[var(--color-muted)]">
                                    {{ $otherAnnouncement->published_at?->translatedFormat('d F Y') ?? 'Tanggal belum diisi' }}
                                </p>
                                <p class="mt-2 font-extrabold text-[var(--color-text)]">{{ $otherAnnouncement->title }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-[var(--color-muted)]">Belum ada pengumuman lain.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </section>
</x-layouts.public>
