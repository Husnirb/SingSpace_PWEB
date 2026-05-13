<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SingSpace Karaoke')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
