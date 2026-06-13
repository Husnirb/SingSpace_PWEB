@extends('layouts.app')

@section('content')
<style>
    /* =======================================
       SINGSPACE ULTIMATE HYBRID STYLES
       ======================================= */
    .landing-wrapper { overflow-x: hidden; background-color: var(--bg-color, #0f172a); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

    /* 1. HERO SECTION */
    .hero-section {
        background-image: linear-gradient(rgba(10, 25, 50, 0.8), rgba(10, 25, 50, 0.9)), url("{{ asset('img/landing-page.jpg') }}");
        background-size: cover; background-position: center; text-align: center;
        padding: 150px 20px; border-bottom: 1px solid #1e293b; position: relative;
    }
    .hero-title { font-size: 3.5rem; font-weight: 800; color: #fff; margin-bottom: 20px; }
    .hero-title span { color: #f97316; }
    .hero-desc { font-size: 1.1rem; color: #cbd5e1; margin: 0 auto 40px auto; line-height: 1.8; max-width: 850px; }
    .btn-hero { background-color: #f97316; color: #fff; padding: 14px 40px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 1.1rem; border: 2px solid #fff; transition: 0.3s; display: inline-block; }
    .btn-hero:hover { background-color: #ea580c; border-color: #f97316; box-shadow: 0 0 20px rgba(249, 115, 22, 0.4); }

    /* 2. FEATURES SECTION */
    .features-section { padding: 100px 5%; background-color: #0f172a; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; }
    .feature-box { background: rgba(30, 41, 59, 0.5); padding: 40px 30px; border-radius: 20px; border: 1px solid #1e293b; transition: 0.4s; backdrop-filter: blur(10px); }
    .feature-box:hover { border-color: #f97316; transform: translateY(-10px); background: #1e293b; }
    .feature-icon-wrap { width: 70px; height: 70px; background: rgba(249, 115, 22, 0.1); border-radius: 16px; display: flex; justify-content: center; align-items: center; margin-bottom: 25px; }
    .feature-icon-wrap i { font-size: 2rem; color: #f97316; }
    .feature-box h3 { color: #fff; font-size: 1.4rem; margin-bottom: 15px; font-weight: 700; }
    .feature-box p { color: #94a3b8; line-height: 1.6; font-size: 0.95rem; }

    /* 3. DUAL SECTION: ABOUT & LOCATIONS */
    .dual-section { display: flex; flex-wrap: wrap; background-color: #1e293b; border-top: 1px solid #1e293b; }
    .half-pane { flex: 1; min-width: 320px; padding: 100px 5%; }
    .about-pane { background: #1e293b; }
    .about-title { color: #fff; font-size: 2.5rem; font-weight: 600; margin-bottom: 25px; line-height: 1.3; }
    .about-title span { color: #f97316; }
    .about-text { color: #94a3b8; font-size: 1rem; line-height: 1.8; margin-bottom: 40px; }
    .stats-container { display: flex; gap: 50px; }
    .stat-item { border-left: 3px solid #f97316; padding-left: 20px; }
    .stat-number { color: #fff; font-size: 2rem; font-weight: bold; display: block; margin-bottom: 5px; }
    .stat-label { color: #94a3b8; font-size: 0.9rem; }
    .location-pane { background: #0f172a; border-left: 1px solid #1e293b; }
    .loc-card { background: linear-gradient(145deg, #1e293b, #0f172a); border: 1px solid #334155; border-radius: 16px; padding: 30px; margin-bottom: 20px; position: relative; overflow: hidden; transition: 0.3s;}
    .loc-card:hover { border-color: #f97316; }
    .loc-card::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: #f97316; }
    .loc-title { color: #fff; font-size: 1.2rem; font-weight: 700; margin-bottom: 10px; }
    .loc-detail { color: #94a3b8; font-size: 0.9rem; line-height: 1.5; margin-bottom: 15px; display: flex; gap: 10px; }
    .loc-detail i { color: #f97316; margin-top: 3px; }
    .loc-card.coming-soon { background: transparent; border: 2px dashed #334155; opacity: 0.6; }
    .loc-card.coming-soon::before { display: none; }
    .loc-card.coming-soon:hover { border-color: #475569; }
    .loc-card.coming-soon .loc-title { color: #64748b; }

    /* 4. CONTACT SECTION */
    .contact-section { padding: 100px 5%; background-color: #0f172a; text-align: center; border-top: 1px solid #1e293b; }
    .contact-header { color: #f97316; font-size: 1.2rem; margin-bottom: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
    .contact-subtitle { color: #94a3b8; font-size: 1.1rem; margin-bottom: 60px; }
    .contact-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; max-width: 1000px; margin: 0 auto; }
    .contact-card { border: 1px solid #1e293b; border-radius: 16px; padding: 40px 20px; transition: 0.3s; background: rgba(30, 41, 59, 0.2); }
    .contact-card:hover { border-color: #f97316; background: rgba(30, 41, 59, 0.4); }
    .contact-icon { color: #f97316; font-size: 2.5rem; margin-bottom: 25px; }
    .contact-title { color: #fff; font-size: 1.2rem; font-weight: 600; margin-bottom: 15px; }
    .contact-text { color: #94a3b8; font-size: 0.95rem; line-height: 1.6; }

    /* 5. FOOTER CTA */
    .cta-footer { text-align: center; padding: 120px 20px; background: url('https://www.transparenttextures.com/patterns/stardust.png') #1e293b; position: relative; border-top: 1px solid #334155; }
    .cta-footer::after { content: ''; position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: 200px; height: 2px; background: linear-gradient(90deg, transparent, #f97316, transparent); }
    .btn-glow { background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; padding: 18px 50px; border-radius: 12px; text-decoration: none; font-weight: 800; font-size: 1.2rem; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 12px; border: none; box-shadow: 0 10px 30px rgba(249, 115, 22, 0.4); text-transform: uppercase; letter-spacing: 1px; cursor: pointer; }
    .btn-glow:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(249, 115, 22, 0.6); color: #fff; }

    /* ==========================================
       6. STATISTIK FOOTER (ADAPTIVE LIGHT/DARK)
       ========================================== */
    .stats-footer { padding: 40px 5%; display: flex; justify-content: center; background-color: #f8fafc; border-top: 1px solid #e2e8f0; transition: background-color 0.3s; }
    .stats-card { background: #ffffff; border: 1px dashed #cbd5e1; border-radius: 20px; padding: 25px 40px; max-width: 800px; width: 100%; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .stats-title { color: #475569; margin: 0 0 20px 0; font-size: 1.1rem; }
    .stats-item { background: #f1f5f9; padding: 15px 25px; border-radius: 16px; flex: 1; min-width: 200px; }
    .stats-number { display: block; font-size: 1.8rem; font-weight: 900; color: #0f172a; }
    .stats-time { display: block; font-size: 1rem; font-weight: bold; color: #0f172a; margin-top: 8px; margin-bottom: 5px; }
    .stats-label { color: #64748b; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

    /* Perintah Otomatis Saat Mode Gelap (.dark) Aktif */
    .dark .stats-footer, body.dark .stats-footer { background-color: #0f172a; border-top-color: #1e293b; }
    .dark .stats-card, body.dark .stats-card { background: rgba(30, 41, 59, 0.4); border-color: #334155; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
    .dark .stats-title, body.dark .stats-title { color: #94a3b8; }
    .dark .stats-item, body.dark .stats-item { background: rgba(15,23,42,0.6); }
    .dark .stats-number, .dark .stats-time, body.dark .stats-number, body.dark .stats-time { color: #ffffff; }
    .dark .stats-label, body.dark .stats-label { color: #94a3b8; }

    /* ==========================================
       7. WIDGET MUSIK (ADAPTIVE LIGHT/DARK)
       ========================================== */
    .widget-pill {
        background: rgba(255, 255, 255, 0.85); /* Putih Kaca untuk Light Mode */
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 50px;
        padding: 10px 25px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 300px;
        min-height: 50px;
        transition: transform 0.3s, border-color 0.3s, background-color 0.3s, box-shadow 0.3s;
        cursor: pointer;
    }
    .widget-pill:hover { transform: scale(1.03); border-color: rgba(249, 115, 22, 0.5); }

    /* Text Color untuk Light Mode */
    .widget-loading-text { color: #475569; font-size: 0.95rem; display: flex; align-items: center; gap: 10px; transition: color 0.3s; }
    .widget-text-label { color: #64748b; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; font-weight: bold; transition: color 0.3s; }
    .widget-text-title { color: #0f172a; font-size: 1.1rem; letter-spacing: 0.5px; white-space: nowrap; max-width: 150px; overflow: hidden; text-overflow: ellipsis; display: inline-block; vertical-align: bottom; font-weight: 800; transition: color 0.3s; }
    .widget-text-oleh { color: #94a3b8; font-style: italic; transition: color 0.3s; }
    .widget-text-artist { color: #ea580c; font-weight: bold; white-space: nowrap; max-width: 120px; overflow: hidden; text-overflow: ellipsis; display: inline-block; vertical-align: bottom; transition: color 0.3s; }

    /* Perintah Otomatis Mode Gelap (.dark) untuk Widget */
    .dark .widget-pill, body.dark .widget-pill {
        background: rgba(15, 23, 42, 0.65); /* Biru Dongker Kaca untuk Dark Mode */
        border-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .dark .widget-loading-text, body.dark .widget-loading-text { color: #cbd5e1; }
    .dark .widget-text-label, body.dark .widget-text-label { color: #94a3b8; }
    .dark .widget-text-title, body.dark .widget-text-title { color: #ffffff; }
    .dark .widget-text-oleh, body.dark .widget-text-oleh { color: #64748b; }
    .dark .widget-text-artist, body.dark .widget-text-artist { color: #38bdf8; }

    /* ==========================================
       8. ANIMASI VISUALISASI MUSIK
       ========================================== */
    @keyframes barAnimation {
        0%, 100% { height: 2px; }
        50% { height: 10px; }
    }
    .music-visualizer { display: flex; align-items: flex-end; gap: 2px; width: 20px; height: 10px; position: absolute; }
    .music-bar { width: 3px; height: 2px; background-color: #ffffff; border-radius: 1px; transition: height 0.2s ease; }
    .is-playing .music-bar { animation: barAnimation 1s ease-in-out infinite; }
    .is-playing .music-bar:nth-child(1) { animation-delay: 0.1s; animation-duration: 1.1s; }
    .is-playing .music-bar:nth-child(2) { animation-delay: 0.3s; animation-duration: 0.9s; }
    .is-playing .music-bar:nth-child(3) { animation-delay: 0.2s; animation-duration: 1.0s; }
    .is-playing .music-bar:nth-child(4) { animation-delay: 0.4s; animation-duration: 0.8s; }

    /* ==========================================
       9. MODAL TOP 10 STYLES
       ========================================== */
    .trending-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(10, 15, 30, 0.85); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
        z-index: 9999; display: flex; justify-content: center; align-items: center;
        opacity: 0; visibility: hidden; transition: all 0.4s ease;
    }
    .trending-overlay.show { opacity: 1; visibility: visible; }
    .trending-modal {
        background: rgba(30, 41, 59, 0.7); border: 1px solid rgba(249, 115, 22, 0.3);
        border-radius: 30px; width: 90%; max-width: 480px;
        padding: 40px 30px; box-shadow: 0 30px 60px rgba(0,0,0,0.8), 0 0 40px rgba(249, 115, 22, 0.15);
        position: relative; transform: translateY(50px) scale(0.95); transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .trending-overlay.show .trending-modal { transform: translateY(0) scale(1); }
    .close-modal-btn {
        position: absolute; top: -15px; right: -15px; background: #1e293b;
        border: 2px solid #334155; color: #94a3b8; width: 45px; height: 45px; border-radius: 50%;
        display: flex; justify-content: center; align-items: center; cursor: pointer;
        transition: 0.3s; box-shadow: 0 10px 20px rgba(0,0,0,0.5); font-size: 1.2rem;
    }
    .close-modal-btn:hover { background: #ef4444; border-color: #ef4444; color: #fff; transform: rotate(90deg) scale(1.1); }
    .song-item {
        display: flex; align-items: center; gap: 18px; padding: 15px 20px;
        background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px; margin-bottom: 12px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .song-item:hover { transform: translateX(10px); background: rgba(249, 115, 22, 0.1); border-color: rgba(249, 115, 22, 0.5); box-shadow: 0 10px 25px rgba(249, 115, 22, 0.2); }
    .song-rank { font-size: 1.2rem; color: #fff; font-weight: 900; background: #334155; width: 45px; height: 45px; border-radius: 12px; display: flex; justify-content: center; align-items: center; flex-shrink: 0; box-shadow: inset 0 2px 5px rgba(0,0,0,0.5); }
    .song-info { flex: 1; overflow: hidden; }
    .song-info h4 { color: #fff; margin: 0 0 5px 0; font-size: 1.05rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .song-info p { color: #94a3b8; margin: 0; font-size: 0.85rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    #trending-list-container::-webkit-scrollbar { width: 8px; }
    #trending-list-container::-webkit-scrollbar-track { background: rgba(0,0,0,0.1); border-radius: 10px; margin: 10px 0; }
    #trending-list-container::-webkit-scrollbar-thumb { background: rgba(249, 115, 22, 0.5); border-radius: 10px; }
    #trending-list-container::-webkit-scrollbar-thumb:hover { background: rgba(249, 115, 22, 0.8); }
</style>

<main class="landing-wrapper">

    <header class="hero-section">

        <aside class="dynamic-island-music" style="display: flex; justify-content: center; margin-bottom: 35px;" aria-label="Pemutar Musik Hits">
            <div class="widget-pill" onclick="openTrendingModal()">

                <div id="trending-loading" class="widget-loading-text">
                    <i class="fa-solid fa-circle-notch fa-spin" style="color: #f97316; font-size: 1.1rem;"></i>
                    Menyinkronkan tangga lagu iTunes...
                </div>

                <div id="trending-result" style="display: none; align-items: center; gap: 12px; font-size: 0.95rem;">

                    <button id="btn-play-top" onclick="toggleTopMusic(event)" style="background: linear-gradient(135deg, #f97316, #ea580c); border: none; color: #fff; width: 40px; height: 40px; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 0 12px rgba(249, 115, 22, 0.6); cursor: pointer; transition: transform 0.2s; position: relative;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" aria-label="Play/Pause">
                        <div class="music-visualizer">
                            <span class="music-bar"></span>
                            <span class="music-bar"></span>
                            <span class="music-bar"></span>
                            <span class="music-bar"></span>
                        </div>
                    </button>
                    <i id="top-play-icon" class="fa-solid fa-play" style="color: #fff; font-size: 0.9rem; display: none;"></i>

                    <span class="widget-text-label">HITS:</span>
                    <strong id="t-title" class="widget-text-title"></strong>
                    <span class="widget-text-oleh">oleh</span>
                    <span id="t-artist" class="widget-text-artist"></span>
                </div>
            </div>
        </aside>

        <audio id="audio-top-player" preload="auto"></audio>

        <h1 class="hero-title">SingSpace <span>Karaoke</span></h1>
        <p class="hero-desc">
            Jadikan setiap momen bernyanyimu lebih spektakuler di SingSpace! Nikmati atmosfer hiburan kelas atas dengan privasi maksimal di ruang VIP dan VVIP eksklusif kami. Amankan tempatmu hanya dalam hitungan detik. Pesan sekarang dan mulai bernyanyi!
        </p>

        <style>
            .btn-hero-premium {
                display: inline-flex; align-items: center; gap: 12px;
                background: linear-gradient(135deg, #f97316, #ea580c);
                color: #ffffff !important; padding: 16px 45px; border-radius: 50px;
                font-size: 1.05rem; font-weight: 900; text-transform: uppercase;
                letter-spacing: 1.5px; text-decoration: none;
                box-shadow: 0 10px 25px rgba(249, 115, 22, 0.4);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                border: 1px solid rgba(255, 255, 255, 0.1); margin-top: 15px;
            }
            .btn-hero-premium:hover {
                transform: translateY(-5px) scale(1.02);
                box-shadow: 0 20px 40px rgba(249, 115, 22, 0.6);
                background: linear-gradient(135deg, #fb923c, #f97316);
                border-color: rgba(255, 255, 255, 0.3);
            }
            .btn-hero-premium i { transition: transform 0.3s ease; font-size: 1.1rem; }
            .btn-hero-premium:hover i { transform: translateX(6px); }
        </style>

        <a href="{{ route('ruangan.catalog') }}" class="btn-hero-premium">
            Booking Sekarang <i class="fa-solid fa-arrow-right-long"></i>
        </a>

        <div id="trendingModal" class="trending-overlay" onclick="closeTrendingModal(event)">
            <div class="trending-modal" onclick="event.stopPropagation()">
                <button onclick="closeTrendingModal()" class="close-modal-btn"><i class="fa-solid fa-xmark"></i></button>
                <div style="text-align: center; margin-bottom: 25px;">
                    <div style="display: inline-flex; justify-content: center; align-items: center; width: 60px; height: 60px; background: rgba(249, 115, 22, 0.15); border-radius: 50%; margin-bottom: 15px; box-shadow: 0 0 20px rgba(249, 115, 22, 0.4);">
                        <i class="fa-solid fa-headphones-simple" style="color: #f97316; font-size: 1.8rem;"></i>
                    </div>
                    <h3 style="color: #fff; margin: 0; font-size: 1.6rem; font-weight: 900; letter-spacing: 1px;">Top 10 <span style="color: #f97316;">Hits</span></h3>
                    <p style="color: #94a3b8; margin: 5px 0 0 0; font-size: 0.9rem;">Tangga lagu terpopuler di Indonesia saat ini</p>
                </div>
                <div id="trending-list-container" style="max-height: 45vh; overflow-y: auto; text-align: left; padding-right: 10px;">
                </div>
            </div>
        </div>

        <script>
            async function fetchTrendingSong() {
                const loading = document.getElementById('trending-loading');
                const result = document.getElementById('trending-result');
                const listContainer = document.getElementById('trending-list-container');

                try {
                    await new Promise(resolve => setTimeout(resolve, 800));
                    const response = await fetch('https://itunes.apple.com/id/rss/topsongs/limit=10/json');
                    const data = await response.json();

                    window.listLaguTop = data.feed.entry;
                    window.indexSekarangTop = 0;

                    loading.style.display = 'none';
                    result.style.display = 'flex';

                    let listHTML = '';
                    window.listLaguTop.forEach((track, index) => {
                        let rankStyle = '';
                        let medalIcon = '';
                        if(index === 0) {
                            rankStyle = 'background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #fff; box-shadow: 0 0 15px rgba(251, 191, 36, 0.6);';
                            medalIcon = '<i class="fa-solid fa-crown" style="color:#fbbf24; font-size:0.9rem; margin-left:8px; text-shadow: 0 0 5px rgba(251,191,36,0.5);"></i>';
                        } else if (index === 1) {
                            rankStyle = 'background: linear-gradient(135deg, #94a3b8, #64748b); color: #fff;';
                        } else if (index === 2) {
                            rankStyle = 'background: linear-gradient(135deg, #b45309, #78350f); color: #fff;';
                        }
                        listHTML += `
                            <article class="song-item">
                                <div class="song-rank" style="${rankStyle}">#${index + 1}</div>
                                <div class="song-info">
                                    <h4>${track['im:name'].label} ${medalIcon}</h4>
                                    <p><i class="fa-solid fa-music" style="margin-right:6px; font-size: 0.75rem; color: #f97316;"></i> ${track['im:artist'].label}</p>
                                </div>
                            </article>
                        `;
                    });
                    listContainer.innerHTML = listHTML;
                    siapkanLaguTop(0);

                } catch (error) {
                    loading.innerHTML = '<i class="fa-solid fa-triangle-exclamation" style="color: #ef4444;"></i> Gagal memuat tangga lagu.';
                }
            }

            async function siapkanLaguTop(index) {
                const track = window.listLaguTop[index];
                const audioTop = document.getElementById('audio-top-player');
                const widgetAside = document.querySelector('.dynamic-island-music');

                document.getElementById('t-title').innerText = track['im:name'].label;
                document.getElementById('t-artist').innerText = track['im:artist'].label;

                let pUrl = null;
                if(Array.isArray(track.link)){
                    const audioLink = track.link.find(l => l.attributes && l.attributes.type && l.attributes.type.includes('audio'));
                    if(audioLink) pUrl = audioLink.attributes.href;
                }

                if(pUrl) {
                    audioTop.src = pUrl;
                    try {
                        await audioTop.play();
                        widgetAside.classList.add('is-playing');
                    } catch(e) {
                        widgetAside.classList.remove('is-playing');
                    }
                } else {
                    gantiLaguBerikutnya();
                }
            }

            function toggleTopMusic(event) {
                event.stopPropagation();
                const audioTop = document.getElementById('audio-top-player');
                const widgetAside = document.querySelector('.dynamic-island-music');

                if(audioTop.paused) {
                    audioTop.play();
                    widgetAside.classList.add('is-playing');
                } else {
                    audioTop.pause();
                    widgetAside.classList.remove('is-playing');
                }
            }

            function gantiLaguBerikutnya() {
                window.indexSekarangTop++;
                if (window.indexSekarangTop >= window.listLaguTop.length) {
                    window.indexSekarangTop = 0;
                }
                siapkanLaguTop(window.indexSekarangTop);
            }

            document.addEventListener('DOMContentLoaded', () => {
                fetchTrendingSong();
                document.getElementById('audio-top-player').addEventListener('ended', gantiLaguBerikutnya);
            });

            function openTrendingModal() {
                if(document.getElementById('trending-list-container').innerHTML.trim() !== '') {
                    document.getElementById('trendingModal').classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            }
            function closeTrendingModal(event) {
                document.getElementById('trendingModal').classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        </script>
    </header>

    <section class="features-section">
        <article class="feature-box">
            <div class="feature-icon-wrap"><i class="fa-solid fa-sliders"></i></div>
            <h3>Acoustic Perfection</h3>
            <p>Dilengkapi dengan *sound system* kelas studio dan peredam suara premium. Setiap nada yang Anda nyanyikan terdengar sempurna tanpa distorsi.</p>
        </article>
        <article class="feature-box">
            <div class="feature-icon-wrap"><i class="fa-solid fa-user-lock"></i></div>
            <h3>Ultimate Privacy</h3>
            <p>Akses eksklusif untuk setiap ruangan. Nikmati waktu berkualitas bersama teman dan keluarga tanpa gangguan dari dunia luar.</p>
        </article>
        <article class="feature-box">
            <div class="feature-icon-wrap"><i class="fa-solid fa-martini-glass-citrus"></i></div>
            <h3>F&B Concierge</h3>
            <p>Layanan hidangan dan minuman premium yang langsung diantar ke ruangan Anda. Pesan langsung melalui panel interaktif di dalam *room*.</p>
        </article>
    </section>

    <section class="dual-section" id="tentang">
        <article class="half-pane about-pane">
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
        </article>

        <article class="half-pane location-pane">
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
        </article>
    </section>

    <section class="contact-section" id="lokasi">
        <h3 class="contact-header">Hubungi Kami</h3>
        <p class="contact-subtitle">Punya pertanyaan atau butuh bantuan reservasi? Tim SingSpace siap membantu Anda.</p>

        <div class="contact-grid">
            <address class="contact-card" style="font-style: normal;">
                <i class="fa-solid fa-location-dot contact-icon"></i>
                <h4 class="contact-title">Lokasi</h4>
                <p class="contact-text">
                    Jl. Moh. Yamin No. 5,<br>
                    Jember, Jawa Timur
                </p>
            </address>

            <article class="contact-card">
                <i class="fa-solid fa-phone contact-icon" style="transform: rotate(90deg);"></i>
                <h4 class="contact-title">Telepon</h4>
                <p class="contact-text">
                    +62 812 4684 1249<br>
                    Buka: 10.00 - 22.00 WIB
                </p>
            </article>

            <article class="contact-card">
                <i class="fa-solid fa-envelope contact-icon"></i>
                <h4 class="contact-title">Email</h4>
                <p class="contact-text">
                    singspace@gmail.com<br>
                    Balasan maks 1x24 Jam
                </p>
            </article>
        </div>
    </section>

    <section class="cta-footer">
        <h2 style="color: #fff; font-size: 2.8rem; font-weight: 900; margin-bottom: 20px;">Ready to drop the mic?</h2>
        <p style="color: #94a3b8; margin-bottom: 40px; font-size: 1.1rem; max-width: 600px; margin-left: auto; margin-right: auto;">Jadwalkan sesi Anda sekarang dan rasakan perbedaan akustiknya bersama SingSpace.</p>
        <a href="{{ route('ruangan.catalog') }}" class="btn-glow">
            RESERVASI SEKARANG <i class="fa-solid fa-arrow-right"></i>
        </a>
    </section>

</main> <footer class="stats-footer">
    <div class="stats-card">
        <h4 class="stats-title">
            <i class="fa-solid fa-chart-simple" style="color: #f97316; margin-right: 8px;"></i> Statistik Kunjungan Publik
        </h4>

        <div style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 20px;">
            <div class="stats-item">
                <span class="stats-number">{{ $stats['total'] }} <small style="font-size: 0.9rem; font-weight:normal; opacity: 0.7;">Kali</small></span>
                <span class="stats-label">Total Kunjungan</span>
            </div>

            <div class="stats-item">
                <span class="stats-time">{{ $stats['first'] }}</span>
                <span class="stats-label">Kunjungan Pertama</span>
            </div>

            <div class="stats-item">
                <span class="stats-time" style="color: #38bdf8;">{{ $stats['last'] }}</span>
                <span class="stats-label">Aktivitas Terakhir</span>
            </div>
        </div>
    </div>
</footer>
@endsection
