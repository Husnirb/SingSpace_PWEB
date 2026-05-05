<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SingSpace Karaoke')</title>

    <!-- Memanggil CSS & JS menggunakan Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    @include('partials.navbar')

    <!-- FLASH SESSION MESSAGE -->
    @if(session('success'))
        <div id="flash-message" style="position: fixed; top: 100px; right: 20px; background-color: var(--bg-surface, #1E293B); border: 1px solid var(--border-color, #334155); border-left: 4px solid var(--primary-orange, #F97316); border-radius: 8px; padding: 15px 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.4); z-index: 9999; display: flex; align-items: center; gap: 15px; animation: slideIn 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);">

            <div style="background-color: rgba(249, 115, 22, 0.15); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                👋
            </div>

            <!-- Notifikasi -->
            <div>
                <h4 style="margin: 0; color: var(--primary-orange, #F97316); font-size: 1rem; margin-bottom: 4px;">Halo!</h4>
                <p style="margin: 0; font-size: 0.9rem; color: var(--text-white, #F1F5F9);">{{ session('success') }}</p>
            </div>
        </div>

        <style>
            @keyframes slideIn {
                from { transform: translateX(120%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        </style>

        <script>
            setTimeout(() => {
                const flash = document.getElementById('flash-message');
                if (flash) {
                    flash.style.transition = 'all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1)';
                    flash.style.opacity = '0';
                    flash.style.transform = 'translateX(100%)';
                    setTimeout(() => flash.remove(), 500);
                }
            }, 4000);
        </script>
    @endif

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @stack('scripts')
</body>
</html>
