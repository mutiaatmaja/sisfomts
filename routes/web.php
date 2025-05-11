<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendidikTendikController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ManagemenKelasController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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
    Route::get('/create', [ManagemenKelasController::class, 'create'])->name('kelas.create');
    Route::post('/store', [ManagemenKelasController::class, 'store'])->name('kelas.store');
    Route::get('/{kelas}/edit', [ManagemenKelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/{kelas}', [ManagemenKelasController::class, 'update'])->name('kelas.update');
    Route::delete('/{kelas}', [ManagemenKelasController::class, 'destroy'])->name('kelas.destroy');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('pendidik-tendik')->group(function () {
        Route::post('import', [PendidikTendikController::class, 'import'])->name('pendidik-tendik.import');
    });
});