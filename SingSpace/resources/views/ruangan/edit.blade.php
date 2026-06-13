@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .swal-glass {
        background: rgba(30, 41, 59, 0.75) !important;
        backdrop-filter: blur(16px) !important;
        -webkit-backdrop-filter: blur(16px) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 24px !important;
        box-shadow: 0 25px 50px rgba(0,0,0,0.6), 0 0 30px rgba(249, 115, 22, 0.15) !important;
    }
    .swal-title-glass { color: #ffffff !important; font-weight: 800 !important; }
    .swal-html-glass { color: #cbd5e1 !important; }
    .swal-confirm-orange {
        background: linear-gradient(135deg, #f97316, #ea580c) !important;
        border: none !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3) !important;
        padding: 12px 30px !important;
        font-weight: 800 !important;
        color: #fff !important;
        transition: transform 0.2s !important;
    }
    .swal-confirm-orange:hover { transform: scale(1.05) !important; }
    .swal-cancel-gray {
        background: #334155 !important;
        color: #94a3b8 !important;
        border: 1px solid #475569 !important;
        border-radius: 12px !important;
        padding: 12px 25px !important;
        font-weight: bold !important;
    }
</style>

<main class="sp-container sp-container-sm">
    <header>
        <h3 class="sp-title">Edit Data <span>{{ $ruangan->kode_ruangan }}</span></h3>
    </header>

    <section class="sp-card">
        <form id="formEditRuangan" action="{{ route('ruangan.update', $ruangan->id) }}" method="POST" enctype="multipart/form-data" aria-label="Formulir Edit Data Ruangan">
            @csrf
            @method('PUT')

            <div class="sp-form-group">
                <label for="kode_ruangan" class="sp-label">Kode Ruangan</label>
                <input type="text" id="kode_ruangan" name="kode_ruangan" class="sp-input" value="{{ old('kode_ruangan', $ruangan->kode_ruangan) }}" required>
            </div>

            <div class="sp-form-group">
                <label for="nama" class="sp-label">Nama Ruangan</label>
                <input type="text" id="nama" name="nama" class="sp-input" value="{{ old('nama', $ruangan->nama) }}" required>
            </div>

            <div class="sp-form-group">
                <label for="deskripsi" class="sp-label">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="sp-textarea" rows="3" required>{{ old('deskripsi', $ruangan->deskripsi) }}</textarea>
            </div>

            <div class="sp-grid-3 sp-form-group">
                <div>
                    <label for="tipe" class="sp-label">Tipe</label>
                    <select id="tipe" name="tipe" class="sp-select" required>
                        <option value="Regular" {{ old('tipe', $ruangan->tipe) == 'Regular' ? 'selected' : '' }}>Regular</option>
                        <option value="Family" {{ old('tipe', $ruangan->tipe) == 'Family' ? 'selected' : '' }}>Family</option>
                        <option value="VIP" {{ old('tipe', $ruangan->tipe) == 'VIP' ? 'selected' : '' }}>VIP</option>
                        <option value="VVIP" {{ old('tipe', $ruangan->tipe) == 'VVIP' ? 'selected' : '' }}>VVIP</option>
                    </select>
                </div>
                <div>
                    <label for="harga" class="sp-label">Harga / Jam</label>
                    <input type="number" id="harga" name="harga" class="sp-input" value="{{ old('harga', $ruangan->harga) }}" min="1" required>
                </div>
                <div>
                    <label for="kapasitas" class="sp-label">Kapasitas</label>
                    <input type="number" id="kapasitas" name="kapasitas" class="sp-input" value="{{ old('kapasitas', $ruangan->kapasitas) }}" min="1" required>
                </div>
            </div>

            <div class="sp-form-group">
                <label for="is_aktif" class="sp-label">Status Ruangan</label>
                <select id="is_aktif" name="is_aktif" class="sp-select" required>
                    <option value="1" {{ old('is_aktif', $ruangan->is_aktif) == 1 ? 'selected' : '' }}>Tersedia (Aktif)</option>
                    <option value="0" {{ old('is_aktif', $ruangan->is_aktif) == 0 ? 'selected' : '' }}>Maintenance (Tidak Aktif)</option>
                </select>
                @error('is_aktif')
                    <span style="color: #ef4444; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="sp-form-group">
                <label for="foto" class="sp-label">Ganti Foto Ruangan</label>

                @if($ruangan->foto)
                    <figure style="margin: 0 0 15px 0;">
                        <img src="{{ asset('storage/' . $ruangan->foto) }}" alt="Foto {{ $ruangan->nama }}" style="width: 150px; border-radius: 8px; border: 1px solid #334155;">
                        <figcaption style="font-size: 11px; color: #64748b; margin-top: 5px;">*Foto ruangan saat ini</figcaption>
                    </figure>
                @endif

                <div style="position: relative;">
                    <i class="fa-solid fa-cloud-arrow-up" style="position: absolute; left: 15px; top: 15px; color: #475569;" aria-hidden="true"></i>
                    <input type="file" id="foto" name="foto" class="sp-input" style="padding-left: 45px;" accept="image/png, image/jpeg, image/jpg">
                </div>
                <small style="color: #64748b; font-size: 12px; margin-top: 5px; display: block;">Biarkan kosong jika tidak ingin mengganti foto.</small>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 30px; border-top: 1px solid #334155; padding-top: 20px;">
                <a href="{{ route('ruangan.index') }}" class="sp-btn sp-btn-secondary">Batal</a>
                <button type="submit" class="sp-btn sp-btn-info" style="background: linear-gradient(135deg, #f97316, #ea580c); border:none; box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);">Update Data</button>
            </div>
        </form>
    </section>
</main>

<script>
    document.getElementById('formEditRuangan').addEventListener('submit', function(e) {
        e.preventDefault();

        const harga = document.getElementById('harga').value;
        const kapasitas = document.getElementById('kapasitas').value;
        const nama = document.getElementById('nama').value;

        if (harga <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Harga Tidak Valid',
                text: 'Harga sewa per jam harus lebih besar dari 0!',
                background: 'transparent',
                customClass: { popup: 'swal-glass', title: 'swal-title-glass', htmlContainer: 'swal-html-glass', confirmButton: 'swal-confirm-orange' }
            });
            return;
        }

        if (kapasitas <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Kapasitas Tidak Valid',
                text: 'Kapasitas ruangan minimal 1 orang!',
                background: 'transparent',
                customClass: { popup: 'swal-glass', title: 'swal-title-glass', htmlContainer: 'swal-html-glass', confirmButton: 'swal-confirm-orange' }
            });
            return;
        }

        Swal.fire({
            title: 'Update Data Ruangan?',
            html: `Anda akan menyimpan perubahan untuk ruangan <b style="color:#f97316;">${nama}</b>.`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Update!',
            cancelButtonText: 'Batal',
            background: 'transparent',
            customClass: {
                popup: 'swal-glass',
                title: 'swal-title-glass',
                htmlContainer: 'swal-html-glass',
                confirmButton: 'swal-confirm-orange',
                cancelButton: 'swal-cancel-gray'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menyimpan Perubahan...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    background: 'transparent',
                    customClass: { popup: 'swal-glass', title: 'swal-title-glass', htmlContainer: 'swal-html-glass' },
                    didOpen: () => { Swal.showLoading(); }
                });
                this.submit();
            }
        });
    });
</script>
@endsection
