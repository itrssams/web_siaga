<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Article;
use App\Models\Certificate;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Polyclinic;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@rssams.test'],
            [
                'name' => 'Administrator RSSAMS',
                'password' => Hash::make('password'),
            ],
        );

        $specializations = collect([
            ['name' => 'Penyakit Dalam', 'description' => 'Layanan konsultasi penyakit dalam dan metabolik.', 'sort_order' => 1],
            ['name' => 'Anak', 'description' => 'Layanan kesehatan bayi, anak, dan tumbuh kembang.', 'sort_order' => 2],
            ['name' => 'Kebidanan dan Kandungan', 'description' => 'Layanan kesehatan ibu, kehamilan, dan kandungan.', 'sort_order' => 3],
            ['name' => 'Bedah Umum', 'description' => 'Layanan konsultasi dan tindakan bedah umum.', 'sort_order' => 4],
            ['name' => 'Gigi', 'description' => 'Layanan pemeriksaan dan perawatan kesehatan gigi.', 'sort_order' => 5],
            ['name' => 'Umum', 'description' => 'Layanan dokter umum dan pemeriksaan awal.', 'sort_order' => 6],
        ])->mapWithKeys(fn (array $data): array => [
            $data['name'] => Specialization::query()->updateOrCreate(
                ['name' => $data['name']],
                $data + ['is_active' => true],
            ),
        ]);

        $polyclinics = collect([
            ['name' => 'Poli Penyakit Dalam', 'description' => 'Poliklinik penyakit dalam.', 'sort_order' => 1],
            ['name' => 'Poli Anak', 'description' => 'Poliklinik anak.', 'sort_order' => 2],
            ['name' => 'Poli Kandungan', 'description' => 'Poliklinik kebidanan dan kandungan.', 'sort_order' => 3],
            ['name' => 'Poli Bedah', 'description' => 'Poliklinik bedah umum.', 'sort_order' => 4],
            ['name' => 'Poli Gigi', 'description' => 'Poliklinik gigi.', 'sort_order' => 5],
            ['name' => 'Poli Umum', 'description' => 'Poliklinik umum.', 'sort_order' => 6],
        ])->mapWithKeys(fn (array $data): array => [
            $data['name'] => Polyclinic::query()->updateOrCreate(
                ['name' => $data['name']],
                $data + ['is_active' => true],
            ),
        ]);

        $demoPhoto = collect(Storage::disk('public')->files('doctors'))
            ->first(fn (string $path): bool => str_ends_with($path, '.jpg') || str_ends_with($path, '.jpeg') || str_ends_with($path, '.png') || str_ends_with($path, '.webp'));

        $doctors = collect([
            ['name' => 'dr. Febry Setiawan, Sp.PD', 'specialization' => 'Penyakit Dalam', 'polyclinic' => 'Poli Penyakit Dalam'],
            ['name' => 'dr. Aisyah Ramadhani, Sp.A', 'specialization' => 'Anak', 'polyclinic' => 'Poli Anak'],
            ['name' => 'dr. Nurhaliza Putri, Sp.OG', 'specialization' => 'Kebidanan dan Kandungan', 'polyclinic' => 'Poli Kandungan'],
            ['name' => 'dr. Ahmad Fauzi, Sp.B', 'specialization' => 'Bedah Umum', 'polyclinic' => 'Poli Bedah'],
            ['name' => 'drg. Rina Wulandari', 'specialization' => 'Gigi', 'polyclinic' => 'Poli Gigi'],
            ['name' => 'dr. Muhammad Rizky', 'specialization' => 'Umum', 'polyclinic' => 'Poli Umum'],
        ])->mapWithKeys(fn (array $data): array => [
            $data['name'] => Doctor::query()->updateOrCreate(
                ['name' => $data['name']],
                [
                    'photo' => $demoPhoto,
                    'specialization_id' => $specializations[$data['specialization']]->id,
                    'polyclinic_id' => $polyclinics[$data['polyclinic']]->id,
                ],
            ),
        ]);

        $scheduleRows = [
            ['doctor' => 'dr. Febry Setiawan, Sp.PD', 'day' => 1, 'start' => '09:00', 'end' => '12:00'],
            ['doctor' => 'dr. Febry Setiawan, Sp.PD', 'day' => 3, 'start' => '13:00', 'end' => '15:00'],
            ['doctor' => 'dr. Febry Setiawan, Sp.PD', 'day' => 5, 'start' => '09:00', 'end' => '11:00'],
            ['doctor' => 'dr. Aisyah Ramadhani, Sp.A', 'day' => 2, 'start' => '10:00', 'end' => '13:00'],
            ['doctor' => 'dr. Aisyah Ramadhani, Sp.A', 'day' => 4, 'start' => '10:00', 'end' => '13:00'],
            ['doctor' => 'dr. Nurhaliza Putri, Sp.OG', 'day' => 1, 'start' => '14:00', 'end' => '16:00'],
            ['doctor' => 'dr. Nurhaliza Putri, Sp.OG', 'day' => 5, 'start' => '14:00', 'end' => '16:00'],
            ['doctor' => 'dr. Ahmad Fauzi, Sp.B', 'day' => 2, 'start' => '16:00', 'end' => '19:00'],
            ['doctor' => 'dr. Ahmad Fauzi, Sp.B', 'day' => 6, 'start' => '09:00', 'end' => '12:00', 'note' => 'Dengan perjanjian'],
            ['doctor' => 'drg. Rina Wulandari', 'day' => 3, 'start' => '09:00', 'end' => '12:00'],
            ['doctor' => 'drg. Rina Wulandari', 'day' => 6, 'start' => '10:00', 'end' => '13:00'],
            ['doctor' => 'dr. Muhammad Rizky', 'day' => 1, 'start' => '08:00', 'end' => '14:00'],
            ['doctor' => 'dr. Muhammad Rizky', 'day' => 2, 'start' => '08:00', 'end' => '14:00'],
            ['doctor' => 'dr. Muhammad Rizky', 'day' => 3, 'start' => '08:00', 'end' => '14:00'],
            ['doctor' => 'dr. Muhammad Rizky', 'day' => 4, 'start' => '08:00', 'end' => '14:00'],
            ['doctor' => 'dr. Muhammad Rizky', 'day' => 5, 'start' => '08:00', 'end' => '14:00'],
        ];

        foreach ($scheduleRows as $index => $row) {
            DoctorSchedule::query()->updateOrCreate(
                [
                    'doctor_id' => $doctors[$row['doctor']]->id,
                    'day_of_week' => $row['day'],
                    'start_time' => $row['start'],
                ],
                [
                    'end_time' => $row['end'],
                    'note' => $row['note'] ?? null,
                    'is_active' => true,
                    'sort_order' => $index,
                ],
            );
        }

        collect([
            ['title' => 'Informasi Jam Layanan Rawat Jalan', 'content' => 'Layanan rawat jalan dibuka setiap Senin sampai Sabtu sesuai jadwal dokter yang berlaku. Pasien disarankan datang 30 menit sebelum jadwal praktik.', 'published_at' => now()->subDays(1), 'is_pinned' => true],
            ['title' => 'Pendaftaran Pasien Dapat Dilakukan Lebih Awal', 'content' => 'Untuk kenyamanan pasien, pendaftaran layanan poliklinik dapat dilakukan lebih awal melalui loket informasi rumah sakit.', 'published_at' => now()->subDays(3), 'is_pinned' => false],
            ['title' => 'Pemeriksaan Kesehatan Berkala', 'content' => 'Rumah sakit menyediakan layanan pemeriksaan kesehatan berkala untuk keluarga, karyawan, dan masyarakat umum.', 'published_at' => now()->subDays(7), 'is_pinned' => false],
            ['title' => 'Imbauan Menjaga Kebersihan Tangan', 'content' => 'Pengunjung dan pasien diimbau menjaga kebersihan tangan serta menggunakan masker bila mengalami gejala batuk atau flu.', 'published_at' => now()->subDays(10), 'is_pinned' => false],
        ])->each(fn (array $data): Announcement => Announcement::query()->updateOrCreate(
            ['title' => $data['title']],
            $data + ['is_published' => true],
        ));

        collect([
            ['title' => 'Tips Menjaga Daya Tahan Tubuh Saat Cuaca Tidak Menentu', 'excerpt' => 'Kebiasaan sederhana yang dapat membantu tubuh tetap bugar.', 'content' => 'Menjaga daya tahan tubuh dapat dimulai dari tidur cukup, konsumsi makanan bergizi, minum air yang cukup, dan tetap aktif bergerak setiap hari.', 'author' => 'Tim Edukasi RSSAMS', 'published_at' => now()->subDays(2), 'is_featured' => true],
            ['title' => 'Kapan Harus Memeriksakan Keluhan Nyeri Dada?', 'excerpt' => 'Kenali tanda keluhan yang perlu segera diperiksa.', 'content' => 'Nyeri dada yang disertai sesak, keringat dingin, mual, atau menjalar ke lengan perlu segera mendapatkan pemeriksaan medis.', 'author' => 'Tim Medis RSSAMS', 'published_at' => now()->subDays(5), 'is_featured' => false],
            ['title' => 'Pentingnya Kontrol Rutin untuk Penyakit Kronis', 'excerpt' => 'Kontrol rutin membantu evaluasi kondisi dan pengobatan.', 'content' => 'Pasien dengan penyakit kronis perlu melakukan kontrol berkala agar kondisi kesehatan terpantau dan pengobatan dapat disesuaikan dengan kebutuhan.', 'author' => 'Tim Medis RSSAMS', 'published_at' => now()->subDays(9), 'is_featured' => false],
        ])->each(fn (array $data): Article => Article::query()->updateOrCreate(
            ['title' => $data['title']],
            $data + ['is_published' => true],
        ));

        collect([
            ['name' => 'Sertifikat Akreditasi Rumah Sakit', 'certificate_number' => 'RSSAMS-AKR-2026', 'issuer' => 'Lembaga Akreditasi Rumah Sakit', 'file' => 'certificates/demo-akreditasi.pdf', 'issued_at' => Carbon::parse('2026-01-15'), 'expires_at' => Carbon::parse('2029-01-15'), 'sort_order' => 1],
            ['name' => 'Izin Operasional Rumah Sakit', 'certificate_number' => 'RSSAMS-OPS-2026', 'issuer' => 'Dinas Kesehatan', 'file' => 'certificates/demo-izin-operasional.pdf', 'issued_at' => Carbon::parse('2026-02-01'), 'expires_at' => Carbon::parse('2031-02-01'), 'sort_order' => 2],
            ['name' => 'Sertifikat Keselamatan dan Kesehatan Kerja', 'certificate_number' => 'RSSAMS-K3-2026', 'issuer' => 'Instansi Terkait', 'file' => 'certificates/demo-k3.pdf', 'issued_at' => Carbon::parse('2026-03-10'), 'expires_at' => Carbon::parse('2028-03-10'), 'sort_order' => 3],
        ])->each(fn (array $data): Certificate => Certificate::query()->updateOrCreate(
            ['name' => $data['name']],
            $data + ['is_active' => true],
        ));
    }
}
