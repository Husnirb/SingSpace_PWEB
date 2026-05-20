<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferensiController extends Controller
{
    // Menampilkan Form Preferensi + Hitung Kunjungan via Session
    public function index(Request $request)
    {
        // Baca cookie preferensi saat ini
        $currentTheme = $request->cookie('theme', 'dark');
        $currentFontSize = $request->cookie('font_size', 'medium');

        // Cek apakah session visit_count sudah ada
        $count = $request->session()->get('visit_count', 0);

        if ($count == 0) {
            // Jika kunjungan pertama, catat waktu pertama kali ini
            $firstVisit = now()->format('d M Y, H:i:s') . ' WIB';
            $request->session()->put('first_visit', $firstVisit);
            $count = 1;
        } else {
            // Jika kunjungan ke-2 dan seterusnya, naikkan hitungan
            $count++;
        }

        // Setiap kali halaman di-refresh/dibuka, catat waktu terakhirnya
        $lastVisit = now()->format('d M Y, H:i:s') . ' WIB';

        // Simpan semua data terbaru ke dalam Session Laravel
        $request->session()->put('visit_count', $count);
        $request->session()->put('last_visit', $lastVisit);

        // Ambil data dari session untuk dilempar ke Blade view
        $totalKunjungan = $request->session()->get('visit_count');
        $waktuPertama = $request->session()->get('first_visit');
        $waktuTerakhir = $request->session()->get('last_visit');

        return view('preferensi', compact(
            'currentTheme',
            'currentFontSize',
            'totalKunjungan',
            'waktuPertama',
            'waktuTerakhir'
        ));
    }

    // Proses simpan preferensi via AJAX JSON
    public function save(Request $request)
    {
        $oldTheme = $request->cookie('theme', 'dark');
        $tema = $request->input('tema');
        $ukuranFont = $request->input('ukuran_font');

        $response = response()->json([
            'status' => 'success',
            'message' => 'Pengaturan SingSpace diperbarui!',
            'new_theme' => $tema,
            'new_size' => $ukuranFont
        ]);

        return $response->withCookie(cookie('theme', $tema, 43200, '/', null, false, false))
                        ->withCookie(cookie('font_size', $ukuranFont, 43200, '/', null, false, false));
    }

    // FUNGSI RESET HITUNGAN SESSION
    public function resetKunjungan(Request $request)
    {
        // Menghapus data spesifik dari session sesuai instruksi tugas
        $request->session()->forget(['visit_count', 'first_visit', 'last_visit']);
        // Redirect kembali dengan flash message sukses
        return redirect()->route('preferensi.index')->with('success', 'Statistik kunjungan halaman berhasil di-reset dari awal!');
    }
}
