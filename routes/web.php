<?php

use App\Models\Announcement;
use App\Models\Article;
use App\Models\Certificate;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    $announcements = Schema::hasTable('announcements') ? Announcement::query()
        ->where('is_published', true)
        ->orderByDesc('is_pinned')
        ->latest('published_at')
        ->limit(3)
        ->get() : collect();

    $articles = Schema::hasTable('articles') ? Article::query()
        ->where('is_published', true)
        ->latest('published_at')
        ->limit(3)
        ->get() : collect();

    $doctors = Schema::hasTable('doctors') ? Doctor::query()
        ->with(['specialization', 'polyclinic'])
        ->latest()
        ->limit(4)
        ->get() : collect();

    $schedules = Schema::hasTable('doctor_schedules') ? DoctorSchedule::query()
        ->with(['doctor.polyclinic', 'doctor.specialization'])
        ->orderBy('day_of_week')
        ->orderBy('start_time')
        ->limit(5)
        ->get() : collect();

    $certificates = Schema::hasTable('certificates') ? Certificate::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->latest()
        ->limit(4)
        ->get() : collect();

    return view('home', compact('announcements', 'articles', 'doctors', 'schedules', 'certificates'));
})->name('home');
