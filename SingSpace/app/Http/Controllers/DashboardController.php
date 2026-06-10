<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Reservasi;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Pendapatan Riil (Hanya dari reservasi yang dikonfirmasi/selesai)
        $totalPendapatan = Reservasi::whereIn('status', ['pending', 'Pending', 'confirmed', 'Confirmed', 'selesai', 'Selesai'])
            ->where('status', '!=', 'batal')
            ->sum('total_harga');

        // 2. Hitung Jumlah Pesanan yang Menunggu Konfirmasi (Pending)
        $menungguKonfirmasi = Reservasi::whereIn('status', ['pending', 'Pending'])->count();

        // 3. Hitung Total Ruangan yang Terdaftar di Sistem
        $totalRuangan = Ruangan::count();

        // 4. Hitung Jumlah Reservasi yang Berhasil Dikonfirmasi
        $reservasiTerkonfirmasi = Reservasi::whereIn('status', ['confirmed', 'Confirmed', 'selesai', 'Selesai'])->count();

        // 5. Ambil 5 Data Reservasi Paling Baru untuk Tabel Dashboard
        $reservasiTerbaru = Reservasi::with(['user', 'ruangan'])
            ->latest()
            ->take(5)
            ->get();

        // Kirimkan semua variabel riil ke halaman view dashboard Anda
        return view('dashboard', compact(
            'totalPendapatan',
            'menungguKonfirmasi',
            'totalRuangan',
            'reservasiTerkonfirmasi',
            'reservasiTerbaru'
        ));
    }
}
