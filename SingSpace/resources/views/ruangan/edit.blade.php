@extends('layouts.app')

@section('content')
<div class="sp-container sp-container-sm">
    <h3 class="sp-title">Edit Data <span>{{ $ruangan->kode_ruangan }}</span></h3>

    <div class="sp-card">
        <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="sp-form-group">
                <label class="sp-label">Kode Ruangan</label>
                <input type="text" name="kode_ruangan" class="sp-input" value="{{ old('kode_ruangan', $ruangan->kode_ruangan) }}" required>
            </div>

            <div class="sp-form-group">
                <label class="sp-label">Nama Ruangan</label>
                <input type="text" name="nama" class="sp-input" value="{{ old('nama', $ruangan->nama) }}" required>
            </div>

            <div class="sp-form-group">
                <label class="sp-label">Deskripsi</label>
                <textarea name="deskripsi" class="sp-textarea" rows="3" required>{{ old('deskripsi', $ruangan->deskripsi) }}</textarea>
            </div>

            <div class="sp-grid-3 sp-form-group">
                <div>
                    <label class="sp-label">Tipe</label>
                    <select name="tipe" class="sp-select" required>
                        <option value="Regular" {{ old('tipe', $ruangan->tipe) == 'Regular' ? 'selected' : '' }}>Regular</option>
                        <option value="Family" {{ old('tipe', $ruangan->tipe) == 'Family' ? 'selected' : '' }}>Family</option>
                        <option value="VIP" {{ old('tipe', $ruangan->tipe) == 'VIP' ? 'selected' : '' }}>VIP</option>
                        <option value="VVIP" {{ old('tipe', $ruangan->tipe) == 'VVIP' ? 'selected' : '' }}>VVIP</option>
                    </select>
                </div>
                <div>
                    <label class="sp-label">Harga / Jam</label>
                    <input type="number" name="harga" class="sp-input" value="{{ old('harga', $ruangan->harga) }}" required>
                </div>
                <div>
                    <label class="sp-label">Kapasitas</label>
                    <input type="number" name="kapasitas" class="sp-input" value="{{ old('kapasitas', $ruangan->kapasitas) }}" required>
                </div>
            </div>

            <div class="sp-form-group">
                <label class="sp-label">Status Ruangan</label>
                <select name="is_aktif" class="sp-select" required>
                    <option value="1" {{ old('is_aktif', $ruangan->is_aktif) == 1 ? 'selected' : '' }}>Tersedia (Aktif)</option>
                    <option value="0" {{ old('is_aktif', $ruangan->is_aktif) == 0 ? 'selected' : '' }}>Maintenance (Tidak Aktif)</option>
                </select>
            </div>

            <div class="sp-form-group">
                <label class="sp-label">Ganti Foto Ruangan</label>

                @if($ruangan->foto)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $ruangan->foto) }}" style="width: 150px; border-radius: 8px; border: 1px solid #334155;">
                        <p style="font-size: 11px; color: #64748b; margin-top: 5px;">*Foto saat ini</p>
                    </div>
                @endif

                <div style="position: relative;">
                    <i class="fa-solid fa-cloud-arrow-up" style="position: absolute; left: 15px; top: 15px; color: #475569;"></i>
                    <input type="file" name="foto" class="sp-input" style="padding-left: 45px;" accept="image/png, image/jpeg, image/jpg">
                </div>
                <small style="color: #64748b; font-size: 12px; margin-top: 5px; display: block;">Biarkan kosong jika tidak ingin mengganti foto.</small>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 30px; border-top: 1px solid #334155; padding-top: 20px;">
                <a href="{{ route('ruangan.index') }}" class="sp-btn sp-btn-secondary">Batal</a>
                <button type="submit" class="sp-btn sp-btn-info">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
