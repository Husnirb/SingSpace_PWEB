@extends('layouts.app')

@section('content')
<div style="background-color: #0f172a; min-height: 100vh; padding: 40px 5%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <div style="margin-bottom: 40px; border-bottom: 1px solid #1e293b; padding-bottom: 20px;">
        <h1 style="color: #fff; font-size: 2.2rem; margin: 0 0 5px 0;">Dashboard <span style="color: #f97316;">SingSpace</span></h1>
        <p style="color: #94a3b8; font-size: 1.05rem; margin: 0;">Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong>. Berikut adalah ringkasan sistem hari ini.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 25px; margin-bottom: 40px;">

        <div style="background: linear-gradient(145deg, #1e293b, #0f172a); border: 1px solid #334155; border-radius: 16px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -10px; right: -10px; color: rgba(249, 115, 22, 0.1); font-size: 6rem;"><i class="fa-solid fa-wallet"></i></div>
            <p style="color: #94a3b8; margin: 0 0 10px 0; font-size: 0.9rem; text-transform: uppercase; font-weight: bold; letter-spacing: 1px;">Total Pendapatan</p>
            <h3 style="color: #f97316; margin: 0; font-size: 1.8rem;">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
        </div>

        <div style="background: linear-gradient(145deg, #1e293b, #0f172a); border: 1px solid #334155; border-radius: 16px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -10px; right: -10px; color: rgba(239, 68, 68, 0.1); font-size: 6rem;"><i class="fa-solid fa-bell"></i></div>
            <p style="color: #94a3b8; margin: 0 0 10px 0; font-size: 0.9rem; text-transform: uppercase; font-weight: bold; letter-spacing: 1px;">Menunggu Konfirmasi</p>
            <h3 style="color: #ef4444; margin: 0; font-size: 1.8rem;">{{ $booking_pending }} <span style="font-size: 1rem; color: #94a3b8; font-weight: normal;">Pesanan</span></h3>
        </div>

        <div style="background: linear-gradient(145deg, #1e293b, #0f172a); border: 1px solid #334155; border-radius: 16px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -10px; right: -10px; color: rgba(56, 189, 248, 0.1); font-size: 6rem;"><i class="fa-solid fa-door-open"></i></div>
            <p style="color: #94a3b8; margin: 0 0 10px 0; font-size: 0.9rem; text-transform: uppercase; font-weight: bold; letter-spacing: 1px;">Total Ruangan</p>
            <h3 style="color: #38bdf8; margin: 0; font-size: 1.8rem;">{{ $total_ruangan }} <span style="font-size: 1rem; color: #94a3b8; font-weight: normal;">Unit</span></h3>
        </div>

        <div style="background: linear-gradient(145deg, #1e293b, #0f172a); border: 1px solid #334155; border-radius: 16px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -10px; right: -10px; color: rgba(16, 185, 129, 0.1); font-size: 6rem;"><i class="fa-solid fa-check-double"></i></div>
            <p style="color: #94a3b8; margin: 0 0 10px 0; font-size: 0.9rem; text-transform: uppercase; font-weight: bold; letter-spacing: 1px;">Reservasi Terkonfirmasi</p>
            <h3 style="color: #10b981; margin: 0; font-size: 1.8rem;">{{ $booking_selesai }} <span style="font-size: 1rem; color: #94a3b8; font-weight: normal;">Transaksi</span></h3>
        </div>

    </div>

    <div style="background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="color: #fff; margin: 0; font-size: 1.2rem;"><i class="fa-solid fa-bolt" style="color: #f97316; margin-right: 8px;"></i> 5 Reservasi Terbaru</h3>
            <a href="{{ route('admin.reservasi') }}" style="color: #38bdf8; text-decoration: none; font-size: 0.9rem; font-weight: bold;">Lihat Semua &rarr;</a>
        </div>

        <table style="width: 100%; border-collapse: collapse; color: #cbd5e1; text-align: left;">
            <thead style="border-bottom: 1px solid #334155;">
                <tr>
                    <th style="padding: 12px 10px; color: #94a3b8; font-size: 0.85rem; text-transform: uppercase;">Kode</th>
                    <th style="padding: 12px 10px; color: #94a3b8; font-size: 0.85rem; text-transform: uppercase;">Pelanggan</th>
                    <th style="padding: 12px 10px; color: #94a3b8; font-size: 0.85rem; text-transform: uppercase;">Ruangan</th>
                    <th style="padding: 12px 10px; color: #94a3b8; font-size: 0.85rem; text-transform: uppercase;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservasi_terbaru as $pesanan)
                    <tr style="border-bottom: 1px solid rgba(51, 65, 85, 0.5);">
                        <td style="padding: 12px 10px; font-family: monospace; color: #f97316;">#{{ str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding: 12px 10px; font-weight: bold; color: #fff;">{{ $pesanan->user->name }}</td>
                        <td style="padding: 12px 10px;">{{ $pesanan->ruangan->nama }}</td>
                        <td style="padding: 12px 10px;">
                            @if($pesanan->status == 'pending')
                                <span style="background: rgba(249,115,22,0.1); color: #f97316; padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: bold;">Pending</span>
                            @elseif($pesanan->status == 'confirmed')
                                <span style="background: rgba(16,185,129,0.1); color: #10b981; padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: bold;">Confirmed</span>
                            @else
                                <span style="background: rgba(239,68,68,0.1); color: #ef4444; padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: bold;">Batal</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 20px 10px; text-align: center; color: #64748b;">Belum ada aktivitas reservasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
