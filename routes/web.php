<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root: cek login dulu
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('samples.index')
        : redirect()->route('login');
});

// ================= PROTECTED ROUTES =================
Route::middleware(['auth'])->group(function () {

    // Halaman utama logbook
    Route::get('/samples', [SampleController::class, 'index'])
        ->name('samples.index');

    // CRUD Samples
    Route::resource('samples', SampleController::class);

    // Filter Lab
    Route::get('/ankom', [SampleController::class, 'ankom'])
        ->name('ankom');

    Route::get('/makmin', [SampleController::class, 'makmin'])
        ->name('makmin');

    // Trash & Restore
    Route::get('/trash', [SampleController::class, 'trash'])
        ->name('trash');

    Route::post('/restore/{id}', [SampleController::class, 'restore'])
        ->name('restore');

    // Profile (optional)
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

        Route::get('/samples/export/pdf', [SampleController::class, 'exportPdf'])
    ->name('samples.export.pdf');
});

// Auth Routes (login, register, logout, dll)
require __DIR__.'/auth.php';