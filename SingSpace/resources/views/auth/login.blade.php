@extends('layouts.app')

@section('content')
<div style="min-height: 90vh; display: flex; justify-content: center; align-items: center; padding: 40px 20px; position: relative; z-index: 1;">

    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; max-width: 600px; height: 500px; background: radial-gradient(circle, rgba(249, 115, 22, 0.15) 0%, rgba(0,0,0,0) 60%); z-index: -1;"></div>

    <div style="background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 24px; padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 25px 50px rgba(0,0,0,0.5), inset 0 0 0 1px rgba(249, 115, 22, 0.1);">

        <div style="text-align: center; margin-bottom: 30px;">
            <div style="display: inline-flex; justify-content: center; align-items: center; width: 65px; height: 65px; background: rgba(249, 115, 22, 0.1); border-radius: 20px; margin-bottom: 15px; border: 1px solid rgba(249, 115, 22, 0.2); box-shadow: 0 10px 20px rgba(249, 115, 22, 0.15);">
                <i class="fa-solid fa-microphone-lines" style="color: #f97316; font-size: 1.8rem;"></i>
            </div>
            <h2 style="color: #fff; margin: 0; font-size: 1.6rem; font-weight: 800; letter-spacing: 0.5px;">Selamat Datang</h2>
            <p style="color: #94a3b8; font-size: 0.9rem; margin-top: 5px;">Masuk ke akun SingSpace Anda</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 8px; color: #cbd5e1; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Email Address</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-envelope" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email..." style="width: 100%; padding: 14px 14px 14px 45px; border-radius: 12px; background-color: rgba(15, 23, 42, 0.6); border: 1px solid #334155; color: #fff; box-sizing: border-box; font-size: 0.95rem; transition: all 0.3s; outline: none;" onfocus="this.style.borderColor='#f97316'; this.style.boxShadow='0 0 0 3px rgba(249, 115, 22, 0.2)';" onblur="this.style.borderColor='#334155'; this.style.boxShadow='none';">
                </div>
                @error('email') <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password" style="display: block; margin-bottom: 8px; color: #cbd5e1; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Password</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-lock" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password..." style="width: 100%; padding: 14px 14px 14px 45px; border-radius: 12px; background-color: rgba(15, 23, 42, 0.6); border: 1px solid #334155; color: #fff; box-sizing: border-box; font-size: 0.95rem; transition: all 0.3s; outline: none;" onfocus="this.style.borderColor='#f97316'; this.style.boxShadow='0 0 0 3px rgba(249, 115, 22, 0.2)';" onblur="this.style.borderColor='#334155'; this.style.boxShadow='none';">
                </div>
                @error('password') <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <label for="remember_me" style="display: flex; align-items: center; cursor: pointer;">
                    <input id="remember_me" type="checkbox" name="remember" style="margin-right: 8px; width: 16px; height: 16px; accent-color: #f97316; cursor: pointer;">
                    <span style="color: #94a3b8; font-size: 0.9rem;">Ingat Saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: #f97316; font-size: 0.9rem; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#fb923c'" onmouseout="this.style.color='#f97316'">Lupa password?</a>
                @endif
            </div>

            <button type="submit" style="width: 100%; padding: 15px; border-radius: 12px; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; border: none; font-weight: bold; font-size: 1rem; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 25px rgba(249, 115, 22, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px rgba(249, 115, 22, 0.3)';">
                <i class="fa-solid fa-right-to-bracket" style="margin-right: 8px;"></i> Masuk Sekarang
            </button>
        </form>

        <div style="text-align: center; margin-top: 25px; font-size: 0.9rem; color: #94a3b8; border-top: 1px dashed #334155; padding-top: 20px;">
            Belum punya akun? <a href="{{ route('register') }}" style="color: #38bdf8; text-decoration: none; font-weight: 700; transition: 0.3s;" onmouseover="this.style.color='#7dd3fc'" onmouseout="this.style.color='#38bdf8'">Daftar di sini</a>
        </div>

    </div>
</div>
@endsection
