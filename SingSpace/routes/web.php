<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/hitung/{a}/{b}', fn($a, $b) => $a + $b);
Route::view('/tentang', 'tentang');
Route::view('/kontak', 'kontak');
