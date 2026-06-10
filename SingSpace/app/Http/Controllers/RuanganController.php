<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ADMIN: Hanya melihat ruangan yang dia buat sendiri (Sesuai tugas Bonus no 9)
        $ruangans = Ruangan::where('user_id', request()->user()->id)->latest()->paginate(10);
        return view('ruangan.index', compact('ruangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required|unique:ruangans,kode_ruangan',
            'nama'         => 'required|min:3',
            'tipe'         => 'required|in:Regular,Family,VIP,VVIP',
            'status'       => 'nullable|string', // Beri izin form create untuk menerima status
            'foto'         => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        $data = $request->all();

        // SUNTIKKAN ID USER YANG SEDANG LOGIN KE DALAM DATA
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('ruangan_photos', 'public');
        }

        Ruangan::create($data);
        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan $ruangan)
    {
        // Kirim data spesifik ruangan ke halaman show
        return view('ruangan.show', compact('ruangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruangan $ruangan)
    {
        // Kirim data ruangan yang mau diedit ke form
        return view('ruangan.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        // FIX: Tambahkan validasi untuk status
        $request->validate([
            'kode_ruangan' => 'required|unique:ruangans,kode_ruangan,' . $ruangan->id,
            'nama'         => 'required|min:3',
            'is_aktif'     => 'required|boolean', // <-- Ini yang benar
            'foto'         => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($ruangan->foto) {
                Storage::disk('public')->delete($ruangan->foto);
            }
            $data['foto'] = $request->file('foto')->store('ruangan_photos', 'public');
        }

        // Karena 'status' sudah ada di $fillable, sekarang method update() ini akan berhasil menyimpan status barunya!
        $ruangan->update($data);
        return redirect()->route('ruangan.index')->with('success', 'Data ruangan diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('ruangan.index')->with('success', 'Ruangan telah dihapus dari sistem.');
    }

    public function catalog()
    {
        // PUBLIK: Melihat semua ruangan yang ada di database
        $ruangans = Ruangan::latest()->get();
        return view('ruangan.catalog', compact('ruangans'));
    }

    // Fungsi untuk menghandle Live Search via AJAX
    public function searchAjax(Request $request)
    {
        $keyword = $request->keyword;

        // Cari data ruangan berdasarkan nama atau tipe
        $ruangans = \App\Models\Ruangan::where('nama', 'like', '%' . $keyword . '%')
                                       ->orWhere('tipe', 'like', '%' . $keyword . '%')
                                       ->get();

        // Kembalikan data dalam format JSON agar bisa dibaca oleh JavaScript
        return response()->json($ruangans);
    }
}
