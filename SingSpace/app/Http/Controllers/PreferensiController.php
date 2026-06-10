<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferensiController extends Controller
{
    // Menampilkan Form Preferensi
    public function index(Request $request)
    {
        // Baca cookie saat ini untuk ditampilkan di form preferensi
        $currentTheme = $request->cookie('theme', 'dark');
        $currentFontSize = $request->cookie('font_size', 'medium');

        return view('preferensi', compact('currentTheme', 'currentFontSize'));
    }

    // Proses simpan preferensi via AJAX JSON
    public function save(Request $request)
    {
        $tema = $request->input('tema');
        $ukuranFont = $request->input('ukuran_font');

        // Langsung kembalikan response sukses.
        // Penulisan cookie akan di-handle 100% oleh JavaScript di frontend.
        return response()->json([
            'status' => 'success',
            'message' => 'Pengaturan SingSpace diperbarui!',
            'new_theme' => $tema,
            'new_size' => $ukuranFont
        ]);
    }
}
