<header style="width: 100%; display: flex; justify-content: center; background-color: var(--bg-deep-navy, #0F172A); border-bottom: 1px solid var(--border-color, #1E293B);">

    <nav class="navbar" style="width: 100%; max-width: 1200px; margin: 0 auto; box-sizing: border-box;">
        <div class="logo">
            <img src="{{ asset('img/Logo Singspace.png') }}" alt="Logo SingSpace" class="logo-img">
        </div>
        <ul class="nav-menu">
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="#">Daftar Ruangan</a></li>
            <li><a href="#">Reservasi</a></li>
            <li><a href="{{ url('/tentang') }}">Tentang</a></li>
            <li><a href="{{ url('/kontak') }}">Kontak</a></li>
        </ul>
    </nav>

</header>
