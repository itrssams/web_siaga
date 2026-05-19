<?php

use App\Models\Announcement;
use App\Models\Article;
use App\Models\Certificate;
use App\Models\Doctor;
use App\Models\Polyclinic;
use App\Models\Specialization;
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

    $certificates = Schema::hasTable('certificates') ? Certificate::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->latest()
        ->limit(4)
        ->get() : collect();

    $specializations = Schema::hasTable('specializations') ? Specialization::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get() : collect();

    $polyclinics = Schema::hasTable('polyclinics') ? Polyclinic::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get() : collect();

    $stats = [
        ['value' => Schema::hasTable('polyclinics') ? Polyclinic::count() : 0, 'label' => 'Poliklinik'],
        ['value' => Schema::hasTable('doctors') ? Doctor::count() : 0, 'label' => 'Dokter'],
        ['value' => Schema::hasTable('specializations') ? Specialization::count() : 0, 'label' => 'Spesialis'],
        ['value' => Schema::hasTable('certificates') ? Certificate::count() : 0, 'label' => 'Sertifikat'],
    ];

    return view('home', compact(
        'announcements',
        'articles',
        'doctors',
        'certificates',
        'specializations',
        'polyclinics',
        'stats',
    ));
})->name('home');
