<header>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('img/Logo Singspace.png') }}" alt="Logo SingSpace" class="logo-img">
        </div>
        <ul class="nav-menu">
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="#">Daftar Ruangan</a></li>
            <li><a href="#">Reservasi</a></li>
            <li><a href="{{ url('/tentang') }}">Tentang Kami</a></li>
            <li><a href="#">Kontak</a></li>
        </ul>
    </nav>
</header>
