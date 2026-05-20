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
    </div>
</header>
