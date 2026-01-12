<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\PesertaController;
use App\Models\Kursus;
use Illuminate\Support\Facades\Route;

// Public routes (available for everyone, authenticated or not)
Route::get('/', function () {
    $kursus = Kursus::with('pengajar')->get();
    return view('welcome', compact('kursus'));
})->name('home');

// Public view routes (anyone can view)
Route::get('/pengajar', [PengajarController::class, 'index'])->name('pengajar.index');
Route::get('/pengajar/{pengajar}', [PengajarController::class, 'show'])->name('pengajar.show');

Route::get('/kursus', [KursusController::class, 'index'])->name('kursus.index');
Route::get('/kursus/{kursus}', [KursusController::class, 'show'])->name('kursus.show');

Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');
Route::get('/peserta/{peserta}', [PesertaController::class, 'show'])->name('peserta.show');

// Dashboard (authenticated users only)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Enrollment route (authenticated users can enroll)
    Route::post('/kursus/{kursus}/enroll', [KursusController::class, 'enroll'])->name('kursus.enroll');
});

// Admin only routes (CRUD operations)
Route::middleware(['auth', 'admin'])->group(function () {
    // Pengajar CRUD (admin only)
    Route::get('/pengajar/create', [PengajarController::class, 'create'])->name('pengajar.create');
    Route::post('/pengajar', [PengajarController::class, 'store'])->name('pengajar.store');
    Route::get('/pengajar/{pengajar}/edit', [PengajarController::class, 'edit'])->name('pengajar.edit');
    Route::put('/pengajar/{pengajar}', [PengajarController::class, 'update'])->name('pengajar.update');
    Route::delete('/pengajar/{pengajar}', [PengajarController::class, 'destroy'])->name('pengajar.destroy');

    // Kursus CRUD (admin only)
    Route::get('/kursus/create', [KursusController::class, 'create'])->name('kursus.create');
    Route::post('/kursus', [KursusController::class, 'store'])->name('kursus.store');
    Route::get('/kursus/{kursus}/edit', [KursusController::class, 'edit'])->name('kursus.edit');
    Route::put('/kursus/{kursus}', [KursusController::class, 'update'])->name('kursus.update');
    Route::delete('/kursus/{kursus}', [KursusController::class, 'destroy'])->name('kursus.destroy');

    // Peserta CRUD (admin only)
    Route::get('/peserta/create', [PesertaController::class, 'create'])->name('peserta.create');
    Route::post('/peserta', [PesertaController::class, 'store'])->name('peserta.store');
    Route::get('/peserta/{peserta}/edit', [PesertaController::class, 'edit'])->name('peserta.edit');
    Route::put('/peserta/{peserta}', [PesertaController::class, 'update'])->name('peserta.update');
    Route::delete('/peserta/{peserta}', [PesertaController::class, 'destroy'])->name('peserta.destroy');
});

require __DIR__ . '/auth.php';
