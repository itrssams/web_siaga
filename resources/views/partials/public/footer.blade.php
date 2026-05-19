<footer class="border-t border-[var(--color-border)] bg-[#0F2419] text-white">
    <div class="public-container grid gap-8 py-10 md:grid-cols-[1.4fr_1fr_1fr]">
        <div>
            <div class="mb-4 flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-md bg-white text-sm font-extrabold text-[#14532D]">RS</span>
                <div>
                    <p class="font-extrabold">RS Sams</p>
                    <p class="text-sm text-white/70">Rumah Sakit Siaga</p>
                </div>
            </div>
            <p class="max-w-md text-sm leading-6 text-white/70">
                Website profil resmi untuk informasi dokter, jadwal pelayanan, pengumuman, artikel kesehatan, dan sertifikat rumah sakit.
            </p>
        </div>

        <div>
            <p class="mb-3 font-bold">Navigasi</p>
            <div class="grid gap-2 text-sm text-white/70">
                <a href="#dokter" class="hover:text-white">Dokter</a>
                <a href="#jadwal" class="hover:text-white">Jadwal Dokter</a>
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
            &copy; {{ date('Y') }} RS Sams. All rights reserved.
        </div>
    </div>
</footer>
