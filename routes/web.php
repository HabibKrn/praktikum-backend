<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KatalogController;

Route::get('/', fn () => 'Back-End aktif');
Route::get('/halo', fn () => 'Halo dari Back-End Laravel');

Route::get('/mahasiswa/{nim}', [MahasiswaController::class, 'show']) 
    ->whereNumber('nim');

Route::get('/profil/{nama?}', function (?string $nama = null) {
    return 'Halo, ' . ($nama ?? 'Pengunjung');
});

Route::get('/katalog', [KatalogController::class, 'index']);

Route::get('/admin/katalog', [KatalogController::class, 'index'])
    ->middleware('role.admin');