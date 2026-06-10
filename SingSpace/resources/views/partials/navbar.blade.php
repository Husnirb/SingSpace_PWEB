<style>
    /* =========================================
       CSS NAV MENU & DROPDOWN PROFIL DESKTOP
       ========================================= */
    .profile-wrapper { position: relative; margin-left: 20px; display: flex; align-items: center; }
    .profile-avatar { width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; font-weight: 800; font-size: 1.1rem; border: 2px solid #334155; display: flex; justify-content: center; align-items: center; cursor: pointer; transition: 0.3s; padding: 0; box-shadow: 0 4px 10px rgba(249, 115, 22, 0.3); overflow: hidden; }
    .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .profile-avatar:hover { transform: scale(1.08); border-color: #fff; box-shadow: 0 0 15px rgba(249, 115, 22, 0.6); }
    .profile-dropdown { position: absolute; top: 65px; right: 0; width: 300px; background: #1e293b; border: 1px solid #334155; border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.6); opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); z-index: 999; overflow: hidden; }
    .profile-dropdown.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .pd-header { padding: 25px 20px; background: rgba(15, 23, 42, 0.8); border-bottom: 1px solid #334155; display: flex; align-items: center; gap: 15px; }
    .pd-header .pd-avatar-large { width: 55px; height: 55px; border-radius: 50%; background: #0f172a; color: #f97316; font-weight: 900; font-size: 1.5rem; display: flex; justify-content: center; align-items: center; border: 2px solid #f97316; flex-shrink: 0; box-shadow: inset 0 0 10px rgba(249,115,22,0.2); overflow: hidden; }
    .pd-header .pd-avatar-large img { width: 100%; height: 100%; object-fit: cover; }
    .pd-info h4 { color: #fff; margin: 0 0 5px 0; font-size: 1.1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px; }
    .pd-info p { color: #94a3b8; margin: 0 0 8px 0; font-size: 0.85rem; }
    .pd-badge { background: rgba(249, 115, 22, 0.15); color: #f97316; padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; border: 1px solid rgba(249, 115, 22, 0.3);}
    .pd-item { display: flex; align-items: center; gap: 15px; color: #cbd5e1; font-size: 0.9rem; }
    .pd-item i { color: #64748b; font-size: 1.1rem; width: 20px; text-align: center; }
    .pd-footer { padding: 15px 20px; background: rgba(15, 23, 42, 0.5); border-top: 1px solid #334155; }
    .pd-logout-btn { width: 100%; background: transparent; border: none; color: #ef4444; text-align: left; padding: 12px; font-size: 0.95rem; font-weight: 600; cursor: pointer; border-radius: 10px; transition: 0.3s; display: flex; align-items: center; gap: 10px; }
    .pd-logout-btn:hover { background: rgba(239, 68, 68, 0.15); color: #f87171; padding-left: 15px; }

    /* =========================================
       CSS KHUSUS SIDEBAR PESANAN SAYA (TETAP SAMA)
       ========================================= */
    .sidebar-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 2000; opacity: 0; visibility: hidden; transition: 0.3s; backdrop-filter: blur(4px); }
    .sidebar-overlay.show { opacity: 1; visibility: visible; }
    .pesanan-sidebar { position: fixed; top: 0; right: -450px; width: 100%; max-width: 450px; height: 100vh; background: #0f172a; z-index: 2001; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: -10px 0 40px rgba(0,0,0,0.8); display: flex; flex-direction: column; border-left: 1px solid #1e293b; }
    .pesanan-sidebar.open { right: 0; }
    .ps-header { padding: 25px; border-bottom: 1px solid #1e293b; display: flex; justify-content: space-between; align-items: center; background: #1e293b; }
    .ps-header h3 { color: #fff; margin: 0; font-size: 1.2rem; display: flex; align-items: center; gap: 10px; }
    .ps-close-btn { background: transparent; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer; transition: 0.3s; }
    .ps-close-btn:hover { color: #ef4444; transform: rotate(90deg); }
    .ps-body { padding: 25px; overflow-y: auto; flex: 1; }
    .ps-card { background: #1e293b; border: 1px solid #334155; border-radius: 14px; padding: 20px; margin-bottom: 20px; transition: 0.3s; }
    .ps-card:hover { border-color: #f97316; box-shadow: 0 5px 20px rgba(0,0,0,0.4); transform: translateY(-3px); }
    .ps-card-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #334155; padding-bottom: 12px; margin-bottom: 12px; }
    .ps-code { color: #94a3b8; font-size: 0.85rem; font-family: monospace; }
    .ps-status { padding: 5px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; }
    .st-pending { background: rgba(249, 115, 22, 0.1); color: #f97316; border: 1px solid rgba(249, 115, 22, 0.3); }
    .st-confirmed { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
    .st-batal { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }
    .ps-detail-row { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 8px; color: #cbd5e1; font-size: 0.9rem; }
    .ps-room-name { color: #fff; font-weight: bold; font-size: 1.05rem; display: block; margin-bottom: 2px;}
    .ps-card-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 15px; padding-top: 15px; border-top: 1px solid #334155; }
    .ps-price { color: #fff; font-weight: bold; font-size: 1.1rem; }

    /* =========================================
       CSS BARU: RESPONSIVE HAMBURGER MENU
       ========================================= */
    .mobile-menu-btn { display: none; background: transparent; border: none; color: #f97316; font-size: 1.8rem; cursor: pointer; padding: 0 10px; transition: 0.3s; }
    .mobile-menu-btn:hover { color: #ea580c; }
    .mobile-nav-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1500; opacity: 0; visibility: hidden; transition: 0.3s; backdrop-filter: blur(4px); }
    .mobile-nav-overlay.show { opacity: 1; visibility: visible; }
    .mobile-nav-sidebar { position: fixed; top: 0; right: -300px; width: 280px; height: 100vh; background: #0f172a; z-index: 1501; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1); border-left: 1px solid #1e293b; box-shadow: -10px 0 30px rgba(0,0,0,0.8); display: flex; flex-direction: column; }
    .mobile-nav-sidebar.open { right: 0; }
    .mn-header { padding: 25px; border-bottom: 1px solid #1e293b; display: flex; justify-content: space-between; align-items: center; }
    .mn-links { display: flex; flex-direction: column; padding: 15px 0; overflow-y: auto; flex: 1; }
    .mn-links a { padding: 15px 25px; color: #cbd5e1; text-decoration: none; font-weight: 600; font-size: 1.05rem; display: flex; align-items: center; gap: 15px; transition: 0.3s; border-left: 3px solid transparent; }
    .mn-links a:hover { background: rgba(249, 115, 22, 0.1); color: #f97316; border-left-color: #f97316; padding-left: 30px; }
    .mn-links a i { width: 20px; text-align: center; color: #64748b; }
    .mn-links a:hover i { color: #f97316; }

    @media (max-width: 900px) {
        .nav-menu { display: none !important; }
        .desktop-theme-btn { display: none !important; }
        .desktop-login-btn { display: none !important; }
        .mobile-menu-btn { display: block; }
    }

    /* EFEK HOVER MENU DESKTOP */
    .nav-menu li a { position: relative; padding-bottom: 5px; }
    .nav-menu li a::after { content: ''; position: absolute; width: 0; height: 2px; bottom: 0; left: 0; background-color: #f97316; transition: width 0.3s ease; }
    .nav-menu li a:hover::after { width: 100%; }
</style>

<header style="position: sticky; top: 0; z-index: 1050; width: 100%; display: flex; justify-content: center; background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
    <nav class="navbar" style="width: 100%; max-width: 1200px; margin: 0 auto; box-sizing: border-box; display: flex; align-items: center; padding: 15px 20px;">

        <div class="logo" style="flex: 1;">
            <img src="{{ asset('img/Logo Singspace.png') }}" alt="Logo SingSpace" class="logo-img" style="height: 42px; filter: drop-shadow(0 2px 5px rgba(249,115,22,0.3));">
        </div>

        <ul class="nav-menu" style="display: flex; align-items: center; justify-content: center; list-style: none; margin: 0; padding: 0; gap: 35px; flex: 2;">
            @if(auth()->check() && auth()->user()->role === 'admin')
                <li><a href="{{ route('dashboard') }}" style="color: #e2e8f0; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#e2e8f0'">Dashboard</a></li>
                <li><a href="{{ route('ruangan.index') }}" style="color: #e2e8f0; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#e2e8f0'">Manajemen Ruangan</a></li>
                <li><a href="{{ route('admin.reservasi') }}" style="color: #e2e8f0; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#e2e8f0'">Daftar Reservasi</a></li>
            @else
                <li><a href="{{ url('/') }}" style="color: #e2e8f0; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#e2e8f0'">Beranda</a></li>
                <li><a href="{{ route('ruangan.catalog') }}" style="color: #e2e8f0; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#e2e8f0'">Daftar Ruangan</a></li>
                <li><a href="{{ url('/#tentang') }}" style="color: #e2e8f0; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#e2e8f0'">Tentang Kami</a></li>
                <li><a href="{{ url('/#lokasi') }}" style="color: #e2e8f0; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#e2e8f0'">Kontak</a></li>
                @auth
                    <li><a href="#" onclick="openSidebar(event)" style="color: #e2e8f0; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#e2e8f0'">Pesanan Saya</a></li>
                @endauth
            @endif
        </ul>

        <div style="flex: 1; display: flex; justify-content: flex-end; align-items: center;">
            <button onclick="toggleTheme()" class="desktop-theme-btn" style="background: rgba(249, 115, 22, 0.1); border: 1px solid rgba(249, 115, 22, 0.5); color: #f97316; padding: 8px 18px; border-radius: 20px; cursor: pointer; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; font-weight: bold; font-size: 0.85rem; margin-right: 20px;" onmouseover="this.style.background='#f97316'; this.style.color='#fff';" onmouseout="this.style.background='rgba(249, 115, 22, 0.1)'; this.style.color='#f97316';">
                <i class="fa-solid fa-moon theme-icon-class"></i> <span>Tema</span>
            </button>

            @auth
                <div class="profile-wrapper" style="margin: 0;">

                    <button onclick="toggleProfileMenu(event)" class="profile-avatar">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="Avatar">
                        @else
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        @endif
                    </button>

                    <div id="profileDropdown" class="profile-dropdown">
                        <div class="pd-header">
                            <div class="pd-avatar-large">
                                @if(auth()->user()->foto_profil)
                                    <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="Avatar">
                                @else
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                @endif
                            </div>
                            <div class="pd-info">
                                <h4>{{ auth()->user()->name }}</h4>
                                <p>{{ auth()->user()->email }}</p>
                                <span class="pd-badge"><i class="fa-solid fa-shield-halved"></i> {{ ucfirst(auth()->user()->role) }}</span>
                            </div>
                        </div>

                        <div class="pd-body" style="display: flex; flex-direction: column; gap: 15px; padding: 20px;">
                            <div class="pd-item" style="margin: 0;">
                                <i class="fa-solid fa-calendar-check"></i> Bergabung {{ auth()->user()->created_at->format('d M Y') }}
                            </div>

                            <a href="{{ route('profile.edit') }}" style="text-decoration: none; display: block;">
                                <div class="pd-item" style="margin: 0; padding: 12px; border-radius: 8px; background: rgba(255,255,255,0.05); transition: 0.3s;" onmouseover="this.style.background='rgba(249, 115, 22, 0.1)'; this.style.color='#f97316';" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.color='#cbd5e1';">
                                    <i class="fa-solid fa-user-gear"></i> Informasi Akun Saya
                                </div>
                            </a>

                            <a href="{{ route('preferensi.index') }}" style="text-decoration: none; display: block;">
                                <div class="pd-item" style="margin: 0; padding: 12px; border-radius: 8px; background: rgba(255,255,255,0.05); transition: 0.3s;" onmouseover="this.style.background='rgba(249, 115, 22, 0.1)'; this.style.color='#f97316';" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.color='#cbd5e1';">
                                    <i class="fa-solid fa-sliders"></i> Pengaturan Tampilan
                                </div>
                            </a>
                        </div>
                        <div class="pd-footer">
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="pd-logout-btn">
                                    <i class="fa-solid fa-right-from-bracket"></i> Keluar / Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="desktop-login-btn" style="color: #fff; background: linear-gradient(135deg, #f97316, #ea580c); padding: 8px 24px; border-radius: 20px; text-decoration: none; font-weight: bold; font-size: 0.9rem; transition: 0.3s; box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(249, 115, 22, 0.6)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(249, 115, 22, 0.4)';">
                    <i class="fa-solid fa-right-to-bracket" style="margin-right: 5px;"></i> Masuk
                </a>
            @endauth

            <button class="mobile-menu-btn" onclick="openMobileNav()" style="margin-left: 20px;"><i class="fa-solid fa-bars"></i></button>
        </div>
    </nav>
</header>

<div class="mobile-nav-overlay" id="mobileNavOverlay" onclick="closeMobileNav()"></div>
<div class="mobile-nav-sidebar" id="mobileNavSidebar">
    <div class="mn-header">
        <h3 style="color: #fff; margin: 0; font-size: 1.2rem;">Navigasi</h3>
        <button onclick="closeMobileNav()" style="background: transparent; border: none; color: #cbd5e1; font-size: 1.5rem; cursor: pointer;"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div class="mn-links">
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            <a href="{{ route('ruangan.index') }}"><i class="fa-solid fa-door-open"></i> Manajemen Ruangan</a>
            <a href="{{ route('admin.reservasi') }}"><i class="fa-solid fa-clipboard-list"></i> Daftar Reservasi</a>
        @else
            <a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> Beranda</a>
            <a href="{{ route('ruangan.catalog') }}"><i class="fa-solid fa-border-all"></i> Katalog Ruangan</a>
            <a href="{{ url('/#tentang') }}"><i class="fa-solid fa-circle-info"></i> Tentang Kami</a>
            <a href="{{ url('/#lokasi') }}"><i class="fa-solid fa-address-book"></i> Kontak</a>

            @auth
                <a href="#" onclick="closeMobileNav(); openSidebar(event)"><i class="fa-solid fa-receipt"></i> Pesanan Saya</a>
            @endauth
        @endif

        <div style="border-top: 1px solid #1e293b; margin: 15px 25px;"></div>

        <a href="#" onclick="toggleTheme(); return false;" style="justify-content: space-between;">
            <span style="display: flex; align-items: center; gap: 15px;"><i class="fa-solid fa-moon theme-icon-class"></i> Ganti Tema</span>
        </a>

        @guest
            <div style="padding: 15px 25px; margin-top: 10px;">
                <a href="{{ route('login') }}" style="background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; justify-content: center; border-radius: 12px; border: none; padding: 12px; box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);">
                    <i class="fa-solid fa-right-to-bracket" style="margin-right: 8px;"></i> Masuk
                </a>
            </div>
        @endguest
    </div>
</div>

@auth
    @if(auth()->user()->role !== 'admin')
        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <div id="pesananSidebar" class="pesanan-sidebar">
            <div class="ps-header">
                <h3><i class="fa-solid fa-receipt"></i> Pesanan Saya</h3>
                <button onclick="closeSidebar()" class="ps-close-btn"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
            <div class="ps-body">
                @php
                    $pesanans = \App\Models\Reservasi::with('ruangan')->where('user_id', auth()->id())->latest()->get();
                @endphp

                @forelse($pesanans as $pesanan)
                    <div class="ps-card">
                        <div class="ps-card-header">
                            <span class="ps-code"><i class="fa-regular fa-copy"></i> BKG-{{ str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}</span>
                            @if($pesanan->status == 'pending')
                                <span class="ps-status st-pending">Pending</span>
                            @elseif($pesanan->status == 'confirmed')
                                <span class="ps-status st-confirmed">Confirmed</span>
                            @else
                                <span class="ps-status st-batal">Batal</span>
                            @endif
                        </div>

                        <div class="ps-detail-row">
                            <i class="fa-solid fa-location-dot"></i>
                            <div>
                                <span class="ps-room-name">{{ $pesanan->ruangan->nama }}</span>
                            </div>
                        </div>
                        <div class="ps-detail-row">
                            <i class="fa-regular fa-calendar"></i>
                            <span>{{ date('d M Y', strtotime($pesanan->tanggal)) }}</span>
                        </div>
                        <div class="ps-detail-row">
                            <i class="fa-regular fa-clock"></i>
                            <span>{{ date('H:i', strtotime($pesanan->jam_mulai)) }} - {{ date('H:i', strtotime($pesanan->jam_selesai)) }} ({{ $pesanan->durasi }} Jam)</span>
                        </div>

                        <div class="ps-card-footer">
                            <span class="ps-price">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 40px 20px;">
                        <i class="fa-solid fa-box-open" style="font-size: 3rem; color: #334155; margin-bottom: 15px;"></i>
                        <h4 style="color: #fff; margin-bottom: 5px;">Belum Ada Pesanan</h4>
                        <p style="color: #64748b; font-size: 0.9rem;">Anda belum melakukan reservasi ruangan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endif
@endauth

<script>
    function openMobileNav() {
        document.getElementById('mobileNavOverlay').classList.add('show');
        document.getElementById('mobileNavSidebar').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeMobileNav() {
        document.getElementById('mobileNavOverlay').classList.remove('show');
        document.getElementById('mobileNavSidebar').classList.remove('open');
        document.body.style.overflow = 'auto';
    }
    function toggleTheme() {
        let html = document.documentElement;
        let icons = document.querySelectorAll('.theme-icon-class');

        if (html.classList.contains('dark')) {
            html.classList.remove('dark');
            setCookie('theme', 'light', 30);
            icons.forEach(icon => {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            });
        } else {
            html.classList.add('dark');
            setCookie('theme', 'dark', 30);
            icons.forEach(icon => {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            });
        }
    }
    // SINKRONISASI ICON SAAT LOAD (FIX BUG FATAL ICON TERTUMPUK)
    document.addEventListener('DOMContentLoaded', () => {
        let icons = document.querySelectorAll('.theme-icon-class');
        if(document.documentElement.classList.contains('dark')) {
            icons.forEach(icon => {
                icon.classList.remove('fa-sun');  // Wajib hapus matahari
                icon.classList.add('fa-moon');    // Baru pasang bulan
            });
        } else {
            icons.forEach(icon => {
                icon.classList.remove('fa-moon'); // Wajib hapus bulan
                icon.classList.add('fa-sun');     // Baru pasang matahari
            });
        }
    });

    function toggleProfileMenu(event) {
        event.stopPropagation();
        document.getElementById('profileDropdown').classList.toggle('show');
    }
    function openSidebar(event) {
        event.preventDefault();
        document.getElementById('sidebarOverlay').classList.add('show');
        document.getElementById('pesananSidebar').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        document.getElementById('sidebarOverlay').classList.remove('show');
        document.getElementById('pesananSidebar').classList.remove('open');
        document.body.style.overflow = 'auto';
    }
    window.onclick = function(event) {
        if (!event.target.matches('.profile-avatar') && !event.target.closest('.profile-avatar')) {
            var dropdowns = document.getElementsByClassName("profile-dropdown");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
