<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Mahasiswa\KrsController;
use App\Http\Controllers\Admin\ExportController;

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('mahasiswa.dashboard');
});

// Profile bawaan Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ====== ADMIN ======
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/export/krs', [ExportController::class, 'krsExcel'])->name('export.krs');
    Route::get('/krs', [MahasiswaController::class, 'krs'])->name('krs.index');

    Route::resource('dosen', DosenController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('matakuliah', MataKuliahController::class);
    Route::resource('jadwal', JadwalController::class);
});

// ====== MAHASISWA ======
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('dashboard');

    Route::get('/jadwal', function () {
        return view('mahasiswa.jadwal', ['jadwal' => \App\Models\Jadwal::with(['mataKuliah', 'dosen'])->get()]);
    })->name('jadwal');

    Route::get('/krs/export/pdf', [KrsController::class, 'exportPdf'])->name('krs.export.pdf');
    Route::resource('krs', KrsController::class)->only(['index', 'create', 'store', 'destroy']);
});

require __DIR__.'/auth.php';