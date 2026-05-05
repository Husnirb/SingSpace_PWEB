@extends('layouts.app')

@section('title', 'Tentang - SingSpace Karaoke')

@section('content')

<style>
    .premium-bg-wrapper {
        position: relative;
        background-color: var(--bg-deep-navy);
        overflow: hidden;
    }

    .glow-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(140px);
        z-index: 0;
        animation: floatOrb 10s ease-in-out infinite alternate;
    }

    .orb-orange {
        width: 500px;
        height: 500px;
        background-color: var(--primary-orange);
        top: -100px;
        left: -100px;
        opacity: 0.12;
    }

    .orb-blue {
        width: 600px;
        height: 600px;
        background-color: #3B82F6;
        bottom: -150px;
        right: -100px;
        opacity: 0.08;
        animation-delay: -5s;
    }

    @keyframes floatOrb {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(40px, 60px) scale(1.1); }
    }
</style>

<section class="hero" style="min-height: 45vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px; text-align: center;">
    <div class="hero-content" style="width: 100%; max-width: 800px;">
        <h1 style="font-size: clamp(2rem, 5vw, 3rem); margin-bottom: 15px; color: white;">Tentang <span style="color: var(--primary-orange);">SingSpace</span></h1>
        <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-white, #e2e8f0);">
            Lebih dari sekadar tempat bernyanyi. SingSpace adalah pelopor hiburan karaoke eksklusif yang memadukan teknologi audio mutakhir dengan privasi tanpa batas.
        </p>
    </div>
</section>

<div class="premium-bg-wrapper">
    <div class="glow-orb orb-orange"></div>
    <div class="glow-orb orb-blue"></div>
    <div style="position: relative; z-index: 1; width: 100%; max-width: 1200px; margin: 0 auto; padding: 80px 20px; box-sizing: border-box;">

        <div style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: space-between; align-items: center;">
            <div style="flex: 1 1 500px;">
                <h2 style="color: white; margin-bottom: 20px; font-size: 2rem; line-height: 1.3;">Momen Spektakuler<br><span style="color: var(--primary-orange);">Dimulai dari Sini</span></h2>
                <p style="color: var(--text-muted); line-height: 1.8; margin-bottom: 30px; font-size: 1.05rem;">
                    Berdiri di hati kota Jember, SingSpace lahir dari visi untuk mendefinisikan ulang pengalaman karaoke. Kami percaya bahwa setiap perayaan, pertemuan keluarga, atau sekadar waktu melepas penat berhak mendapatkan suasana yang premium dan pelayanan bintang lima.
                </p>
                <div style="display: flex; gap: 40px;">
                    <div style="border-left: 3px solid var(--primary-orange); padding-left: 15px;">
                        <h3 style="color: white; font-size: 1.8rem; margin-bottom: 5px;">50+</h3>
                        <p style="color: var(--text-muted); font-size: 0.9rem;">Ruang Eksklusif</p>
                    </div>
                    <div style="border-left: 3px solid var(--primary-orange); padding-left: 15px;">
                        <h3 style="color: white; font-size: 1.8rem; margin-bottom: 5px;">10K+</h3>
                        <p style="color: var(--text-muted); font-size: 0.9rem;">Lagu Tersedia</p>
                    </div>
                </div>
            </div>
            <div style="flex: 1 1 400px; display: flex; flex-direction: column; gap: 20px;">
                <div style="background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); padding: 30px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); display: flex; align-items: flex-start; gap: 20px; box-shadow: 0 4px 30px rgba(0,0,0,0.1);">
                    <i class="fa-solid fa-microphone-lines" style="font-size: 2.2rem; color: var(--primary-orange);"></i>
                    <div>
                        <h4 style="color: white; margin-bottom: 8px; font-size: 1.2rem;">Audio Kelas Dunia</h4>
                        <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; margin: 0;">Sound system premium untuk kualitas vokal yang jernih dan menggelegar.</p>
                    </div>
                </div>

                <div style="background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); padding: 30px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); display: flex; align-items: flex-start; gap: 20px; box-shadow: 0 4px 30px rgba(0,0,0,0.1);">
                    <i class="fa-solid fa-couch" style="font-size: 2.2rem; color: var(--primary-orange);"></i>
                    <div>
                        <h4 style="color: white; margin-bottom: 8px; font-size: 1.2rem;">Privasi Maksimal</h4>
                        <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; margin: 0;">Ruangan kedap suara dengan desain interior mewah nan elegan.</p>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
