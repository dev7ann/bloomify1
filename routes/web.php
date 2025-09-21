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

Route::get('/wellness', [WellnessController::class, 'index'])->name('wellness.index');
Route::get('/support', [SupportController::class, 'index'])->name('support.index');

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
});
Route::middleware('auth')->group(function () {
    Route::get('/journals', [JournalController::class, 'index'])->name('journals.index');
    Route::get('/journals/create', [JournalController::class, 'create'])->name('journals.create');
    Route::post('/journals', [JournalController::class, 'store'])->name('journals.store');
});

require __DIR__.'/auth.php';
