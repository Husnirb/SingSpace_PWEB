<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RuanganController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/hitung/{a}/{b}', fn($a, $b) => $a + $b);
Route::view('/tentang', 'tentang');
Route::view('/kontak', 'kontak');
Route::resource('ruangan', RuanganController::class);
Route::get('/daftar-ruangan', [RuanganController::class, 'catalog'])->name('ruangan.catalog');
