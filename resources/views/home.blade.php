<x-layouts.public title="Beranda">
    <section class="relative overflow-hidden bg-[var(--color-bg)]">
        <div class="public-container grid min-h-[560px] items-center gap-10 py-14 lg:grid-cols-[1.05fr_0.95fr]">
            <div>
                <p class="public-eyebrow mb-4">Rumah Sakit Siaga</p>
                <h1 class="max-w-3xl text-4xl font-extrabold leading-tight text-[var(--color-text)] sm:text-5xl">
                    Pelayanan kesehatan yang sigap, ramah, dan terpercaya.
                </h1>
                <p class="mt-5 max-w-2xl text-base leading-7 text-[var(--color-muted)] sm:text-lg">
                    Akses informasi dokter, jadwal praktik, pengumuman resmi, artikel kesehatan, dan sertifikat rumah sakit dalam satu tempat.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#jadwal" class="public-btn-primary">Lihat Jadwal Dokter</a>
                    <a href="#dokter" class="public-btn-outline">Cari Dokter</a>
                </div>
            </div>

            <div class="public-card overflow-hidden">
                <div class="bg-[#14532D] p-6 text-white">
                    <p class="text-sm font-bold text-white/70">Informasi Cepat</p>
                    <h2 class="mt-2 text-2xl font-extrabold">Layanan dan informasi RS</h2>
                </div>
                <div class="grid divide-y divide-[var(--color-border)]">
                    <a href="#jadwal" class="flex items-center justify-between p-5 transition hover:bg-[#DCFCE7]/40">
                        <span class="font-bold">Jadwal Dokter</span>
                        <span class="text-[#14532D]">Lihat</span>
                    </a>
                    <a href="#pengumuman" class="flex items-center justify-between p-5 transition hover:bg-[#DCFCE7]/40">
                        <span class="font-bold">Pengumuman Terbaru</span>
                        <span class="text-[#14532D]">Buka</span>
                    </a>
                    <a href="#artikel" class="flex items-center justify-between p-5 transition hover:bg-[#DCFCE7]/40">
                        <span class="font-bold">Artikel Kesehatan</span>
                        <span class="text-[#14532D]">Baca</span>
                    </a>
                    <a href="#sertifikat" class="flex items-center justify-between p-5 transition hover:bg-[#DCFCE7]/40">
                        <span class="font-bold">Sertifikat dan Perizinan</span>
                        <span class="text-[#14532D]">Cek</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="profil" class="public-section bg-white">
        <div class="public-container grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <p class="public-eyebrow mb-3">Profil Singkat</p>
                <h2 class="text-3xl font-extrabold text-[var(--color-text)]">Fondasi layanan publik yang jelas dan mudah diakses.</h2>
            </div>
            <p class="text-base leading-7 text-[var(--color-muted)]">
                Website ini disiapkan sebagai pusat informasi resmi rumah sakit. Konten dari panel admin akan tampil di halaman publik, sehingga pengunjung bisa melihat jadwal dokter, pengumuman, artikel, dan sertifikat terbaru secara cepat.
            </p>
        </div>
    </section>

    <section id="dokter" class="public-section">
        <div class="public-container">
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="public-eyebrow mb-3">Dokter</p>
                    <h2 class="text-3xl font-extrabold">Dokter terbaru</h2>
                </div>
                <a href="#jadwal" class="public-btn-outline text-sm">Lihat Jadwal</a>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                @forelse ($doctors as $doctor)
                    <article class="public-card p-5">
                        <div class="mb-4 h-24 w-24 overflow-hidden rounded-md bg-[#DCFCE7]">
                            @if ($doctor->photo)
                                <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                        <h3 class="font-extrabold">{{ $doctor->name }}</h3>
                        <p class="mt-1 text-sm text-[var(--color-muted)]">{{ $doctor->specialization?->name ?? 'Spesialis belum diisi' }}</p>
                        <p class="mt-3 inline-flex rounded-full bg-[#DCFCE7] px-3 py-1 text-xs font-bold text-[#14532D]">
                            {{ $doctor->polyclinic?->name ?? 'Poliklinik belum diisi' }}
                        </p>
                    </article>
                @empty
                    <div class="public-card col-span-full p-6 text-[var(--color-muted)]">Data dokter belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="jadwal" class="public-section bg-white">
        <div class="public-container">
            <div class="mb-8">
                <p class="public-eyebrow mb-3">Jadwal Dokter</p>
                <h2 class="text-3xl font-extrabold">Jadwal praktik</h2>
            </div>

            <div class="public-card overflow-hidden">
                <div class="grid divide-y divide-[var(--color-border)]">
                    @forelse ($schedules as $schedule)
                        <div class="grid gap-3 p-5 md:grid-cols-[1fr_1fr_1fr_auto] md:items-center">
                            <div>
                                <p class="font-extrabold">{{ $schedule->doctor?->name }}</p>
                                <p class="text-sm text-[var(--color-muted)]">{{ $schedule->doctor?->specialization?->name }}</p>
                            </div>
                            <p class="text-sm font-bold text-[#14532D]">{{ $schedule->doctor?->polyclinic?->name }}</p>
                            <p class="text-sm text-[var(--color-muted)]">{{ \App\Models\DoctorSchedule::DAYS[$schedule->day_of_week] ?? '-' }}</p>
                            <p class="text-sm font-extrabold">{{ $schedule->start_time?->format('H:i') }} - {{ $schedule->end_time?->format('H:i') }}</p>
                        </div>
                    @empty
                        <div class="p-6 text-[var(--color-muted)]">Jadwal dokter belum tersedia.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section id="pengumuman" class="public-section">
        <div class="public-container">
            <div class="mb-8">
                <p class="public-eyebrow mb-3">Pengumuman</p>
                <h2 class="text-3xl font-extrabold">Informasi resmi terbaru</h2>
            </div>

            <div class="grid gap-4 lg:grid-cols-3">
                @forelse ($announcements as $announcement)
                    <article class="public-card p-5">
                        @if ($announcement->is_pinned)
                            <span class="mb-3 inline-flex rounded-full bg-[#D4A017]/15 px-3 py-1 text-xs font-bold text-[#8A6500]">Disematkan</span>
                        @endif
                        <h3 class="font-extrabold">{{ $announcement->title }}</h3>
                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-[var(--color-muted)]">{{ $announcement->content }}</p>
                    </article>
                @empty
                    <div class="public-card col-span-full p-6 text-[var(--color-muted)]">Pengumuman belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="artikel" class="public-section bg-white">
        <div class="public-container">
            <div class="mb-8">
                <p class="public-eyebrow mb-3">Artikel</p>
                <h2 class="text-3xl font-extrabold">Artikel kesehatan</h2>
            </div>

            <div class="grid gap-4 lg:grid-cols-3">
                @forelse ($articles as $article)
                    <article class="public-card overflow-hidden">
                        <div class="h-44 bg-[#DCFCE7]">
                            @if ($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-extrabold">{{ $article->title }}</h3>
                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-[var(--color-muted)]">{{ $article->excerpt ?: $article->content }}</p>
                        </div>
                    </article>
                @empty
                    <div class="public-card col-span-full p-6 text-[var(--color-muted)]">Artikel belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="sertifikat" class="public-section">
        <div class="public-container">
            <div class="mb-8">
                <p class="public-eyebrow mb-3">Sertifikat</p>
                <h2 class="text-3xl font-extrabold">Sertifikat dan perizinan</h2>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                @forelse ($certificates as $certificate)
                    <article class="public-card p-5">
                        <p class="font-extrabold">{{ $certificate->name }}</p>
                        <p class="mt-2 text-sm text-[var(--color-muted)]">{{ $certificate->issuer ?: 'Penerbit belum diisi' }}</p>
                        @if ($certificate->file)
                            <a href="{{ asset('storage/' . $certificate->file) }}" target="_blank" class="mt-4 inline-flex text-sm font-bold text-[#14532D]">Buka File</a>
                        @endif
                    </article>
                @empty
                    <div class="public-card col-span-full p-6 text-[var(--color-muted)]">Sertifikat belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>
</x-layouts.public>
