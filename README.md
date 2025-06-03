# Infus\_project

**Infus\_project** adalah aplikasi monitoring infus yang terintegrasi dengan kontrol servo menggunakan modul ESP8266. Project ini menggunakan Laravel 8 untuk backend dan PHP, serta ESP8266 dengan sensor berat HX711 dan OLED display untuk perangkat IoT-nya. Sistem ini memungkinkan pemantauan tetesan infus secara realtime sekaligus kontrol mekanisme servo secara otomatis berdasarkan data tetesan.

---

## Fitur Utama

* Monitoring laju tetesan infus secara realtime (drops per minute & drops per second)
* Pengukuran berat cairan infus menggunakan sensor HX711
* Kontrol servo otomatis sesuai laju tetesan
* Tampilan data pada OLED 128x64 pada perangkat IoT
* Komunikasi data IoT ke server Laravel menggunakan HTTP GET request
* Backend Laravel untuk manajemen data dan monitoring
* Video demo: [YouTube - Infus Project Demo](https://youtu.be/WhJtefjVekc)

---

## Teknologi yang Digunakan

* **Backend**: PHP Laravel Framework 8
* **Frontend**: Blade, CSS, JavaScript
* **IoT Device**: ESP8266 (NodeMCU), sensor HX711 (load cell), OLED SSD1306, Servo Motor
* **Libraries IoT**: ESP8266WiFi, HX711, Adafruit\_SSD1306, Servo, Ticker

---

## Instalasi dan Setup

### 1. Clone Repository

```bash
git clone https://github.com/Krisnaadityapratama/Infus_project.git
cd Infus_project
```

### 2. Setup Backend Laravel

* Pastikan PHP versi 7.3 atau lebih tinggi sudah terinstall
* Install dependencies via Composer:

```bash
composer install
```

* Copy file environment example:

```bash
cp .env.example .env
```

* Edit file `.env` sesuai konfigurasi database Anda (MySQL atau lainnya). Contoh:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=infus_db
DB_USERNAME=root
DB_PASSWORD=
```

* Generate application key:

```bash
php artisan key:generate
```

* Jalankan migrasi database:

```bash
php artisan migrate
```

* Jalankan server Laravel (default di `http://localhost:8000`):

```bash
php artisan serve
```

### 3. Setup Frontend

Frontend sudah termasuk di dalam Laravel dengan Blade templates. Anda tinggal buka di browser.

### 4. Upload Firmware IoT (ESP8266)

* Buka folder `infus_basic/`
* File utama: `infus_basic.ino`
* Buka file tersebut di Arduino IDE atau platform pengembangan ESP8266 lain.
* Pastikan board ESP8266 sudah dipilih dengan benar.
* Sesuaikan `ssid`, `password`, dan `host` di kode dengan jaringan WiFi dan IP server backend Anda.
* Upload kode ke ESP8266.

---

## Penjelasan Folder `infus_basic`

Folder ini berisi kode firmware untuk perangkat IoT berbasis ESP8266 yang bertugas untuk:

* Menghitung jumlah tetesan cairan infus menggunakan interrupt (pin D5/D14)
* Mengukur berat cairan menggunakan sensor load cell dengan modul HX711
* Menampilkan data tetesan dan berat cairan pada layar OLED 128x64 menggunakan Adafruit SSD1306
* Mengirim data tetesan dan berat secara berkala ke server backend Laravel melalui HTTP GET request
* Mengambil data setting laju tetesan (drop rate) dari server untuk mengontrol servo motor secara otomatis
* Menggerakkan servo motor berdasarkan data laju tetesan yang diterima

### Detail Kode `infus_basic.ino`

* **Library dan Pin Setup**
  Menggunakan ESP8266WiFi untuk koneksi WiFi, HX711 untuk load cell, Adafruit\_SSD1306 untuk OLED, Servo untuk motor servo, dan Ticker untuk timer interrupt.

* **Interrupt Counter**
  Fungsi `voidCounter()` dipasang sebagai interrupt service routine untuk menghitung setiap tetesan yang terdeteksi pada sensor tetesan cairan.

* **Penghitungan Drops per Minute dan Drops per Second**
  Fungsi `timerIsr()` menghitung interval antar tetesan dan menghitung laju tetesan yang kemudian ditampilkan dan dikirim ke server.

* **Pengukuran Berat Cairan**
  Sensor HX711 mengukur berat cairan yang dikalibrasi dan dikonversi ke satuan gram.

* **Display OLED**
  Data seperti tetesan per detik (T/D), tetesan per menit (D/M), dan kapasitas cairan (K) ditampilkan di OLED.

* **Pengiriman Data ke Server**
  Setiap 60 detik, data tetesan dan kapasitas cairan dikirimkan ke endpoint server Laravel dengan HTTP GET.

* **Pengambilan Data dari Server**
  Kode mengambil nilai drop rate dari server untuk digunakan sebagai acuan dalam menggerakkan servo motor.

* **Kontrol Servo Motor**
  Servo dikontrol berdasarkan nilai drop rate yang diterima, dengan mapping sudut servo dari 0 sampai 180 derajat.

---

## Konfigurasi Penting di Firmware

* `ssid` dan `password` — untuk koneksi WiFi
* `host` — IP server backend Laravel
* `idAlat` — ID unik alat IoT, dapat disesuaikan sesuai kebutuhan
* `calibration_factor` — faktor kalibrasi sensor HX711, perlu disesuaikan dengan sensor Anda

---

## File dan Struktur Penting

```
Infus_project/
├── app/
├── bootstrap/
├── config/
├── database/
├── infus_basic/
│   └── infus_basic.ino          # Firmware ESP8266
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── .env.example
├── composer.json
├── package.json
├── README.md                   # Dokumentasi ini
└── webpack.mix.js
```

---

## Referensi dan Video Demo

* Demo Project dapat dilihat di YouTube:
  [https://youtu.be/WhJtefjVekc](https://youtu.be/WhJtefjVekc)

---

## Lisensi

Proyek ini menggunakan lisensi **MIT**.
