<x-layouts.public title="Dokter Kami">
    <section class="bg-white">
        <div class="public-container grid gap-6 py-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-end">
            <div>
                <p class="public-eyebrow mb-3">Dokter Kami</p>
                <h1 class="max-w-3xl text-4xl font-extrabold leading-tight text-[var(--color-text)] sm:text-5xl">
                    Temukan dokter berdasarkan spesialisasi dan poliklinik.
                </h1>
            </div>
            <p class="max-w-2xl leading-7 text-[var(--color-muted)] lg:justify-self-end">
                Gunakan filter untuk mencari dokter yang sesuai dengan kebutuhan layanan kesehatan Anda.
            </p>
        </div>
    </section>

    <section class="border-y border-[var(--color-border)] bg-[var(--color-primary-soft)] py-6">
        <div class="public-container">
            <form method="GET" action="{{ route('doctors.index') }}" class="public-card grid gap-4 p-5 lg:grid-cols-[1fr_0.8fr_0.8fr_auto] lg:items-end">
                <label class="grid gap-2 text-sm font-bold">
                    Nama Dokter
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control-public" placeholder="Cari nama dokter">
                </label>
                <label class="grid gap-2 text-sm font-bold">
                    Spesialisasi
                    <select name="specialization_id" class="form-control-public">
                        <option value="">Semua Spesialisasi</option>
                        @foreach ($specializations as $specialization)
                            <option value="{{ $specialization->id }}" @selected((string) request('specialization_id') === (string) $specialization->id)>
                                {{ $specialization->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label class="grid gap-2 text-sm font-bold">
                    Poliklinik
                    <select name="polyclinic_id" class="form-control-public">
                        <option value="">Semua Poliklinik</option>
                        @foreach ($polyclinics as $polyclinic)
                            <option value="{{ $polyclinic->id }}" @selected((string) request('polyclinic_id') === (string) $polyclinic->id)>
                                {{ $polyclinic->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <div class="flex flex-col gap-2 sm:flex-row lg:flex-col">
                    <button class="public-btn-primary" type="submit">Cari</button>
                    <a href="{{ route('doctors.index') }}" class="public-btn-outline text-sm">Reset</a>
                </div>
            </form>
        </div>
    </section>

    <section class="public-section">
        <div class="public-container">
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="public-eyebrow mb-3">Daftar Dokter</p>
                    <h2 class="text-3xl font-extrabold">Profil dokter rumah sakit</h2>
                </div>
                <a href="{{ route('home') }}" class="public-btn-outline text-sm">Kembali ke Beranda</a>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                @forelse ($doctors as $doctor)
                    <article class="public-card overflow-hidden">
                        <div class="h-56 bg-[var(--color-primary-soft)]">
                            @if ($doctor->photo)
                                <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="grid h-full place-items-center text-5xl font-extrabold text-[var(--color-primary)]/25">RS</div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-extrabold">{{ $doctor->name }}</h3>
                            <p class="mt-1 text-sm text-[var(--color-muted)]">{{ $doctor->specialization?->name ?? 'Spesialis belum diisi' }}</p>
                            <p class="mt-3 inline-flex rounded-full bg-[var(--color-primary-soft)] px-3 py-1 text-xs font-bold text-[var(--color-primary)]">
                                {{ $doctor->polyclinic?->name ?? 'Poliklinik belum diisi' }}
                            </p>
                        </div>
                    </article>
                @empty
                    <div class="public-card col-span-full p-6 text-[var(--color-muted)]">Data dokter belum tersedia.</div>
                @endforelse
            </div>

            @if ($doctors instanceof \Illuminate\Contracts\Pagination\Paginator && $doctors->hasPages())
                <div class="mt-8">
                    {{ $doctors->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layouts.public>
