<x-layouts.public title="Jadwal Dokter">
    <section class="bg-white">
        <div class="public-container grid gap-6 py-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-end">
            <div>
                <p class="public-eyebrow mb-3">Jadwal Dokter</p>
                <h1 class="max-w-3xl text-4xl font-extrabold leading-tight text-[var(--color-text)] sm:text-5xl">
                    Lihat jadwal praktik dokter berdasarkan hari dan layanan.
                </h1>
            </div>
            <p class="max-w-2xl leading-7 text-[var(--color-muted)] lg:justify-self-end">
                Gunakan filter untuk menemukan jadwal dokter, spesialisasi, dan poliklinik yang sesuai.
            </p>
        </div>
    </section>

    <section class="border-y border-[var(--color-border)] bg-[var(--color-primary-soft)] py-6">
        <div class="public-container">
            <form method="GET" action="{{ route('schedules.index') }}" class="public-card grid gap-4 p-5 lg:grid-cols-[1fr_0.8fr_0.8fr_0.7fr_auto] lg:items-end">
                <label class="grid gap-2 text-sm font-bold">
                    Dokter
                    <select name="doctor_id" class="form-control-public">
                        <option value="">Semua Dokter</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}" @selected((string) request('doctor_id') === (string) $doctor->id)>
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
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
                <label class="grid gap-2 text-sm font-bold">
                    Hari
                    <select name="day_of_week" class="form-control-public">
                        <option value="">Semua Hari</option>
                        @foreach (\App\Models\DoctorSchedule::DAYS as $dayNumber => $dayName)
                            <option value="{{ $dayNumber }}" @selected((string) request('day_of_week') === (string) $dayNumber)>
                                {{ $dayName }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <div class="flex flex-col gap-2 sm:flex-row lg:flex-col">
                    <button class="public-btn-primary" type="submit">Cari</button>
                    <a href="{{ route('schedules.index') }}" class="public-btn-outline text-sm">Reset</a>
                </div>
            </form>
        </div>
    </section>

    <section class="public-section">
        <div class="public-container">
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="public-eyebrow mb-3">Daftar Jadwal</p>
                    <h2 class="text-3xl font-extrabold">Jadwal praktik tersedia</h2>
                </div>
                <a href="{{ route('home') }}" class="public-btn-outline text-sm">Kembali ke Beranda</a>
            </div>

            <div class="grid gap-4">
                @forelse ($schedules as $schedule)
                    <article class="public-card grid gap-4 p-5 md:grid-cols-[1fr_0.75fr_0.75fr_auto] md:items-center">
                        <div class="flex items-center gap-4">
                            <div class="h-16 w-16 flex-none overflow-hidden rounded-md bg-[var(--color-primary-soft)]">
                                @if ($schedule->doctor?->photo)
                                    <img src="{{ asset('storage/' . $schedule->doctor->photo) }}" alt="{{ $schedule->doctor->name }}" class="h-full w-full object-cover">
                                @else
                                    <div class="grid h-full place-items-center text-lg font-extrabold text-[var(--color-primary)]/35">RS</div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-extrabold">{{ $schedule->doctor?->name ?? 'Dokter belum diisi' }}</h3>
                                <p class="mt-1 text-sm text-[var(--color-muted)]">{{ $schedule->doctor?->specialization?->name ?? 'Spesialis belum diisi' }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase text-[var(--color-muted)]">Poliklinik</p>
                            <p class="mt-1 font-bold text-[var(--color-primary)]">{{ $schedule->doctor?->polyclinic?->name ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase text-[var(--color-muted)]">Hari</p>
                            <p class="mt-1 font-bold">{{ $schedule->day_name }}</p>
                        </div>

                        <div class="rounded-md border border-[var(--color-border)] bg-white px-4 py-3 text-center">
                            <p class="text-xs font-bold uppercase text-[var(--color-muted)]">Jam Praktik</p>
                            <p class="mt-1 whitespace-nowrap font-extrabold">
                                {{ $schedule->start_time?->format('H:i') }} - {{ $schedule->end_time?->format('H:i') }}
                            </p>
                        </div>

                        @if ($schedule->note)
                            <p class="md:col-span-4 rounded-md bg-[var(--color-primary-soft)] px-4 py-3 text-sm leading-6 text-[var(--color-muted)]">
                                {{ $schedule->note }}
                            </p>
                        @endif
                    </article>
                @empty
                    <div class="public-card p-6 text-[var(--color-muted)]">Jadwal dokter belum tersedia.</div>
                @endforelse
            </div>

            @if ($schedules instanceof \Illuminate\Contracts\Pagination\Paginator && $schedules->hasPages())
                <div class="mt-8">
                    {{ $schedules->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layouts.public>
