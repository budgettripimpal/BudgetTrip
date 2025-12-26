# BudgetTrip 🎒✈️

**BudgetTrip** adalah aplikasi berbasis web yang dirancang untuk membantu wisatawan (*budget traveler*) dalam merencanakan perjalanan wisata, menyusun itinerary, mencari transportasi/akomodasi, serta melakukan estimasi anggaran secara terperinci.

Aplikasi ini dibangun menggunakan Framework **Laravel 10**, **Tailwind CSS**, dan mengintegrasikan **Midtrans Payment Gateway**.

---

## 👥 Anggota Kelompok

**Kelompok 4 - Prodi S1 Informatika, Telkom University**

1. **M Dani Riadi** (NIM: 103012300341)
2. **Muhammad Haris Azmi** (NIM: 103012300044)
3. **Fajril Ikhsan Ramadhan** (NIM: 103012300204)
4. **Damar Wahyu Suwarno** (NIM: 103012300090)

Kelas IF-47-12
---

## 💻 Persyaratan Sistem (Prerequisites)

Pastikan perangkat Anda telah terinstal:
- **PHP**: Versi 8.1 atau lebih baru.
- **Composer**: Dependency manager untuk PHP.
- **Node.js & NPM**: Untuk compile aset frontend (Vite/Tailwind).
- **MySQL**: Database server (via XAMPP/Laragon).
- **Git**: Untuk cloning repository.

---

## 🚀 Panduan Instalasi Lengkap

Ikuti langkah-langkah berikut secara berurutan di terminal (Command Prompt/PowerShell/Terminal VS Code):

### 1. Clone Repository
```bash
git clone [https://github.com/username-anda/budgettrip.git](https://github.com/username-anda/budgettrip.git)
cd budgettrip

```

### 2. Install Dependensi Backend & Frontend

Install library PHP dan JavaScript yang dibutuhkan:

```bash
# Install library PHP (Laravel Framework)
composer install

# Install library Frontend
npm install

```

### 3. Konfigurasi Environment (.env)

Salin file konfigurasi contoh dan buat file `.env` baru:

```bash
cp .env.example .env

```

Buka file `.env` tersebut menggunakan teks editor, lalu sesuaikan konfigurasi berikut:

**A. Koneksi Database:**
Pastikan Anda sudah membuat database kosong bernama `budgettrip` di phpMyAdmin.

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=budgettrip
DB_USERNAME=root
DB_PASSWORD=

```

**B. Konfigurasi Midtrans (Payment Gateway):**
Isi dengan Server Key dan Client Key dari akun Sandbox Midtrans Anda.

```ini
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxx
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true

```

### 4. Generate Application Key

```bash
php artisan key:generate

```

### 5. Migrasi Database & Seeding Data (PENTING!)

Perintah ini akan membuat tabel-tabel di database dan mengisi data dummy (Akun Admin, User, Kota, Transportasi, Hotel) agar aplikasi siap digunakan.

```bash
php artisan migrate:fresh --seed

```

### 6. Build Aset Frontend

Compile file CSS dan JS menggunakan Vite:

```bash
npm run build

```

### 7. Jalankan Server

Jalankan server lokal Laravel di CMD:

```bash
php artisan serve
```

Buka CMD baru dan jalankan NPM:
```bash
npm run dev
```

Akses aplikasi melalui browser di alamat: **http://127.0.0.1:8000**

---

## 🔐 Akun Demo (Login)

Gunakan akun berikut untuk masuk ke dalam sistem (Password default untuk semua akun seed adalah `password`):

| Role | Email | Password |
| --- | --- | --- |
| **Administrator** | `admin@budgettrip.com` | `password` |
| **User (Pengguna)** | `user@budgettrip.com` | `password` |

---

## ✅ Menjalankan Pengujian (Testing)

Aplikasi ini dilengkapi dengan skenario pengujian otomatis menggunakan **PHPUnit**. Berikut cara menjalankannya:

### 1. Menjalankan Test Fitur Utama (Travel Plan)

Menguji fitur CRUD Rencana Perjalanan, Validasi, dan Keamanan Akses:

```bash
php artisan test tests/Feature/TravelPlanTest.php

```

### 2. Menjalankan White Box Testing (Logika Kompleks)

Menguji logika `addToPlan` (Validasi stok kursi, perhitungan harga durasi hotel, merge item):

```bash
php artisan test tests/Feature/WhiteBoxAddToPlanTest.php

```

---

## 🛠 Troubleshooting (Kendala Umum)

1. **Gambar tidak muncul?**
Jalankan perintah ini untuk menghubungkan folder storage publik:
```bash
php artisan storage:link

```


2. **Error "Vite manifest not found"?**
Pastikan Anda sudah menjalankan `npm run build`.
3. **Error Database?**
Pastikan XAMPP/MySQL sudah menyala dan database `budgettrip` sudah dibuat sebelum menjalankan migrasi.

---

**Dibuat untuk memenuhi Tugas Besar Mata Kuliah IMPAL.**

```

```
