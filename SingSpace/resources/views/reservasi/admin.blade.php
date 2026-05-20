@extends('layouts.app')

@section('content')
<div style="padding: 50px 5%; background-color: #0f172a; min-height: 100vh;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #1e293b; padding-bottom: 20px;">
        <div>
            <h2 style="color: #fff; font-size: 2rem; margin: 0;">Daftar <span style="color: #f97316;">Reservasi Masuk</span></h2>
            <p style="color: #94a3b8; margin-top: 5px;">Kelola dan konfirmasi pesanan dari pelanggan.</p>
        </div>
    </div>

    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.1); border-left: 4px solid #10b981; color: #10b981; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #1e293b; border-radius: 12px; border: 1px solid #334155; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
        <table style="width: 100%; border-collapse: collapse; color: #cbd5e1; text-align: left;">
            <thead style="background: #0f172a; border-bottom: 2px solid #334155;">
                <tr>
                    <th style="padding: 18px 20px;">Kode Booking</th>
                    <th style="padding: 18px 20px;">Pelanggan</th>
                    <th style="padding: 18px 20px;">Ruangan & Waktu</th>
                    <th style="padding: 18px 20px;">Total & Bukti</th>
                    <th style="padding: 18px 20px; text-align: center;">Status</th>
                    <th style="padding: 18px 20px; text-align: center;">Konfirmasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanans as $pesanan)
                <tr style="border-bottom: 1px solid #334155; transition: 0.3s;" onmouseover="this.style.backgroundColor='rgba(15, 23, 42, 0.5)'" onmouseout="this.style.backgroundColor='transparent'">

                    <td style="padding: 15px 20px; font-family: monospace; color: #f97316; font-weight: bold;">
                        #BKG-{{ str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}
                    </td>

                    <td style="padding: 15px 20px;">
                        <strong style="color: #fff; display: block;">{{ $pesanan->user->name }}</strong>
                        <span style="font-size: 0.85rem; color: #94a3b8;">{{ $pesanan->user->email }}</span>
                    </td>

                    <td style="padding: 15px 20px;">
                        <strong style="color: #38bdf8; display: block;">{{ $pesanan->ruangan->nama }}</strong>
                        <span style="font-size: 0.85rem; display: block; margin-top: 3px;"><i class="fa-regular fa-calendar"></i> {{ date('d M Y', strtotime($pesanan->tanggal)) }}</span>
                        <span style="font-size: 0.85rem; color: #94a3b8;"><i class="fa-regular fa-clock"></i> {{ date('H:i', strtotime($pesanan->jam_mulai)) }} - {{ date('H:i', strtotime($pesanan->jam_selesai)) }}</span>
                    </td>

                    <td style="padding: 15px 20px;">
                        <strong style="color: #fff; display: block;">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong>
                        <span style="font-size: 0.8rem; background: #334155; padding: 2px 8px; border-radius: 4px; margin-top: 5px; display: inline-block;">{{ $pesanan->metode_pembayaran }}</span>

                        @if($pesanan->bukti_pembayaran)
                            <a href="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" target="_blank" style="display: block; margin-top: 8px; font-size: 0.85rem; color: #10b981; text-decoration: none;">
                                <i class="fa-solid fa-image"></i> Lihat Bukti Transfer
                            </a>
                        @endif
                    </td>

                    <td style="padding: 15px 20px; text-align: center;">
                        @if($pesanan->status == 'pending')
                            <span style="background: rgba(249, 115, 22, 0.2); color: #f97316; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; border: 1px solid rgba(249, 115, 22, 0.5);">Pending</span>
                        @elseif($pesanan->status == 'confirmed')
                            <span style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; border: 1px solid rgba(16, 185, 129, 0.5);">Confirmed</span>
                        @else
                            <span style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; border: 1px solid rgba(239, 68, 68, 0.5);">Dibatalkan</span>
                        @endif
                    </td>

                    <td style="padding: 15px 20px; text-align: center;">
                        @if($pesanan->status == 'pending')
                            <div style="display: flex; justify-content: center; gap: 10px;">
                                <form action="{{ route('admin.reservasi.status', $pesanan->id) }}" method="POST" style="margin: 0;">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" title="Terima Pesanan" style="display: inline-flex; justify-content: center; align-items: center; padding: 0; background: #10b981; color: #fff; border: none; width: 35px; height: 35px; border-radius: 8px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.backgroundColor='#059669'" onmouseout="this.style.backgroundColor='#10b981'">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.reservasi.status', $pesanan->id) }}" method="POST" style="margin: 0;">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="batal">
                                    <button type="submit" title="Tolak Pesanan" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')" style="display: inline-flex; justify-content: center; align-items: center; padding: 0; background: transparent; color: #ef4444; border: 1px solid #ef4444; width: 35px; height: 35px; border-radius: 8px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.backgroundColor='#ef4444'; this.style.color='#fff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#ef4444';">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                            </div>
                        @else
                            <span style="color: #64748b; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 5px;"><i class="fa-solid fa-lock"></i> Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 40px; text-align: center; color: #64748b;">
                        <i class="fa-solid fa-inbox" style="font-size: 3rem; margin-bottom: 10px;"></i><br>
                        Belum ada data reservasi masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
