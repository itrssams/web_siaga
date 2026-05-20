@php
    $logoPath = 'images/logo-rssams.png';
    $hasLogo = file_exists(public_path($logoPath));
    $links = [
        ['label' => 'Beranda', 'href' => route('home')],
        ['label' => 'Pelayanan', 'href' => route('home') . '#layanan'],
        ['label' => 'Dokter Kami', 'href' => route('doctors.index')],
        ['label' => 'Jadwal Dokter', 'href' => route('schedules.index')],
        ['label' => 'Artikel', 'href' => route('articles.index')],
        ['label' => 'Pengumuman', 'href' => route('announcements.index')],
        ['label' => 'Sertifikat', 'href' => route('certificates.index')],
        ['label' => 'Tentang Kami', 'href' => route('about')],
    ];
@endphp

<header class="sticky top-0 z-40 border-b border-[var(--color-border)] bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/85">
    <div class="public-container flex min-h-20 items-center justify-between gap-6">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            @if ($hasLogo)
                <img src="{{ asset($logoPath) }}" alt="Rumah Sakit Siaga Al Munawwarah Samarinda" class="h-12 w-12 rounded-md object-contain">
            @else
                <span class="flex h-12 w-12 items-center justify-center rounded-md bg-[var(--color-primary-strong)] text-lg font-extrabold text-white">RS</span>
            @endif
            <span class="leading-tight">
                <span class="block text-lg font-extrabold text-[var(--color-primary-strong)]">RS Siaga Al Munawwarah</span>
                <span class="block text-xs font-semibold text-[var(--color-muted)]">Samarinda</span>
            </span>
        </a>

        <nav class="hidden items-center gap-5 text-sm font-semibold text-[var(--color-muted)] lg:flex">
            @foreach ($links as $link)
                <a href="{{ $link['href'] }}" class="transition hover:text-[var(--color-primary-strong)]">{{ $link['label'] }}</a>
            @endforeach
        </nav>

        <a href="{{ url('/admin') }}" class="public-btn-outline hidden text-sm lg:inline-flex">Admin</a>

        <details class="mobile-menu relative lg:hidden">
            <summary class="flex h-11 w-11 cursor-pointer list-none items-center justify-center rounded-md border border-[var(--color-border)] text-[var(--color-primary-strong)] transition hover:border-[var(--color-primary)] hover:bg-[var(--color-primary-soft)]">
                <span class="sr-only">Buka menu navigasi</span>
                @svg('heroicon-o-bars-3', 'h-6 w-6 mobile-menu-open-icon')
                @svg('heroicon-o-x-mark', 'h-6 w-6 mobile-menu-close-icon')
            </summary>

            <div class="absolute right-0 top-14 w-[min(20rem,calc(100vw-2rem))] overflow-hidden rounded-lg border border-[var(--color-border)] bg-white shadow-[0_24px_70px_rgb(15_32_51_/_0.16)]">
                <nav class="grid p-2 text-sm font-bold text-[var(--color-muted)]">
                    @foreach ($links as $link)
                        <a href="{{ $link['href'] }}" class="rounded-md px-4 py-3 transition hover:bg-[var(--color-primary-soft)] hover:text-[var(--color-primary-strong)]">{{ $link['label'] }}</a>
                    @endforeach
                </nav>
                <div class="border-t border-[var(--color-border)] p-3">
                    <a href="{{ url('/admin') }}" class="public-btn-outline w-full text-sm">Admin</a>
                </div>
            </div>
        </details>
    </div>
</header>
