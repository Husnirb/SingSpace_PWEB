@extends('layouts.app')

@section('content')
<div class="sp-container" style="max-width: 1200px;">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 style="color: #fff; font-size: 36px; font-weight: 800; margin-bottom: 10px;">Pilih <span style="color: #f97316;">Ruang Karaoke</span> Anda</h1>
        <p style="color: #94a3b8; font-size: 16px;">Temukan kenyamanan bernyanyi dengan fasilitas audio terbaik di SingSpace.</p>
    </div>

    <div class="sp-room-grid">
        @forelse($ruangans as $ruangan)
            <div class="sp-room-card">
                <div class="sp-card-img-wrapper">
                    @if($ruangan->foto)
                        <img src="{{ asset('storage/' . $ruangan->foto) }}" alt="{{ $ruangan->nama }}" class="sp-card-img">
                    @else
                        <div class="sp-no-img">
                            <i class="fa-solid fa-image" style="font-size: 3rem; color: #334155;"></i>
                        </div>
                    @endif
                    <div class="sp-type-badge">{{ $ruangan->tipe }}</div>
                </div>

                <div style="padding: 25px;">
                    <h3 style="color: #fff; font-size: 20px; margin-bottom: 10px; font-weight: 700;">{{ $ruangan->nama }}</h3>
                    <p style="color: #94a3b8; font-size: 14px; line-height: 1.6; height: 45px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        {{ $ruangan->deskripsi }}
                    </p>

                    <div style="display: flex; align-items: center; gap: 15px; margin-top: 20px; padding-top: 20px; border-top: 1px solid #334155;">
                        <div style="flex-grow: 1;">
                            <span style="display: block; color: #64748b; font-size: 12px; font-weight: 600; text-transform: uppercase;">Harga Mulai</span>
                            <span style="color: #f97316; font-size: 18px; font-weight: 800;">Rp {{ number_format($ruangan->harga, 0, ',', '.') }}<small style="font-size: 12px; color: #64748b; font-weight: normal;"> / Jam</small></span>
                        </div>
                        <div style="text-align: right;">
                            <span style="display: block; color: #64748b; font-size: 12px; font-weight: 600; text-transform: uppercase;">Kapasitas</span>
                            <span style="color: #fff; font-size: 14px; font-weight: bold;"><i class="fa-solid fa-users" style="margin-right: 5px;"></i> {{ $ruangan->kapasitas }} Orang</span>
                        </div>
                    </div>

                    <a href="#" class="sp-btn-book">Booking Sekarang</a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 100px; color: #64748b;">
                <i class="fa-solid fa-face-frown" style="font-size: 4rem; margin-bottom: 20px;"></i>
                <p>Maaf, saat ini belum ada ruangan yang tersedia untuk dipesan.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
