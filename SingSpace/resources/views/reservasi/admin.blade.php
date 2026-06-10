@extends('layouts.app')

@section('content')
<style>
    /* CSS Khusus Tombol Filter agar support Light/Dark Mode */
    .filter-btn {
        padding: 8px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .filter-btn.active {
        background: #f97316;
        color: #fff !important;
        border: 1px solid #f97316;
        box-shadow: 0 4px 10px rgba(249, 115, 22, 0.3);
    }
    .filter-btn.inactive {
        background: transparent;
        color: #94a3b8;
        border: 1px solid #334155;
    }
    /* Saat Light Mode Aktif */
    html:not(.dark) .filter-btn.inactive {
        color: #475569 !important;
        border-color: #cbd5e1;
    }
    html:not(.dark) .filter-btn.inactive:hover {
        color: #f97316 !important;
        border-color: #f97316;
        background: #fff7ed;
    }
</style>

<div style="padding: 40px 5%; background-color: transparent; min-height: 100vh; max-width: 100vw; box-sizing: border-box;">

    <div style="margin-bottom: 30px; border-bottom: 1px solid #1e293b; padding-bottom: 20px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 15px;">
        <div>
            <h2 style="color: #fff; font-size: clamp(1.5rem, 4vw, 2rem); margin: 0;">Daftar <span style="color: #f97316;">Reservasi Masuk</span></h2>
            <p style="color: #94a3b8; margin-top: 5px;">Kelola dan konfirmasi pesanan dari pelanggan.</p>
        </div>

        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="{{ request()->url() }}?status=semua" class="filter-btn {{ request('status') == 'semua' || !request('status') ? 'active' : 'inactive' }}">Semua</a>
            <a href="{{ request()->url() }}?status=pending" class="filter-btn {{ request('status') == 'pending' ? 'active' : 'inactive' }}">Pending</a>
            <a href="{{ request()->url() }}?status=confirmed" class="filter-btn {{ request('status') == 'confirmed' ? 'active' : 'inactive' }}">Dikonfirmasi</a>
            <a href="{{ request()->url() }}?status=batal" class="filter-btn {{ request('status') == 'batal' ? 'active' : 'inactive' }}">Dibatalkan</a>
        </div>
    </div>

    <div style="background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-radius: 16px; border: 1px solid #334155; overflow-x: auto; -webkit-overflow-scrolling: touch; box-shadow: 0 15px 30px rgba(0,0,0,0.3);">

        <table style="width: 100%; min-width: 1000px; border-collapse: collapse; color: #cbd5e1; text-align: left;">
            <thead style="background: rgba(15, 23, 42, 0.8); border-bottom: 2px solid #334155;">
                <tr>
                    <th style="padding: 18px 20px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8;">Kode Booking</th>
                    <th style="padding: 18px 20px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8;">Pelanggan</th>
                    <th style="padding: 18px 20px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8;">Ruangan & Waktu</th>
                    <th style="padding: 18px 20px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8;">Total & Bukti</th>
                    <th style="padding: 18px 20px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8; text-align: center;">Status</th>
                    <th style="padding: 18px 20px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8; text-align: center;">Konfirmasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanans as $pesanan)
                <tr style="border-bottom: 1px solid #334155; transition: 0.3s;" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.03)'" onmouseout="this.style.backgroundColor='transparent'">

                    <td style="padding: 18px 20px; font-family: monospace; color: #f97316; font-weight: 900; font-size: 0.95rem;">
                        #BKG-{{ str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}
                    </td>

                    <td style="padding: 18px 20px;">
                        <strong style="color: #fff; display: block; font-size: 0.95rem;">{{ $pesanan->user->name }}</strong>
                        <span style="font-size: 0.85rem; color: #64748b;">{{ $pesanan->user->email }}</span>
                    </td>

                    <td style="padding: 18px 20px;">
                        <strong style="color: #38bdf8; display: block; margin-bottom: 4px;">{{ $pesanan->ruangan->nama }}</strong>
                        <span style="font-size: 0.85rem; display: block; color: #cbd5e1;"><i class="fa-regular fa-calendar" style="margin-right: 5px;"></i> {{ date('d M Y', strtotime($pesanan->tanggal)) }}</span>
                        <span style="font-size: 0.85rem; color: #cbd5e1;"><i class="fa-regular fa-clock" style="margin-right: 5px;"></i> {{ date('H:i', strtotime($pesanan->jam_mulai)) }} - {{ date('H:i', strtotime($pesanan->jam_selesai)) }}</span>
                    </td>

                    <td style="padding: 18px 20px;">
                        <strong style="color: #fff; display: block; font-size: 1rem; margin-bottom: 4px;">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong>
                        <span style="font-size: 0.75rem; background: rgba(255,255,255,0.1); padding: 2px 8px; border-radius: 4px; display: inline-block; margin-bottom: 4px;">{{ $pesanan->metode_pembayaran }}</span>

                        @if($pesanan->bukti_pembayaran)
                            <a href="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" target="_blank" style="display: block; margin-top: 4px; font-size: 0.85rem; color: #10b981; text-decoration: none; transition: 0.3s;" onmouseover="this.style.color='#34d399'">
                                <i class="fa-solid fa-image"></i> Lihat Bukti Transfer
                            </a>
                        @endif
                    </td>

                    <td style="padding: 18px 20px; text-align: center;">
                        @if($pesanan->status == 'pending')
                            <span style="background: rgba(249, 115, 22, 0.1); color: #f97316; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 800; border: 1px solid rgba(249, 115, 22, 0.3);">Pending</span>
                        @elseif($pesanan->status == 'confirmed')
                            <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 800; border: 1px solid rgba(16, 185, 129, 0.3);">Confirmed</span>
                        @else
                            <span style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 800; border: 1px solid rgba(239, 68, 68, 0.3);">Dibatalkan</span>
                        @endif
                    </td>

                    <td style="padding: 18px 20px; text-align: center; white-space: nowrap;">
                        @if($pesanan->status == 'pending')
                            <div style="display: flex; justify-content: center; gap: 8px;">
                                <form action="{{ route('admin.reservasi.status', $pesanan->id) }}" method="POST" style="margin: 0;">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" title="Terima Pesanan" style="display: inline-flex; justify-content: center; align-items: center; background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid #10b981; width: 35px; height: 35px; border-radius: 8px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.background='#10b981'; this.style.color='#fff';" onmouseout="this.style.background='rgba(16, 185, 129, 0.1)'; this.style.color='#10b981';">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.reservasi.status', $pesanan->id) }}" method="POST" style="margin: 0;">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="batal">
                                    <button type="submit" title="Tolak Pesanan" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')" style="display: inline-flex; justify-content: center; align-items: center; background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid #ef4444; width: 35px; height: 35px; border-radius: 8px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.background='#ef4444'; this.style.color='#fff';" onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.color='#ef4444';">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                            </div>
                        @else
                            <span style="color: #64748b; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="fa-solid fa-lock"></i> Selesai
                            </span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 50px; text-align: center; color: #64748b;">
                        <i class="fa-solid fa-inbox" style="font-size: 3rem; margin-bottom: 15px; color: #334155;"></i>
                        <p style="margin: 0; font-size: 1.1rem;">Belum ada data reservasi masuk saat ini.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
