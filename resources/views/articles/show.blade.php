<x-layouts.public title="{{ $article->title }}">
    <section class="bg-white">
        <div class="public-container max-w-4xl py-10">
            <a href="{{ route('articles.index') }}" class="mb-6 inline-flex text-sm font-extrabold text-[var(--color-primary)] hover:text-[var(--color-primary-strong)]">
                Kembali ke Artikel
            </a>
            <p class="public-eyebrow mb-3">Artikel</p>
            <h1 class="text-4xl font-extrabold leading-tight text-[var(--color-text)] sm:text-5xl">
                {{ $article->title }}
            </h1>
            <div class="mt-5 flex flex-wrap items-center gap-3 text-sm font-bold text-[var(--color-muted)]">
                <span>{{ $article->published_at?->translatedFormat('d F Y') ?? 'Tanggal belum diisi' }}</span>
                @if ($article->author)
                    <span>Ditulis oleh {{ $article->author }}</span>
                @endif
                @if ($article->is_featured)
                    <span class="rounded-full bg-[var(--color-accent)]/18 px-3 py-1 text-xs font-extrabold text-[#7A5F09]">Unggulan</span>
                @endif
            </div>
        </div>
    </section>

    <section class="public-section bg-[linear-gradient(180deg,#ffffff_0%,#fff7e0_52%,#ffffff_100%)]">
        <div class="public-container grid gap-8 lg:grid-cols-[1fr_20rem]">
            <article class="public-card overflow-hidden">
                @if ($article->thumbnail)
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="h-72 w-full object-cover">
                @endif
                <div class="p-6 lg:p-8">
                    @if ($article->excerpt)
                        <p class="mb-6 rounded-md bg-[var(--color-primary-soft)] p-4 font-bold leading-7 text-[var(--color-primary-strong)]">{{ $article->excerpt }}</p>
                    @endif

                    <div class="space-y-5 text-base leading-8 text-[var(--color-text)]">
                        @foreach (preg_split('/\r\n|\r|\n/', $article->content) as $paragraph)
                            @if (filled(trim($paragraph)))
                                <p>{{ $paragraph }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </article>

            <aside>
                <div class="public-card p-5">
                    <p class="mb-4 font-extrabold text-[var(--color-primary-strong)]">Artikel Lainnya</p>
                    <div class="grid gap-4">
                        @forelse ($otherArticles as $otherArticle)
                            <a href="{{ route('articles.show', $otherArticle) }}" class="block rounded-md border border-[var(--color-border)] p-4 transition hover:border-[var(--color-accent)]/60 hover:bg-[var(--color-primary-soft)]">
                                <p class="text-xs font-bold uppercase text-[var(--color-muted)]">
                                    {{ $otherArticle->published_at?->translatedFormat('d F Y') ?? 'Tanggal belum diisi' }}
                                </p>
                                <p class="mt-2 font-extrabold text-[var(--color-text)]">{{ $otherArticle->title }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-[var(--color-muted)]">Belum ada artikel lain.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </section>
</x-layouts.public>
