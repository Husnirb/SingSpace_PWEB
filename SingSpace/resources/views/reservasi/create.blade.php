@extends('layouts.app')

@section('content')
<style>
    body { background-color: #0f172a; color: #fff; }
    .wizard-container { max-width: 700px; margin: 80px auto; background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.3); }

    /* Stepper */
    .stepper { display: flex; justify-content: center; margin-bottom: 40px; gap: 20px; align-items: center; }
    .step-circle { width: 40px; height: 40px; border-radius: 50%; background: #334155; color: #94a3b8; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 1.2rem; transition: 0.3s; }
    .step-line { height: 2px; width: 40px; background: #334155; }
    .step-circle.active { background: #f97316; color: #fff; box-shadow: 0 0 15px rgba(249, 115, 22, 0.5); }

    /* Form Elements */
    .step-content { display: none; animation: fadeIn 0.4s ease; }
    .step-content.active { display: block; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    h2 { color: #fff; font-size: 1.5rem; margin-top: 0; margin-bottom: 5px; }
    p.subtitle { color: #94a3b8; font-size: 0.95rem; margin-bottom: 25px; }

    .form-group { margin-bottom: 20px; }
    label { display: block; color: #cbd5e1; margin-bottom: 8px; font-size: 0.9rem; text-transform: uppercase; }
    input, select { width: 100%; padding: 14px; border-radius: 10px; background: #0f172a; border: 1px solid #334155; color: #fff; font-size: 1rem; box-sizing: border-box; }
    input:focus, select:focus { outline: none; border-color: #f97316; }

    .btn-orange { background: #f97316; color: #fff; padding: 14px 25px; border-radius: 10px; border: none; font-weight: bold; cursor: pointer; transition: 0.3s; width: 100%; font-size: 1.1rem; }
    .btn-orange:hover { background: #ea580c; }
    .btn-outline { background: transparent; color: #cbd5e1; padding: 14px 25px; border-radius: 10px; border: 1px solid #cbd5e1; font-weight: bold; cursor: pointer; transition: 0.3s; width: 100%; }
    .btn-outline:hover { background: #334155; color: #fff; }

    .action-buttons { display: flex; gap: 15px; margin-top: 30px; }

    /* Summary Box */
    .summary-box { background: rgba(56, 189, 248, 0.05); border: 1px solid #334155; padding: 20px; border-radius: 12px; margin-bottom: 25px; }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 10px; color: #cbd5e1; font-size: 0.95rem; }
    .summary-row strong { color: #fff; }

    /* Rules Box */
    .rules-box { background: rgba(249, 115, 22, 0.1); border: 1px solid rgba(249, 115, 22, 0.3); padding: 25px; border-radius: 12px; margin-bottom: 25px; }
    .rules-box p { color: #cbd5e1; margin-bottom: 15px; line-height: 1.6; font-size: 0.95rem; }
</style>

<div class="wizard-container">

    <div class="stepper">
        <div class="step-circle active" id="ind-1">1</div>
        <div class="step-line"></div>
        <div class="step-circle" id="ind-2">2</div>
        <div class="step-line"></div>
        <div class="step-circle" id="ind-3">3</div>
        <div class="step-line"></div>
        <div class="step-circle" id="ind-4">4</div>
    </div>

    <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" id="bookingForm">
        @csrf
        <input type="hidden" name="ruangan_id" value="{{ $ruangan->id }}">

        <div class="step-content active" id="step-1">
            <h2>Pilih Tanggal Booking</h2>
            <p class="subtitle">Reservasi tersedia untuk maksimal 14 hari ke depan.</p>

            <div class="form-group">
                <label>Pilih Cabang</label>
                <input type="text" value="SingSpace - Pusat Jember" readonly style="background: #1e293b; color: #64748b;">
            </div>

            <div class="form-group">
                <label>Tanggal Booking</label>
                <input type="date" name="tanggal" id="inputTanggal" required>
            </div>

            <div class="action-buttons">
                <button type="button" class="btn-orange" onclick="nextStep(1, 2)">Lanjutkan</button>
            </div>
        </div>

        <div class="step-content" id="step-2">
            <h2>Aturan Reservasi</h2>
            <p class="subtitle">Baca dan setujui aturan booking SingSpace.</p>

            <div class="rules-box">
                <p>1. Pemesanan pada hari H tidak dapat dibatalkan maupun dijadwalkan ulang.</p>
                <p>2. Pembatalan/Reschedule dapat dilakukan maksimal H-1 dari waktu booking.</p>
                <p>3. Dilarang membawa makanan dan minuman berat dari luar area SingSpace.</p>
                <p>4. Kerusakan fasilitas ruangan akibat kelalaian pelanggan akan dikenakan denda sesuai SOP.</p>
            </div>

            <div class="action-buttons">
                <button type="button" class="btn-outline" onclick="nextStep(2, 1)">Kembali</button>
                <button type="button" class="btn-orange" onclick="nextStep(2, 3)">Saya Setuju</button>
            </div>
        </div>

        <div class="step-content" id="step-3">
            <h2>Pilih Jam & Durasi</h2>
            <p class="subtitle">Waktu minimal pemesanan adalah 1 Jam (Bulat).</p>

            <div class="summary-box">
                <div class="summary-row"><span>Ruangan:</span> <strong>{{ $ruangan->nama }} ({{ $ruangan->tipe }})</strong></div>
                <div class="summary-row"><span>Harga per Jam:</span> <strong>Rp {{ number_format($ruangan->harga, 0, ',', '.') }}</strong></div>
            </div>

            <div style="display: flex; gap: 15px;">
                <div class="form-group" style="flex: 1;">
                    <label>Jam Mulai (Teng)</label>
                    <select name="jam_mulai" id="jamMulai" required>
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
                    <label>Durasi (Jam)</label>
                    <select name="durasi" id="durasiJam" required onchange="hitungTotal()">
                        <option value="1">1 Jam</option>
                        <option value="2">2 Jam</option>
                        <option value="3">3 Jam</option>
                        <option value="4">4 Jam</option>
                        <option value="5">5 Jam</option>
                    </select>
                </div>
            </div>

            <div style="margin-top: 10px; padding: 15px; background: #0f172a; border-radius: 10px; display: flex; justify-content: space-between; align-items: center;">
                <span style="color: #94a3b8; font-weight: bold;">Total Pembayaran:</span>
                <span style="color: #f97316; font-size: 1.5rem; font-weight: bold;" id="tampilTotal">Rp {{ number_format($ruangan->harga, 0, ',', '.') }}</span>
            </div>

            <div class="action-buttons">
                <button type="button" class="btn-outline" onclick="nextStep(3, 2)">Kembali</button>
                <button type="button" class="btn-orange" onclick="validasiJam()">Lanjutkan</button>
            </div>
        </div>

        <div class="step-content" id="step-4">
            <h2>Data & Pembayaran</h2>
            <p class="subtitle">Lengkapi proses pembayaran untuk mengonfirmasi pesanan.</p>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" value="{{ auth()->user()->name }}" readonly style="background: #1e293b; color: #64748b;">
            </div>

            <div class="form-group">
                <label>Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metodeBayar" required onchange="gantiMetode()">
                    <option value="">Pilih Metode</option>
                    <option value="QRIS">QRIS SingSpace</option>
                    <option value="Transfer BCA">Transfer Seabank (901069855761)</option>
                    <option value="Transfer Mandiri">Transfer Bank Jago (104218536015)</option>
                </select>
            </div>

            <div id="qrisBox" style="display: none; text-align: center; background: #fff; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="QRIS" style="width: 150px; height: 150px;">
                <p style="color: #0f172a; margin-top: 10px; font-weight: bold;">Scan QRIS SingSpace</p>
            </div>

            <div class="form-group">
                <label>Upload Bukti Pembayaran <span style="color: #ef4444;">*</span></label>
                <input type="file" name="bukti_pembayaran" accept="image/*" required style="padding: 10px; background: #1e293b;">
            </div>

            <div class="action-buttons">
                <button type="button" class="btn-outline" onclick="nextStep(4, 3)">Kembali</button>
                <button type="submit" class="btn-orange"><i class="fa-solid fa-check-circle"></i> Konfirmasi Booking</button>
            </div>
        </div>

    </form>
</div>

<script>
    // JS Untuk Batasan Tanggal (Hari ini s/d 14 Hari ke Depan)
    const dtInput = document.getElementById('inputTanggal');
    const today = new Date();
    const maxDate = new Date();
    maxDate.setDate(today.getDate() + 14);

    dtInput.min = today.toISOString().split("T")[0];
    dtInput.max = maxDate.toISOString().split("T")[0];

    // JS Navigasi Antar Step
    function nextStep(current, next) {
        // Validasi simpel sebelum lanjut
        if (current === 1 && !dtInput.value) {
            alert('Silakan pilih tanggal booking terlebih dahulu!');
            return;
        }

        document.getElementById(`step-${current}`).classList.remove('active');
        document.getElementById(`step-${next}`).classList.add('active');

        // Update Indikator Bulat di atas
        for (let i = 1; i <= 4; i++) {
            if (i <= next) {
                document.getElementById(`ind-${i}`).classList.add('active');
            } else {
                document.getElementById(`ind-${i}`).classList.remove('active');
            }
        }
    }

    // JS Validasi Jam
    function validasiJam() {
        const jam = document.getElementById('jamMulai').value;
        if (!jam) {
            alert('Silakan pilih jam mulai!');
            return;
        }
        nextStep(3, 4);
    }

    // JS Hitung Total Harga Real-time
    const hargaPerJam = {{ $ruangan->harga }};
    function hitungTotal() {
        const durasi = document.getElementById('durasiJam').value;
        const total = hargaPerJam * durasi;
        document.getElementById('tampilTotal').innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    // JS Munculkan QRIS
    function gantiMetode() {
        const metode = document.getElementById('metodeBayar').value;
        const qrisBox = document.getElementById('qrisBox');
        if (metode === 'QRIS') {
            qrisBox.style.display = 'block';
        } else {
            qrisBox.style.display = 'none';
        }
    }
</script>
@endsection
