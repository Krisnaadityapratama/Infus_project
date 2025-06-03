# Infus_project

Project monitoring dan kontrol servo menggunakan Laravel Framework versi 8.  
Aplikasi ini dirancang untuk memantau dan mengendalikan alat infus secara real-time dengan interface yang mudah digunakan.

## Demo Video

Tonton video demo dan tutorial penggunaan di YouTube berikut:  
[https://youtu.be/WhJtefjVekc](https://youtu.be/WhJtefjVekc)

---

## Fitur Utama

- Monitoring status infus secara real-time  
- Kontrol servo untuk pengaturan aliran infus  
- Tampilan responsif berbasis Laravel dan Bootstrap  
- Integrasi Sweet Alert untuk notifikasi interaktif

---

## Teknologi yang Digunakan

- PHP 7.3+ / 8.x dengan Laravel Framework 8  
- MySQL sebagai database  
- JavaScript dan CSS untuk frontend interaktif  
- Sweet Alert untuk notifikasi  
- Laravel Sanctum untuk autentikasi API

---

## Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di lokal:

### 1. Clone repository

```bash
git clone https://github.com/Krisnaadityapratama/Infus_project.git
cd Infus_project
````

### 2. Install dependencies dengan Composer

Pastikan kamu sudah memasang [Composer](https://getcomposer.org/) di sistem kamu.

```bash
composer install
```

### 3. Install dependencies frontend

Pastikan kamu sudah memasang [Node.js](https://nodejs.org/) dan npm.

```bash
npm install
npm run dev
```

### 4. Konfigurasi file lingkungan

Copy file `.env.example` menjadi `.env`

```bash
cp .env.example .env
```

Edit `.env` sesuai konfigurasi database lokal kamu:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password_database
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Migrasi dan seed database

Jalankan migrasi untuk membuat tabel database:

```bash
php artisan migrate
```

Jika ada data seed, jalankan juga:

```bash
php artisan db:seed
```

### 7. Jalankan server lokal Laravel

```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

---

## Konfigurasi Kode Style

Untuk memudahkan maintainability, gunakan konfigurasi berikut:

```yaml
php:
  preset: laravel
  version: 8
  disabled:
    - no_unused_imports
  finder:
    not-name:
      - index.php
      - server.php
js:
  finder:
    not-name:
      - webpack.mix.js
css: true
```

---

## Struktur File Penting

* `app/` — Kode backend Laravel
* `resources/` — File blade, css, js frontend
* `routes/web.php` — Routing aplikasi
* `.env` — Konfigurasi environment
* `webpack.mix.js` — Konfigurasi asset frontend
* `README.md` — Dokumentasi proyek ini

---

## Lisensi

Proyek ini menggunakan lisensi MIT.

---

## Kontak

* Krisna Aditya Pratama — [GitHub](https://github.com/Krisnaadityapratama)

---

Terima kasih telah menggunakan proyek ini.
Semoga bermanfaat!

```
