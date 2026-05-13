@extends('layouts.app')

@section('content')
<div class="sp-container">
    <div class="sp-header" style="margin-bottom: 30px; border-bottom: 1px solid #334155; padding-bottom: 20px;">
        <div>
            <h2 class="sp-title" style="margin-bottom: 5px;">Dashboard <span>Admin</span></h2>
            <p style="color: #94a3b8; font-size: 16px;">Selamat datang kembali, <strong style="color: #f97316;">{{ auth()->user()->name }}</strong>!</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 40px;">

        <div class="sp-card" style="text-align: center; padding: 40px 20px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fa-solid fa-microphone-lines" style="font-size: 4rem; color: #f97316; margin-bottom: 20px;"></i>
            <h3 style="color: #fff; font-size: 22px; margin: 0 0 10px 0;">Manajemen Ruangan</h3>
            <p style="color: #64748b; font-size: 14px; line-height: 1.5; margin-bottom: 25px;">
                Kelola data ruangan, perbarui harga, atur status ketersediaan, dan unggah foto interior.
            </p>
            <a href="{{ route('ruangan.index') }}" class="sp-btn sp-btn-primary" style="display: block; width: 100%; text-decoration: none;">Kelola Sekarang</a>
        </div>

        <div class="sp-card" style="text-align: center; padding: 40px 20px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fa-solid fa-user-shield" style="font-size: 4rem; color: #10b981; margin-bottom: 20px;"></i>
            <h3 style="color: #fff; font-size: 22px; margin: 0 0 10px 0;">Profil Akun</h3>
            <p style="color: #64748b; font-size: 14px; line-height: 1.5; margin-bottom: 25px;">
                Perbarui informasi akun, email, dan amankan kata sandi administrator Anda.
            </p>
            <a href="{{ route('profile.edit') }}" class="sp-btn" style="background: #334155; color: #fff; display: block; width: 100%; text-decoration: none; border: 1px solid #475569;">Pengaturan Profil</a>
        </div>

    </div>
</div>
@endsection
