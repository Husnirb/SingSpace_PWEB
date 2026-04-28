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
            <div class="stat-box">
                <span class="stat-value" id="statTotal">0</span>
                <span class="stat-label">Total Reservasi</span>
            </div>
            <div class="stat-box">
                <span class="stat-value" id="statConfirmed">0</span>
                <span class="stat-label">Confirmed</span>
            </div>
            <div class="stat-box ready-vip">
                <span class="stat-value text-orange" id="statPending">0</span>
                <span class="stat-label">Pending</span>
            </div>
            <div class="stat-box ready-vvip">
                <span class="stat-value text-orange" id="statVipVvip">0</span>
                <span class="stat-label">VIP/VVIP</span>
            </div>
        </div>
    </aside>

    <main class="content">

        <section class="room-section">
            <h2>Daftar Ruangan</h2>
            <div class="room-grid">
                <div class="room-card">Regular Room</div>
                <div class="room-card">Family Room</div>
                <div class="room-card">VIP Room</div>
                <div class="room-card">VVIP Room</div>
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
