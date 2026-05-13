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
        // FILTER: Hanya ambil data yang user_id-nya sama dengan user yang sedang login
    $ruangans = Ruangan::where('user_id', request()->user()->id)
                        ->latest()
                        ->paginate(10);

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
        $request->validate([
            'kode_ruangan' => 'required|unique:ruangans,kode_ruangan,' . $ruangan->id,
            'nama'         => 'required|min:3',
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
        $ruangans = Ruangan::where('is_aktif', 1)->get();
        return view('ruangan.catalog', compact('ruangans'));
    }
}
