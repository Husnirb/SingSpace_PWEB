@extends('layouts.app')

@section('content')
<style>
    /* ==========================================
       STYLING PREFERENSI (ADAPTIVE LIGHT/DARK)
       ========================================== */
    .pref-wrapper {
        min-height: 100vh;
        padding: 120px 5% 50px 5%;
        background-color: #f8fafc; /* Warna dasar Light Mode */
        transition: background-color 0.3s;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .pref-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.3s;
    }

    .pref-title {
        font-size: 1.8rem;
        margin: 0;
        color: #0f172a; /* Teks gelap untuk Light Mode */
        font-weight: 800;
        transition: color 0.3s;
    }

    .pref-title span { color: #f97316; }

    .pref-desc {
        color: #64748b;
        margin-top: 10px;
        transition: color 0.3s;
    }

    .pref-label {
        color: #475569;
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
        transition: color 0.3s;
    }

    .pref-select {
        width: 100%;
        padding: 12px;
        border-radius: 12px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: #0f172a;
        cursor: pointer;
        outline: none;
        transition: all 0.3s;
    }

    .pref-select:focus { border-color: #f97316; box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2); }

    /* ==========================================
       LOGIKA DARK MODE (Otomatis Aktif)
       ========================================== */
    .dark .pref-wrapper, body.dark .pref-wrapper { background-color: #0f172a; }
    .dark .pref-card, body.dark .pref-card { background: #1e293b; border-color: #334155; box-shadow: 0 25px 50px rgba(0,0,0,0.5); }
    .dark .pref-title, body.dark .pref-title { color: #ffffff; }
    .dark .pref-desc, body.dark .pref-desc { color: #94a3b8; }
    .dark .pref-label, body.dark .pref-label { color: #cbd5e1; }
    .dark .pref-select, body.dark .pref-select { background: #0f172a; border-color: #334155; color: #ffffff; }
</style>

<main class="pref-wrapper">
    <section style="max-width: 550px; margin: 0 auto; display: flex; flex-direction: column; gap: 30px;">

        <article class="pref-card">
            <header style="text-align: center; margin-bottom: 35px;">
                <figure style="width: 70px; height: 70px; background: rgba(249, 115, 22, 0.1); border-radius: 20px; display: flex; justify-content: center; align-items: center; margin: 0 auto 20px auto;">
                    <i class="fa-solid fa-wand-magic-sparkles" style="font-size: 2rem; color: #f97316;" aria-hidden="true"></i>
                </figure>
                <h2 class="pref-title">Atur <span>Tampilan</span></h2>
                <p class="pref-desc">Pilih tema dan ukuran font yang paling nyaman untuk Anda.</p>
            </header>

            <form id="formPreferensi" aria-label="Formulir Preferensi Tampilan">
                @csrf
                <div style="margin-bottom: 25px;">
                    <label for="tema" class="pref-label">Tema Aplikasi</label>
                    <select id="tema" name="tema" class="pref-select">
                        <option value="light" {{ $currentTheme == 'light' ? 'selected' : '' }}>Light Mode (Terang)</option>
                        <option value="dark" {{ $currentTheme == 'dark' ? 'selected' : '' }}>Dark Mode (Gelap)</option>
                    </select>
                </div>

                <div style="margin-bottom: 35px;">
                    <label for="ukuran_font" class="pref-label">Ukuran Font</label>
                    <select id="ukuran_font" name="ukuran_font" class="pref-select">
                        <option value="small" {{ $currentFontSize == 'small' ? 'selected' : '' }}>Kecil</option>
                        <option value="medium" {{ $currentFontSize == 'medium' ? 'selected' : '' }}>Sedang (Normal)</option>
                        <option value="large" {{ $currentFontSize == 'large' ? 'selected' : '' }}>Besar</option>
                    </select>
                </div>

                <button type="submit" id="btnSimpan" style="width: 100%; padding: 15px; border-radius: 12px; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; font-weight: bold; border: none; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);">
                    Simpan Perubahan
                </button>
            </form>
        </article>

    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('tema').value = getCookie('theme') || 'dark';
        document.getElementById('ukuran_font').value = getCookie('font_size') || 'medium';
    });

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
                setCookie('theme', tema, 30);
                setCookie('font_size', font, 30);
                sessionStorage.setItem('flash_message', data.message);
                window.location.reload();
            }
        } catch (error) {
            alert('Gagal menyimpan preferensi');
            btn.innerHTML = 'Simpan Perubahan';
        }
    });
</script>
@endsection
