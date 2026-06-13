@extends('layouts.app')

@section('content')
<style>
    /* =======================================
       SINGSPACE PREMIUM CATALOG STYLES
       ======================================= */
    .pilih-container { background-color: #0f172a; min-height: 100vh; padding: 80px 5%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

    .pilih-header { text-align: center; margin-bottom: 40px; }
    .pilih-header h1 { color: #fff; font-size: 2.8rem; font-weight: 900; margin-bottom: 10px; letter-spacing: 1px; }
    .pilih-header span { color: #f97316; text-shadow: 0 0 15px rgba(249, 115, 22, 0.4); }
    .pilih-header p { color: #94a3b8; font-size: 1.1rem; }

    .pilih-room-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 35px; max-width: 1200px; margin: 0 auto; }

    /* 1. ANIMASI KARTU UTAMA */
    .pilih-room-card { background: #1e293b; border: 1px solid #334155; border-radius: 20px; overflow: hidden; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 10px 25px rgba(0,0,0,0.3); display: flex; flex-direction: column; cursor: pointer;}
    .pilih-room-card:hover { transform: translateY(-5px); border-color: #f97316; box-shadow: 0 20px 50px rgba(249, 115, 22, 0.15); }

    /* 2. ANIMASI GAMBAR */
    .pilih-room-img-wrap { margin: 0; padding: 0; height: 230px; background: #0f172a; position: relative; display: flex; justify-content: center; align-items: center; border-bottom: 1px solid #334155; overflow: hidden; }
    .pilih-room-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
    .pilih-room-card:hover .pilih-room-img-wrap img { transform: scale(1.1); }

    /* Lencana Tipe */
    .pilih-room-badge { position: absolute; top: 18px; right: 18px; background: rgba(249, 115, 22, 0.9); backdrop-filter: blur(5px); color: #fff; padding: 7px 18px; border-radius: 30px; font-weight: 800; font-size: 0.8rem; box-shadow: 0 5px 15px rgba(0,0,0,0.3); text-transform: uppercase; letter-spacing: 1px; z-index: 2; }

    /* Bagian Teks Detail */
    .pilih-room-details { padding: 30px; flex: 1; display: flex; flex-direction: column; }
    .pilih-room-title { color: #fff; font-size: 1.5rem; margin: 0 0 12px 0; font-weight: 800; }
    .pilih-room-desc { color: #94a3b8; font-size: 0.95rem; margin-bottom: 30px; line-height: 1.7; flex: 1; }

    /* Statistik & Harga */
    .pilih-room-stats { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; border-top: 1px solid #334155; padding-top: 25px; }
    .pilih-stat-label { display: block; color: #64748b; font-size: 0.8rem; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px; font-weight: bold;}
    .pilih-price-val { color: #f97316; font-size: 1.4rem; font-weight: 900; text-shadow: 0 0 10px rgba(249, 115, 22, 0.3); }
    .pilih-price-unit { color: #94a3b8; font-size: 0.95rem; font-weight: normal; margin-left: 3px;}
    .pilih-cap-val { color: #fff; font-size: 1.2rem; font-weight: bold; }

    /* 3. ANIMASI TOMBOL BOOKING OREN */
    .pilih-btn-book { display: block; width: 100%; text-align: center; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; padding: 18px; border-radius: 12px; text-decoration: none; font-weight: 800; font-size: 1.1rem; transition: all 0.3s ease; border: none; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; position: relative; overflow: hidden; z-index: 1;}
    .pilih-btn-book:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(249, 115, 22, 0.5); color: #fff; }
    .pilih-btn-book::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); transition: 0.5s; z-index: -1;}
    .pilih-btn-book:hover::before { left: 100%; }

    /* 4. TOMBOL MAINTENANCE (DISABLE) */
    .pilih-btn-disabled { display: block; width: 100%; text-align: center; background: #334155; color: #94a3b8; padding: 18px; border-radius: 12px; font-weight: 800; font-size: 1.1rem; border: 1px solid #475569; cursor: not-allowed; text-transform: uppercase; letter-spacing: 1px; }

    /* Loading Spinner Styles */
    .search-loading-container { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 60px 20px; color: #94a3b8; grid-column: 1 / -1; }
</style>

<main class="pilih-container">

    <header class="pilih-header">
        <h1>Pilih Ruang <span>Karaokemu</span></h1>
        <p>Fasilitas premium untuk pengalaman bernyanyi kelas dunia.</p>
    </header>

    <section style="max-width: 800px; margin: 0 auto 50px auto; padding: 0 20px;" aria-label="Pencarian Ruangan">
        <div style="position: relative;">
            <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 20px; top: 18px; color: #f97316; font-size: 1.2rem;" aria-hidden="true"></i>

            <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">

            <input type="text" id="live-search-input" aria-label="Ketik nama atau tipe ruangan" placeholder="Cari ruangan... (Ketik 'Family' atau 'VIP')" style="width: 100%; padding: 15px 15px 15px 55px; border-radius: 12px; border: 2px solid #334155; background-color: #1e293b; color: #fff; font-size: 1.05rem; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='#f97316'" onblur="this.style.borderColor='#334155'">
        </div>
    </section>

    <div id="search-loading" style="display: none; max-width: 1200px; margin: 0 auto;">
        <div class="search-loading-container">
            <i class="fa-solid fa-spinner fa-spin" style="font-size: 3rem; color: #f97316; margin-bottom: 20px;"></i>
            <h3 style="margin: 0; color: #cbd5e1;">Mencari Ruangan...</h3>
            <p>Mohon tunggu sebentar.</p>
        </div>
    </div>

    <section class="pilih-room-grid" id="original-grid" aria-label="Katalog Ruangan Utama">
        @forelse($ruangans as $ruangan)
        <article class="pilih-room-card">

            <figure class="pilih-room-img-wrap">
                @if($ruangan->foto)
                    <img src="{{ asset('storage/' . $ruangan->foto) }}" alt="Foto Ruangan {{ $ruangan->nama }}">
                @else
                    <i class="fa-solid fa-image" style="font-size: 5rem; color: #334155;"></i>
                @endif
                <span class="pilih-room-badge">{{ $ruangan->tipe }}</span>
            </figure>

            <div class="pilih-room-details">
                <h3 class="pilih-room-title">{{ $ruangan->nama }}</h3>
                <p class="pilih-room-desc">{{ Str::limit($ruangan->deskripsi ?? 'Ruangan eksklusif dengan sistem audio berkualitas tinggi, pencahayaan LED premium, dan peredam suara kelas studio.', 120) }}</p>

                <div class="pilih-room-stats">
                    <div>
                        <span class="pilih-stat-label">Harga Mulai</span>
                        <span class="pilih-price-val">Rp {{ number_format($ruangan->harga, 0, ',', '.') }}</span><span class="pilih-price-unit"> / Jam</span>
                    </div>
                    <div style="text-align: right;">
                        <span class="pilih-stat-label">Kapasitas</span>
                        <span class="pilih-cap-val"><i class="fa-solid fa-user-group" style="margin-right: 7px; color: #cbd5e1;"></i> {{ $ruangan->kapasitas }}</span><span class="pilih-price-unit"> Orang</span>
                    </div>
                </div>

                @if($ruangan->is_aktif == 0)
                    <div class="pilih-btn-disabled"><i class="fa-solid fa-tools" style="margin-right: 8px;"></i> Sedang Perbaikan</div>
                @else
                    <a href="{{ route('booking.create', $ruangan->id) }}" class="pilih-btn-book">Booking Sekarang</a>
                @endif
            </div>

        </article>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; color: #94a3b8; padding: 100px; font-size: 1.2rem;">Belum ada ruangan yang tersedia saat ini.</div>
        @endforelse
    </section>

    <section class="pilih-room-grid" id="search-grid" style="display: none;" aria-label="Hasil Pencarian Ruangan">
    </section>
</main>

<script>
    const searchInput = document.getElementById('live-search-input');
    const originalGrid = document.getElementById('original-grid');
    const searchGrid = document.getElementById('search-grid');
    const loadingIndicator = document.getElementById('search-loading');
    const csrfToken = document.getElementById('csrf_token').value;

    const bookingRoute = "{{ route('booking.create', ':id') }}";

    // Timer untuk membatasi request API (Debounce) agar tidak memberatkan server saat user mengetik cepat
    let searchTimeout;

    searchInput.addEventListener('keyup', function() {
        clearTimeout(searchTimeout);
        let keyword = this.value;

        if(keyword.length === 0) {
            originalGrid.style.display = 'grid';
            searchGrid.style.display = 'none';
            loadingIndicator.style.display = 'none';
            searchGrid.innerHTML = '';
            return;
        }

        // Tampilkan Loading Indicator & Sembunyikan Grid
        originalGrid.style.display = 'none';
        searchGrid.style.display = 'none';
        loadingIndicator.style.display = 'block';

        searchTimeout = setTimeout(async () => {
            try {
                const response = await fetch("{{ route('ruangan.search') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ keyword: keyword })
                });

                if (!response.ok) throw new Error("Gagal terhubung ke server");

                const data = await response.json();

                // Matikan Loading, Tampilkan Grid Hasil
                loadingIndicator.style.display = 'none';
                searchGrid.style.display = 'grid';
                searchGrid.innerHTML = '';

                if(data.length > 0) {
                    data.forEach(ruangan => {
                        let hargaFormat = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(ruangan.harga);

                        let imgHtml = ruangan.foto
                            ? `<img src="/storage/${ruangan.foto}" alt="Foto Ruangan ${ruangan.nama}">`
                            : `<i class="fa-solid fa-image" style="font-size: 5rem; color: #334155;"></i>`;

                        let url = bookingRoute.replace(':id', ruangan.id);

                        let btnHtml = '';
                        if(ruangan.is_aktif == 0 || ruangan.is_aktif === false) {
                            btnHtml = `<div class="pilih-btn-disabled"><i class="fa-solid fa-tools" style="margin-right: 8px;"></i> Sedang Perbaikan</div>`;
                        } else {
                            btnHtml = `<a href="${url}" class="pilih-btn-book">Booking Sekarang</a>`;
                        }

                        // Hasil AJAX tetap di-generate menggunakan HTML5 Semantic (Article & Figure)
                        searchGrid.innerHTML += `
                            <article class="pilih-room-card">
                                <figure class="pilih-room-img-wrap">
                                    ${imgHtml}
                                    <span class="pilih-room-badge" style="background: #10b981;">Hasil Pencarian: ${ruangan.tipe}</span>
                                </figure>
                                <div class="pilih-room-details">
                                    <h3 class="pilih-room-title">${ruangan.nama}</h3>
                                    <p class="pilih-room-desc">Ruangan eksklusif dengan sistem audio berkualitas tinggi, pencahayaan LED premium, dan peredam suara kelas studio.</p>
                                    <div class="pilih-room-stats">
                                        <div>
                                            <span class="pilih-stat-label">Harga Mulai</span>
                                            <span class="pilih-price-val">${hargaFormat}</span><span class="pilih-price-unit"> / Jam</span>
                                        </div>
                                        <div style="text-align: right;">
                                            <span class="pilih-stat-label">Kapasitas</span>
                                            <span class="pilih-cap-val"><i class="fa-solid fa-user-group" style="margin-right: 7px; color: #cbd5e1;"></i> ${ruangan.kapasitas}</span><span class="pilih-price-unit"> Orang</span>
                                        </div>
                                    </div>
                                    ${btnHtml}
                                </div>
                            </article>
                        `;
                    });
                } else {
                    searchGrid.innerHTML = `
                        <div style="grid-column: 1 / -1; text-align: center; color: #ef4444; padding: 60px; background: rgba(239, 68, 68, 0.1); border-radius: 20px; border: 1px dashed #ef4444;">
                            <i class="fa-solid fa-face-frown-open" style="font-size: 4rem; margin-bottom: 20px;"></i>
                            <h2 style="margin:0;">Ruangan "${keyword}" tidak ditemukan!</h2>
                            <p style="color: #94a3b8; margin-top: 10px;">Coba gunakan kata kunci lain seperti "VIP", "Family", atau "VVIP".</p>
                        </div>
                    `;
                }
            } catch (error) {
                // Error Handling AJAX
                loadingIndicator.style.display = 'none';
                searchGrid.style.display = 'grid';
                searchGrid.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; color: #f59e0b; padding: 60px; background: rgba(245, 158, 11, 0.1); border-radius: 20px; border: 1px dashed #f59e0b;">
                        <i class="fa-solid fa-wifi" style="font-size: 4rem; margin-bottom: 20px;"></i>
                        <h2 style="margin:0;">Gagal Terhubung ke Server</h2>
                        <p style="color: #94a3b8; margin-top: 10px;">Terjadi kesalahan saat memproses pencarian. Pastikan koneksi internet Anda stabil.</p>
                    </div>
                `;
            }
        }, 500); // 500ms delay untuk memberikan efek natural dan meringankan load database
    });
</script>
@endsection
