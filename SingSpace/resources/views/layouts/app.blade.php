<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SingSpace Karaoke')</title>

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

        // TERAPKAN UKURAN FONT LANGSUNG
        let font = getCookie('font_size') || 'medium';
        let sizeMap = { 'small': '14px', 'medium': '16px', 'large': '18px' };
        document.documentElement.style.fontSize = sizeMap[font];
        document.documentElement.style.transition = 'font-size 0.3s ease';
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* 0. FIX CELAH MISTERIUS & RESET */
        body {
            background-color: #0f172a;
            margin: 0;
            padding: 0;
        }
        header {
            border-bottom: none !important;
        }
        main {
            display: block;
            line-height: normal;
            min-height: 100vh;
        }

        /* 1. Background Dasar Light Mode Global */
        html:not(.dark) body,
        html:not(.dark) header,
        html:not(.dark) .landing-wrapper,
        html:not(.dark) .pilih-container,
        html:not(.dark) main > div[style*="background-color: #0f172a"],
        html:not(.dark) main > div[style*="background-color:#0f172a"] {
            background-color: #f8fafc !important;
        }

        /* 1b. REVISI OPACITY HERO (FINAL - PAKE NAMA FILE YANG BENAR) */
        .hero-section {
            position: relative !important;
            background-color: #0f172a !important;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)),
                url('{{ asset('img/landing-page.jpg') }}') !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            min-height: 500px;
        }

        /* Dark Mode: Overlay lebih gelap, foto tetap muncul */
        html.dark .hero-section {
            background-image:
                linear-gradient(rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.7)),
                url('{{ asset('img/landing-page.jpg') }}') !important;
        }

        /* 2. Warna Section Publik */
        html:not(.dark) .features-section,
        html:not(.dark) .contact-section,
        html:not(.dark) .dual-section {
            background-color: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
        }
        html:not(.dark) .about-pane,
        html:not(.dark) .location-pane {
            background-color: transparent !important;
        }

        /* 3. Kotak Kaca & Card */
        html:not(.dark) .feature-box,
        html:not(.dark) .loc-card,
        html:not(.dark) .contact-card,
        html:not(.dark) .pilih-room-card,
        html:not(.dark) .hero-section > div > div,
        html:not(.dark) main div[style*="background: #1e293b"],
        html:not(.dark) main div[style*="background:#1e293b"],
        html:not(.dark) main div[style*="background-color: #1e293b"],
        html:not(.dark) main div[style*="background: rgba(30, 41, 59"],
        html:not(.dark) main div[style*="background:rgba(30, 41, 59"] {
            background: #ffffff !important;
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05) !important;
        }

        /* ========================================================
           4. PERBAIKAN TABEL LIGHT MODE (ULTRA PREMIUM)
           ======================================================== */
        html:not(.dark) main table {
            color: #475569 !important;
        }
        html:not(.dark) main thead,
        html:not(.dark) main thead[style*="background"] {
            background: #f8fafc !important;
            border-bottom: 2px solid #e2e8f0 !important;
        }
        html:not(.dark) main th,
        html:not(.dark) main th[style*="color"] {
            color: #64748b !important;
        }
        html:not(.dark) main td[style*="color: #fff"],
        html:not(.dark) main td[style*="color:#fff"],
        html:not(.dark) main strong[style*="color: #fff"],
        html:not(.dark) main strong[style*="color:#fff"] {
            color: #0f172a !important;
        }
        html:not(.dark) main tr[style*="border-bottom"] {
            border-bottom: 1px solid #f1f5f9 !important;
        }
        html:not(.dark) main tbody tr:hover,
        html:not(.dark) main tbody tr:hover td {
            background-color: #f8fafc !important;
        }

        /* 5. WARNA TEKS UMUM */
        html:not(.dark) .feature-box h3,
        html:not(.dark) .about-title,
        html:not(.dark) .stat-number,
        html:not(.dark) .loc-title,
        html:not(.dark) .contact-header,
        html:not(.dark) .contact-title,
        html:not(.dark) .pilih-header h1,
        html:not(.dark) .pilih-room-title,
        html:not(.dark) .pilih-cap-val,
        html:not(.dark) .hero-title,
        html:not(.dark) .nav-menu li a,
        html:not(.dark) #t-title,
        html:not(.dark) .cta-footer h2,
        html:not(.dark) footer h3,
        html:not(.dark) footer h4,
        html:not(.dark) main h2,
        html:not(.dark) main h3,
        html:not(.dark) main h4,
        html:not(.dark) main label {
            color: #0f172a !important;
        }

        html:not(.dark) .hero-title span,
        html:not(.dark) .about-title span,
        html:not(.dark) footer span,
        html:not(.dark) main span[style*="color: #f97316"],
        html:not(.dark) main span[style*="color:#f97316"],
        html:not(.dark) main td[style*="color: #f97316"] {
            color: #f97316 !important;
        }

        html:not(.dark) .loc-detail span,
        html:not(.dark) .loc-card span[style],
        html:not(.dark) .feature-box p,
        html:not(.dark) .about-text,
        html:not(.dark) .stat-label,
        html:not(.dark) .loc-detail,
        html:not(.dark) .contact-subtitle,
        html:not(.dark) .contact-text,
        html:not(.dark) .pilih-header p,
        html:not(.dark) .pilih-room-desc,
        html:not(.dark) .hero-desc,
        html:not(.dark) #trending-loading,
        html:not(.dark) #t-artist,
        html:not(.dark) .cta-footer p,
        html:not(.dark) footer p,
        html:not(.dark) footer li,
        html:not(.dark) footer a,
        html:not(.dark) main p,
        html:not(.dark) main span[style*="color: #cbd5e1"],
        html:not(.dark) main span[style*="color: #94a3b8"] {
            color: #475569 !important;
        }

        html:not(.dark) footer a:hover {
            color: #f97316 !important;
        }

        /* 6. INPUT FIELD & SEARCH BAR */
        html:not(.dark) input[type="text"],
        html:not(.dark) input[type="search"],
        html:not(.dark) input[type="email"],
        html:not(.dark) input[type="password"],
        html:not(.dark) main select,
        html:not(.dark) main textarea {
            background-color: #ffffff !important;
            color: #0f172a !important;
            border: 1px solid #cbd5e1 !important;
        }
        html:not(.dark) input::placeholder {
            color: #94a3b8 !important;
        }

        /* 7. PEMBUNGKUS FOOTER & FIX CROP BOTTOM */
        html:not(.dark) .footer-wrapper {
            background-color: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
        }
        html:not(.dark) .footer-bottom-wrapper {
            background-color: #e2e8f0 !important;
            border-top: 1px solid #cbd5e1 !important;
        }
        html:not(.dark) .footer-text,
        html:not(.dark) .footer-link,
        html:not(.dark) .copyright-text {
            color: #475569 !important;
        }
        html:not(.dark) .footer-link:hover {
            color: #f97316 !important;
        }

        /* ========================================================
           8. FINAL GLOW UP: CTA & STATISTIK
           ======================================================== */
        html:not(.dark) .cta-footer {
            background: radial-gradient(circle at center top, #fff3e0 0%, #f8fafc 80%) !important;
            border-top: 1px solid rgba(249, 115, 22, 0.15) !important;
            border-bottom: 1px solid rgba(203, 213, 225, 0.4) !important;
            position: relative;
            overflow: hidden;
        }

        html:not(.dark) .cta-footer::before {
            content: '';
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 300px;
            height: 100px;
            background: #f97316;
            filter: blur(80px);
            opacity: 0.15;
            z-index: 0;
            pointer-events: none;
        }

        html:not(.dark) .cta-footer h2,
        html:not(.dark) .cta-footer p {
            color: #0f172a !important;
            position: relative;
            z-index: 1;
        }

        html:not(.dark) main section[style*="background-color: #0f172a"],
        html:not(.dark) main section[style*="background-color:#0f172a"] {
            background: #f8fafc !important;
            border-top: 1px solid rgba(203, 213, 225, 0.3) !important;
        }

        html:not(.dark) main div[style*="rgba(30, 41, 59"],
        html:not(.dark) main div[style*="rgba(30,41,59"] {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(16px) !important;
            -webkit-backdrop-filter: blur(16px) !important;
            border: 1px solid rgba(249, 115, 22, 0.12) !important;
            border-radius: 20px !important;
            box-shadow: 0 15px 35px rgba(249, 115, 22, 0.04) !important;
        }

        html:not(.dark) main div[style*="rgba(30, 41, 59"] div[style*="background"] {
            background: #ffffff !important;
            background-color: #ffffff !important;
            border: 1px solid rgba(226, 232, 240, 0.7) !important;
            border-radius: 14px !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02) !important;
            transition: all 0.3s ease !important;
        }

        html:not(.dark) main div[style*="rgba(30, 41, 59"] div[style*="background"]:hover {
            transform: translateY(-4px) !important;
            box-shadow: 0 12px 25px rgba(249, 115, 22, 0.1) !important;
            border-color: rgba(249, 115, 22, 0.3) !important;
        }

        html:not(.dark) main div[style*="rgba(30, 41, 59"] * {
            color: #64748b !important;
            text-shadow: none !important;
        }

        html:not(.dark) main div[style*="rgba(30, 41, 59"] > div:first-child {
            color: #1e293b !important;
            font-weight: 700 !important;
        }

        html:not(.dark) main div[style*="rgba(30, 41, 59"] strong,
        html:not(.dark) main div[style*="rgba(30, 41, 59"] b,
        html:not(.dark) main div[style*="rgba(30, 41, 59"] h2,
        html:not(.dark) main div[style*="rgba(30, 41, 59"] h3,
        html:not(.dark) main div[style*="rgba(30, 41, 59"] i {
            color: #f97316 !important;
        }

        /* ========================================================
           9. FIX KHUSUS DROPDOWN, WIZARD BOOKING & FORM RUANGAN
           ======================================================== */
        html:not(.dark) .profile-dropdown,
        html:not(.dark) .mobile-nav-sidebar,
        html:not(.dark) .pesanan-sidebar {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        }

        html:not(.dark) .pd-header,
        html:not(.dark) .pd-footer,
        html:not(.dark) .mn-header,
        html:not(.dark) .ps-header {
            background: #f8fafc !important;
            border-color: #e2e8f0 !important;
        }

        html:not(.dark) .pd-item,
        html:not(.dark) .mn-links a,
        html:not(.dark) .ps-detail-row {
            color: #475569 !important;
        }

        html:not(.dark) .pd-item:hover,
        html:not(.dark) .mn-links a:hover {
            background: #f1f5f9 !important;
            color: #f97316 !important;
        }

        html:not(.dark) .pd-info h4,
        html:not(.dark) .mn-header h3,
        html:not(.dark) .ps-header h3,
        html:not(.dark) .ps-room-name,
        html:not(.dark) .ps-price {
            color: #0f172a !important;
        }

        html:not(.dark) .pd-avatar-large {
            background: #ffffff !important;
            color: #f97316 !important;
            border-color: #f97316 !important;
        }

        html:not(.dark) .wizard-container,
        html:not(.dark) .sp-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05) !important;
        }

        html:not(.dark) .wizard-container *,
        html:not(.dark) .sp-card * {
            color: #1e293b !important;
            text-shadow: none !important;
        }

        html:not(.dark) .wizard-container input,
        html:not(.dark) .wizard-container select,
        html:not(.dark) .sp-card input,
        html:not(.dark) .sp-card select,
        html:not(.dark) .sp-card textarea {
            background: #f8fafc !important;
            border: 1px solid #cbd5e1 !important;
            color: #0f172a !important;
        }

        html:not(.dark) .step-circle {
            background: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
            color: #64748b !important;
        }

        html:not(.dark) .step-circle.active {
            background: #f97316 !important;
            border-color: #f97316 !important;
            color: #ffffff !important;
        }

        html:not(.dark) button[type="submit"],
        html:not(.dark) .sp-card button,
        html:not(.dark) .wizard-container button {
            color: #ffffff !important;
        }

        /* ========================================================
           10. FIX MINOR (TOMBOL KEMBALI, FOOTER DASHBOARD & QRIS)
           ======================================================== */
        html:not(.dark) .btn-outline,
        html:not(.dark) button.btn-outline {
            color: #475569 !important;
            border: 1px solid #cbd5e1 !important;
            background: transparent !important;
        }
        html:not(.dark) .btn-outline:hover,
        html:not(.dark) button.btn-outline:hover {
            color: #f97316 !important;
            border-color: #f97316 !important;
            background: #fff7ed !important;
        }

        html:not(.dark) .footer-wrapper h4,
        html:not(.dark) .footer-col h4,
        html:not(.dark) footer h4[style*="color: #fff"] {
            color: #f97316 !important;
        }

        #qrisBox {
            background: #ffffff !important;
            border: 2px dashed #cbd5e1 !important;
            border-radius: 16px !important;
            padding: 1.5rem !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.3s ease !important;
            position: relative;
            overflow: hidden;
        }

        html:not(.dark) #qrisBox {
            border-color: #fed7aa !important;
            box-shadow: 0 15px 35px rgba(249, 115, 22, 0.08) !important;
        }

        #qrisBox img {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
            display: inline-block;
        }
        #qrisBox img:hover {
            transform: scale(1.02);
        }

        /* ========================================================
           11. FIX KOTAK TOTAL PEMBAYARAN (WIZARD STEP 3)
           ======================================================== */
        /* Mengalahkan inline style background gelap bawaan form */
        html:not(.dark) .wizard-container div[style*="background: #0f172a"],
        html:not(.dark) .wizard-container div[style*="background:#0f172a"] {
            background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%) !important; /* Gradasi oranye pastel */
            border: 1px solid #fed7aa !important; /* Border oranye lembut */
            box-shadow: 0 4px 10px rgba(249, 115, 22, 0.05) !important;
        }

        /* Label "Total Pembayaran" dibuat agak gelap agar kontras */
        html:not(.dark) .wizard-container div[style*="background: #0f172a"] span,
        html:not(.dark) .wizard-container div[style*="background:#0f172a"] span,
        html:not(.dark) .wizard-container div[style*="background: #0f172a"] p,
        html:not(.dark) .wizard-container div[style*="background:#0f172a"] p {
            color: #9a3412 !important; /* Cokelat/Oren tua */
            font-weight: 600 !important;
        }

        /* Angka Harga "Rp 100.000" dibuat menyala */
        html:not(.dark) .wizard-container div[style*="background: #0f172a"] h2,
        html:not(.dark) .wizard-container div[style*="background:#0f172a"] h2,
        html:not(.dark) .wizard-container div[style*="background: #0f172a"] h3,
        html:not(.dark) .wizard-container div[style*="background:#0f172a"] h3,
        html:not(.dark) .wizard-container div[style*="background: #0f172a"] strong,
        html:not(.dark) .wizard-container div[style*="background:#0f172a"] strong {
            color: #ea580c !important; /* Oren pekat */
            font-weight: 800 !important;
        }

        /* ========================================================
           12. FIX KOTAK "PESANAN SAYA" (SIDEBAR USER)
           ======================================================== */
        html:not(.dark) .ps-card {
            background: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03) !important;
        }
        html:not(.dark) .ps-card * {
            color: #1e293b !important;
        }
        /* Penyesuaian warna ikon dan detail */
        html:not(.dark) .ps-card i { color: #f97316 !important; }
        html:not(.dark) .ps-card p { color: #475569 !important; }
    </style>

</head>
<body>
    <div id="toast-notification" style="position: fixed; top: 100px; right: 25px; z-index: 9999; background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 14px; padding: 14px 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 14px; min-width: 280px; max-width: 360px; transform: translateX(150%); transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);">

        <div id="toast-icon-container" style="font-size: 1.3rem; display: flex; justify-content: center; align-items: center; flex-shrink: 0; transition: 0.3s;">
            <i class="fa-solid fa-circle-check" id="toast-icon-inner"></i>
        </div>

        <div style="flex: 1;">
            <h4 id="toast-title" style="margin: 0 0 2px 0; font-size: 0.95rem; font-weight: 700; color: #fff; letter-spacing: 0.3px;"></h4>
            <p id="toast-message" style="margin: 0; font-size: 0.85rem; color: #94a3b8; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"></p>
        </div>

        <button onclick="closeToast()" style="background: transparent; border: none; color: #64748b; font-size: 1.1rem; cursor: pointer; padding: 0 0 0 5px; transition: 0.3s; flex-shrink: 0;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#64748b'">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <script>
        function showToast(type, title, message) {
            const toast = document.getElementById('toast-notification');
            const iconBox = document.getElementById('toast-icon-container');
            const iconInner = document.getElementById('toast-icon-inner');
            const titleEl = document.getElementById('toast-title');
            const messageEl = document.getElementById('toast-message');

            let colorHex = '';
            if(type === 'success') {
                colorHex = '#10b981'; // Hijau
                iconInner.className = 'fa-solid fa-circle-check';
            } else if (type === 'welcome') {
                colorHex = '#f97316'; // Oren
                iconInner.className = 'fa-solid fa-sparkles';
            } else {
                colorHex = '#ef4444'; // Merah
                iconInner.className = 'fa-solid fa-circle-exclamation';
            }

            // Pewarnaan Ikon yang simpel tanpa background norak
            iconBox.style.color = colorHex;
            iconBox.style.textShadow = `0 0 12px ${colorHex}80`;

            titleEl.innerText = title;
            messageEl.innerText = message;

            toast.style.transform = 'translateX(0)';
            setTimeout(() => { closeToast(); }, 5000);
        }

        function closeToast() {
            document.getElementById('toast-notification').style.transform = 'translateX(150%)';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const jsMessage = sessionStorage.getItem('flash_message');
            if(jsMessage) {
                showToast('success', 'Yeay, Berhasil!', jsMessage);
                sessionStorage.removeItem('flash_message');
            }

            @if(session('welcome')) showToast('welcome', 'Halo, Selamat Datang!', {!! json_encode(session('welcome')) !!}); @endif
            @if(session('success')) showToast('success', 'Berhasil!', {!! json_encode(session('success')) !!}); @endif
            @if(session('error')) showToast('error', 'Oops, Ada Masalah!', {!! json_encode(session('error')) !!}); @endif
            @if($errors->any()) showToast('error', 'Cek Kembali Inputmu!', {!! json_encode($errors->first()) !!}); @endif
        });
    </script>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @stack('scripts')

</body>
</html>
