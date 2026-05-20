@extends('layouts.app')

@section('content')
<style>
    /* =======================================
       SINGSPACE ULTIMATE HYBRID STYLES
       ======================================= */
    .landing-wrapper { overflow-x: hidden; background-color: #0f172a; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

    /* 1. HERO SECTION (Dengan Overlay Transparan) */
    .hero-section {
        background-image: linear-gradient(rgba(10, 25, 50, 0.8), rgba(10, 25, 50, 0.9)), url("{{ asset('img/landing-page.jpg') }}");
        background-size: cover;
        background-position: center;
        text-align: center;
        padding: 150px 20px;
        border-bottom: 1px solid #1e293b;
        position: relative;
    }
    .hero-title { font-size: 3.5rem; font-weight: 800; color: #fff; margin-bottom: 20px; }
    .hero-title span { color: #f97316; }
    .hero-desc { font-size: 1.1rem; color: #cbd5e1; margin: 0 auto 40px auto; line-height: 1.8; max-width: 850px; }

    .btn-hero { background-color: #f97316; color: #fff; padding: 14px 40px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 1.1rem; border: 2px solid #fff; transition: 0.3s; display: inline-block; }
    .btn-hero:hover { background-color: #ea580c; border-color: #f97316; box-shadow: 0 0 20px rgba(249, 115, 22, 0.4); }

    /* 2. FEATURES SECTION (Acoustic Perfection, etc.) */
    .features-section { padding: 100px 5%; background-color: #0f172a; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; }
    .feature-box { background: rgba(30, 41, 59, 0.5); padding: 40px 30px; border-radius: 20px; border: 1px solid #1e293b; transition: 0.4s; backdrop-filter: blur(10px); }
    .feature-box:hover { border-color: #f97316; transform: translateY(-10px); background: #1e293b; }
    .feature-icon-wrap { width: 70px; height: 70px; background: rgba(249, 115, 22, 0.1); border-radius: 16px; display: flex; justify-content: center; align-items: center; margin-bottom: 25px; }
    .feature-icon-wrap i { font-size: 2rem; color: #f97316; }
    .feature-box h3 { color: #fff; font-size: 1.4rem; margin-bottom: 15px; font-weight: 700; }
    .feature-box p { color: #94a3b8; line-height: 1.6; font-size: 0.95rem; }

    /* 3. DUAL SECTION: ABOUT (Kiri) & LOCATIONS (Kanan) */
    .dual-section { display: flex; flex-wrap: wrap; background-color: #1e293b; border-top: 1px solid #1e293b; }
    .half-pane { flex: 1; min-width: 320px; padding: 100px 5%; }

    /* Tentang Kami */
    .about-pane { background: #1e293b; }
    .about-title { color: #fff; font-size: 2.5rem; font-weight: 600; margin-bottom: 25px; line-height: 1.3; }
    .about-title span { color: #f97316; }
    .about-text { color: #94a3b8; font-size: 1rem; line-height: 1.8; margin-bottom: 40px; }

    /* Statistik Garis Oren */
    .stats-container { display: flex; gap: 50px; }
    .stat-item { border-left: 3px solid #f97316; padding-left: 20px; }
    .stat-number { color: #fff; font-size: 2rem; font-weight: bold; display: block; margin-bottom: 5px; }
    .stat-label { color: #94a3b8; font-size: 0.9rem; }

    /* Cabang / Temukan Kami */
    .location-pane { background: #0f172a; border-left: 1px solid #1e293b; }
    .loc-card { background: linear-gradient(145deg, #1e293b, #0f172a); border: 1px solid #334155; border-radius: 16px; padding: 30px; margin-bottom: 20px; position: relative; overflow: hidden; transition: 0.3s;}
    .loc-card:hover { border-color: #f97316; }
    .loc-card::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: #f97316; }
    .loc-title { color: #fff; font-size: 1.2rem; font-weight: 700; margin-bottom: 10px; }
    .loc-detail { color: #94a3b8; font-size: 0.9rem; line-height: 1.5; margin-bottom: 15px; display: flex; gap: 10px; }
    .loc-detail i { color: #f97316; margin-top: 3px; }

    /* Card Cabang 2 Coming Soon */
    .loc-card.coming-soon { background: transparent; border: 2px dashed #334155; opacity: 0.6; }
    .loc-card.coming-soon::before { display: none; }
    .loc-card.coming-soon:hover { border-color: #475569; }
    .loc-card.coming-soon .loc-title { color: #64748b; }

    /* 4. CONTACT SECTION (Hubungi Kami 3 Kartu) */
    .contact-section { padding: 100px 5%; background-color: #0f172a; text-align: center; border-top: 1px solid #1e293b; }
    .contact-header { color: #f97316; font-size: 1.2rem; margin-bottom: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
    .contact-subtitle { color: #94a3b8; font-size: 1.1rem; margin-bottom: 60px; }

    .contact-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; max-width: 1000px; margin: 0 auto; }
    .contact-card { border: 1px solid #1e293b; border-radius: 16px; padding: 40px 20px; transition: 0.3s; background: rgba(30, 41, 59, 0.2); }
    .contact-card:hover { border-color: #f97316; background: rgba(30, 41, 59, 0.4); }
    .contact-icon { color: #f97316; font-size: 2.5rem; margin-bottom: 25px; }
    .contact-title { color: #fff; font-size: 1.2rem; font-weight: 600; margin-bottom: 15px; }
    .contact-text { color: #94a3b8; font-size: 0.95rem; line-height: 1.6; }

    /* 5. FOOTER CALL TO ACTION (Dengan Motif Bintang) */
    .cta-footer { text-align: center; padding: 120px 20px; background: url('https://www.transparenttextures.com/patterns/stardust.png') #1e293b; position: relative; border-top: 1px solid #334155; }
    .cta-footer::after { content: ''; position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: 200px; height: 2px; background: linear-gradient(90deg, transparent, #f97316, transparent); }
    .btn-glow { background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; padding: 18px 50px; border-radius: 12px; text-decoration: none; font-weight: 800; font-size: 1.2rem; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 12px; border: none; box-shadow: 0 10px 30px rgba(249, 115, 22, 0.4); text-transform: uppercase; letter-spacing: 1px; cursor: pointer; }
    .btn-glow:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(249, 115, 22, 0.6); color: #fff; }
</style>

<div class="landing-wrapper">

    <section class="hero-section">

        <div style="display: flex; justify-content: center; margin-bottom: 35px;">
            <div style="background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 50px; padding: 10px 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); display: inline-flex; align-items: center; justify-content: center; min-width: 300px; min-height: 50px;">

                <div id="trending-loading" style="color: #cbd5e1; font-size: 0.95rem; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-notch fa-spin" style="color: #f97316; font-size: 1.1rem;"></i>
                    Menyinkronkan tangga lagu iTunes...
                </div>

                <div id="trending-result" style="display: none; align-items: center; gap: 12px; color: #cbd5e1; font-size: 0.95rem;">
                    <div style="background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; width: 30px; height: 30px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 0.8rem; box-shadow: 0 0 10px rgba(249, 115, 22, 0.5);">
                        <i class="fa-solid fa-music"></i>
                    </div>
                    <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; font-weight: bold;">#1 Hits:</span>
                    <strong id="t-title" style="color: #fff; font-size: 1.1rem; letter-spacing: 0.5px;"></strong>
                    <span style="color: #64748b; font-style: italic;">oleh</span>
                    <span id="t-artist" style="color: #38bdf8; font-weight: bold;"></span>
                </div>
            </div>
        </div>

        <script>
            async function fetchTrendingSong() {
                const loading = document.getElementById('trending-loading');
                const result = document.getElementById('trending-result');

                try {
                    await new Promise(resolve => setTimeout(resolve, 1200));

                    // Fetch API iTunes RSS Top Songs Indonesia (Real-time Chart Asli)
                    const response = await fetch('https://itunes.apple.com/id/rss/topsongs/limit=5/json');
                    const data = await response.json();

                    // Ambil lagu urutan pertama (Peringkat 1)
                    const track = data.feed.entry[0];

                    document.getElementById('t-title').innerText = track['im:name'].label;
                    document.getElementById('t-artist').innerText = track['im:artist'].label;

                    // Tampilkan hasil
                    loading.style.display = 'none';
                    result.style.display = 'flex';
                } catch (error) {
                    loading.innerHTML = '<i class="fa-solid fa-triangle-exclamation" style="color: #ef4444;"></i> Gagal memuat tangga lagu.';
                }
            }

            document.addEventListener('DOMContentLoaded', fetchTrendingSong);
        </script>
        <h1 class="hero-title">SingSpace <span>Karaoke</span></h1>
        <p class="hero-desc">
            Jadikan setiap momen bernyanyimu lebih spektakuler di SingSpace! Nikmati atmosfer hiburan kelas atas dengan privasi maksimal di ruang VIP dan VVIP eksklusif kami. Amankan tempatmu hanya dalam hitungan detik. Pesan sekarang dan mulai bernyanyi!
        </p>
        <a href="{{ route('ruangan.catalog') }}" class="btn-hero">Booking Sekarang</a>
    </section>

    <section class="features-section">
        <div class="feature-box">
            <div class="feature-icon-wrap"><i class="fa-solid fa-sliders"></i></div>
            <h3>Acoustic Perfection</h3>
            <p>Dilengkapi dengan *sound system* kelas studio dan peredam suara premium. Setiap nada yang Anda nyanyikan terdengar sempurna tanpa distorsi.</p>
        </div>
        <div class="feature-box">
            <div class="feature-icon-wrap"><i class="fa-solid fa-user-lock"></i></div>
            <h3>Ultimate Privacy</h3>
            <p>Akses eksklusif untuk setiap ruangan. Nikmati waktu berkualitas bersama teman dan keluarga tanpa gangguan dari dunia luar.</p>
        </div>
        <div class="feature-box">
            <div class="feature-icon-wrap"><i class="fa-solid fa-martini-glass-citrus"></i></div>
            <h3>F&B Concierge</h3>
            <p>Layanan hidangan dan minuman premium yang langsung diantar ke ruangan Anda. Pesan langsung melalui panel interaktif di dalam *room*.</p>
        </div>
    </section>

    <section class="dual-section" id="tentang">
        <div class="half-pane about-pane">
            <h2 class="about-title">Momen Spektakuler<br><span>Dimulai dari Sini</span></h2>
            <p class="about-text">
                Berdiri di hati kota Jember, SingSpace lahir dari visi untuk mendefinisikan ulang pengalaman karaoke. Kami percaya bahwa setiap perayaan, pertemuan keluarga, atau sekadar waktu melepas penat berhak mendapatkan suasana yang premium dan pelayanan bintang lima.
            </p>
            <div class="stats-container">
                <div class="stat-item">
                    <span class="stat-number">50+</span>
                    <span class="stat-label">Ruang Eksklusif</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">10K+</span>
                    <span class="stat-label">Lagu Tersedia</span>
                </div>
            </div>
        </div>

        <div class="half-pane location-pane">
            <h2 class="about-title" style="font-size: 1.8rem; margin-bottom: 30px;">Cabang <span>Eksklusif</span></h2>

            <div class="loc-card">
                <h3 class="loc-title">SingSpace - Pusat Jember</h3>
                <div class="loc-detail">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>Jl. Moh. Yamin No. 5, Jember, Jawa Timur</span>
                </div>
                <div class="loc-detail" style="margin-bottom: 0;">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span style="color: #fff; font-weight: bold;">+62 812 4684 1249</span>
                </div>
            </div>

            <div class="loc-card coming-soon">
                <h3 class="loc-title">SingSpace - Cabang Ke-2</h3>
                <div class="loc-detail">
                    <i class="fa-solid fa-clock"></i>
                    <span>Segera Hadir (Coming Soon). Kami sedang menyiapkan ruang baru khusus untuk Anda!</span>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section" id="lokasi">
        <h3 class="contact-header">Hubungi Kami</h3>
        <p class="contact-subtitle">Punya pertanyaan atau butuh bantuan reservasi? Tim SingSpace siap membantu Anda.</p>

        <div class="contact-grid">
            <div class="contact-card">
                <i class="fa-solid fa-location-dot contact-icon"></i>
                <h4 class="contact-title">Lokasi</h4>
                <p class="contact-text">
                    Jl. Moh. Yamin No. 5,<br>
                    Jember, Jawa Timur
                </p>
            </div>

            <div class="contact-card">
                <i class="fa-solid fa-phone contact-icon" style="transform: rotate(90deg);"></i>
                <h4 class="contact-title">Telepon</h4>
                <p class="contact-text">
                    +62 812 4684 1249<br>
                    Buka: 10.00 - 24.00 WIB
                </p>
            </div>

            <div class="contact-card">
                <i class="fa-solid fa-envelope contact-icon"></i>
                <h4 class="contact-title">Email</h4>
                <p class="contact-text">
                    singspace@gmail.com<br>
                    Balasan maks 1x24 Jam
                </p>
            </div>
        </div>
    </section>

    <section class="cta-footer">
        <h2 style="color: #fff; font-size: 2.8rem; font-weight: 900; margin-bottom: 20px;">Ready to drop the mic?</h2>
        <p style="color: #94a3b8; margin-bottom: 40px; font-size: 1.1rem; max-width: 600px; margin-left: auto; margin-right: auto;">Jadwalkan sesi Anda sekarang dan rasakan perbedaan akustiknya bersama SingSpace.</p>
        <a href="{{ route('ruangan.catalog') }}" class="btn-glow">
            RESERVASI SEKARANG <i class="fa-solid fa-arrow-right"></i>
        </a>
    </section>

</div>
@endsection
