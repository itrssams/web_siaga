<footer class="border-t border-[var(--color-border)] bg-[var(--color-primary-strong)] text-white">
    @php
        $logoPath = 'images/logo-rssams.png';
        $hasLogo = file_exists(public_path($logoPath));
    @endphp

    <div class="public-container grid gap-8 py-10 md:grid-cols-[1.4fr_1fr_1fr]">
        <div>
            <div class="mb-4 flex items-center gap-3">
                @if ($hasLogo)
                    <img src="{{ asset($logoPath) }}" alt="Rumah Sakit Siaga Al Munawwarah Samarinda" class="h-10 w-10 rounded-md bg-white object-contain">
                @else
                    <span class="flex h-10 w-10 items-center justify-center rounded-md bg-white text-sm font-extrabold text-[var(--color-primary-strong)]">RS</span>
                @endif
                <div>
                    <p class="font-extrabold">RS Siaga Al Munawwarah</p>
                    <p class="text-sm text-white/70">Samarinda</p>
                </div>
            </div>
            <p class="max-w-md text-sm leading-6 text-white/70">
                Website profil resmi untuk informasi dokter, pengumuman, artikel kesehatan, dan sertifikat rumah sakit.
            </p>
        </div>

        <div>
            <p class="mb-3 font-bold">Navigasi</p>
            <div class="grid gap-2 text-sm text-white/70">
                <a href="#dokter" class="hover:text-white">Dokter</a>
                <a href="#pengumuman" class="hover:text-white">Pengumuman</a>
                <a href="#artikel" class="hover:text-white">Artikel</a>
            </div>
        </div>

        <div>
            <p class="mb-3 font-bold">Kontak</p>
            <div class="grid gap-2 text-sm text-white/70">
                <span>Telp. (0000) 000000</span>
                <span>Email: info@rssams.test</span>
                <span>Alamat rumah sakit dapat disesuaikan.</span>
            </div>
        </div>
    </div>
    <div class="border-t border-white/10 py-4">
        <div class="public-container text-sm text-white/60">
            &copy; {{ date('Y') }} Rumah Sakit Siaga Al Munawwarah Samarinda. All rights reserved.
        </div>
    </div>
</footer>
