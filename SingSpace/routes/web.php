<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController; // WAJIB ADA AGAR CONTROLLER TERBACA
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Keamanan ekstra: Pastikan hanya admin yang bisa buka dashboard
    if (auth()->user()->role !== 'admin') {
        return redirect('/');
    }

    // Ambil data statistik dari database
    $total_pendapatan = \App\Models\Reservasi::where('status', 'confirmed')->sum('total_harga');
    $total_ruangan = \App\Models\Ruangan::count();
    $booking_pending = \App\Models\Reservasi::where('status', 'pending')->count();
    $booking_selesai = \App\Models\Reservasi::where('status', 'confirmed')->count();

    // Ambil 5 reservasi terbaru untuk preview di dashboard
    $reservasi_terbaru = \App\Models\Reservasi::with(['user', 'ruangan'])->latest()->take(5)->get();

    return view('dashboard', compact('total_pendapatan', 'total_ruangan', 'booking_pending', 'booking_selesai', 'reservasi_terbaru'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/daftar-ruangan', [RuanganController::class, 'catalog'])->name('ruangan.catalog');

Route::middleware('auth')->group(function () {
    Route::resource('ruangan', RuanganController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Letakkan di dalam Route::middleware('auth')->group(function () { ... });
    Route::get('/ruangan/{id}/booking', [App\Http\Controllers\ReservasiController::class, 'create'])->name('booking.create');
    Route::post('/booking', [App\Http\Controllers\ReservasiController::class, 'store'])->name('booking.store');
    // Manajemen Reservasi (Admin)
    Route::get('/admin/reservasi', [App\Http\Controllers\ReservasiController::class, 'indexAdmin'])->name('admin.reservasi');
    Route::patch('/admin/reservasi/{id}/status', [App\Http\Controllers\ReservasiController::class, 'updateStatus'])->name('admin.reservasi.status');
    // Route Preferensi & Hitung Kunjungan Session
    Route::get('/preferensi', [App\Http\Controllers\PreferensiController::class, 'index'])->name('preferensi.index');
    Route::post('/preferensi/save', [App\Http\Controllers\PreferensiController::class, 'save'])->name('preferensi.save');
    Route::post('/preferensi/reset', [App\Http\Controllers\PreferensiController::class, 'resetKunjungan'])->name('preferensi.reset');
    });

    require __DIR__.'/auth.php';

// Live Search Ruangan via AJAX
Route::post('/ruangan/search', [App\Http\Controllers\RuanganController::class, 'searchAjax'])->name('ruangan.search');
