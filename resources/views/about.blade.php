<x-layouts.public title="Tentang Kami">
    <section class="bg-white">
        <div class="public-container grid gap-8 py-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
            <div>
                <p class="public-eyebrow mb-3">Tentang Kami</p>
                <h1 class="max-w-3xl text-4xl font-extrabold leading-tight text-[var(--color-text)] sm:text-5xl">
                    Rumah Sakit Siaga Al Munawwarah Samarinda.
                </h1>
                <p class="mt-5 max-w-2xl text-base leading-7 text-[var(--color-muted)] sm:text-lg">
                    Rumah sakit yang berkomitmen menghadirkan layanan kesehatan yang profesional, ramah, dan mudah diakses untuk masyarakat Samarinda dan sekitarnya.
                </p>
            </div>
            <div class="public-card overflow-hidden">
                <img src="{{ asset('images/hero-rs.jpg') }}" alt="Gedung Rumah Sakit Siaga Al Munawwarah Samarinda" class="h-80 w-full object-cover">
            </div>
        </div>
    </section>

    <section class="public-section bg-[linear-gradient(180deg,#ffffff_0%,#fff7e0_52%,#ffffff_100%)]">
        <div class="public-container grid gap-6 lg:grid-cols-3">
            <article class="public-card p-6 lg:col-span-2">
                <p class="public-eyebrow mb-3">Profil</p>
                <h2 class="text-3xl font-extrabold">Layanan kesehatan dengan pendekatan yang tenang dan personal.</h2>
                <div class="mt-5 grid gap-4 text-base leading-8 text-[var(--color-muted)]">
                    <p>
                        Rumah Sakit Siaga Al Munawwarah Samarinda menyediakan layanan kesehatan untuk pasien umum, keluarga, dan masyarakat dengan dukungan dokter, poliklinik, serta informasi layanan yang terus diperbarui.
                    </p>
                    <p>
                        Website ini disiapkan sebagai kanal informasi resmi untuk membantu pasien melihat profil dokter, jadwal praktik, pengumuman, artikel kesehatan, dan dokumen sertifikat rumah sakit.
                    </p>
                </div>
            </article>

            <aside class="public-card p-6">
                <p class="public-eyebrow mb-3">Kontak</p>
                <div class="grid gap-4 text-sm leading-6 text-[var(--color-muted)]">
                    <div>
                        <p class="font-extrabold text-[var(--color-text)]">Telepon</p>
                        <p>(0000) 000000</p>
                    </div>
                    <div>
                        <p class="font-extrabold text-[var(--color-text)]">Email</p>
                        <p>info@rssams.test</p>
                    </div>
                    <div>
                        <p class="font-extrabold text-[var(--color-text)]">Alamat</p>
                        <p>Alamat rumah sakit dapat disesuaikan melalui konten resmi.</p>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <section class="bg-[var(--color-primary-strong)] py-12 text-white">
        <div class="public-container grid gap-6 lg:grid-cols-2">
            <div class="rounded-md border border-white/15 bg-white/8 p-6">
                <p class="text-sm font-extrabold uppercase text-[var(--color-accent)]">Visi</p>
                <h2 class="mt-3 text-3xl font-extrabold">Menjadi rumah sakit pilihan dengan layanan yang bermutu dan humanis.</h2>
            </div>
            <div class="rounded-md border border-white/15 bg-white/8 p-6">
                <p class="text-sm font-extrabold uppercase text-[var(--color-accent)]">Misi</p>
                <ul class="mt-3 grid gap-3 text-sm leading-6 text-white/78">
                    <li>Memberikan pelayanan kesehatan yang profesional, aman, dan berorientasi pada pasien.</li>
                    <li>Menghadirkan informasi layanan yang jelas, cepat, dan mudah diakses.</li>
                    <li>Mendukung peningkatan kualitas kesehatan masyarakat melalui edukasi dan pelayanan berkelanjutan.</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="public-section bg-white">
        <div class="public-container">
            <div class="mb-8">
                <p class="public-eyebrow mb-3">Nilai Layanan</p>
                <h2 class="text-3xl font-extrabold">Fokus pada kenyamanan dan kepercayaan pasien.</h2>
            </div>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['title' => 'Profesional', 'description' => 'Pelayanan diberikan oleh tenaga kesehatan sesuai kompetensi dan standar layanan.'],
                    ['title' => 'Ramah', 'description' => 'Setiap pasien dilayani dengan komunikasi yang hangat, jelas, dan menghargai kebutuhan pasien.'],
                    ['title' => 'Terpercaya', 'description' => 'Informasi dokter, jadwal, dan pengumuman disiapkan sebagai kanal resmi rumah sakit.'],
                    ['title' => 'Responsif', 'description' => 'Layanan terus dikembangkan agar mudah diakses oleh pasien dan keluarga.'],
                ] as $value)
                    <article class="public-card p-5">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-md bg-[var(--color-primary-soft)] text-[var(--color-primary)]">
                            @svg('heroicon-o-check-badge', 'h-7 w-7')
                        </div>
                        <h3 class="font-extrabold">{{ $value['title'] }}</h3>
                        <p class="mt-3 text-sm leading-6 text-[var(--color-muted)]">{{ $value['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.public>
