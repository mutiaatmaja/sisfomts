<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendidikTendikController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ManagemenKelasController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\InforsekolahController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\ZonaintegritasController;
use App\Http\Controllers\ApskemenagController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\ApslainController;
use App\Http\Controllers\SuaramadrasahController;
use App\Http\Controllers\Angketlayanan as AngketlayananController;
use App\Http\Controllers\Formulironline as FormulironlineController;
use App\Http\Controllers\SpmbController;
use App\Http\Controllers\Layananterpadu as LayananTerpaduController;
use App\Http\Controllers\OsisController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\UserController;

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

Route::prefix('suara-madrasah')->group(function () {
    Route::get('/', [SuaramadrasahController::class, 'index'])->name('suara-madrasah.index');
    Route::post('/store', [SuaramadrasahController::class, 'store'])->name('suara-madrasah.store');
    Route::get('/semua-lapopran', [SuaramadrasahController::class, 'semuaLaporan'])
        ->middleware(['role:admin'])
        ->name('suara-madrasah.semua-laporan');
    Route::get('/{aduan}/show', [SuaramadrasahController::class, 'show'])
        ->middleware(['role:admin'])
        ->name('suara-madrasah.show');

    Route::delete('/{aduan}', [SuaramadrasahController::class, 'destroy'])
        ->middleware(['role:admin'])
        ->name('suara-madrasah.destroy');
});

//pesertadidik
Route::prefix('kesiswaan')->group(function () {
    Route::prefix('peserta-didik')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('pesertadidik.index');
        Route::get('/create', [SiswaController::class, 'create'])
            ->middleware(['role:admin'])
            ->name('pesertadidik.create');
        Route::get('/{siswa}/show', [SiswaController::class, 'show'])->name('pesertadidik.show');
        Route::get('/{siswa}/card', [SiswaController::class, 'showCard'])->name('pesertadidik.card');
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
        Route::get('/{siswa}/cetak-kartu', [SiswaController::class, 'cetakKartu'])->name('pesertadidik.cetak_kartu');
        Route::get('/rekap-ktp/{kelas_id}', [SiswaController::class, 'rekapKtpKelas'])->name('pesertadidik.rekap_ktp');
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
        Route::get('/{kelas}/siswa', [ManagemenKelasController::class, 'siswaKelas'])->name('kelas.siswa');
        Route::get('/{kelas}/siswa-pdf', [ManagemenKelasController::class, 'exportPdfSiswaKelas'])->name('kelas.siswa_pdf');
        Route::get('/cetak/semua/siswa-pdf', [ManagemenKelasController::class, 'exportPdfSemuaKelas'])->name('kelas.semua_siswa_pdf');
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
        Route::get('/rekam2', [AbsenController::class, 'rekam2'])
            ->middleware(['role:admin'])
            ->name('absen.rekam2');
        Route::post('/rekam2proses', [AbsenController::class, 'rekam2proses'])->name('absen.rekam2proses');
        Route::get('/lihat-absen-kelas', [AbsenController::class, 'lihatAbsenKelas'])
            ->middleware(['role:admin'])
            ->name('absen.lihat-absen-kelas');
    });

    // Public route for viewing OSIS members
    Route::get('/osis', [OsisController::class, 'index'])->name('osis.index');

    // Admin-only routes for managing OSIS
    Route::prefix('osis')->middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/create', [OsisController::class, 'create'])->name('osis.create');
        Route::post('/', [OsisController::class, 'store'])->name('osis.store');
        Route::get('/{osis}/edit', [OsisController::class, 'edit'])->name('osis.edit');
        Route::put('/{osis}', [OsisController::class, 'update'])->name('osis.update');
        Route::delete('/{osis}', [OsisController::class, 'destroy'])->name('osis.destroy');
    });

    Route::prefix('kelulusan')->group(function () {
        Route::get('/', [KelulusanController::class, 'index'])->name('kesiswaan.kelulusan.index');
    });
});
Route::get('/absen/data', [AbsenController::class, 'data'])->name('absen.data');

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
    Route::get('/', [ZonaintegritasController::class, 'index'])->name('zona-integritas.index');
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
Route::prefix('administratif')->name('administratif.')->group(function () {
    Route::prefix('angket-layanan')->group(function () {
        Route::get('/', [AngketlayananController::class, 'index'])->name('angket-layanan.index');
        Route::post('/store', [AngketlayananController::class, 'store'])->name('angket-layanan.store');
        Route::get('/semua-laporan', [AngketlayananController::class, 'semuaLaporan'])
            ->middleware(['role:admin'])
            ->name('angket-layanan.semua-laporan');
        Route::get('/{angket}/show', [AngketlayananController::class, 'show'])
            ->middleware(['role:admin'])
            ->name('angket-layanan.show');
        Route::delete('/{angket}', [AngketlayananController::class, 'destroy'])
            ->middleware(['role:admin'])
            ->name('angket-layanan.destroy');
    });

    Route::prefix('formulir-online')->group(function () {
        Route::get('/', [FormulironlineController::class, 'index'])->name('formulir-online.index');
        Route::post('/store', [FormulironlineController::class, 'store'])->name('formulir-online.store');
        Route::get('/semua-laporan', [FormulironlineController::class, 'semuaLaporan'])
            ->middleware(['role:admin'])
            ->name('formulir-online.semua-laporan');
        Route::get('/{formulir}/show', [FormulironlineController::class, 'show'])
            ->middleware(['role:admin'])
            ->name('formulir-online.show');
        Route::delete('/{formulir}', [FormulironlineController::class, 'destroy'])
            ->middleware(['role:admin'])
            ->name('formulir-online.destroy');
    });

    Route::prefix('spmb')->group(function () {
        Route::get('/', [SpmbController::class, 'index'])->name('spmb.index');
        Route::post('/store', [SpmbController::class, 'store'])->name('spmb.store');
        Route::get('/semua-laporan', [SpmbController::class, 'semuaLaporan'])
            ->middleware(['role:admin'])
            ->name('spmb.semua-laporan');
        Route::get('/{spmb}/show', [SpmbController::class, 'show'])
            ->middleware(['role:admin'])
            ->name('spmb.show');
        Route::delete('/{spmb}', [SpmbController::class, 'destroy'])
            ->middleware(['role:admin'])
            ->name('spmb.destroy');
    });

    Route::prefix('layanan-terpadu')->group(function () {
        Route::get('/', [LayananTerpaduController::class, 'index'])->name('layanan-terpadu.index');
        Route::post('/store', [LayananTerpaduController::class, 'store'])->name('layanan-terpadu.store');
        Route::get('/semua-laporan', [LayananTerpaduController::class, 'semuaLaporan'])
            ->middleware(['role:admin'])
            ->name('layanan-terpadu.semua-laporan');
        Route::get('/{layanan}/show', [LayananTerpaduController::class, 'show'])
            ->middleware(['role:admin'])
            ->name('layanan-terpadu.show');
        Route::delete('/{layanan}', [LayananTerpaduController::class, 'destroy'])
            ->middleware(['role:admin'])
            ->name('layanan-terpadu.destroy');
    });
});
Route::prefix('angket-layanan')->group(function () {
    Route::get('/', [AngketlayananController::class, 'index'])->name('angket-layanan.index');
    Route::post('/store', [AngketlayananController::class, 'store'])->name('angket-layanan.store');
    Route::get('/semua-laporan', [AngketlayananController::class, 'semuaLaporan'])
        ->middleware(['role:admin'])
        ->name('angket-layanan.semua-laporan');
    Route::get('/{angket}/show', [AngketlayananController::class, 'show'])
        ->middleware(['role:admin'])
        ->name('angket-layanan.show');
    Route::delete('/{angket}', [AngketlayananController::class, 'destroy'])
        ->middleware(['role:admin'])
        ->name('angket-layanan.destroy');
});

