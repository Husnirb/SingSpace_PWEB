<style>
    /* =========================================
       CSS NAV MENU & DROPDOWN PROFIL (Tetap Sama)
       ========================================= */
    .profile-wrapper { position: relative; margin-left: 20px; display: flex; align-items: center; }
    .profile-avatar { width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; font-weight: 800; font-size: 1.1rem; border: 2px solid #334155; display: flex; justify-content: center; align-items: center; cursor: pointer; transition: 0.3s; padding: 0; }
    .profile-avatar:hover { transform: scale(1.05); border-color: #f97316; box-shadow: 0 0 15px rgba(249, 115, 22, 0.4); }
    .profile-dropdown { position: absolute; top: 60px; right: 0; width: 300px; background: #1e293b; border: 1px solid #334155; border-radius: 16px; box-shadow: 0 15px 35px rgba(0,0,0,0.5); opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s ease; z-index: 999; overflow: hidden; }
    .profile-dropdown.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .pd-header { padding: 25px 20px; background: rgba(15, 23, 42, 0.5); border-bottom: 1px solid #334155; display: flex; align-items: center; gap: 15px; }
    .pd-header .pd-avatar-large { width: 55px; height: 55px; border-radius: 50%; background: #0f172a; color: #f97316; font-weight: 900; font-size: 1.5rem; display: flex; justify-content: center; align-items: center; border: 2px solid #f97316; flex-shrink: 0;}
    .pd-info h4 { color: #fff; margin: 0 0 5px 0; font-size: 1.1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px; }
    .pd-info p { color: #94a3b8; margin: 0 0 8px 0; font-size: 0.85rem; }
    .pd-badge { background: rgba(249, 115, 22, 0.2); color: #f97316; padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; border: 1px solid rgba(249, 115, 22, 0.5);}
    .pd-body { padding: 20px; border-bottom: 1px solid #334155; }
    .pd-item { display: flex; align-items: center; gap: 15px; color: #cbd5e1; margin-bottom: 15px; font-size: 0.9rem; }
    .pd-item:last-child { margin-bottom: 0; }
    .pd-item i { color: #64748b; font-size: 1.1rem; width: 20px; text-align: center; }
    .pd-footer { padding: 15px 20px; background: rgba(15, 23, 42, 0.3); }
    .pd-logout-btn { width: 100%; background: transparent; border: none; color: #ef4444; text-align: left; padding: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer; border-radius: 8px; transition: 0.3s; display: flex; align-items: center; gap: 10px; }
    .pd-logout-btn:hover { background: rgba(239, 68, 68, 0.1); color: #f87171; }

    /* =========================================
       CSS KHUSUS SIDEBAR PESANAN SAYA
       ========================================= */
    .sidebar-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1000; opacity: 0; visibility: hidden; transition: 0.3s; backdrop-filter: blur(3px); }
    .sidebar-overlay.show { opacity: 1; visibility: visible; }

    .pesanan-sidebar { position: fixed; top: 0; right: -450px; width: 100%; max-width: 450px; height: 100vh; background: #0f172a; z-index: 1001; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: -10px 0 30px rgba(0,0,0,0.5); display: flex; flex-direction: column; border-left: 1px solid #1e293b; }
    .pesanan-sidebar.open { right: 0; }

    .ps-header { padding: 25px; border-bottom: 1px solid #1e293b; display: flex; justify-content: space-between; align-items: center; background: #1e293b; }
    .ps-header h3 { color: #fff; margin: 0; font-size: 1.2rem; display: flex; align-items: center; gap: 10px; }
    .ps-header h3 i { color: #f97316; }
    .ps-close-btn { background: transparent; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer; transition: 0.3s; }
    .ps-close-btn:hover { color: #ef4444; transform: rotate(90deg); }

    .ps-body { padding: 25px; overflow-y: auto; flex: 1; }

    /* Card Pesanan ala Treebox */
    .ps-card { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 20px; margin-bottom: 20px; transition: 0.3s; }
    .ps-card:hover { border-color: #f97316; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }

    .ps-card-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #334155; padding-bottom: 12px; margin-bottom: 12px; }
    .ps-code { color: #94a3b8; font-size: 0.85rem; font-family: monospace; }
    .ps-status { padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: bold; text-transform: uppercase; }
    .st-pending { background: rgba(249, 115, 22, 0.1); color: #f97316; border: 1px solid rgba(249, 115, 22, 0.3); }
    .st-confirmed { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
    .st-batal { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }

    .ps-detail-row { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 8px; color: #cbd5e1; font-size: 0.9rem; }
    .ps-detail-row i { color: #64748b; margin-top: 3px; width: 16px; text-align: center; }
    .ps-room-name { color: #fff; font-weight: bold; font-size: 1.05rem; display: block; margin-bottom: 2px;}

    .ps-card-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 15px; padding-top: 15px; border-top: 1px solid #334155; }
    .ps-method { color: #64748b; font-size: 0.85rem; text-transform: uppercase; font-weight: bold;}
    .ps-price { color: #fff; font-weight: bold; font-size: 1.1rem; }
</style>

<header style="width: 100%; display: flex; justify-content: center; background-color: var(--bg-deep-navy, #0F172A); border-bottom: 1px solid var(--border-color, #1E293B);">
    <nav class="navbar" style="width: 100%; max-width: 1200px; margin: 0 auto; box-sizing: border-box; display: flex; align-items: center; padding: 15px 20px;">

        <div class="logo" style="flex: 1;">
            <img src="{{ asset('img/Logo Singspace.png') }}" alt="Logo SingSpace" class="logo-img" style="height: 40px;">
        </div>

        <ul class="nav-menu" style="display: flex; align-items: center; justify-content: center; list-style: none; margin: 0; padding: 0; gap: 35px; flex: 2;">

            @if(auth()->check() && auth()->user()->role === 'admin')
                <li><a href="{{ route('dashboard') }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#cbd5e1'">Dashboard</a></li>
                <li><a href="{{ route('ruangan.index') }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#cbd5e1'">Manajemen Ruangan</a></li>
                <li><a href="{{ route('admin.reservasi') }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#cbd5e1'">Daftar Reservasi</a></li>
            @else
                <li><a href="{{ url('/') }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#cbd5e1'">Beranda</a></li>
                <li><a href="{{ route('ruangan.catalog') }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#cbd5e1'">Daftar Ruangan</a></li>
                <li><a href="{{ url('/#tentang') }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#cbd5e1'">Tentang Kami</a></li>
                <li><a href="{{ url('/#lokasi') }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#cbd5e1'">Kontak</a></li>

                @auth
                    <li><a href="#" onclick="openSidebar(event)" style="color: #10b981; font-weight: bold; text-decoration: none;">Pesanan Saya</a></li>
                @endauth
            @endif

        </ul>

        <div style="flex: 1; display: flex; justify-content: flex-end; align-items: center;">

            <button onclick="toggleTheme()" id="theme-btn" style="background: transparent; border: 1px solid #f97316; color: #f97316; padding: 6px 15px; border-radius: 20px; cursor: pointer; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; font-weight: bold; font-size: 0.85rem; margin-right: 15px;">
                <i class="fa-solid fa-moon" id="theme-icon"></i> <span id="theme-text">Tema</span>
            </button>

            @auth
                <div class="profile-wrapper" style="margin: 0;">
                    <button onclick="toggleProfileMenu(event)" class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </button>

                    <div id="profileDropdown" class="profile-dropdown">
                        <div class="pd-header">
                            <div class="pd-avatar-large">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                            <div class="pd-info">
                                <h4>{{ auth()->user()->name }}</h4>
                                <p>{{ auth()->user()->email }}</p>
                                <span class="pd-badge"><i class="fa-solid fa-shield-halved"></i> {{ ucfirst(auth()->user()->role) }}</span>
                            </div>
                        </div>
                        <div class="pd-body" style="display: flex; flex-direction: column; gap: 15px;">

                            <div class="pd-item" style="margin: 0;">
                                <i class="fa-solid fa-calendar-check"></i> Bergabung {{ auth()->user()->created_at->format('d M Y') }}
                            </div>

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
                {{-- <a href="{{ route('login') }}" style="color: #fff; background: #f97316; padding: 8px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 0.9rem; transition: 0.3s;">Login</a> --}}
            @endauth
        </div>

    </nav>
</header>

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
                            <span class="ps-method">{{ $pesanan->metode_pembayaran }}</span>
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
    // TUGAS 3C: Script Toggle Dark Mode
    function toggleTheme() {
        let html = document.documentElement;
        let icon = document.getElementById('theme-icon');

        if (html.classList.contains('dark')) {
            html.classList.remove('dark');
            setCookie('theme', 'light', 30);
            icon.classList.replace('fa-moon', 'fa-sun');
        } else {
            html.classList.add('dark');
            setCookie('theme', 'dark', 30);
            icon.classList.replace('fa-sun', 'fa-moon');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        let icon = document.getElementById('theme-icon');
        if(document.documentElement.classList.contains('dark')) {
            icon.classList.add('fa-moon');
        } else {
            icon.classList.add('fa-sun');
        }
    });

    // Script Sidebar dan Dropdown (Tetap sama)
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
        if (!event.target.matches('.profile-avatar')) {
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
