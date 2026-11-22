# KantinGo 🍽️

**Website Pemesanan Makanan dan Minuman Kantin Kampus**

## 📖 Deskripsi Proyek

KantinGo adalah aplikasi berbasis web yang dikembangkan untuk mempermudah proses pemesanan makanan dan minuman di kantin kampus. Aplikasi ini memungkinkan pembeli melihat menu, melakukan pemesanan, dan memantau status pesanan. Penjual dapat mengelola informasi kantin, menu, pesanan masuk, serta riwayat transaksi.

Proyek ini dikembangkan sebagai tugas akhir kelompok mata kuliah Praktikum Pemrograman Web.

## 🎯 Tujuan

- Mempermudah mahasiswa dalam memesan makanan dan minuman di kantin kampus.
- Membantu penjual mengelola menu dan pesanan secara terstruktur.
- Menyediakan informasi status pesanan dan pembayaran.
- Meningkatkan efisiensi proses pemesanan makanan di lingkungan kampus.

## ✨ Fitur Utama

### 1. Fitur Umum
- Login dan registrasi pengguna.
- Pemilihan peran pengguna sebagai pembeli atau penjual.
- Beranda pembeli.
- Pengelolaan profil pengguna.

### 2. Fitur Pembeli
- Melihat daftar makanan dan minuman.
- Melihat detail menu.
- Menambahkan menu ke keranjang.
- Mengatur jumlah dan menghapus item keranjang.
- Melakukan checkout dan membuat pesanan.
- Memilih metode pembayaran.
- Melihat riwayat dan status pesanan.
- Memberikan rating dan ulasan.
- Melihat notifikasi.

### 3. Fitur Penjual
- Melihat dashboard penjual.
- Mengelola informasi kantin.
- Mengatur status buka atau tutup kantin.
- Menambah, mengubah, dan menghapus menu.
- Mengelola stok dan ketersediaan menu.
- Melihat pesanan masuk dan detail pesanan.
- Memperbarui status pesanan.
- Melihat riwayat transaksi.
- Melihat notifikasi.

> **Catatan:** Pembayaran pada aplikasi ini berupa simulasi. Integrasi dengan penyedia layanan pembayaran atau payment gateway eksternal bukan bagian dari implementasi yang telah dikonfirmasi.

## 🛠️ Teknologi yang Digunakan

| Teknologi | Kegunaan |
|---|---|
| PHP 8.2 | Bahasa pemrograman sisi server |
| Laravel 9 | Framework aplikasi web |
| MySQL/MariaDB | Sistem manajemen basis data |
| Blade | Template tampilan Laravel |
| HTML | Struktur halaman web |
| CSS | Pengaturan tampilan |
| JavaScript | Interaksi pada halaman web |
| Composer | Pengelolaan dependensi PHP |
| Node.js dan NPM | Pengelolaan dependensi frontend jika diperlukan |

## 📋 Persyaratan Sistem

Pastikan perangkat telah memiliki:

- PHP 8.2 atau versi yang kompatibel dengan proyek.
- Composer.
- MySQL atau MariaDB.
- Node.js dan NPM jika proyek menggunakan proses build aset frontend.
- Web server lokal, seperti Laravel Herd atau alternatif yang kompatibel.

## 🚀 Instalasi dan Menjalankan Proyek

### 1. Clone atau siapkan source code

Jika proyek tersedia di repositori Git:

```bash
git clone <URL_REPOSITORY>
cd kantingo-app
```

Jika menggunakan file ZIP, ekstrak proyek terlebih dahulu, kemudian buka terminal pada folder utama proyek.

### 2. Instal dependensi PHP

```bash
composer install
```

### 3. Konfigurasi file environment

Salin file `.env.example` menjadi `.env`.

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Kemudian buat application key:

```bash
php artisan key:generate
```

### 4. Konfigurasi database

