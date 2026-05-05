@extends('layouts.app')

@section('title', 'Dashboard - SingSpace Karaoke')

@section('content')

<section class="hero">
    <div class="hero-content">
        <h1><span class="text-white">SingSpace</span> Karaoke</h1>
        <p class="hero-desc">
            Jadikan setiap momen bernyanyimu lebih spektakuler di SingSpace! Nikmati atmosfer hiburan kelas atas dengan privasi maksimal di ruang VIP dan VVIP eksklusif kami. Amankan tempatmu hanya dalam hitungan detik.
            Pesan sekarang dan mulai bernyanyi!
        </p>
        <button class="cta-btn">Booking Sekarang</button>
    </div>
</section>

<div class="container">

    <aside class="sidebar">
        <h3 class="sidebar-title">🔍 Filter Reservasi</h3>
        <div class="filter-group">
            <label class="label-text" style="color: var(--text-muted); margin-bottom: 5px; display: block;">Ruangan:</label>
            <select id="filterRuangan" style="margin-bottom: 15px; padding: 8px; border-radius: 6px; background: var(--bg-deep-navy); color: white; border: 1px solid var(--border-color); width: 100%;">
                <option value="All">Semua Ruangan</option>
                <option value="regular">Regular Room</option>
                <option value="family">Family Room</option>
                <option value="vip">VIP Room</option>
                <option value="vvip">VVIP Room</option>
            </select>

            <label class="label-text" style="color: var(--text-muted); margin-bottom: 5px; display: block;">Status:</label>
            <select id="filterStatus" style="padding: 8px; border-radius: 6px; background: var(--bg-deep-navy); color: white; border: 1px solid var(--border-color); width: 100%;">
                <option value="All">Semua Status</option>
                <option value="Pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

<h3 class="sidebar-title mt-4">📊 Statistik Hari Ini</h3>
        <div class="stat-grid">
            <x-stat-card judul="Total Reservasi" nilai="6" ikon='<i class="fa-solid fa-clipboard-list"></i>' />
            <x-stat-card judul="Confirmed" nilai="2" ikon='<i class="fa-solid fa-square-check"></i>' warna="#10B981" />
            <x-stat-card judul="Pending" nilai="4" ikon='<i class="fa-solid fa-hourglass-half"></i>' warna="var(--primary-orange)" />
            <x-stat-card judul="VIP VVIP" nilai="2" ikon='<i class="fa-solid fa-crown"></i>' warna="var(--primary-orange)" />
        </div>
    </aside>

    <main class="content">

<section class="room-section">
            <h2>Daftar Ruangan</h2>
            <div class="room-grid">
                @forelse ($daftarRuangan as $ruang)
                    <div class="room-card" style="display: flex; flex-direction: column; gap: 8px;">
                        <h4 style="margin: 0; font-size: 1.1rem;">{{ $ruang['nama'] }}</h4>

                        <div style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.6;">
                            <i class="fa-solid fa-users" style="width: 20px;"></i> {{ $ruang['kapasitas'] }} <br>
                            <i class="fa-solid fa-tag" style="width: 20px;"></i> <span style="color: var(--primary-orange); font-weight: 600;">{{ $ruang['harga'] }}</span>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: span 4; text-align: center; padding: 20px; border: 1px dashed var(--border-color); border-radius: 8px; color: var(--text-muted);">
                        <i class="fa-solid fa-face-frown-open" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <p>Wah, saat ini belum ada data ruangan yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="form-section">
            <h2>Form Reservasi</h2>
            <form class="booking-form" id="bookingForm">
                <div id="errorMessages" style="color: #ff4d4d; margin-bottom: 15px; font-size: 0.9rem; font-weight: 500;"></div>

                <input type="hidden" id="editId" value="">

                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="telepon">Nomor Telepon</label>
                    <input type="tel" id="telepon" name="telepon" required>
                </div>

                <div class="form-group">
                    <label for="ruangan">Ruangan</label>
                    <select id="ruangan" name="ruangan" required>
                        <option value="">-- Pilih Ruangan --</option>
                        <option value="regular">Regular Room</option>
                        <option value="family">Family Room</option>
                        <option value="vip">VIP Room</option>
                        <option value="vvip">VVIP Room</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" required>
                </div>

                <div class="form-group">
                    <label for="jam">Jam</label>
                    <input type="time" id="jam" name="jam" required>
                </div>

                <div class="form-group">
                    <label for="durasi">Durasi (Jam)</label>
                    <input type="number" id="durasi" name="durasi" min="1" required>
                </div>

                <div class="form-group">
                    <label for="catatan">Catatan (Opsional)</label>
                    <textarea id="catatan" name="catatan"></textarea>
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" id="btnSubmit" class="cta-btn" style="flex: 1;">Booking Sekarang</button>
                    <button type="button" id="btnCancelEdit" class="cta-btn" style="background-color: var(--border-color); display: none;">Batal Edit</button>
                </div>
            </form>
        </section>

        <section class="table-section">
            <h2>Data Reservasi</h2>
            <form class="search-form" id="searchForm" style="display: flex; gap: 10px; margin-bottom: 20px;">
                <input type="text" id="searchInput" placeholder="Cari nama pemesan atau ruangan..." style="flex: 1; padding: 12px; background: var(--bg-deep-navy); color: white; border: 1px solid var(--border-color); border-radius: 6px;">
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                </tbody>
            </table>
        </section>

    </main>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const targetStats = {
            'statTotalReservasi': 13,
            'statConfirmed': 8,
            'statPending': 5,
            'statVIPVVIP': 2
        };

        for (let id in targetStats) {
            let element = document.getElementById(id);
            if (element) {
                let current = 0;
                let target = targetStats[id];
                let increment = target / 50;

                let timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        element.innerText = target;
                        clearInterval(timer);
                    } else {
                        element.innerText = Math.ceil(current);
                    }
                }, 20);
            }
        }

        const filterRuangan = document.getElementById('filterRuangan');
        const roomCards = document.querySelectorAll('.room-card');

        if (filterRuangan) {
            filterRuangan.addEventListener('change', function() {
                const filterValue = this.value.toLowerCase();

                roomCards.forEach(card => {
                    const roomName = card.querySelector('h4').innerText.toLowerCase();

                    if (filterValue === 'all' || roomName.includes(filterValue)) {
                        card.style.display = 'flex';
                        card.style.opacity = '0';

                        setTimeout(() => {
                            card.style.transition = 'opacity 0.4s ease-in';
                            card.style.opacity = '1';
                        }, 50);
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endpush
