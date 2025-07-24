# 📘 Aplikasi Buku Tamu Digital - Laravel 12

Aplikasi **Buku Tamu Digital** berbasis Laravel 12 untuk mencatat kedatangan tamu secara efisien, praktis, dan modern. Dilengkapi dengan fitur login admin untuk memantau dan mengelola data kunjungan.

---

## ✨ Fitur Utama

- Formulir pengisian tamu: Nama, Instansi, Nomor Telepon, Keperluan, Foto Wajah.
- Penyimpanan otomatis waktu kunjungan.
- Panel Admin untuk melihat dan mengelola semua data tamu.
- Sistem login aman untuk admin.
- Antarmuka minimalis dan responsif.

---

## 🛠️ Teknologi yang Digunakan

- Laravel 12
- Blade Template (UI minimalis)
- MySQL / MariaDB
- Session-based authentication (tanpa Laravel Breeze)
- PHP 8.x
- HTML & Tailwind CSS (jika digunakan)

---

## ⚙️ Cara Instalasi

1. **Clone repositori:**

```bash
git clone https://github.com/kamu/buku-tamu.git
cd buku-tamu
Instal dependensi:composer install
Konfigurasi file environment:cp .env.example .env
php artisan key:generate
Atur database di .env:DB_DATABASE=bukutamu
DB_USERNAME=root
DB_PASSWORD=
Jalankan migrasi:php artisan migrate
Jalankan aplikasi:php artisan serve

Pull request terbuka untuk siapa saja. Silakan fork, modifikasi, dan ajukan PR jika ingin meningkatkan fitur.


