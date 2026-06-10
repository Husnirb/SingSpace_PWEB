<div class="footer-wrapper" style="width: 100%; display: flex; flex-direction: column; align-items: center; background-color: #1e293b; border-top: 1px solid #334155; margin-top: auto;">

    <footer class="footer" style="width: 100%; max-width: 1200px; margin: 0 auto; background: transparent; border: none; box-sizing: border-box; padding: 50px 20px 30px 20px; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 30px;">

        <div class="footer-col" style="flex: 1; min-width: 250px;">
            <img src="{{ asset('img/Logo Singspace.png') }}" alt="Logo SingSpace" style="height: 45px; margin-bottom: 15px; filter: drop-shadow(0 2px 5px rgba(249,115,22,0.3));">
            <p class="footer-text" style="color: #94a3b8; font-size: 0.95rem; line-height: 1.6; margin: 0;">Destinasi hiburan premium untuk momen bernyanyi tak terlupakan. SingSpace menghadirkan ruang karaoke eksklusif dengan privasi maksimal.</p>
        </div>

        <div class="footer-col" style="flex: 1; min-width: 200px;">
            <h4 style="color: #fff; font-size: 1.1rem; margin-bottom: 15px; font-weight: bold;">Navigasi</h4>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <li><a href="{{ route('dashboard') }}" class="footer-link" style="color: #94a3b8; text-decoration: none; transition: 0.3s; font-size: 0.95rem;">Dashboard Sistem</a></li>
                    <li><a href="{{ route('ruangan.index') }}" class="footer-link" style="color: #94a3b8; text-decoration: none; transition: 0.3s; font-size: 0.95rem;">Manajemen Ruangan</a></li>
                    <li><a href="{{ route('admin.reservasi') }}" class="footer-link" style="color: #94a3b8; text-decoration: none; transition: 0.3s; font-size: 0.95rem;">Daftar Reservasi Masuk</a></li>
                @else
                    <li><a href="{{ url('/') }}" class="footer-link" style="color: #94a3b8; text-decoration: none; transition: 0.3s; font-size: 0.95rem;">Beranda</a></li>
                    <li><a href="{{ route('ruangan.catalog') }}" class="footer-link" style="color: #94a3b8; text-decoration: none; transition: 0.3s; font-size: 0.95rem;">Katalog Ruangan</a></li>
                    <li><a href="{{ url('/#tentang') }}" class="footer-link" style="color: #94a3b8; text-decoration: none; transition: 0.3s; font-size: 0.95rem;">Tentang Kami</a></li>
                    <li><a href="{{ url('/#lokasi') }}" class="footer-link" style="color: #94a3b8; text-decoration: none; transition: 0.3s; font-size: 0.95rem;">Kontak Bantuan</a></li>
                @endif
            </ul>
        </div>

        <div class="footer-col" style="flex: 1; min-width: 250px;">
            <h4 style="color: #fff; font-size: 1.1rem; margin-bottom: 15px; font-weight: bold;">Hubungi Kami</h4>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                <li class="footer-text" style="color: #94a3b8; font-size: 0.95rem; display: flex; align-items: flex-start; gap: 10px;"><i class="fa-solid fa-location-dot" style="color: #f97316; margin-top: 3px;"></i> Jl. Moh. Yamin No. 5, Tegal Besar, Jember</li>
                <li class="footer-text" style="color: #94a3b8; font-size: 0.95rem; display: flex; align-items: center; gap: 10px;"><i class="fa-solid fa-phone" style="color: #f97316;"></i> +62 812 4684 1249</li>
                <li class="footer-text" style="color: #94a3b8; font-size: 0.95rem; display: flex; align-items: center; gap: 10px;"><i class="fa-solid fa-envelope" style="color: #f97316;"></i> singspace@gmail.com</li>
            </ul>
        </div>
    </footer>

    <div class="footer-bottom-wrapper" style="width: 100%; background-color: #0b1120; padding: 18px 20px; border-top: 1px solid rgba(255,255,255,0.05); text-align: center; box-sizing: border-box; margin: 0;">
        <p class="copyright-text" style="color: #94a3b8; font-size: 0.9rem; margin: 0; letter-spacing: 0.5px;">&copy; 2026 SingSpace Karaoke. All rights reserved.</p>
    </div>

</div>
