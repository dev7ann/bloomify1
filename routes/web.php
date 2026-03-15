<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\WellnessController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TrendsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->middleware(['auth', 'trackLastLogin'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'admin', 'trackLastLogin'])->group(function () {
    // main dashboard (default)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // User management
    Route::get('/users', [DashboardController::class, 'users'])->name('admin.users');
    Route::put('/users/{user}/role', [DashboardController::class, 'updateRole']);
    Route::delete('/users/{user}', [DashboardController::class, 'destroyUser']);

    // Wellness tips
    Route::post('/wellness-tips', [DashboardController::class, 'storeTip'])->name('admin.wellness.store');
    Route::put('/wellness-tips/{tip}', [DashboardController::class, 'updateTip'])->name('admin.wellness.update');
    Route::delete('/wellness-tips/{tip}', [DashboardController::class, 'destroyTip'])->name('admin.wellness.delete');
});

Route::get('/trends/partial/index', [TrendsController::class, 'partialIndex'])->name('trends.partial.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/moods', [MoodController::class, 'index'])->name('moods.index');
    Route::delete('/moods/{mood}', [MoodController::class, 'destroy'])->name('moods.destroy');
    Route::post('/moods', [MoodController::class, 'store'])->name('moods.store');
    Route::put('/moods/{mood}', [MoodController::class, 'update'])->name('moods.update');
    Route::get('/moods/partial/index', [MoodController::class, 'partialIndex'])->name('moods.partial.index');
    Route::get('/moods/partial/create', [MoodController::class, 'partialCreate'])->name('moods.partial.create');
    Route::get('/moods/partial/edit/{mood}', [MoodController::class, 'partialEdit'])->name('moods.partial.edit');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/journals', [JournalController::class, 'index'])->name('journals.index');
    Route::get('/journals/create', [JournalController::class, 'create'])->name('journals.create');
    Route::post('/journals', [JournalController::class, 'store'])->name('journals.store');
    Route::get('/journals/partial/index', [JournalController::class, 'partialIndex'])->name('journals.partial.index');
    Route::get('/journals/partial/create', [JournalController::class, 'partialCreate'])->name('journals.partial.create');
    Route::delete('/journals/{journal}', [JournalController::class, 'destroy'])->name('journals.destroy');
    Route::get('/journals/partial/edit/{journal}', [JournalController::class, 'Editpartial'])->name('journals.partial.edit');
    Route::put('/journals/{journal}', [JournalController::class, 'update'])->name('journal.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/wellness', [WellnessController::class, 'index'])->name('wellness.index');
    Route::get('/wellness/partial', [WellnessController::class, 'partialIndex'])->name('wellness.partial');
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');
    Route::get('/support/partial', [SupportController::class, 'partialIndex'])->name('support.partial');
});

require __DIR__.'/auth.php';