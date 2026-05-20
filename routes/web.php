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

Route::get('/jadwal-dokter', function (Request $request) {
    $doctors = Schema::hasTable('doctors') ? Doctor::query()
        ->orderBy('name')
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

    $scheduleDoctors = Schema::hasTable('doctor_schedules') ? Doctor::query()
        ->with(['specialization', 'polyclinic'])
        ->with(['schedules' => function ($query) use ($request): void {
            $query
                ->where('is_active', true)
                ->when($request->filled('day_of_week'), function ($query) use ($request): void {
                    $query->where('day_of_week', $request->integer('day_of_week'));
                })
                ->orderBy('day_of_week')
                ->orderBy('start_time')
                ->orderBy('sort_order');
        }])
        ->whereHas('schedules', function ($query) use ($request): void {
            $query
                ->where('is_active', true)
                ->when($request->filled('day_of_week'), function ($query) use ($request): void {
                    $query->where('day_of_week', $request->integer('day_of_week'));
                });
        })
        ->when($request->filled('doctor_id'), function ($query) use ($request): void {
            $query->whereKey($request->integer('doctor_id'));
        })
        ->when($request->filled('specialization_id'), function ($query) use ($request): void {
            $query->where('specialization_id', $request->integer('specialization_id'));
        })
        ->when($request->filled('polyclinic_id'), function ($query) use ($request): void {
            $query->where('polyclinic_id', $request->integer('polyclinic_id'));
        })
        ->orderBy('name')
        ->paginate(8)
        ->withQueryString() : collect();

    return view('schedules.index', compact('scheduleDoctors', 'doctors', 'specializations', 'polyclinics'));
})->name('schedules.index');

Route::get('/pengumuman', function (Request $request) {
    $announcements = Schema::hasTable('announcements') ? Announcement::query()
        ->where('is_published', true)
        ->when($request->filled('search'), function ($query) use ($request): void {
            $query->where(function ($query) use ($request): void {
                $search = $request->string('search')->toString();

                $query
                    ->where('title', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'.$search.'%');
            });
        })
        ->orderByDesc('is_pinned')
        ->latest('published_at')
        ->paginate(9)
        ->withQueryString() : collect();

    return view('announcements.index', compact('announcements'));
})->name('announcements.index');

Route::get('/pengumuman/{announcement:slug}', function (Announcement $announcement) {
    abort_unless($announcement->is_published, 404);

    $otherAnnouncements = Announcement::query()
        ->where('is_published', true)
        ->whereKeyNot($announcement->getKey())
        ->latest('published_at')
        ->limit(3)
        ->get();

    return view('announcements.show', compact('announcement', 'otherAnnouncements'));
})->name('announcements.show');

Route::get('/artikel', function (Request $request) {
    $articles = Schema::hasTable('articles') ? Article::query()
        ->where('is_published', true)
        ->when($request->filled('search'), function ($query) use ($request): void {
            $query->where(function ($query) use ($request): void {
                $search = $request->string('search')->toString();

                $query
                    ->where('title', 'like', '%'.$search.'%')
                    ->orWhere('excerpt', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'.$search.'%');
            });
        })
        ->orderByDesc('is_featured')
        ->latest('published_at')
        ->paginate(9)
        ->withQueryString() : collect();

    return view('articles.index', compact('articles'));
})->name('articles.index');

Route::get('/artikel/{article:slug}', function (Article $article) {
    abort_unless($article->is_published, 404);

    $otherArticles = Article::query()
        ->where('is_published', true)
        ->whereKeyNot($article->getKey())
        ->latest('published_at')
        ->limit(3)
        ->get();

    return view('articles.show', compact('article', 'otherArticles'));
})->name('articles.show');

Route::get('/sertifikat', function (Request $request) {
    $certificates = Schema::hasTable('certificates') ? Certificate::query()
        ->where('is_active', true)
        ->when($request->filled('search'), function ($query) use ($request): void {
            $query->where(function ($query) use ($request): void {
                $search = $request->string('search')->toString();

                $query
                    ->where('name', 'like', '%'.$search.'%')
                    ->orWhere('certificate_number', 'like', '%'.$search.'%')
                    ->orWhere('issuer', 'like', '%'.$search.'%');
            });
        })
        ->orderBy('sort_order')
        ->latest()
        ->paginate(12)
        ->withQueryString() : collect();

    return view('certificates.index', compact('certificates'));
})->name('certificates.index');

Route::view('/tentang-kami', 'about')->name('about');
