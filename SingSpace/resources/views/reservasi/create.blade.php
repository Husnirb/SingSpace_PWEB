@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* =======================================
       SINGSPACE BOOKING WIZARD STYLES (ORIGINAL)
       ======================================= */
    .wizard-page {
        min-height: 100vh;
        padding: 80px 5% 50px 5%;
        background-color: #f8fafc; /* Light Mode BG */
        transition: background-color 0.3s;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .wizard-container {
        max-width: 700px;
        margin: 0 auto;
        background: #ffffff; /* Light Mode Card */
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        transition: all 0.3s;
    }

    /* Stepper */
    .stepper { display: flex; justify-content: center; margin-bottom: 40px; gap: 20px; align-items: center; }
    .step-circle { width: 40px; height: 40px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 1.2rem; transition: 0.3s; }
    .step-line { height: 2px; width: 40px; background: #e2e8f0; transition: 0.3s;}
    .step-circle.active { background: #f97316; color: #fff; box-shadow: 0 0 15px rgba(249, 115, 22, 0.5); }

    /* Form Elements */
    .step-content { display: none; animation: fadeIn 0.4s ease; }
    .step-content.active { display: block; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    .step-title { color: #0f172a; font-size: 1.5rem; margin-top: 0; margin-bottom: 5px; transition: color 0.3s; font-weight: bold;}
    .step-subtitle { color: #64748b; font-size: 0.95rem; margin-bottom: 25px; transition: color 0.3s; }

    .form-group { margin-bottom: 20px; }
    .sp-label { display: block; color: #475569; margin-bottom: 8px; font-size: 0.9rem; text-transform: uppercase; font-weight: bold; transition: color 0.3s; }
    .sp-input, .sp-select { width: 100%; padding: 14px; border-radius: 10px; background: #f1f5f9; border: 1px solid #cbd5e1; color: #0f172a; font-size: 1rem; box-sizing: border-box; transition: all 0.3s; outline: none; }
    .sp-input:focus, .sp-select:focus { border-color: #f97316; }
    .sp-input[readonly] { background: #e2e8f0; color: #64748b; cursor: not-allowed; }

    select option:disabled { color: #ef4444; font-weight: bold; font-style: italic; }

    .btn-orange { background: #f97316; color: #fff; padding: 14px 25px; border-radius: 10px; border: none; font-weight: bold; cursor: pointer; transition: 0.3s; width: 100%; font-size: 1.1rem; }
    .btn-orange:hover { background: #ea580c; }
    .btn-outline { background: transparent; color: #64748b; padding: 14px 25px; border-radius: 10px; border: 1px solid #cbd5e1; font-weight: bold; cursor: pointer; transition: 0.3s; width: 100%; }
    .btn-outline:hover { background: #f1f5f9; color: #0f172a; border-color: #94a3b8; }

    .action-buttons { display: flex; gap: 15px; margin-top: 30px; }

    /* Boxes */
    .summary-box { background: rgba(56, 189, 248, 0.05); border: 1px solid #bae6fd; padding: 20px; border-radius: 12px; margin-bottom: 25px; transition: all 0.3s;}
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 10px; color: #475569; font-size: 0.95rem; }
    .summary-row strong { color: #0f172a; }

    .rules-box { background: rgba(249, 115, 22, 0.05); border: 1px solid rgba(249, 115, 22, 0.2); padding: 25px; border-radius: 12px; margin-bottom: 25px; }
    .rules-box p { color: #475569; margin-bottom: 15px; line-height: 1.6; font-size: 0.95rem; }

    .total-box { margin-top: 10px; padding: 15px; background: #f1f5f9; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; transition: all 0.3s;}

    /* ==========================================
       LOGIKA DARK MODE (Otomatis Aktif)
       ========================================== */
    .dark .wizard-page, body.dark .wizard-page { background-color: #0f172a; }
    .dark .wizard-container, body.dark .wizard-container { background: #1e293b; border-color: #334155; box-shadow: 0 15px 35px rgba(0,0,0,0.3); }
    .dark .step-circle, body.dark .step-circle { background: #334155; color: #94a3b8; }
    .dark .step-line, body.dark .step-line { background: #334155; }
    .dark .step-title, body.dark .step-title { color: #ffffff; }
    .dark .step-subtitle, body.dark .step-subtitle { color: #94a3b8; }
    .dark .sp-label, body.dark .sp-label { color: #cbd5e1; }
    .dark .sp-input, .dark .sp-select, body.dark .sp-input, body.dark .sp-select { background: #0f172a; border-color: #334155; color: #ffffff; }
    .dark .sp-input[readonly], body.dark .sp-input[readonly] { background: #1e293b; color: #64748b; }
    .dark .btn-outline, body.dark .btn-outline { color: #cbd5e1; border-color: #cbd5e1; }
    .dark .btn-outline:hover, body.dark .btn-outline:hover { background: #334155; color: #fff; border-color: #334155;}
    .dark .summary-box, body.dark .summary-box { border-color: #334155; }
    .dark .summary-row, body.dark .summary-row { color: #cbd5e1; }
    .dark .summary-row strong, body.dark .summary-row strong { color: #fff; }
    .dark .rules-box p, body.dark .rules-box p { color: #cbd5e1; }
    .dark .total-box, body.dark .total-box { background: #0f172a; }

    /* SweetAlert2 Kustom */
    .swal-glass { background: rgba(30, 41, 59, 0.85) !important; backdrop-filter: blur(16px) !important; border: 1px solid rgba(255, 255, 255, 0.1) !important; border-radius: 20px !important; }
    .swal-title-glass { color: #ffffff !important; }
    .swal-html-glass { color: #cbd5e1 !important; }
    .swal-confirm-orange { background: #f97316 !important; border-radius: 10px !important; font-weight: bold !important; padding: 12px 30px !important;}
</style>

<main class="wizard-page">
    <div class="wizard-container">

        <nav class="stepper" aria-label="Progress Booking">
            <div class="step-circle active" id="ind-1">1</div>
            <div class="step-line"></div>
            <div class="step-circle" id="ind-2">2</div>
            <div class="step-line"></div>
            <div class="step-circle" id="ind-3">3</div>
            <div class="step-line"></div>
            <div class="step-circle" id="ind-4">4</div>
        </nav>

        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" id="bookingForm" aria-label="Formulir Reservasi Ruangan">
            @csrf
            <input type="hidden" name="ruangan_id" id="ruanganId" value="{{ $ruangan->id }}">

            <section class="step-content active" id="step-1">
                <div class="step-heading">
                    <h2 class="step-title">Pilih Tanggal Booking</h2>
                    <p class="step-subtitle">Reservasi tersedia untuk maksimal 14 hari ke depan.</p>
                </div>

                <div class="form-group">
                    <label for="cabang" class="sp-label">Pilih Cabang</label>
                    <input type="text" id="cabang" class="sp-input" value="SingSpace - Pusat Jember" readonly>
                </div>

                <div class="form-group">
                    <label for="inputTanggal" class="sp-label">Tanggal Booking</label>
                    <input type="date" name="tanggal" id="inputTanggal" class="sp-input" required>
                </div>

                <div class="action-buttons">
                    <button type="button" class="btn-orange" onclick="nextStep(1, 2)">Lanjutkan</button>
                </div>
            </section>

            <section class="step-content" id="step-2">
                <div class="step-heading">
                    <h2 class="step-title">Aturan Reservasi</h2>
                    <p class="step-subtitle">Baca dan setujui aturan booking SingSpace.</p>
                </div>

                <article class="rules-box">
                    <p>1. Pemesanan pada hari H tidak dapat dibatalkan maupun dijadwalkan ulang.</p>
                    <p>2. Pembatalan/Reschedule dapat dilakukan maksimal H-1 dari waktu booking.</p>
                    <p>3. Dilarang membawa makanan dan minuman berat dari luar area SingSpace.</p>
                    <p>4. Kerusakan fasilitas ruangan akibat kelalaian pelanggan akan dikenakan denda sesuai SOP.</p>
                </article>

                <div class="action-buttons">
                    <button type="button" class="btn-outline" onclick="nextStep(2, 1)">Kembali</button>
                    <button type="button" class="btn-orange" onclick="nextStep(2, 3)">Saya Setuju</button>
                </div>
            </section>

            <section class="step-content" id="step-3">
                <div class="step-heading">
                    <h2 class="step-title">Pilih Jam & Durasi</h2>
                    <p class="step-subtitle">Waktu minimal pemesanan adalah 1 Jam (Bulat).</p>
                </div>

                <article class="summary-box">
                    <div class="summary-row"><span>Ruangan:</span> <strong>{{ $ruangan->nama }} ({{ $ruangan->tipe }})</strong></div>
                    <div class="summary-row"><span>Harga per Jam:</span> <strong>Rp {{ number_format($ruangan->harga, 0, ',', '.') }}</strong></div>
                </article>

                <div style="display: flex; gap: 15px;">
                    <div class="form-group" style="flex: 1;">
                        <label for="jamMulai" class="sp-label">Jam Mulai (Teng)</label>
                        <select name="jam_mulai" id="jamMulai" class="sp-select" required>
                            <option value="">Pilih Jam</option>
                            <option value="10:00">10:00 WIB</option>
                            <option value="11:00">11:00 WIB</option>
                            <option value="12:00">12:00 WIB</option>
                            <option value="13:00">13:00 WIB</option>
                            <option value="14:00">14:00 WIB</option>
                            <option value="15:00">15:00 WIB</option>
                            <option value="16:00">16:00 WIB</option>
                            <option value="17:00">17:00 WIB</option>
                            <option value="18:00">18:00 WIB</option>
                            <option value="19:00">19:00 WIB</option>
                            <option value="20:00">20:00 WIB</option>
                            <option value="21:00">21:00 WIB</option>
                            <option value="22:00">22:00 WIB</option>
                        </select>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label for="durasiJam" class="sp-label">Durasi (Jam)</label>
                        <select name="durasi" id="durasiJam" class="sp-select" required onchange="hitungTotal()">
                            <option value="1">1 Jam</option>
                            <option value="2">2 Jam</option>
                            <option value="3">3 Jam</option>
                            <option value="4">4 Jam</option>
                            <option value="5">5 Jam</option>
                        </select>
                    </div>
                </div>

                <div class="total-box">
                    <span style="color: #94a3b8; font-weight: bold;">Total Pembayaran:</span>
                    <span style="color: #f97316; font-size: 1.5rem; font-weight: bold;" id="tampilTotal">Rp {{ number_format($ruangan->harga, 0, ',', '.') }}</span>
                </div>

                <div class="action-buttons">
                    <button type="button" class="btn-outline" onclick="nextStep(3, 2)">Kembali</button>
                    <button type="button" class="btn-orange" onclick="validasiJam()">Lanjutkan</button>
                </div>
            </section>

            <section class="step-content" id="step-4">
                <div class="step-heading">
                    <h2 class="step-title">Data & Pembayaran</h2>
                    <p class="step-subtitle">Lengkapi proses pembayaran untuk mengonfirmasi pesanan.</p>
                </div>

                <div class="form-group">
                    <label for="namaPemesan" class="sp-label">Nama Lengkap</label>
                    <input type="text" id="namaPemesan" class="sp-input" value="{{ auth()->user()->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="metodeBayar" class="sp-label">Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metodeBayar" class="sp-select" required onchange="gantiMetode()">
                        <option value="">Pilih Metode</option>
                        <option value="QRIS">QRIS SingSpace</option>
                        <option value="Transfer BCA">Transfer Seabank (901069855761)</option>
                        <option value="Transfer Mandiri">Transfer Bank Jago (104218536015)</option>
                    </select>
                </div>

                <figure id="qrisBox" style="display: none; text-align: center; background: #fff; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                    <img src="{{ asset('img/qris-singspace.png') }}" alt="QRIS SingSpace" style="max-width: 250px; border-radius: 12px; margin-top: 15px;">
                    <figcaption style="color: #0f172a; margin-top: 10px; font-weight: bold;">Scan QRIS SingSpace</figcaption>
                </figure>

                <div class="form-group">
                    <label for="buktiBayar" class="sp-label">Upload Bukti Pembayaran <span style="color: #ef4444;">*</span></label>
                    <input type="file" id="buktiBayar" name="bukti_pembayaran" class="sp-input" accept="image/*" required>
                </div>

                <div class="action-buttons">
                    <button type="button" class="btn-outline" onclick="nextStep(4, 3)">Kembali</button>
                    <button type="submit" class="btn-orange" id="btnSubmitKonfirmasi">Konfirmasi Booking</button>
                </div>
            </section>

        </form>
    </div>
</main>

<script>
    // Batasan Tanggal & Waktu Lokal
    const dtInput = document.getElementById('inputTanggal');
    const today = new Date();

    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const localToday = `${year}-${month}-${day}`;

    const maxDate = new Date(today);
    maxDate.setDate(today.getDate() + 14);
    const maxYear = maxDate.getFullYear();
    const maxMonth = String(maxDate.getMonth() + 1).padStart(2, '0');
    const maxDay = String(maxDate.getDate()).padStart(2, '0');
    const localMaxDate = `${maxYear}-${maxMonth}-${maxDay}`;

    dtInput.min = localToday;
    dtInput.max = localMaxDate;

    // AJAX Cek Jadwal Penuh
    const ruanganIdInput = document.getElementById('ruanganId');
    const jamMulaiSelect = document.getElementById('jamMulai');

    dtInput.addEventListener('change', function() {
        const tanggal = this.value;
        const ruanganId = ruanganIdInput.value;

        if(!tanggal) return;

        const now = new Date();
        const currentHour = now.getHours();

        Array.from(jamMulaiSelect.options).forEach(opt => {
            opt.disabled = false;
            if (opt.value) { opt.text = opt.value + ' WIB'; }
            else { opt.text = 'Pilih Jam'; }
        });

        if (tanggal === localToday) {
            Array.from(jamMulaiSelect.options).forEach(opt => {
                if (!opt.value) return;
                const optHour = parseInt(opt.value.substring(0, 2));
                if (optHour <= currentHour) {
                    opt.disabled = true;
                    opt.text = opt.value + ' WIB (Lewat)';
                }
            });
        }

        fetch(`/cek-jadwal?ruangan_id=${ruanganId}&tanggal=${tanggal}`)
            .then(response => response.json())
            .then(bookedHours => {
                Array.from(jamMulaiSelect.options).forEach(opt => {
                    if (!opt.value) return;
                    if (bookedHours.includes(opt.value)) {
                        opt.disabled = true;
                        if (!opt.text.includes('(Lewat)')) {
                            opt.text = opt.value + ' WIB (Penuh)';
                        }
                    }
                });
            })
            .catch(error => console.error('Gagal mengecek jadwal:', error));
    });

    // Validasi SweetAlert2 untuk Navigasi Step
    function nextStep(current, next) {
        if (current === 1 && !dtInput.value) {
            Swal.fire({
                icon: 'warning',
                title: 'Tanggal Belum Dipilih',
                text: 'Silakan pilih tanggal booking terlebih dahulu.',
                background: 'transparent',
                customClass: { popup: 'swal-glass', title: 'swal-title-glass', htmlContainer: 'swal-html-glass', confirmButton: 'swal-confirm-orange' }
            });
            return;
        }

        document.getElementById(`step-${current}`).classList.remove('active');
        document.getElementById(`step-${next}`).classList.add('active');

        for (let i = 1; i <= 4; i++) {
            if (i <= next) {
                document.getElementById(`ind-${i}`).classList.add('active');
            } else {
                document.getElementById(`ind-${i}`).classList.remove('active');
            }
        }
    }

    function validasiJam() {
        const jam = document.getElementById('jamMulai').value;
        if (!jam) {
            Swal.fire({
                icon: 'warning',
                title: 'Jam Belum Dipilih',
                text: 'Silakan pilih jam mulai karaoke.',
                background: 'transparent',
                customClass: { popup: 'swal-glass', title: 'swal-title-glass', htmlContainer: 'swal-html-glass', confirmButton: 'swal-confirm-orange' }
            });
            return;
        }
        nextStep(3, 4);
    }

    const hargaPerJam = {{ $ruangan->harga }};
    function hitungTotal() {
        const durasi = document.getElementById('durasiJam').value;
        const total = hargaPerJam * durasi;
        document.getElementById('tampilTotal').innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    function gantiMetode() {
        const metode = document.getElementById('metodeBayar').value;
        const qrisBox = document.getElementById('qrisBox');
        if (metode === 'QRIS') {
            qrisBox.style.display = 'block';
        } else {
            qrisBox.style.display = 'none';
        }
    }

    // Intersep Submit untuk Loading SweetAlert2
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Memproses Pesanan...',
            text: 'Mohon tunggu, jangan tutup halaman ini.',
            allowOutsideClick: false,
            background: 'transparent',
            customClass: { popup: 'swal-glass', title: 'swal-title-glass', htmlContainer: 'swal-html-glass' },
            didOpen: () => {
                Swal.showLoading();
            }
        });

        this.submit();
    });
</script>
@endsection
