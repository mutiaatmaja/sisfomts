<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendidikTendikController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ManagemenKelasController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\InforsekolahController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\ZonaIntegritasController;
use App\Http\Controllers\ApskemenagController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\ApslainController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/');

Route::prefix('kepegawaian')->group(function () {
    //Pendidik-tendik
    Route::prefix('pendidik-tendik')->group(function () {
        Route::get('/', [PendidikTendikController::class, 'index'])->name('pendidik-tendik.index');
        Route::get('/create', [PendidikTendikController::class, 'create'])
            ->middleware(['role:admin'])
            ->name('pendidik-tendik.create');
        Route::post('/store', [PendidikTendikController::class, 'store'])
            ->middleware(['role:admin'])
            ->name('pendidik-tendik.store');
        Route::get('/{pendidik}/edit', [PendidikTendikController::class, 'edit'])
            ->middleware(['role:admin'])
            ->name('pendidik-tendik.edit');
        Route::put('/{pendidik}', [PendidikTendikController::class, 'update'])
            ->middleware(['role:admin'])
            ->name('pendidik-tendik.update');
        Route::delete('/{pendidik}', [PendidikTendikController::class, 'destroy'])
            ->middleware(['role:admin'])
            ->name('pendidik-tendik.destroy');
        Route::get('/{pendidik}/show', [PendidikTendikController::class, 'show'])
            ->middleware(['role:admin'])
            ->name('pendidik-tendik.show');
    });
});

//pesertadidik
Route::prefix('kesiswaan')->group(function () {
    Route::prefix('peserta-didik')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('pesertadidik.index');
        Route::get('/create', [SiswaController::class, 'create'])
            ->middleware(['role:admin'])
            ->name('pesertadidik.create');
        Route::post('/store', [SiswaController::class, 'store'])
            ->middleware(['role:admin'])
            ->name('pesertadidik.store');
        Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])
            ->middleware(['role:admin'])
            ->name('pesertadidik.edit');
        Route::put('/{siswa}', [SiswaController::class, 'update'])
            ->middleware(['role:admin'])
            ->name('pesertadidik.update');
        Route::delete('/{siswa}', [SiswaController::class, 'destroy'])
            ->middleware(['role:admin'])
            ->name('pesertadidik.destroy');
    });
    //managemen kelas
    Route::prefix('kelas')->group(function () {
        Route::get('/', [ManagemenKelasController::class, 'index'])->name('kelas.index');
        Route::get('/create', [ManagemenKelasController::class, 'create'])
            ->middleware(['role:admin'])
            ->name('kelas.create');
        Route::post('/store', [ManagemenKelasController::class, 'store'])
            ->middleware(['role:admin'])
            ->name('kelas.store');
        Route::get('/{kelas}/edit', [ManagemenKelasController::class, 'edit'])
            ->middleware(['role:admin'])
            ->name('kelas.edit');
        Route::put('/{kelas}', [ManagemenKelasController::class, 'update'])
            ->middleware(['role:admin'])
            ->name('kelas.update');
        Route::delete('/{kelas}', [ManagemenKelasController::class, 'destroy'])->name('kelas.destroy');
    });
    Route::prefix('prestasi')->group(function () {
        Route::get('/', [PrestasiController::class, 'index'])->name('prestasi.index');
        Route::get('/create', [PrestasiController::class, 'create'])
            ->middleware(['role:admin'])
            ->name('prestasi.create');
        Route::post('/store', [PrestasiController::class, 'store'])
            ->middleware(['role:admin'])
            ->name('prestasi.store');
        Route::get('/{prestasi}/edit', [PrestasiController::class, 'edit'])
            ->middleware(['role:admin'])
            ->name('prestasi.edit');
        Route::put('/{prestasi}', [PrestasiController::class, 'update'])
            ->middleware(['role:admin'])
            ->name('prestasi.update');
        Route::delete('/{prestasi}', [PrestasiController::class, 'destroy'])
            ->middleware(['role:admin'])
            ->name('prestasi.destroy');
    });
    Route::prefix('absen')->group(function () {
        Route::get('/', [AbsenController::class, 'index'])->name('absen.index');
        Route::get('/rekam', [AbsenController::class, 'rekam'])
            ->middleware(['role:admin'])
            ->name('absen.rekam');
    });
});

Route::prefix('informasi-sekolah')->group(function () {
    Route::get('/', [InforsekolahController::class, 'index'])->name('informasi-sekolah.index');
    Route::get('/create', [InforsekolahController::class, 'create'])
        ->middleware(['role:admin'])
        ->name('informasi-sekolah.create');
    Route::post('/store', [InforsekolahController::class, 'store'])
        ->middleware(['role:admin'])
        ->name('informasi-sekolah.store');
    Route::get('/{inforsekolah}/edit', [InforsekolahController::class, 'edit'])
        ->middleware(['role:admin'])
        ->name('informasi-sekolah.edit');
    Route::put('/{inforsekolah}', [InforsekolahController::class, 'update'])
        ->middleware(['role:admin'])
        ->name('informasi-sekolah.update');
    Route::delete('/{inforsekolah}', [InforsekolahController::class, 'destroy'])
        ->middleware(['role:admin'])
        ->name('informasi-sekolah.destroy');
});

Route::prefix('zona-integritas')->group(function () {
    Route::get('/', [ZonaIntegritasController::class, 'index'])->name('zona-integritas.index');
});
Route::prefix('aplikasi-kemenag')->group(function () {
    Route::get('/', [ApskemenagController::class, 'index'])->name('apskemenag.index');
});
Route::prefix('akademik')->group(function () {
    Route::get('/', [AkademikController::class, 'index'])->name('akademik.index');
});
Route::prefix('aplikasi-lain')->group(function () {
    Route::get('/', [ApslainController::class, 'index'])->name('apslain.index');
});


Route::prefix('admin')
    ->name('admin.')
    ->middleware(['role:admin'])
    ->group(function () {
        Route::prefix('pendidik-tendik')->group(function () {
            Route::post('import', [PendidikTendikController::class, 'import'])->name('pendidik-tendik.import');
        });
        Route::prefix('peserta-didik')->group(function () {
            Route::post('import', [SiswaController::class, 'import'])->name('peserta-didik.import');
        });
        Route::prefix('prestasi')->group(function () {
            Route::post('import', [PrestasiController::class, 'import'])->name('prestasi.import');
        });
    });
