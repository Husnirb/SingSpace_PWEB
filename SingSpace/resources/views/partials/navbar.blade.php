<header style="width: 100%; display: flex; justify-content: center; background-color: var(--bg-deep-navy, #0F172A); border-bottom: 1px solid var(--border-color, #1E293B);">

    <nav class="navbar" style="width: 100%; max-width: 1200px; margin: 0 auto; box-sizing: border-box;">
        <div class="logo">
            <img src="{{ asset('img/Logo Singspace.png') }}" alt="Logo SingSpace" class="logo-img">
        </div>
        <ul class="nav-menu">
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('ruangan.catalog') }}">Daftar Ruangan</a></li>

            @auth
                <li style="color: #f97316; font-weight: 700; margin-left: 15px; border-left: 1px solid #334155; padding-left: 15px;">
                    <i class="fa-solid fa-circle-user"></i> Halo, {{ auth()->user()->name }}
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #ef4444; font-weight: bold; cursor: pointer; font-size: 15px; padding: 0;">
                            <i class="fa-solid fa-power-off"></i> Logout
                        </button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" style="color: #f97316; font-weight: bold;">Login</a></li>
            @endauth
        </ul>
    </nav>

</header>
