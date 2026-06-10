@extends('layouts.app')

@section('content')
<div style="min-height: 90vh; display: flex; justify-content: center; align-items: center; padding: 40px 20px; position: relative; z-index: 1;">

    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; max-width: 600px; height: 500px; background: radial-gradient(circle, rgba(239, 68, 68, 0.15) 0%, rgba(0,0,0,0) 60%); z-index: -1;"></div>

    <div style="background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 24px; padding: 40px; width: 100%; max-width: 450px; box-shadow: 0 25px 50px rgba(0,0,0,0.5), inset 0 0 0 1px rgba(239, 68, 68, 0.1);">

        <div style="text-align: center; margin-bottom: 25px;">
            <div style="display: inline-flex; justify-content: center; align-items: center; width: 65px; height: 65px; background: rgba(239, 68, 68, 0.1); border-radius: 20px; margin-bottom: 15px; border: 1px solid rgba(239, 68, 68, 0.2); box-shadow: 0 10px 20px rgba(239, 68, 68, 0.15);">
                <i class="fa-solid fa-shield-halved" style="color: #ef4444; font-size: 1.6rem;"></i>
            </div>
            <h2 style="color: #fff; margin: 0; font-size: 1.5rem; font-weight: 800; letter-spacing: 0.5px;">Area Keamanan</h2>
            <p style="color: #94a3b8; font-size: 0.9rem; margin-top: 8px; line-height: 1.5;">Ini adalah area aplikasi yang aman. Harap konfirmasi password Anda sebelum melanjutkan.</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div style="margin-bottom: 25px;">
                <label for="password" style="display: block; margin-bottom: 8px; color: #cbd5e1; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Password</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-lock" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda..." style="width: 100%; padding: 14px 14px 14px 45px; border-radius: 12px; background-color: rgba(15, 23, 42, 0.6); border: 1px solid #334155; color: #fff; box-sizing: border-box; font-size: 0.95rem; transition: all 0.3s; outline: none;" onfocus="this.style.borderColor='#ef4444'; this.style.boxShadow='0 0 0 3px rgba(239, 68, 68, 0.2)';" onblur="this.style.borderColor='#334155'; this.style.boxShadow='none';">
                </div>
                @error('password') <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </div>

            <button type="submit" style="width: 100%; padding: 15px; border-radius: 12px; background: linear-gradient(135deg, #ef4444, #dc2626); color: #fff; border: none; font-weight: bold; font-size: 1rem; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 25px rgba(239, 68, 68, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px rgba(239, 68, 68, 0.3)';">
                Konfirmasi Identitas
            </button>
        </form>

    </div>
</div>
@endsection
