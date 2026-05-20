@extends('layouts.app')

@section('content')
<div style="padding: 50px 5%; background-color: #0f172a; min-height: 100vh;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #1e293b; padding-bottom: 20px;">
        <h2 style="color: #fff; font-size: 2rem; margin: 0;">Manajemen <span style="color: #f97316;">Ruangan</span></h2>
        <a href="{{ route('ruangan.create') }}" style="background: #f97316; color: #fff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold;"><i class="fa-solid fa-plus"></i> Tambah Ruangan</a>
    </div>

    @if(session('success'))
        <div style="background: #10b981; color: #fff; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #1e293b; border-radius: 12px; border: 1px solid #334155; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; color: #cbd5e1; text-align: left;">
            <thead style="background: #0f172a; border-bottom: 2px solid #334155;">
                <tr>
                    <th style="padding: 15px 20px;">Kode</th>
                    <th style="padding: 15px 20px;">Nama Ruangan</th>
                    <th style="padding: 15px 20px;">Tipe</th>
                    <th style="padding: 15px 20px;">Kapasitas</th>
                    <th style="padding: 15px 20px;">Harga / Jam</th>
                    <th style="padding: 15px 20px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ruangans as $ruangan)
                <tr style="border-bottom: 1px solid #334155;">
                    <td style="padding: 15px 20px; font-weight: bold; color: #f97316;">{{ $ruangan->kode_ruangan }}</td>
                    <td style="padding: 15px 20px; color: #fff;">{{ $ruangan->nama }}</td>
                    <td style="padding: 15px 20px;">
                        <span style="background: #334155; padding: 5px 10px; border-radius: 5px; font-size: 0.85rem;">{{ $ruangan->tipe }}</span>
                    </td>
                    <td style="padding: 15px 20px;">{{ $ruangan->kapasitas }} Orang</td>
                    <td style="padding: 15px 20px;">Rp {{ number_format($ruangan->harga, 0, ',', '.') }}</td>
                    <td style="padding: 15px 20px; text-align: center;">
                        <a href="{{ route('ruangan.edit', $ruangan->id) }}" style="color: #38bdf8; text-decoration: none; margin-right: 15px;"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 1rem;" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fa-solid fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 30px; text-align: center; color: #64748b;">Belum ada data ruangan yang Anda tambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
