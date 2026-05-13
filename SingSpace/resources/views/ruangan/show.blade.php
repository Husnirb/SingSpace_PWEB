@extends('layouts.app')

@section('content')
<div class="sp-container sp-container-sm">
    <div class="sp-header">
        <h3 class="sp-title">Detail <span>Ruangan</span></h3>
        <a href="{{ route('ruangan.index') }}" class="sp-btn sp-btn-secondary">Kembali</a>
    </div>

    <div class="sp-card">
        <div class="sp-row">
            <div class="sp-row-label">Kode Ruangan</div>
            <div class="sp-row-value" style="font-family: monospace; font-size: 18px; font-weight: bold; color: #fff;">{{ $ruangan->kode_ruangan }}</div>
        </div>

        <div class="sp-row">
            <div class="sp-row-label">Nama Ruangan</div>
            <div class="sp-row-value" style="font-size: 18px;">{{ $ruangan->nama }}</div>
        </div>

        <div class="sp-row">
            <div class="sp-row-label">Deskripsi</div>
            <div class="sp-row-value" style="line-height: 1.6;">{{ $ruangan->deskripsi }}</div>
        </div>

        <div class="sp-row">
            <div class="sp-row-label">Tipe & Kapasitas</div>
            <div class="sp-row-value">
                <span class="sp-badge sp-badge-neutral" style="margin-right: 10px;">{{ $ruangan->tipe }}</span>
                <span style="color: #cbd5e1;">Maks {{ $ruangan->kapasitas }} Orang</span>
            </div>
        </div>

        <div class="sp-row">
            <div class="sp-row-label">Harga / Jam</div>
            <div class="sp-row-value" style="font-size: 20px; font-weight: bold; color: #f97316;">Rp {{ number_format($ruangan->harga, 0, ',', '.') }}</div>
        </div>

        <div class="sp-row" style="border-bottom: none; padding-bottom: 0;">
            <div class="sp-row-label">Status</div>
            <div class="sp-row-value">
                @if($ruangan->is_aktif)
                    <span class="sp-badge sp-badge-success">Tersedia</span>
                @else
                    <span class="sp-badge sp-badge-danger">Maintenance</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
