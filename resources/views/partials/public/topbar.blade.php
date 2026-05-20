@php
    $topbarLeft = \Illuminate\Support\Facades\Schema::hasTable('site_settings')
        ? \App\Models\SiteSetting::activeFor('topbar_left')
        : collect();
    $topbarRight = \Illuminate\Support\Facades\Schema::hasTable('site_settings')
        ? \App\Models\SiteSetting::activeFor('topbar_right')
        : collect();

    if ($topbarLeft->isEmpty()) {
        $topbarLeft = collect([
            (object) ['label' => 'IGD 24 Jam', 'value' => '0812 0000 0000', 'url' => null],
            (object) ['label' => 'Ambulans', 'value' => '0812 1111 1111', 'url' => null],
        ]);
    }

    if ($topbarRight->isEmpty()) {
        $topbarRight = collect([
            (object) ['label' => 'Telp', 'value' => '(0000) 000000', 'url' => null],
            (object) ['label' => 'Email', 'value' => 'info@rssams.test', 'url' => null],
        ]);
    }
@endphp

<div class="bg-[var(--color-primary-strong)] text-white">
    <div class="public-container flex min-h-10 flex-col justify-center gap-1 py-2 text-sm sm:flex-row sm:items-center sm:justify-between sm:py-0">
        <div class="flex flex-wrap items-center gap-x-5 gap-y-1">
            @foreach ($topbarLeft as $item)
                @if ($item->url)
                    <a href="{{ $item->url }}" class="hover:text-[var(--color-accent)]">{{ $item->label }}: {{ $item->value }}</a>
                @else
                    <span>{{ $item->label }}: {{ $item->value }}</span>
                @endif
                @if (! $loop->last)
                    <span class="hidden h-4 w-px bg-white/30 sm:block"></span>
                @endif
            @endforeach
        </div>
        <div class="flex flex-wrap items-center gap-x-5 gap-y-1 text-white/90">
            @foreach ($topbarRight as $item)
                @if ($item->url)
                    <a href="{{ $item->url }}" class="hover:text-[var(--color-accent)]">{{ $item->label }}: {{ $item->value }}</a>
                @else
                    <span>{{ $item->label }}: {{ $item->value }}</span>
                @endif
            @endforeach
        </div>
    </div>
</div>
