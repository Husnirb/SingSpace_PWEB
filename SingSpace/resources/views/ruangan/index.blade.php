@extends('layouts.app')

@section('content')
<div style="padding: 40px 5%; background-color: transparent; min-height: 100vh;">

    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #1e293b; padding-bottom: 20px;">
        <h2 style="color: #fff; font-size: clamp(1.5rem, 4vw, 2rem); margin: 0;">Manajemen <span style="color: #f97316;">Ruangan</span></h2>
        <a href="{{ route('ruangan.create') }}" style="background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: bold; white-space: nowrap; box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3); transition: 0.3s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fa-solid fa-plus" style="margin-right: 5px;"></i> Tambah Ruangan
        </a>
    </div>

    <div style="background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-radius: 16px; border: 1px solid #334155; overflow-x: auto; -webkit-overflow-scrolling: touch; box-shadow: 0 15px 30px rgba(0,0,0,0.3);">

        <table style="width: 100%; min-width: 850px; border-collapse: collapse; color: #cbd5e1; text-align: left;">
            <thead style="background: rgba(15, 23, 42, 0.8); border-bottom: 2px solid #334155;">
                <tr>
                    <th style="padding: 18px 25px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8;">Kode</th>
                    <th style="padding: 18px 25px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8;">Nama Ruangan</th>
                    <th style="padding: 18px 25px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8;">Tipe</th>
                    <th style="padding: 18px 25px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8;">Kapasitas</th>
                    <th style="padding: 18px 25px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8;">Harga / Jam</th>
                    <th style="padding: 18px 25px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; color: #94a3b8; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ruangans as $ruangan)
                <tr style="border-bottom: 1px solid #334155; transition: 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 18px 25px; font-weight: 800; color: #f97316;">{{ $ruangan->kode_ruangan }}</td>
                    <td style="padding: 18px 25px; color: #fff; font-weight: 600;">{{ $ruangan->nama }}</td>
                    <td style="padding: 18px 25px;">
                        <span style="background: rgba(249, 115, 22, 0.1); color: #f97316; border: 1px solid rgba(249, 115, 22, 0.2); padding: 5px 12px; border-radius: 8px; font-size: 0.85rem; font-weight: bold;">
                            {{ $ruangan->tipe }}
                        </span>
                    </td>
                    <td style="padding: 18px 25px;">{{ $ruangan->kapasitas }} Orang</td>
                    <td style="padding: 18px 25px; font-weight: 600;">Rp {{ number_format($ruangan->harga, 0, ',', '.') }}</td>
                    <td style="padding: 18px 25px; text-align: center; white-space: nowrap;">
                        <a href="{{ route('ruangan.edit', $ruangan->id) }}" style="background: rgba(56, 189, 248, 0.1); color: #38bdf8; padding: 8px 15px; border-radius: 8px; text-decoration: none; margin-right: 10px; font-size: 0.9rem; transition: 0.3s;" onmouseover="this.style.background='#38bdf8'; this.style.color='#fff';">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: none; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: 0.3s;" onmouseover="this.style.background='#ef4444'; this.style.color='#fff';" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 50px; text-align: center; color: #64748b;">
                        <i class="fa-solid fa-folder-open" style="font-size: 3rem; margin-bottom: 15px; color: #334155;"></i>
                        <p style="margin: 0; font-size: 1.1rem;">Belum ada data ruangan yang ditambahkan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
