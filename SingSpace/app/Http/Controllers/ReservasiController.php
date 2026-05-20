<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    public function create($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('reservasi.create', compact('ruangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruangan_id' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'durasi' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $ruangan = Ruangan::findOrFail($request->ruangan_id);

        // Simpan File Bukti Transfer ke folder public/storage/bukti_pembayaran
        $pathBukti = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Hitung total dan jam selesai
        $total_harga = $ruangan->harga * $request->durasi;
        $jam_selesai = date('H:i', strtotime($request->jam_mulai) + ($request->durasi * 3600));

        Reservasi::create([
            'user_id' => auth()->id(),
            'ruangan_id' => $ruangan->id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $jam_selesai,
            'durasi' => $request->durasi,
            'total_harga' => $total_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $pathBukti,
            'status' => 'pending',
        ]);

        // Nanti kita arahkan ke halaman "Pesanan Saya", sementara lempar ke katalog dulu
        return redirect()->route('ruangan.catalog')->with('success', 'Reservasi berhasil dibuat! Menunggu konfirmasi admin.');
    }

    // ADMIN: Menampilkan semua daftar reservasi
    public function indexAdmin()
    {
        // Ambil semua data reservasi beserta data user dan ruangan-nya
        $pesanans = Reservasi::with(['user', 'ruangan'])->latest()->get();
        return view('reservasi.admin', compact('pesanans'));
    }

    // ADMIN: Mengubah status reservasi (Terima/Tolak)
    public function updateStatus(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui!');
    }
}
