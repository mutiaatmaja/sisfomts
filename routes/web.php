<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendidikTendikController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Pendidik-tendik
Route::prefix('pendidik-tendik')->group(function () {
    Route::get('/', [PendidikTendikController::class, 'index'])->name('pendidik-tendik.index');

});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('pendidik-tendik')->group(function () {
        Route::post('import', [PendidikTendikController::class, 'import'])->name('pendidik-tendik.import');
    });
});