Route::prefix('formulir-online')->group(function () {
    Route::get('/', [FormulironlineController::class, 'index'])->name('formulir-online.index');
    Route::post('/store', [FormulironlineController::class, 'store'])->name('formulir-online.store');
    Route::get('/semua-laporan', [FormulironlineController::class, 'semuaLaporan'])
        ->middleware(['role:admin'])
        ->name('formulir-online.semua-laporan');
    Route::get('/{formulir}/show', [FormulironlineController::class, 'show'])
        ->middleware(['role:admin'])
        ->name('formulir-online.show');
    Route::delete('/{formulir}', [FormulironlineController::class, 'destroy'])
        ->middleware(['role:admin'])
        ->name('formulir-online.destroy');
});

Route::prefix('spmb')->group(function () {
    Route::get('/', [SpmbController::class, 'index'])->name('spmb.index');
    Route::post('/store', [SpmbController::class, 'store'])->name('spmb.store');
    Route::get('/semua-laporan', [SpmbController::class, 'semuaLaporan'])
        ->middleware(['role:admin'])
        ->name('spmb.semua-laporan');
    Route::get('/{spmb}/show', [SpmbController::class, 'show'])
        ->middleware(['role:admin'])
        ->name('spmb.show');
    Route::delete('/{spmb}', [SpmbController::class, 'destroy'])
        ->middleware(['role:admin'])
        ->name('spmb.destroy');
});

Route::prefix('layanan-terpadu')->group(function () {
    Route::get('/', [LayananTerpaduController::class, 'index'])->name('layanan-terpadu.index');
    Route::post('/store', [LayananTerpaduController::class, 'store'])->name('layanan-terpadu.store');
    Route::get('/semua-laporan', [LayananTerpaduController::class, 'semuaLaporan'])
        ->middleware(['role:admin'])
        ->name('layanan-terpadu.semua-laporan');
    Route::get('/{layanan}/show', [LayananTerpaduController::class, 'show'])
        ->middleware(['role:admin'])
        ->name('layanan-terpadu.show');
    Route::delete('/{layanan}', [LayananTerpaduController::class, 'destroy'])
        ->middleware(['role:admin'])
        ->name('layanan-terpadu.destroy');
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

Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
});
