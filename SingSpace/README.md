# SingSpace - Premium Karaoke Room Reservation System

![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-Semantic-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-Ready-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

**SingSpace** adalah platform reservasi ruang karaoke eksklusif berbasis web. Sistem ini dirancang untuk mendigitalkan proses pemesanan ruangan, mengelola ketersediaan jadwal secara *real-time*, dan memberikan pengalaman pengguna yang interaktif melalui antarmuka adaptif dan modern.

Website ini dikembangkan sebagai bentuk pemenuhan Tugas Akhir Mata Kuliah **Pemrograman Berbasis Web (KSI1412)**, Program Studi S1 Sistem Informasi, Fakultas Ilmu Komputer, Universitas Jember.

**Dibuat oleh:** Husni Rasyid Bachrie (NIM: 242410101017)  
**Demo Video:** [Masukkan Tautan YouTube Di Sini]  
**Live Website:** [Masukkan Tautan Hosting Di Sini]

---

## 📑 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Keunggulan Sistem (Standar RTM)](#-keunggulan-sistem-standar-rtm)
- [Struktur Database](#-struktur-database)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Panduan Instalasi & Menjalankan Website](#-panduan-instalasi--menjalankan-Website)
- [Akun Akses Default](#-akun-akses-default-demo)

---

## ✨ Fitur Utama

Sistem ini memfasilitasi dua peran utama, yaitu Pengguna (Customer) dan Administrator:

### 👤 Untuk Pelanggan (Customer)
- **Katalog Interaktif:** Eksplorasi daftar ruangan dengan fitur pencarian instan (Live Search) tanpa perlu memuat ulang halaman.
- **Smart Booking Wizard:** Formulir pemesanan multi-langkah interaktif dengan validasi jadwal otomatis untuk mencegah pemesanan ganda.
- **Dynamic Music Widget:** Pemutar musik cerdas di halaman utama yang terintegrasi dengan iTunes API (Top 10 Pop Hits) dan dilengkapi visualisasi audio.
- **Pengaturan Preferensi:** Fitur kustomisasi ukuran font dan tema antarmuka (Light Mode / Dark Mode) yang disimpan secara persisten.
- **Riwayat Reservasi:** Pemantauan status pemesanan dan fitur unggah bukti pembayaran yang aman.

### 🛡️ Untuk Administrator
- **Dashboard Manajemen:** Ringkasan statistik kunjungan dan operasional bisnis.
- **Manajemen Data Ruangan:** Fitur CRUD (Create, Read, Update, Delete) penuh untuk mengatur katalog ruangan, harga, kapasitas, tipe, hingga mengunggah foto interior.
- **Kendali Ketersediaan:** Pengaturan status operasional ruangan (Aktif / Maintenance).
- **Proses Reservasi:** Verifikasi bukti pembayaran dan pengelolaan persetujuan jadwal pelanggan.

---

## 🎯 Keunggulan Sistem (Standar RTM)

Website SingSpace dikembangkan secara ketat dengan mematuhi standar pengembangan web modern:
1. **HTML5 Semantik:** Penggunaan struktur tag yang bermakna (`<main>`, `<section>`, `<article>`) untuk menunjang aksesibilitas dan SEO.
2. **Komunikasi Asinkronus (AJAX):** Implementasi Fetch API dengan algoritma *Debounce* pada pencarian dan jadwal untuk meringankan beban server, lengkap dengan *Loading Indicator* dan *Error Handling*.
3. **Validasi Klien Tingkat Lanjut:** Integrasi *SweetAlert2* dengan desain *Glassmorphism* kustom untuk memvalidasi *input* formulir dan memberikan *feedback* yang informatif.
4. **Proteksi Session & Middleware:** Pemisahan *Role-Based Access Control* yang ketat serta keamanan pengelolaan rute sistem.
5. **Keamanan Database:** Semua kueri database dilindungi dari injeksi SQL melalui implementasi Eloquent ORM (*Prepared Statements*) Laravel.

---

## 🗄️ Struktur Database

Website menggunakan database relasional (MySQL) dengan tabel utama sebagai berikut:
1. `users`: Menyimpan data autentikasi pengguna dan peran akses (*role*).
2. `ruangans`: Menyimpan entitas dan spesifikasi ruangan (nama, tipe, harga, foto, status).
3. `reservasis`: Mencatat jejak transaksional, jadwal pemesanan, tagihan, dan file bukti pembayaran.
4. `sessions`: Menyimpan manajemen sesi pengguna secara dinamis dan aman.

---

## 🚀 Panduan Instalasi & Menjalankan Website

Ikuti panduan berikut untuk mengkonfigurasi dan menjalankan SingSpace di lingkungan lokal (*localhost*) Anda.

### 1. Persyaratan Sistem
Pastikan perangkat Anda telah terinstal perangkat lunak berikut:
* **PHP** (Minimal versi 8.2)
* **Composer** (Manajemen paket PHP)
* **Node.js & NPM** (Kompilasi aset *frontend*)
* **MySQL / MariaDB** (Disarankan menggunakan XAMPP atau Laragon)
* **Git** (Untuk kloning repositori)

### 2. Kloning Repositori
Buka Terminal atau Command Prompt, lalu eksekusi perintah berikut:
```bash
git clone <URL_REPOSITORI_GITHUB_ANDA>
cd singspace

```

### 3. Instalasi Dependensi (Backend & Frontend)

Unduh seluruh pustaka yang dibutuhkan oleh sistem:

```bash
composer install
npm install

```

### 4. Konfigurasi Environment

Salin file pengaturan bawaan Website:

```bash
cp .env.example .env

```

Buka file `.env` di *code editor* Anda (misal: VS Code) dan sesuaikan zona waktu serta kredensial *database* Anda:

```env
APP_TIMEZONE=Asia/Jakarta

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=singspace_db
DB_USERNAME=root
DB_PASSWORD=

```

*(Catatan: Biarkan `DB_PASSWORD` kosong jika Anda menggunakan konfigurasi default dari XAMPP).*

### 5. Generate Application Key

Amankan sesi dan data terenkripsi Website dengan perintah:

```bash
php artisan key:generate

```

### 6. Migrasi Database, Seeder, dan Storage Link

Pastikan *service* MySQL di XAMPP/Laragon Anda sudah berjalan, lalu buat database kosong bernama `singspace_db` di *phpMyAdmin*.

Setelah itu, jalankan perintah di bawah ini untuk membangun tabel, memasukkan data awal (*dummy*), dan menautkan direktori penyimpanan gambar:

```bash
php artisan migrate --seed
php artisan storage:link

```

*(Penting: `storage:link` wajib dijalankan agar foto ruangan dan bukti transfer dapat ditampilkan dengan benar di browser).*

### 7. Jalankan Server Lokal

Untuk menjalankan Website, Anda perlu membuka **dua tab Terminal** secara bersamaan di dalam folder proyek:

**Terminal 1 (Untuk kompilasi aset CSS/JS):**

```bash
npm run dev

```

**Terminal 2 (Untuk menjalankan server Laravel):**

```bash
php artisan config:clear
php artisan serve

```

### 8. Akses Website

Setelah kedua proses di atas berjalan tanpa kendala, buka web browser Anda dan kunjungi:
👉 **http://127.0.0.1:8000**

---

## 🔐 Akun Akses Default (Demo)

Sistem telah dilengkapi dengan data *dummy* melalui proses *Seeder* untuk memudahkan pengujian. Anda dapat masuk menggunakan salah satu kredensial di bawah ini:

| Peran (Role) | Alamat Email | Kata Sandi |
| --- | --- | --- |
| **Administrator** | `husni@gmail.com` | `admin123` |
| **Pelanggan (Customer)** | `rasyid@gmail.com` | `makanbakso` |

*(Anda juga dapat melakukan simulasi pendaftaran sebagai pelanggan baru melalui menu Registrasi).*

---

*SingSpace - Elevating Your Karaoke Experience.*
