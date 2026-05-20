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

            <div class="grid">
                @forelse ($scheduleDoctors as $doctor)
                    <article class="border-b border-[var(--color-accent)]/30 py-8 first:pt-0 last:border-b-0">
                        <div class="grid gap-6 lg:grid-cols-[16rem_1fr] lg:items-start">
                            <aside class="flex justify-center lg:pt-8">
                                <div class="h-32 w-32 overflow-hidden rounded-full bg-[var(--color-primary-soft)] shadow-[0_18px_44px_rgb(15_63_38_/_0.14)] ring-4 ring-white">
                                    @if ($doctor->photo)
                                        <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="grid h-full place-items-center text-4xl font-extrabold text-[var(--color-primary)]/30">RS</div>
                                    @endif
                                </div>
                            </aside>

                            <div class="min-w-0">
                                <div class="mb-3">
                                    <h3 class="text-2xl font-extrabold leading-tight text-[var(--color-text)]">{{ $doctor->name }}</h3>
                                    <p class="mt-1 text-base font-medium italic text-[var(--color-text)]">{{ $doctor->polyclinic?->name ?? 'Poliklinik belum diisi' }}</p>
                                    <p class="mt-1 text-sm font-bold text-[var(--color-muted)]">{{ $doctor->specialization?->name ?? 'Spesialis belum diisi' }}</p>
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="w-full min-w-[820px] table-fixed border-collapse bg-white text-center">
                                        <thead class="text-base font-extrabold text-[var(--color-text)]">
                                            <tr>
                                                @foreach (\App\Models\DoctorSchedule::DAYS as $dayName)
                                                    <th class="w-[14.285714%] border border-[var(--color-border)] px-3 py-2">{{ $dayName }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach (\App\Models\DoctorSchedule::DAYS as $dayNumber => $dayName)
                                                    @php
                                                        $daySchedules = $doctor->schedules->where('day_of_week', $dayNumber);
                                                    @endphp

                                                    <td class="w-[14.285714%] border border-[var(--color-border)] px-2 py-2 align-middle">
                                                        @forelse ($daySchedules as $schedule)
                                                            <div class="mx-auto mb-1 last:mb-0">
                                                                <p class="whitespace-nowrap text-sm font-extrabold text-[var(--color-text)]">
                                                                    {{ $schedule->start_time?->format('H:i') }} - {{ $schedule->end_time?->format('H:i') }}
                                                                </p>
                                                                @if ($schedule->note)
                                                                    <p class="mt-1 text-xs leading-5 text-[var(--color-muted)]">{{ $schedule->note }}</p>
                                                                @endif
                                                            </div>
                                                        @empty
                                                            <span class="text-sm font-extrabold text-[var(--color-muted)]">-</span>
                                                        @endforelse
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4 flex flex-wrap gap-2">
                                    <a href="{{ route('doctors.index', ['search' => $doctor->name]) }}" class="inline-flex min-h-8 items-center justify-center rounded-md bg-[var(--color-primary)] px-4 text-sm font-extrabold text-white transition hover:bg-[var(--color-primary-strong)]">
                                        View Detail
                                    </a>
                                    <a href="#" class="inline-flex min-h-8 items-center justify-center rounded-md bg-[var(--color-accent)] px-4 text-sm font-extrabold text-[var(--color-primary-strong)] transition hover:bg-[#f4cf59]">
                                        Reservasi Online
                                    </a>
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
