<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SingSpace Karaoke')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* 0. FIX CELAH MISTERIUS: Warnai dasar body dengan Navy agar celah tidak terlihat */
        body { background-color: #0f172a; margin: 0; padding: 0; }
        header { border-bottom: none !important; }

        /* 1. Background Dasar Light Mode */
        html:not(.dark) body,
        html:not(.dark) .landing-wrapper,
        html:not(.dark) .pilih-container {
            background-color: #f8fafc !important;
        }

        /* 2. Warna Section */
        html:not(.dark) .features-section,
        html:not(.dark) .contact-section,
        html:not(.dark) .dual-section {
            background-color: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
        }
        html:not(.dark) .about-pane, html:not(.dark) .location-pane {
            background-color: transparent !important;
        }

        /* 3. Warna Kartu/Box */
        html:not(.dark) .feature-box,
        html:not(.dark) .loc-card,
        html:not(.dark) .contact-card,
        html:not(.dark) .pilih-room-card {
            background: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05) !important;
        }

        /* 4. PERBAIKAN TEKS JUDUL & ANGKA */
        html:not(.dark) .feature-box h3,
        html:not(.dark) .about-title,
        html:not(.dark) .stat-number,
        html:not(.dark) .loc-title,
        html:not(.dark) .contact-header,
        html:not(.dark) .contact-title,
        html:not(.dark) .pilih-header h1,
        html:not(.dark) .pilih-room-title,
        html:not(.dark) .pilih-cap-val {
            color: #0f172a !important;
        }

        /* FIX 1: TULISAN 'KARAOKE' & 'DIMULAI DARI SINI' TETAP OREN! */
        html:not(.dark) .hero-title span,
        html:not(.dark) .about-title span {
            color: #f97316 !important;
        }

        /* FIX 2: NOMOR WHATSAPP MUNCUL DI LIGHT MODE (Biar nggak nyaru putih ke putih) */
        html:not(.dark) .loc-detail span,
        html:not(.dark) .loc-card span[style] {
            color: #475569 !important;
            font-weight: 800 !important;
        }

        /* 5. PERBAIKAN TEKS PARAGRAF */
        html:not(.dark) .feature-box p,
        html:not(.dark) .about-text,
        html:not(.dark) .stat-label,
        html:not(.dark) .loc-detail,
        html:not(.dark) .contact-subtitle,
        html:not(.dark) .contact-text,
        html:not(.dark) .pilih-header p,
        html:not(.dark) .pilih-room-desc {
            color: #475569 !important;
        }

        /* 6. PENGECUALIAN HERO & FOOTER (Tetap Dark/Premium sesuai aslinya) */
        html:not(.dark) .hero-section {
            border-bottom-color: #e2e8f0 !important;
        }
        html:not(.dark) .hero-title {
            color: #ffffff !important; /* Teks utama Hero tetap putih */
        }
        html:not(.dark) .hero-desc {
            color: #cbd5e1 !important;
        }

        html:not(.dark) .cta-footer {
            background-color: #1e293b !important;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png') !important;
            border-top-color: #e2e8f0 !important;
        }
        html:not(.dark) .cta-footer h2 {
            color: #ffffff !important;
        }
        html:not(.dark) .cta-footer p {
            color: #94a3b8 !important;
        }
    </style>

    <script>
        // Helper Functions
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                let date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for(let i=0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function deleteCookie(name) {
            document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }

        // Cek Cookie saat Load (Cegah FOUC)
        let theme = getCookie('theme');
        // Default SingSpace adalah Dark, jadi kalau belum ada cookie, paksa jadi dark
        if (theme === 'dark' || !theme) {
            document.documentElement.classList.add('dark');
            if(!theme) setCookie('theme', 'dark', 30);
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body>

    @include('partials.navbar')

    @if(session('success') || session('error') || $errors->any())
        @php
            $msg = session('success') ?? session('error') ?? 'Terdapat kesalahan pada input Anda.';
            // Deteksi apakah ini pesan sapaan selamat datang
            $isWelcome = str_contains(strtolower($msg), 'selamat datang');
        @endphp

        <div id="flash-message" style="position: fixed; top: 100px; right: 20px; background-color: #1E293B; border: 1px solid #334155; border-left: 4px solid {{ $isWelcome ? '#F97316' : (session('success') ? '#10B981' : '#EF4444') }}; border-radius: 12px; padding: 18px 25px; box-shadow: 0 20px 40px rgba(0,0,0,0.6); z-index: 9999; display: flex; align-items: center; gap: 15px; animation: slideIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);">

            <div style="color: {{ $isWelcome ? '#F97316' : (session('success') ? '#10B981' : '#EF4444') }}; font-size: 1.6rem; width: 35px; display: flex; align-items: center; justify-content: center;">
                @if($isWelcome)
                    <i class="fa-solid fa-hand"></i> @elseif(session('success'))
                    <i class="fa-solid fa-circle-check"></i>
                @else
                    <i class="fa-solid fa-circle-exclamation"></i>
                @endif
            </div>

            <div style="min-width: 180px;">
                <h4 style="margin: 0; color: {{ $isWelcome ? '#F97316' : (session('success') ? '#10B981' : '#EF4444') }}; font-size: 0.85rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">
                    {{ $isWelcome ? 'Halo,' : (session('success') ? 'Success Notification' : 'System Error') }}
                </h4>
                <p style="margin: 0; font-size: 0.95rem; color: #F1F5F9; margin-top: 4px; font-weight: 500;">
                    {{ $msg }}
                </p>
            </div>

            <button onclick="this.parentElement.remove()" style="background: none; border: none; color: #475569; cursor: pointer; padding: 5px; font-size: 1rem; transition: 0.3s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#475569'">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <style>
            @keyframes slideIn {
                from { transform: translateX(120%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        </style>

        <script>
            // Welcome message tampil lebih lama (7 detik), CRUD standar (4 detik)
            const displayTime = {{ $isWelcome ? '7000' : '4000' }};

            setTimeout(() => {
                const flash = document.getElementById('flash-message');
                if (flash) {
                    flash.style.transition = 'all 0.7s cubic-bezier(0.68, -0.55, 0.27, 1.55)';
                    flash.style.opacity = '0';
                    flash.style.transform = 'translateX(120%)';
                    setTimeout(() => flash.remove(), 700);
                }
            }, displayTime);
        </script>
    @endif

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @stack('scripts')

</body>
</html>
