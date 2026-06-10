@extends('layouts.app')

@section('content')
<div style="padding: 40px 5%; background-color: transparent; min-height: 100vh; max-width: 100vw; overflow-x: hidden; box-sizing: border-box;">

    <div style="margin-bottom: 30px;">
        <h2 style="color: #fff; font-size: clamp(1.5rem, 4vw, 2rem); margin: 0;">Dashboard <span style="color: #f97316;">SingSpace</span></h2>
        <p style="color: #94a3b8; margin-top: 5px;">Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong>. Berikut adalah ringkasan sistem hari ini.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 40px;">

        <div style="background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(10px); border: 1px solid #334155; border-radius: 16px; padding: 25px; box-shadow: 0 10px 20px rgba(0,0,0,0.2); position: relative; overflow: hidden;">
            <i class="fa-solid fa-wallet" style="position: absolute; right: -15px; bottom: -15px; font-size: 5rem; color: rgba(255,255,255,0.03);"></i>
            <h4 style="color: #94a3b8; margin: 0 0 10px 0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Total Pendapatan</h4>
            <span style="display: block; font-size: 1.8rem; font-weight: 800; color: #f97316;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
        </div>

        <div style="background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(10px); border: 1px solid #334155; border-radius: 16px; padding: 25px; box-shadow: 0 10px 20px rgba(0,0,0,0.2); position: relative; overflow: hidden;">
            <i class="fa-solid fa-bell" style="position: absolute; right: -15px; bottom: -15px; font-size: 5rem; color: rgba(239,68,68,0.05);"></i>
            <h4 style="color: #94a3b8; margin: 0 0 10px 0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Menunggu Konfirmasi</h4>
            <span style="display: block; font-size: 1.8rem; font-weight: 800; color: #ef4444;">{{ $menungguKonfirmasi }} <small style="font-size: 0.9rem; color: #64748b; font-weight: normal;">Pesanan</small></span>
        </div>

        <div style="background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(10px); border: 1px solid #334155; border-radius: 16px; padding: 25px; box-shadow: 0 10px 20px rgba(0,0,0,0.2); position: relative; overflow: hidden;">
            <i class="fa-solid fa-door-open" style="position: absolute; right: -15px; bottom: -15px; font-size: 5rem; color: rgba(56,189,248,0.05);"></i>
            <h4 style="color: #94a3b8; margin: 0 0 10px 0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Total Ruangan</h4>
            <span style="display: block; font-size: 1.8rem; font-weight: 800; color: #38bdf8;">{{ $totalRuangan }} <small style="font-size: 0.9rem; color: #64748b; font-weight: normal;">Unit</small></span>
        </div>

        <div style="background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(10px); border: 1px solid #334155; border-radius: 16px; padding: 25px; box-shadow: 0 10px 20px rgba(0,0,0,0.2); position: relative; overflow: hidden;">
            <i class="fa-solid fa-check-double" style="position: absolute; right: -15px; bottom: -15px; font-size: 5rem; color: rgba(16,185,129,0.05);"></i>
            <h4 style="color: #94a3b8; margin: 0 0 10px 0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Reservasi Terkonfirmasi</h4>
            <span style="display: block; font-size: 1.8rem; font-weight: 800; color: #10b981;">{{ $reservasiTerkonfirmasi }} <small style="font-size: 0.9rem; color: #64748b; font-weight: normal;">Transaksi</small></span>
        </div>

    </div>

    <div style="background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-radius: 16px; border: 1px solid #334155; box-shadow: 0 15px 30px rgba(0,0,0,0.3); overflow: hidden;">

        <div style="padding: 20px 25px; border-bottom: 1px solid #334155; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <h3 style="margin: 0; color: #fff; font-size: 1.1rem; display: flex; align-items: center; gap: 10px;"><i class="fa-solid fa-bolt" style="color: #f97316;"></i> 5 Reservasi Terbaru</h3>
            <a href="{{ route('admin.reservasi') }}" style="color: #38bdf8; text-decoration: none; font-size: 0.9rem; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#7dd3fc'" onmouseout="this.style.color='#38bdf8'">Lihat Semua &rarr;</a>
        </div>

        <div style="width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table style="width: 100%; min-width: 600px; border-collapse: collapse; color: #cbd5e1; text-align: left;">
                <thead style="background: rgba(15, 23, 42, 0.8);">
                    <tr>
                        <th style="padding: 15px 25px; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; color: #94a3b8;">Kode</th>
                        <th style="padding: 15px 25px; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; color: #94a3b8;">Pelanggan</th>
                        <th style="padding: 15px 25px; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; color: #94a3b8;">Ruangan</th>
                        <th style="padding: 15px 25px; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; color: #94a3b8;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservasiTerbaru as $res)
                    <tr style="border-bottom: 1px solid #334155; transition: 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.02)'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 15px 25px; font-weight: 800; color: #f97316;">
                            #{{ str_pad($res->id, 4, '0', STR_PAD_LEFT) }}
                        </td>

                        <td style="padding: 15px 25px; color: #fff; font-weight: 600;">
                            {{ $res->user->name ?? 'User Dihapus' }}
                        </td>

                        <td style="padding: 15px 25px;">
                            {{ $res->ruangan->nama ?? 'Ruangan Dihapus' }}
                        </td>

                        <td style="padding: 15px 25px;">
                            @if(strtolower($res->status) == 'pending')
                                <span style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); padding: 5px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: bold;">Pending</span>
                            @elseif(strtolower($res->status) == 'confirmed' || strtolower($res->status) == 'selesai')
                                <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); padding: 5px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: bold;">Confirmed</span>
                            @else
                                <span style="background: rgba(100, 116, 139, 0.1); color: #94a3b8; border: 1px solid rgba(100, 116, 139, 0.2); padding: 5px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: bold;">{{ ucfirst($res->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding: 40px; text-align: center; color: #64748b;">
                            <i class="fa-solid fa-folder-open" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                            Belum ada reservasi terbaru bulan ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
