<?php

use App\Models\Announcement;
use App\Models\Article;
use App\Models\Certificate;
use App\Models\Doctor;
use App\Models\Polyclinic;
use App\Models\Specialization;
use Illuminate\Http\Request;
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

    $certificates = Schema::hasTable('certificates') ? Certificate::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->latest()
        ->limit(4)
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
        'certificates',
        'stats',
    ));
})->name('home');

Route::get('/dokter', function (Request $request) {
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

    $doctors = Schema::hasTable('doctors') ? Doctor::query()
        ->with(['specialization', 'polyclinic'])
        ->when($request->filled('search'), function ($query) use ($request): void {
            $query->where('name', 'like', '%'.$request->string('search')->toString().'%');
        })
        ->when($request->filled('specialization_id'), function ($query) use ($request): void {
            $query->where('specialization_id', $request->integer('specialization_id'));
        })
        ->when($request->filled('polyclinic_id'), function ($query) use ($request): void {
            $query->where('polyclinic_id', $request->integer('polyclinic_id'));
        })
        ->latest()
        ->paginate(12)
        ->withQueryString() : collect();

    return view('doctors.index', compact('doctors', 'specializations', 'polyclinics'));
})->name('doctors.index');
