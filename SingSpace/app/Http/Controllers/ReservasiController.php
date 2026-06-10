<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    public function create($id)
    {
        // CEK ROLE: Mencegah Admin masuk ke halaman form booking
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak! Admin tidak diperbolehkan melakukan booking ruangan.');
        }

        $ruangan = Ruangan::findOrFail($id);

        // BLOKIR RUANGAN MAINTENANCE YANG BENAR (Pakai is_aktif == 0)
        if ($ruangan->is_aktif == 0) {
            return redirect()->route('ruangan.catalog')->with('error', 'Maaf, ruangan ini sedang dalam perbaikan (Maintenance) dan tidak dapat dipesan saat ini.');
        }

        return view('reservasi.create', compact('ruangan'));
    }

    public function store(Request $request)
    {
        // PERBAIKAN 1: VALIDASI ANTI-HACKER TANGGAL
        $request->validate([
            'ruangan_id' => 'required',
            'tanggal' => 'required|date|after_or_equal:today', // <-- INI KUNCI ANTI HACKER TANGGAL
            'jam_mulai' => 'required',
            'durasi' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'tanggal.after_or_equal' => 'Waduh, Anda tidak bisa melakukan booking untuk tanggal yang sudah berlalu!'
        ]);

        // PERBAIKAN 2: VALIDASI ANTI-HACKER WAKTU (Jam)
        if ($request->tanggal == date('Y-m-d')) {
            $jam_sekarang = date('H:i');
            // Jika memilih hari ini, tapi jamnya sudah lewat dari jam sekarang
            if ($request->jam_mulai <= $jam_sekarang) {
                return redirect()->back()->withInput()->with('error', 'Waktu yang Anda pilih sudah lewat. Silakan pilih jam lain.');
            }
        }

        $ruangan = Ruangan::findOrFail($request->ruangan_id);

        // BLOKIR RUANGAN MAINTENANCE YANG BENAR (Pakai is_aktif == 0)
        if ($ruangan->is_aktif == 0) {
            return redirect()->route('ruangan.catalog')->with('error', 'Maaf, ruangan ini sedang dalam perbaikan (Maintenance) dan tidak dapat dipesan saat ini.');
        }

        $pathBukti = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $total_harga = $ruangan->harga * $request->durasi;
        $jam_selesai = date('H:i', strtotime($request->jam_mulai) + ($request->durasi * 3600));

        // LOGIKA DETEKSI BENTROKAN JADWAL RESERVASI
        $bentrok = \App\Models\Reservasi::where('ruangan_id', $request->ruangan_id)
            ->where('tanggal', $request->tanggal)
            ->where('status', '!=', 'batal')
            ->where(function ($query) use ($request, $jam_selesai) {
                $query->where(function ($q) use ($request) {
                    $q->where('jam_mulai', '<=', $request->jam_mulai)
                      ->where('jam_selesai', '>', $request->jam_mulai);
                })
                ->orWhere(function ($q) use ($jam_selesai) {
                    $q->where('jam_mulai', '<', $jam_selesai)
                      ->where('jam_selesai', '>=', $jam_selesai);
                })
                ->orWhere(function ($q) use ($request, $jam_selesai) {
                    $q->where('jam_mulai', '>=', $request->jam_mulai)
                      ->where('jam_selesai', '<=', $jam_selesai);
                });
            })->exists();

        if ($bentrok) {
            return redirect()->back()->withInput()->with('error', 'Waduh, slot waktu pada jam tersebut sudah di-booking oleh pelanggan lain. Silakan pilih jam atau hari lain ya!');
        }

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

        return redirect()->route('ruangan.catalog')->with('success', 'Reservasi berhasil dibuat! Menunggu konfirmasi admin.');
    }

    // ADMIN: Menampilkan semua daftar reservasi + FITUR FILTER STATUS
    public function indexAdmin(Request $request)
    {
        $query = \App\Models\Reservasi::with(['user', 'ruangan'])->latest();

        if ($request->has('status') && $request->status != 'semua') {
            $query->where('status', $request->status);
        }

        $pesanans = $query->get();
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

    // METHOD AJAX: Mengambil data jam yang sudah dibooking
    public function cekJadwal(Request $request)
    {
        $ruangan_id = $request->ruangan_id;
        $tanggal = $request->tanggal;

        $reservasis = Reservasi::where('ruangan_id', $ruangan_id)
            ->where('tanggal', $tanggal)
            ->whereIn('status', ['pending', 'Pending', 'confirmed', 'Confirmed'])
            ->get(['jam_mulai', 'jam_selesai']);

        $bookedHours = [];

        foreach ($reservasis as $res) {
            $start = strtotime($res->jam_mulai);
            $end = strtotime($res->jam_selesai);

            for ($i = $start; $i < $end; $i += 3600) {
                $bookedHours[] = date('H:i', $i);
            }
        }

        return response()->json(array_unique($bookedHours));
    }
}
