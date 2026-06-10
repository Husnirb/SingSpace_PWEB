@extends('layouts.app')

@section('content')
<div class="landing-wrapper" style="min-height: 100vh; padding: 120px 5% 50px 5%; background-color: #0f172a;">
    <div style="max-width: 550px; margin: 0 auto; display: flex; flex-direction: column; gap: 30px;">

        <div style="background: #1e293b; border: 1px solid #334155; border-radius: 24px; padding: 40px; box-shadow: 0 25px 50px rgba(0,0,0,0.5);">
            <div style="text-align: center; margin-bottom: 35px;">
                <div style="width: 70px; height: 70px; background: rgba(249, 115, 22, 0.1); border-radius: 20px; display: flex; justify-content: center; align-items: center; margin: 0 auto 20px auto;">
                    <i class="fa-solid fa-wand-magic-sparkles" style="font-size: 2rem; color: #f97316;"></i>
                </div>
                <h2 class="hero-title" style="font-size: 1.8rem; margin: 0;">Atur <span>Tampilan</span></h2>
                <p style="color: #94a3b8; margin-top: 10px;">Pilih tema dan ukuran font yang paling nyaman untuk Anda.</p>
            </div>

            <form id="formPreferensi">
                @csrf
                <div style="margin-bottom: 25px;">
                    <label style="color: #cbd5e1; font-weight: bold; display: block; margin-bottom: 10px;">Tema Aplikasi</label>
                    <select id="tema" class="form-select" style="width: 100%; padding: 12px; border-radius: 12px; background: #0f172a; border: 1px solid #334155; color: #fff; cursor: pointer;">
                        <option value="light" {{ $currentTheme == 'light' ? 'selected' : '' }}>Light Mode (Terang)</option>
                        <option value="dark" {{ $currentTheme == 'dark' ? 'selected' : '' }}>Dark Mode (Gelap)</option>
                    </select>
                </div>

                <div style="margin-bottom: 35px;">
                    <label style="color: #cbd5e1; font-weight: bold; display: block; margin-bottom: 10px;">Ukuran Font</label>
                    <select id="ukuran_font" class="form-select" style="width: 100%; padding: 12px; border-radius: 12px; background: #0f172a; border: 1px solid #334155; color: #fff; cursor: pointer;">
                        <option value="small" {{ $currentFontSize == 'small' ? 'selected' : '' }}>Kecil</option>
                        <option value="medium" {{ $currentFontSize == 'medium' ? 'selected' : '' }}>Sedang (Normal)</option>
                        <option value="large" {{ $currentFontSize == 'large' ? 'selected' : '' }}>Besar</option>
                    </select>
                </div>

                <button type="submit" id="btnSimpan" style="width: 100%; padding: 15px; border-radius: 12px; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; font-weight: bold; border: none; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);">
                    Simpan Perubahan
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    // 1. Atur nilai dropdown sesuai cookie saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('tema').value = getCookie('theme') || 'dark';
        document.getElementById('ukuran_font').value = getCookie('font_size') || 'medium';
    });

    // 2. Proses saat tombol simpan diklik
    document.getElementById('formPreferensi').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSimpan');
        const tema = document.getElementById('tema').value;
        const font = document.getElementById('ukuran_font').value;

        btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Memproses...';

        try {
            const response = await fetch("{{ route('preferensi.save') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({ tema: tema, ukuran_font: font })
            });

            const data = await response.json();

            if(data.status === 'success') {
                // Tulis cookie secara manual via JS agar tidak dienkripsi oleh backend Laravel
                setCookie('theme', tema, 30);
                setCookie('font_size', font, 30);

                // Titip pesan Toast untuk dimunculkan setelah reload
                sessionStorage.setItem('flash_message', data.message);

                // RELOAD HALAMAN INI SAJA biar perubahannya langsung terlihat instan
                window.location.reload();
            }
        } catch (error) {
            alert('Gagal menyimpan preferensi');
            btn.innerHTML = 'Simpan Perubahan';
        }
    });
</script>
@endsection
