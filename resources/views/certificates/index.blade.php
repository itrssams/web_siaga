<x-layouts.public title="Sertifikat">
    <section class="bg-white">
        <div class="public-container grid gap-6 py-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-end">
            <div>
                <p class="public-eyebrow mb-3">Sertifikat & Akreditasi</p>
                <h1 class="max-w-3xl text-4xl font-extrabold leading-tight text-[var(--color-text)] sm:text-5xl">
                    Legalitas dan sertifikat rumah sakit.
                </h1>
            </div>
            <p class="max-w-2xl leading-7 text-[var(--color-muted)] lg:justify-self-end">
                Informasi dokumen legal, akreditasi, dan sertifikat pendukung layanan rumah sakit.
            </p>
        </div>
    </section>

    <section class="border-y border-[var(--color-border)] bg-[var(--color-primary-soft)] py-6">
        <div class="public-container">
            <form method="GET" action="{{ route('certificates.index') }}" class="public-card grid gap-4 p-5 md:grid-cols-[1fr_auto] md:items-end">
                <label class="grid gap-2 text-sm font-bold">
                    Cari Sertifikat
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control-public" placeholder="Cari nama, nomor, atau penerbit">
                </label>
                <div class="flex flex-col gap-2 sm:flex-row">
                    <button class="public-btn-primary" type="submit">Cari</button>
                    <a href="{{ route('certificates.index') }}" class="public-btn-outline text-sm">Reset</a>
                </div>
            </form>
        </div>
    </section>

    <section class="public-section bg-[linear-gradient(180deg,#ffffff_0%,#fff7e0_52%,#ffffff_100%)]">
        <div class="public-container">
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="public-eyebrow mb-3">Daftar Sertifikat</p>
                    <h2 class="text-3xl font-extrabold">Sertifikat aktif</h2>
                </div>
                <a href="{{ route('home') }}" class="public-btn-outline text-sm">Kembali ke Beranda</a>
            </div>

            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($certificates as $certificate)
                    <article class="public-card relative overflow-hidden p-5">
                        <div class="absolute right-0 top-0 h-20 w-20 rounded-bl-full bg-[var(--color-accent)]/16"></div>
                        <div class="relative">
                            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-md bg-[var(--color-primary-soft)] text-[var(--color-primary)]">
                                @svg('heroicon-o-shield-check', 'h-7 w-7')
                            </div>
                            <h3 class="text-xl font-extrabold text-[var(--color-primary-strong)]">{{ $certificate->name }}</h3>
                            <div class="mt-4 grid gap-2 text-sm text-[var(--color-muted)]">
                                <p><span class="font-bold text-[var(--color-text)]">Nomor:</span> {{ $certificate->certificate_number ?: '-' }}</p>
                                <p><span class="font-bold text-[var(--color-text)]">Penerbit:</span> {{ $certificate->issuer ?: '-' }}</p>
                                <p><span class="font-bold text-[var(--color-text)]">Terbit:</span> {{ $certificate->issued_at?->translatedFormat('d F Y') ?? '-' }}</p>
                                <p><span class="font-bold text-[var(--color-text)]">Berlaku sampai:</span> {{ $certificate->expires_at?->translatedFormat('d F Y') ?? '-' }}</p>
                            </div>
                            @if ($certificate->file)
                                <a href="{{ asset('storage/' . $certificate->file) }}" target="_blank" class="mt-5 inline-flex text-sm font-extrabold text-[var(--color-primary)] hover:text-[var(--color-primary-strong)]">
                                    Buka File
                                </a>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="public-card col-span-full p-6 text-[var(--color-muted)]">Sertifikat belum tersedia.</div>
                @endforelse
            </div>

            @if ($certificates instanceof \Illuminate\Contracts\Pagination\Paginator && $certificates->hasPages())
                <div class="mt-8">
                    {{ $certificates->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layouts.public>
