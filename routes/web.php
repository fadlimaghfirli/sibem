<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile (Bawaan Breeze)
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- RUTE BARU UNTUK ADMIN ---

    // 1. Manajemen Kabinet
    Route::resource('cabinets', App\Http\Controllers\CabinetController::class)->except(['show']);

    // 2. Manajemen Pengurus
    Route::resource('penguruses', App\Http\Controllers\PengurusController::class);

    // 3. Manajemen Departemen (Opsional, jika ingin edit deskripsi)
    Route::resource('departements', App\Http\Controllers\DepartementController::class)->only(['index', 'edit', 'update']);
});