Buat database dengan nama `kantingo`, kemudian sesuaikan konfigurasi berikut pada file `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kantingo
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username dan password dengan konfigurasi database lokal masing-masing. Jangan mengunggah file `.env` yang berisi kredensial pribadi ke repositori publik.

### 5. Jalankan migration

Untuk instalasi baru dengan database kosong:

```bash
php artisan migrate
```

Jika proyek memiliki seeder yang sudah diperiksa dan memang diperlukan:

```bash
php artisan db:seed
```

**Penting:** Jika database KantinGo sudah berisi data, jangan menggunakan `php artisan migrate:fresh` atau `php artisan db:wipe`, karena perintah tersebut dapat menghapus tabel dan data.

### 6. Instal dependensi frontend

Jika proyek menggunakan NPM:

```bash
npm install
npm run build
```

### 7. Jalankan aplikasi

```bash
php artisan serve
```

Buka alamat berikut pada browser:

```text
http://127.0.0.1:8000
```

Jika menggunakan Laravel Herd, aplikasi juga dapat dijalankan melalui domain lokal yang telah dikonfigurasi.

## 🗂️ Struktur Direktori

```text
kantingo-app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
├── routes/
│   └── web.php
├── public/
├── storage/
├── tests/
├── .env.example
├── artisan
├── composer.json
└── README.md
```

Keterangan:

- `app/Http/Controllers/` — menangani alur permintaan dan proses aplikasi.
- `app/Models/` — merepresentasikan data dan relasi database.
- `database/migrations/` — mendefinisikan struktur tabel database.
- `database/seeders/` — menyediakan data awal jika diperlukan.
- `resources/views/` — menyimpan tampilan Blade.
- `routes/web.php` — mendefinisikan rute aplikasi.
- `public/` — menyimpan aset publik aplikasi.
- `tests/` — menyimpan pengujian aplikasi.

## 🗄️ Database

Database KantinGo digunakan untuk menyimpan data yang mendukung proses autentikasi, pengelolaan kantin, menu, keranjang, pemesanan, pembayaran, notifikasi, dan ulasan.

Tabel-tabel yang digunakan harus mengikuti migration yang tersedia pada source code proyek. Contoh tabel inti meliputi:

- `users` — data pengguna.
- `tenants` — data kantin.
- `categories` — kategori menu.
- `menus` — data makanan dan minuman.
- `carts` dan `cart_items` — data keranjang.
- `orders` dan `order_items` — data pesanan.
- `payments` — data pembayaran.
- `notifications` — data notifikasi.
- `reviews` — data ulasan.

## 👥 Pembagian Tugas Anggota

| Inisial | Anggota | Tanggung Jawab Utama |
|---|---|---|
| SK | Siti Kamila Nurhalisa | Pembayaran dan notifikasi |
| DR | Dinda Rahayu Agustina | Riwayat pesanan pembeli dan ulasan |
| LS | Louisa Safina Permata Citra | Detail makanan dan pengelolaan menu |
| KR | Khaizuran Rafie Safaraz | Keranjang dan checkout |
| PK | Petra Kanisia Braniva | Dashboard dan pengelolaan tenant |
| BA | Billqisthi Albar Haprabu | Pesanan masuk, detail pesanan, dan riwayat transaksi |
| ALL | Seluruh anggota | Login, register, home pembeli, dan profil |

## 🔐 Keamanan

- Autentikasi digunakan untuk membatasi akses pengguna.
- Hak akses dibedakan berdasarkan peran pembeli dan penjual.
- Validasi input digunakan untuk memeriksa data yang dikirimkan pengguna.
- Kata sandi disimpan dalam bentuk hash.
- File `.env` tidak boleh dibagikan karena dapat berisi informasi konfigurasi sensitif.

## 📌 Status Proyek

KantinGo dikembangkan sebagai proyek akhir kelompok untuk mata kuliah Praktikum Pemrograman Web. Fitur dan status pengujiannya perlu disesuaikan dengan implementasi serta hasil pengujian aktual.

## 🧑‍🏫 Dosen Pengampu

Ir. Wibisono Sukmo Wardhono, S.T., M.T.
