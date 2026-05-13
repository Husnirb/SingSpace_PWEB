@extends('layouts.app')

@section('content')
<div class="sp-container">
    <div class="sp-header">
        <h2 class="sp-title">Manajemen Ruangan <span>SingSpace</span></h2>
        <a href="{{ route('ruangan.create') }}" class="sp-btn sp-btn-primary">+ Tambah Ruangan</a>
    </div>

    <div class="sp-card" style="padding: 0;">
        <table class="sp-table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Ruangan</th>
                    <th>Preview</th> <th>Tipe</th>
                    <th>Harga / Jam</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ruangans as $ruangan)
                <tr>
                    <td style="color: #fff; font-weight: bold;">{{ $ruangan->kode_ruangan }}</td>
                    <td>{{ $ruangan->nama }}</td>

                    <td>
                        @if($ruangan->foto)
                            <img src="{{ asset('storage/' . $ruangan->foto) }}" style="width: 70px; height: 45px; object-fit: cover; border-radius: 6px; border: 1px solid #334155;">
                        @else
                            <div style="width: 70px; height: 45px; background: #0f172a; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #475569; border: 1px dashed #334155;">
                                <i class="fa-solid fa-image-slash" style="margin-right: 5px;"></i> No Image
                            </div>
                        @endif
                    </td>

                    <td><span class="sp-badge sp-badge-neutral">{{ $ruangan->tipe }}</span></td>
                    <td style="color: #f97316; font-weight: bold;">Rp {{ number_format($ruangan->harga, 0, ',', '.') }}</td>
                    <td style="text-align: center;">
                        @if($ruangan->is_aktif)
                            <span class="sp-badge sp-badge-success">Tersedia</span>
                        @else
                            <span class="sp-badge sp-badge-danger">Maintenance</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('ruangan.show', $ruangan->id) }}" class="sp-btn sp-btn-info" style="padding: 6px 12px; margin-right: 5px;">Detail</a>
                        <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="sp-btn sp-btn-secondary" style="padding: 6px 12px;">Edit</a>

                        <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus ruangan {{ $ruangan->nama }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="sp-btn" style="background-color: #ef4444; color: #fff; padding: 6px 12px;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">Belum ada data ruangan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $ruangans->links() }}
    </div>
</div>
@endsection
