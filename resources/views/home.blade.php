<x-layouts.public title="Beranda">
    <section class="bg-white">
        <div class="public-container grid gap-8 py-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center lg:py-14">
            <div>
                <p class="public-eyebrow mb-4">Selamat Datang di RS Sams</p>
                <h1 class="max-w-3xl text-4xl font-extrabold leading-tight text-[var(--color-text)] sm:text-5xl">
                    Kesehatan Anda adalah prioritas kami.
                </h1>
                <p class="mt-5 max-w-2xl text-base leading-7 text-[var(--color-muted)] sm:text-lg">
                    Informasi dokter, jadwal praktik, pengumuman, artikel kesehatan, dan sertifikat rumah sakit tersaji dalam satu halaman resmi.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#cari-dokter" class="public-btn-primary">Cari Dokter</a>
                    <a href="#jadwal" class="public-btn-outline">Jadwal Hari Ini</a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="absolute left-6 top-6 z-10 rounded-md bg-white/92 p-5 shadow-xl">
                    <p class="text-sm font-bold text-[var(--color-muted)]">Layanan Darurat</p>
                    <p class="mt-1 text-2xl font-extrabold text-[#14532D]">24 Jam</p>
                </div>
                <div class="absolute bottom-6 left-6 z-10 max-w-xs rounded-md bg-white/92 p-5 shadow-xl">
                    <p class="text-sm font-bold text-[var(--color-muted)]">Informasi cepat dan resmi untuk pasien serta keluarga.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="-mt-1 border-y border-[var(--color-border)] bg-[#F8FAF8]">
        <div class="public-container grid gap-4 py-6 sm:grid-cols-2 lg:grid-cols-5">
            @foreach ([
                ['icon' => 'D', 'title' => 'Dokter Kami', 'href' => '#dokter'],
                ['icon' => 'J', 'title' => 'Jadwal Dokter', 'href' => '#jadwal'],
                ['icon' => 'P', 'title' => 'Pengumuman', 'href' => '#pengumuman'],
                ['icon' => 'A', 'title' => 'Artikel', 'href' => '#artikel'],
                ['icon' => 'S', 'title' => 'Sertifikat', 'href' => '#sertifikat'],
            ] as $service)
                <a href="{{ $service['href'] }}" class="public-card flex items-center gap-4 p-4 transition hover:-translate-y-0.5 hover:border-[#14532D]">
                    <span class="service-icon">{{ $service['icon'] }}</span>
                    <span class="font-extrabold">{{ $service['title'] }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <section id="cari-dokter" class="public-section">
        <div class="public-container grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <p class="public-eyebrow mb-3">Cari Dokter</p>
                <h2 class="text-3xl font-extrabold">Temukan dokter berdasarkan spesialisasi dan poliklinik.</h2>
                <p class="mt-4 leading-7 text-[var(--color-muted)]">
                    Form ini menjadi pondasi fitur pencarian dokter. Untuk tahap berikutnya, pilihan ini akan diarahkan ke halaman daftar dokter dengan filter aktif.
                </p>
            </div>
            <div class="public-card p-5">
                <div class="grid gap-4 md:grid-cols-3">
                    <label class="grid gap-2 text-sm font-bold">
                        Nama Dokter
                        <select class="form-control-public">
                            <option>Semua Dokter</option>
                            @foreach ($doctors as $doctor)
                                <option>{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="grid gap-2 text-sm font-bold">
                        Spesialisasi
                        <select class="form-control-public">
                            <option>Semua Spesialisasi</option>
                            @foreach ($specializations as $specialization)
                                <option>{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="grid gap-2 text-sm font-bold">
                        Poliklinik
                        <select class="form-control-public">
                            <option>Semua Poliklinik</option>
                            @foreach ($polyclinics as $polyclinic)
                                <option>{{ $polyclinic->name }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <button class="public-btn-primary mt-5 w-full md:w-auto" type="button">Cari Jadwal Dokter</button>
            </div>
        </div>
    </section>

    <section id="profil" class="bg-[#14532D] py-10 text-white">
        <div class="public-container grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($stats as $stat)
                <div class="rounded-md border border-white/15 bg-white/8 p-5">
                    <p class="text-4xl font-extrabold">{{ $stat['value'] }}+</p>
                    <p class="mt-2 text-sm font-bold text-white/75">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section id="jadwal" class="public-section bg-white">
        <div class="public-container grid gap-8 lg:grid-cols-[0.85fr_1.15fr]">
            <div>
                <p class="public-eyebrow mb-3">Jadwal Dokter</p>
                <h2 class="text-3xl font-extrabold">Jadwal praktik terbaru</h2>
                <p class="mt-4 leading-7 text-[var(--color-muted)]">
                    Jadwal mengikuti data yang dikelola admin. Poliklinik otomatis mengikuti data dokter.
                </p>
            </div>

            <div class="public-card overflow-hidden">
                <div class="grid divide-y divide-[var(--color-border)]">
                    @forelse ($schedules as $schedule)
                        <div class="grid gap-3 p-5 md:grid-cols-[1fr_0.8fr_0.7fr_auto] md:items-center">
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

    <section id="dokter" class="public-section">
        <div class="public-container">
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="public-eyebrow mb-3">Dokter Kami</p>
                    <h2 class="text-3xl font-extrabold">Dokter terbaru</h2>
                </div>
                <a href="#cari-dokter" class="public-btn-outline text-sm">Cari Dokter</a>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                @forelse ($doctors as $doctor)
                    <article class="public-card overflow-hidden">
                        <div class="h-52 bg-[#DCFCE7]">
                            @if ($doctor->photo)
                                <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="grid h-full place-items-center text-5xl font-extrabold text-[#14532D]/25">RS</div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-extrabold">{{ $doctor->name }}</h3>
                            <p class="mt-1 text-sm text-[var(--color-muted)]">{{ $doctor->specialization?->name ?? 'Spesialis belum diisi' }}</p>
                            <p class="mt-3 inline-flex rounded-full bg-[#DCFCE7] px-3 py-1 text-xs font-bold text-[#14532D]">
                                {{ $doctor->polyclinic?->name ?? 'Poliklinik belum diisi' }}
                            </p>
                        </div>
                    </article>
                @empty
                    <div class="public-card col-span-full p-6 text-[var(--color-muted)]">Data dokter belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="pengumuman" class="public-section bg-white">
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

    <section id="artikel" class="public-section">
        <div class="public-container grid gap-8 lg:grid-cols-[0.85fr_1.15fr]">
            <div>
                <p class="public-eyebrow mb-3">News & Article</p>
                <h2 class="text-3xl font-extrabold">Artikel dan berita kesehatan.</h2>
                <p class="mt-4 leading-7 text-[var(--color-muted)]">
                    Artikel yang dipublikasikan dari admin akan tampil sebagai konten edukasi untuk pengunjung website.
                </p>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                @forelse ($articles as $article)
                    <article class="public-card overflow-hidden">
                        <div class="h-36 bg-[#DCFCE7]">
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
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-md bg-[#DCFCE7] font-extrabold text-[#14532D]">✓</div>
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
