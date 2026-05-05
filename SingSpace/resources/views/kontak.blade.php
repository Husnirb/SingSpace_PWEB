@extends('layouts.app')

@section('title', 'Kontak - SingSpace Karaoke')

@section('content')
<div style="padding: 80px 20px; text-align: center; min-height: 60vh;">

    <h1 style="color: var(--primary-orange); margin-bottom: 15px;">Hubungi Kami</h1>
    <p style="color: var(--text-muted); margin-bottom: 40px; font-size: 1.1rem;">Punya pertanyaan atau butuh bantuan reservasi? Tim SingSpace siap membantu Anda.</p>

    <div style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;">

        <div style="background: var(--bg-deep-navy); padding: 30px; border-radius: 12px; border: 1px solid var(--border-color); width: 280px;">
            <i class="fa-solid fa-location-dot" style="font-size: 2.5rem; color: var(--primary-orange); margin-bottom: 15px;"></i>
            <h3 style="color: white; margin-bottom: 10px;">Lokasi</h3>
            <p style="color: var(--text-muted); line-height: 1.5;">Jl. Moh. Yamin No. 5,<br>Jember, Jawa Timur</p>
        </div>

        <div style="background: var(--bg-deep-navy); padding: 30px; border-radius: 12px; border: 1px solid var(--border-color); width: 280px;">
            <i class="fa-solid fa-phone" style="font-size: 2.5rem; color: var(--primary-orange); margin-bottom: 15px;"></i>
            <h3 style="color: white; margin-bottom: 10px;">Telepon</h3>
            <p style="color: var(--text-muted); line-height: 1.5;">+62 812 4684 1249<br>Buka: 10.00 - 24.00 WIB</p>
        </div>

        <div style="background: var(--bg-deep-navy); padding: 30px; border-radius: 12px; border: 1px solid var(--border-color); width: 280px;">
            <i class="fa-solid fa-envelope" style="font-size: 2.5rem; color: var(--primary-orange); margin-bottom: 15px;"></i>
            <h3 style="color: white; margin-bottom: 10px;">Email</h3>
            <p style="color: var(--text-muted); line-height: 1.5;">singspace@gmail.com<br>Balasan maks 1x24 Jam</p>
        </div>

    </div>
</div>
@endsection
