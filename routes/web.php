<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendidikTendikController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ManagemenKelasController;
use App\Http\Controllers\PrestasiController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/');
//Pendidik-tendik
Route::prefix('pendidik-tendik')->group(function () {
    Route::get('/', [PendidikTendikController::class, 'index'])->name('pendidik-tendik.index');

});
//pesertadidik
Route::prefix('peserta-didik')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('pesertadidik.index');
    Route::get('/create', [SiswaController::class, 'create'])->name('pesertadidik.create');
    Route::post('/store', [SiswaController::class, 'store'])->name('pesertadidik.store');
    Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])->name('pesertadidik.edit');
    Route::put('/{siswa}', [SiswaController::class, 'update'])->name('pesertadidik.update');
    Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('pesertadidik.destroy');
});
//managemen kelas
Route::prefix('kelas')->group(function () {
    Route::get('/', [ManagemenKelasController::class, 'index'])->name('kelas.index');
    Route::get('/create', [ManagemenKelasController::class, 'create'])->middleware(['role:admin'])->name('kelas.create');
    Route::post('/store', [ManagemenKelasController::class, 'store'])->middleware(['role:admin'])->name('kelas.store');
    Route::get('/{kelas}/edit', [ManagemenKelasController::class, 'edit'])->middleware(['role:admin'])->name('kelas.edit');
    Route::put('/{kelas}', [ManagemenKelasController::class, 'update'])->middleware(['role:admin'])->name('kelas.update');
    Route::delete('/{kelas}', [ManagemenKelasController::class, 'destroy'])->name('kelas.destroy');
});
Route::prefix('prestasi')->group(function () {
    Route::get('/', [PrestasiController::class, 'index'])->name('prestasi.index');
    Route::get('/create', [PrestasiController::class, 'create'])->name('prestasi.create');
    Route::post('/store', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::get('/{prestasi}/edit', [PrestasiController::class, 'edit'])->name('prestasi.edit');
    Route::put('/{prestasi}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/{prestasi}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
});
Route::prefix('admin')->name('admin.')->middleware(['role:admin'])->group(function () {
    Route::prefix('pendidik-tendik')->group(function () {
        Route::post('import', [PendidikTendikController::class, 'import'])->name('pendidik-tendik.import');
    });
    Route::prefix('peserta-didik')->group(function () {
        Route::post('import', [SiswaController::class, 'import'])->name('peserta-didik.import');
    });
});