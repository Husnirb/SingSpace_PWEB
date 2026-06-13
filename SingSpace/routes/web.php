<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PreferensiController;
use App\Http\Controllers\DashboardController;

// ====================================================================
// 1. RUTE PUBLIK (Bisa diakses tanpa login)
// ====================================================================
Route::get('/', function (Request $request) {
    $count = $request->session()->get('visit_count', 0);

    if ($count == 0) {
        $request->session()->put('first_visit', now()->format('d M Y, H:i:s') . ' WIB');
        $count = 1;

        // TEMBAKKAN FLASH MESSAGE WELCOME!
        session()->flash('welcome', 'Selamat datang di SingSpace Karaoke! Nikmati pengalaman bernyanyi VIP.');
    } else {
        $count++;
    }

    $request->session()->put('visit_count', $count);
    $request->session()->put('last_visit', now()->format('d M Y, H:i:s') . ' WIB');

    $stats = [
        'total' => $count,
        'first' => $request->session()->get('first_visit'),
        'last'  => $request->session()->get('last_visit')
    ];

    return view('welcome', compact('stats'));
});

// Katalog ruangan publik
Route::get('/daftar-ruangan', [RuanganController::class, 'catalog'])->name('ruangan.catalog');

// Live Search Ruangan via AJAX
Route::post('/ruangan/search', [RuanganController::class, 'searchAjax'])->name('ruangan.search');


// ====================================================================
// 2. RUTE KHUSUS ADMIN (Tergembok oleh Middleware 'admin')
// ====================================================================
Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Data Ruangan (CRUD Ruangan)
    Route::resource('ruangan', RuanganController::class);

    // Manajemen Reservasi (Admin)
    Route::get('/admin/reservasi', [ReservasiController::class, 'indexAdmin'])->name('admin.reservasi');
    Route::patch('/admin/reservasi/{id}/status', [ReservasiController::class, 'updateStatus'])->name('admin.reservasi.status');

});


// ====================================================================
// 3. RUTE CUSTOMER & ADMIN (Semua User yang Sudah Login)
// ====================================================================
Route::middleware('auth')->group(function () {

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Reservasi / Booking
    Route::get('/ruangan/{id}/booking', [ReservasiController::class, 'create'])->name('booking.create');
    Route::post('/booking', [ReservasiController::class, 'store'])->name('booking.store');

    // ROUTE AJAX UNTUK CEK JADWAL PENUH
    Route::get('/cek-jadwal', [ReservasiController::class, 'cekJadwal'])->name('cek-jadwal');

    // Route Preferensi & Hitung Kunjungan Session
    Route::get('/preferensi', [PreferensiController::class, 'index'])->name('preferensi.index');
    Route::post('/preferensi/save', [PreferensiController::class, 'save'])->name('preferensi.save');
    Route::post('/preferensi/reset', [PreferensiController::class, 'resetKunjungan'])->name('preferensi.reset');

});

require __DIR__.'/auth.php';
