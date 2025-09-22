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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->middleware(['auth', 'trackLastLogin'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'admin', 'trackLastLogin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('moods', MoodController::class);
    Route::get('/moods/partial/index', [MoodController::class, 'partialIndex'])->name('moods.partial.index');
    Route::get('/moods/partial/create', [MoodController::class, 'partialCreate'])->name('moods.partial.create');
    Route::get('/moods/partial/edit/{mood}', [MoodController::class, 'partialEdit'])->name('moods.partial.edit');
    Route::get('/moods/partial/show/{mood}', [MoodController::class, 'partialShow'])->name('moods.partial.show');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/journals', [JournalController::class, 'index'])->name('journals.index');
    Route::get('/journals/create', [JournalController::class, 'create'])->name('journals.create');
    Route::post('/journals', [JournalController::class, 'store'])->name('journals.store');
    Route::get('/journals/partial/index', [JournalController::class, 'partialIndex'])->name('journals.partial.index');
    Route::get('/journals/partial/create', [JournalController::class, 'partialCreate'])->name('journals.partial.create');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/wellness', [WellnessController::class, 'index'])->name('wellness.index');
    Route::get('/wellness/partial', [WellnessController::class, 'partialIndex'])->name('wellness.partial');
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');
    Route::get('/support/partial', [SupportController::class, 'partialIndex'])->name('support.partial');
});

require __DIR__.'/auth.php';