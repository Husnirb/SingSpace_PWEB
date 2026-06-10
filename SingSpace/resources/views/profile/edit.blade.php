@extends('layouts.app')

@section('content')
<div class="landing-wrapper" style="min-height: 100vh; padding: 120px 5% 50px 5%; background-color: #0f172a;">
    <div style="max-width: 600px; margin: 0 auto; display: flex; flex-direction: column; gap: 30px;">

        <div style="background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 24px; padding: 40px; box-shadow: 0 25px 50px rgba(0,0,0,0.5);">

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf @method('patch')

                <div style="text-align: center; margin-bottom: 35px;">
                    <div style="position: relative; width: 100px; height: 100px; margin: 0 auto 15px auto;">

                        <div style="width: 100%; height: 100%; border-radius: 50%; overflow: hidden; border: 3px solid #f97316; box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);">
                            @if(auth()->user()->foto_profil)
                                <img id="preview-img" src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                <div id="initials-fallback" style="width: 100%; height: 100%; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; font-weight: 900; font-size: 2.2rem; display: none; justify-content: center; align-items: center;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                            @else
                                <img id="preview-img" src="" alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                                <div id="initials-fallback" style="width: 100%; height: 100%; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; font-weight: 900; font-size: 2.2rem; display: flex; justify-content: center; align-items: center;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>

                        <label for="foto_profil" style="position: absolute; bottom: 0; right: 0; background: #0f172a; border: 2px solid #f97316; color: #f97316; width: 35px; height: 35px; border-radius: 50%; display: flex; justify-content: center; align-items: center; cursor: pointer; transition: 0.3s; z-index: 10;" onmouseover="this.style.background='#f97316'; this.style.color='#fff';" onmouseout="this.style.background='#0f172a'; this.style.color='#f97316';">
                            <i class="fa-solid fa-camera"></i>
                        </label>
                        <input type="file" id="foto_profil" name="foto_profil" accept="image/png, image/jpeg" style="display: none;" onchange="previewImage(event)">
                    </div>

                    <h2 style="color: #fff; margin: 0; font-size: 1.6rem; font-weight: 800;">Profil <span style="color: #f97316;">Akun Saya</span></h2>
                    <p style="color: #94a3b8; margin-top: 5px; font-size: 0.85rem;">Format JPG/PNG maksimal 2MB.</p>
                    @error('foto_profil') <span style="color: #ef4444; font-size: 0.8rem; display: block; margin-top: 5px;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="color: #cbd5e1; font-weight: bold; display: block; margin-bottom: 8px; font-size: 0.85rem; text-transform: uppercase;">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required style="width: 100%; padding: 12px; border-radius: 12px; background: #0f172a; border: 1px solid #334155; color: #fff; outline: none;">
                    @error('name') <span style="color: #ef4444; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span> @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="color: #cbd5e1; font-weight: bold; display: block; margin-bottom: 8px; font-size: 0.85rem; text-transform: uppercase;">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required style="width: 100%; padding: 12px; border-radius: 12px; background: #0f172a; border: 1px solid #334155; color: #fff; outline: none;">
                    @error('email') <span style="color: #ef4444; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span> @enderror
                </div>

                <div style="border-top: 1px dashed #334155; margin: 30px 0; padding-top: 20px;">
                    <h3 style="color: #fff; margin: 0 0 5px 0; font-size: 1.1rem;">Ubah Password <small style="color: #64748b; font-weight: normal;">(Kosongkan jika tidak diubah)</small></h3>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="color: #cbd5e1; font-weight: bold; display: block; margin-bottom: 8px; font-size: 0.85rem; text-transform: uppercase;">Password Baru</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter..." style="width: 100%; padding: 12px; border-radius: 12px; background: #0f172a; border: 1px solid #334155; color: #fff; outline: none;">
                    @error('password') <span style="color: #ef4444; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span> @enderror
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="color: #cbd5e1; font-weight: bold; display: block; margin-bottom: 8px; font-size: 0.85rem; text-transform: uppercase;">Ulangi Password Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ketik ulang password baru..." style="width: 100%; padding: 12px; border-radius: 12px; background: #0f172a; border: 1px solid #334155; color: #fff; outline: none;">
                </div>

                <button type="submit" style="width: 100%; padding: 15px; border-radius: 12px; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; font-weight: bold; border: none; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                    Simpan Perubahan Data Akun
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            // Cek ukuran file manual di frontend (maks 2MB)
            if(input.files[0].size > 2097152) {
                alert("Ukuran foto terlalu besar! Maksimal 2 MB.");
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                // Tampilkan gambar yang dipilih, sembunyikan inisial huruf tanpa merusak input file
                const previewImg = document.getElementById('preview-img');
                const initialsFallback = document.getElementById('initials-fallback');

                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                initialsFallback.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
