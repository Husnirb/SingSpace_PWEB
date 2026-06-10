@extends('layouts.app')

@section('content')
<div style="min-height: 90vh; display: flex; justify-content: center; align-items: center; padding: 60px 20px; position: relative; z-index: 1;">

    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; max-width: 600px; height: 600px; background: radial-gradient(circle, rgba(249, 115, 22, 0.15) 0%, rgba(0,0,0,0) 60%); z-index: -1;"></div>

    <div style="background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 24px; padding: 40px; width: 100%; max-width: 450px; box-shadow: 0 25px 50px rgba(0,0,0,0.5), inset 0 0 0 1px rgba(249, 115, 22, 0.1);">

        <div style="text-align: center; margin-bottom: 30px;">
            <div style="display: inline-flex; justify-content: center; align-items: center; width: 65px; height: 65px; background: rgba(249, 115, 22, 0.1); border-radius: 20px; margin-bottom: 15px; border: 1px solid rgba(249, 115, 22, 0.2); box-shadow: 0 10px 20px rgba(249, 115, 22, 0.15);">
                <i class="fa-solid fa-user-plus" style="color: #f97316; font-size: 1.6rem;"></i>
            </div>
            <h2 style="color: #fff; margin: 0; font-size: 1.6rem; font-weight: 800; letter-spacing: 0.5px;">Daftar Akun</h2>
            <p style="color: #94a3b8; font-size: 0.9rem; margin-top: 5px;">Bergabung dengan SingSpace hari ini.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="name" style="display: block; margin-bottom: 8px; color: #cbd5e1; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Nama Lengkap</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-user" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Contoh: Husni Rasyid" style="width: 100%; padding: 14px 14px 14px 45px; border-radius: 12px; background-color: rgba(15, 23, 42, 0.6); border: 1px solid #334155; color: #fff; box-sizing: border-box; font-size: 0.95rem; transition: all 0.3s; outline: none;" onfocus="this.style.borderColor='#f97316'; this.style.boxShadow='0 0 0 3px rgba(249, 115, 22, 0.2)';" onblur="this.style.borderColor='#334155'; this.style.boxShadow='none';">
                </div>
                @error('name') <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 8px; color: #cbd5e1; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Email Address</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-envelope" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="email@contoh.com" style="width: 100%; padding: 14px 14px 14px 45px; border-radius: 12px; background-color: rgba(15, 23, 42, 0.6); border: 1px solid #334155; color: #fff; box-sizing: border-box; font-size: 0.95rem; transition: all 0.3s; outline: none;" onfocus="this.style.borderColor='#f97316'; this.style.boxShadow='0 0 0 3px rgba(249, 115, 22, 0.2)';" onblur="this.style.borderColor='#334155'; this.style.boxShadow='none';">
                </div>
                @error('email') <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password" style="display: block; margin-bottom: 8px; color: #cbd5e1; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Password</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-lock" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" style="width: 100%; padding: 14px 14px 14px 45px; border-radius: 12px; background-color: rgba(15, 23, 42, 0.6); border: 1px solid #334155; color: #fff; box-sizing: border-box; font-size: 0.95rem; transition: all 0.3s; outline: none;" onfocus="this.style.borderColor='#f97316'; this.style.boxShadow='0 0 0 3px rgba(249, 115, 22, 0.2)';" onblur="this.style.borderColor='#334155'; this.style.boxShadow='none';">
                </div>
                @error('password') <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 30px;">
                <label for="password_confirmation" style="display: block; margin-bottom: 8px; color: #cbd5e1; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Konfirmasi Password</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-shield-check" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang password" style="width: 100%; padding: 14px 14px 14px 45px; border-radius: 12px; background-color: rgba(15, 23, 42, 0.6); border: 1px solid #334155; color: #fff; box-sizing: border-box; font-size: 0.95rem; transition: all 0.3s; outline: none;" onfocus="this.style.borderColor='#f97316'; this.style.boxShadow='0 0 0 3px rgba(249, 115, 22, 0.2)';" onblur="this.style.borderColor='#334155'; this.style.boxShadow='none';">
                </div>
                @error('password_confirmation') <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </div>

            <button type="submit" style="width: 100%; padding: 15px; border-radius: 12px; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; border: none; font-weight: bold; font-size: 1rem; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 25px rgba(249, 115, 22, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px rgba(249, 115, 22, 0.3)';">
                Buat Akun Sekarang
            </button>
        </form>

        <div style="text-align: center; margin-top: 25px; font-size: 0.9rem; color: #94a3b8; border-top: 1px dashed #334155; padding-top: 20px;">
            Sudah punya akun? <a href="{{ route('login') }}" style="color: #38bdf8; text-decoration: none; font-weight: 700; transition: 0.3s;" onmouseover="this.style.color='#7dd3fc'" onmouseout="this.style.color='#38bdf8'">Masuk di sini</a>
        </div>

    </div>
</div>
@endsection
