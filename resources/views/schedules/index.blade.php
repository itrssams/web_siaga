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

            <div class="grid gap-5">
                @forelse ($scheduleDoctors as $doctor)
                    <article class="public-card overflow-hidden">
                        <div class="grid gap-4 border-b border-[var(--color-border)] p-5 md:grid-cols-[auto_1fr_auto] md:items-center">
                            <div class="h-20 w-20 overflow-hidden rounded-md bg-[var(--color-primary-soft)]">
                                @if ($doctor->photo)
                                    <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="h-full w-full object-cover">
                                @else
                                    <div class="grid h-full place-items-center text-xl font-extrabold text-[var(--color-primary)]/35">RS</div>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-xl font-extrabold">{{ $doctor->name }}</h3>
                                <p class="mt-1 text-sm text-[var(--color-muted)]">{{ $doctor->specialization?->name ?? 'Spesialis belum diisi' }}</p>
                                <p class="mt-3 inline-flex rounded-full bg-[var(--color-primary-soft)] px-3 py-1 text-xs font-bold text-[var(--color-primary)]">
                                    {{ $doctor->polyclinic?->name ?? 'Poliklinik belum diisi' }}
                                </p>
                            </div>
                            <a href="{{ route('doctors.index', ['search' => $doctor->name]) }}" class="public-btn-outline text-sm">Detail Dokter</a>
                        </div>

                        <div class="overflow-x-auto">
                            <div class="min-w-[760px]">
                                <div class="grid grid-cols-7 border-b border-[var(--color-border)] bg-[var(--color-primary-strong)] text-center text-xs font-extrabold uppercase text-white">
                                    @foreach (\App\Models\DoctorSchedule::DAYS as $dayName)
                                        <div class="border-r border-white/10 px-3 py-3 last:border-r-0">{{ $dayName }}</div>
                                    @endforeach
                                </div>
                                <div class="grid grid-cols-7 bg-white text-center">
                                    @foreach (\App\Models\DoctorSchedule::DAYS as $dayNumber => $dayName)
                                        @php
                                            $daySchedules = $doctor->schedules->where('day_of_week', $dayNumber);
                                        @endphp

                                        <div class="min-h-28 border-r border-[var(--color-border)] px-3 py-4 last:border-r-0">
                                            @forelse ($daySchedules as $schedule)
                                                <div class="mb-2 rounded-md border border-[var(--color-border)] bg-[var(--color-primary-soft)] px-2 py-2 last:mb-0">
                                                    <p class="whitespace-nowrap text-sm font-extrabold text-[var(--color-primary)]">
                                                        {{ $schedule->start_time?->format('H:i') }} - {{ $schedule->end_time?->format('H:i') }}
                                                    </p>
                                                    @if ($schedule->note)
                                                        <p class="mt-1 text-xs leading-5 text-[var(--color-muted)]">{{ $schedule->note }}</p>
                                                    @endif
                                                </div>
                                            @empty
                                                <span class="inline-flex h-full min-h-16 items-center text-sm font-bold text-[var(--color-muted)]/60">-</span>
                                            @endforelse
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="public-card p-6 text-[var(--color-muted)]">Jadwal dokter belum tersedia.</div>
                @endforelse
            </div>

            @if ($scheduleDoctors instanceof \Illuminate\Contracts\Pagination\Paginator && $scheduleDoctors->hasPages())
                <div class="mt-8">
                    {{ $scheduleDoctors->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layouts.public>
