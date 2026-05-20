<x-layouts.public title="Beranda">
    @php
        $heroImage = 'images/hero-rs.jpg';
        $hasHeroImage = file_exists(public_path($heroImage));
    @endphp

    <section class="hero-masthead {{ $hasHeroImage ? 'has-hero-image' : '' }}">
        @if ($hasHeroImage)
            <img src="{{ asset($heroImage) }}" alt="Gedung Rumah Sakit Siaga Al Munawwarah Samarinda" class="hero-masthead-image">
        @endif

        <div class="public-container flex min-h-[clamp(32rem,calc(100svh-7.5rem),46rem)] items-center py-12 sm:py-14">
            <div class="max-w-3xl animate-rise">
                <p class="hero-eyebrow mb-4">Selamat Datang di Rumah Sakit Siaga Al Munawwarah Samarinda</p>
                <h1 class="text-4xl font-extrabold leading-tight text-white sm:text-5xl lg:text-6xl">
                    Layanan kesehatan modern dengan sentuhan yang tenang dan personal.
                </h1>
                <p class="mt-5 max-w-2xl text-base leading-7 text-white/82 sm:text-lg">
                    Temukan informasi dokter, pengumuman resmi, artikel kesehatan, dan sertifikat rumah sakit secara cepat dan jelas.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('doctors.index') }}" class="public-btn-primary">Cari Dokter</a>
                    <a href="{{ route('announcements.index') }}" class="hero-btn-outline">Lihat Informasi</a>
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="service-strip">
        <div class="public-container grid gap-4 py-7 sm:grid-cols-2 lg:grid-cols-5">
            @foreach ([
                ['icon' => 'heroicon-o-user-group', 'title' => 'Dokter Kami', 'href' => route('doctors.index')],
                ['icon' => 'heroicon-o-calendar-days', 'title' => 'Jadwal Dokter', 'href' => route('schedules.index')],
                ['icon' => 'heroicon-o-megaphone', 'title' => 'Pengumuman', 'href' => route('announcements.index')],
                ['icon' => 'heroicon-o-newspaper', 'title' => 'Artikel', 'href' => '#artikel'],
                ['icon' => 'heroicon-o-shield-check', 'title' => 'Sertifikat', 'href' => '#sertifikat'],
            ] as $service)
                <a href="{{ $service['href'] }}" class="service-card">
                    <span class="service-icon">
                        @svg($service['icon'], 'h-6 w-6')
                    </span>
                    <span class="service-title">{{ $service['title'] }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <section id="profil" class="bg-[var(--color-primary-strong)] py-10 text-white">
        <div class="public-container grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($stats as $stat)
                <div class="rounded-md border border-white/15 bg-white/8 p-5">
                    <p class="text-4xl font-extrabold">{{ $stat['value'] }}+</p>
                    <p class="mt-2 text-sm font-bold text-white/75">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section id="pengumuman" class="public-section bg-white">
        <div class="public-container">
            <div class="mb-8">
                <p class="public-eyebrow mb-3">Pengumuman</p>
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                    <h2 class="text-3xl font-extrabold">Informasi resmi terbaru</h2>
                    <a href="{{ route('announcements.index') }}" class="public-btn-outline text-sm">Lihat Semua</a>
                </div>
            </div>

            <div class="grid gap-4 lg:grid-cols-3">
                @forelse ($announcements as $announcement)
                    <article class="public-card p-5">
                        @if ($announcement->is_pinned)
                            <span class="mb-3 inline-flex rounded-full bg-[var(--color-accent)]/15 px-3 py-1 text-xs font-bold text-[#7A5F09]">Disematkan</span>
                        @endif
                        <h3 class="font-extrabold">{{ $announcement->title }}</h3>
                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-[var(--color-muted)]">{{ $announcement->content }}</p>
                        <a href="{{ route('announcements.show', $announcement) }}" class="mt-4 inline-flex text-sm font-extrabold text-[var(--color-primary)] hover:text-[var(--color-primary-strong)]">
                            Baca Selengkapnya
                        </a>
                    </article>
                @empty
                    <div class="public-card col-span-full p-6 text-[var(--color-muted)]">Pengumuman belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="artikel" class="public-section">
        <div class="public-container grid gap-8 lg:grid-cols-[0.85fr_1.15fr]">
            <div>
                <p class="public-eyebrow mb-3">News & Article</p>
                <h2 class="text-3xl font-extrabold">Artikel dan berita kesehatan.</h2>
                <p class="mt-4 leading-7 text-[var(--color-muted)]">
                    Baca informasi kesehatan, aktivitas rumah sakit, dan kabar terbaru untuk pasien serta keluarga.
                </p>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                @forelse ($articles as $article)
                    <article class="public-card overflow-hidden">
                        <div class="h-36 bg-[var(--color-primary-soft)]">
                            @if ($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-extrabold">{{ $article->title }}</h3>
                            <p class="mt-2 line-clamp-3 text-sm leading-6 text-[var(--color-muted)]">{{ $article->excerpt ?: $article->content }}</p>
                        </div>
                    </article>
                @empty
                    <div class="public-card col-span-full p-6 text-[var(--color-muted)]">Artikel belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="sertifikat" class="public-section bg-white">
        <div class="public-container">
            <div class="mb-8">
                <p class="public-eyebrow mb-3">Sertifikat & Akreditasi</p>
                <h2 class="text-3xl font-extrabold">Legalitas dan sertifikat rumah sakit</h2>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                @forelse ($certificates as $certificate)
                    <article class="public-card p-5">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-md bg-[var(--color-primary-soft)] font-extrabold text-[var(--color-primary)]">OK</div>
                        <p class="font-extrabold">{{ $certificate->name }}</p>
                        <p class="mt-2 text-sm text-[var(--color-muted)]">{{ $certificate->issuer ?: 'Penerbit belum diisi' }}</p>
                        @if ($certificate->file)
                            <a href="{{ asset('storage/' . $certificate->file) }}" target="_blank" class="mt-4 inline-flex text-sm font-bold text-[var(--color-primary)]">Buka File</a>
                        @endif
                    </article>
                @empty
                    <div class="public-card col-span-full p-6 text-[var(--color-muted)]">Sertifikat belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>
</x-layouts.public>
