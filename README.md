# SiMantap Spasial

Panduan ini menjelaskan cara memasang aplikasi SiMantap Spasial di laptop lain atau server produksi. Aplikasi ini menggunakan Laravel, MySQL, dan Vite untuk aset frontend.

## Kebutuhan Sistem

Pastikan perangkat sudah memiliki:

- PHP 8.3 atau lebih baru
- Composer
- Node.js dan npm
- MySQL atau MariaDB
- Git
- Web server untuk produksi, misalnya Nginx atau Apache

Untuk instalasi lokal di laptop, web server khusus tidak wajib karena aplikasi bisa dijalankan dengan `php artisan serve`.

## Instalasi di Laptop Lain

### 1. Ambil kode aplikasi

Clone repository atau salin folder aplikasi ke laptop tujuan.

```bash
git clone <url-repository> SiMantapSpasial
cd SiMantapSpasial
```

Jika aplikasi disalin manual, langsung masuk ke folder aplikasi:

```bash
cd SiMantapSpasial
```

### 2. Install dependency PHP

```bash
composer install
```

### 3. Install dependency frontend

```bash
npm install
```

### 4. Buat file konfigurasi `.env`

```bash
cp .env.example .env
```

Pada Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Buat database

Buat database MySQL baru, misalnya:

```sql
CREATE DATABASE simantap_spasial;
```

### 7. Atur koneksi database di `.env`

Sesuaikan bagian berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simantap_spasial
DB_USERNAME=root
DB_PASSWORD=
```

Isi `DB_USERNAME` dan `DB_PASSWORD` sesuai akun MySQL di perangkat tujuan.

### 8. Jalankan migrasi dan seeder

```bash
php artisan migrate --seed
```

Seeder akan membuat data awal, termasuk akun admin:

```text
Email: admin@example.com
Password: password
```

Segera ubah email dan password admin setelah berhasil login.

### 9. Build aset frontend

```bash
npm run build
```

### 10. Jalankan aplikasi lokal

```bash
php artisan serve
```

Buka aplikasi di browser:

```text
http://127.0.0.1:8000
```

Halaman utama aplikasi tersedia di `/`, sedangkan halaman login tersedia di `/login`.

## Instalasi untuk Produksi

Gunakan langkah ini saat aplikasi dipasang di server produksi.

### 1. Upload atau clone aplikasi ke server

Contoh:

```bash
git clone <url-repository> /var/www/SiMantapSpasial
cd /var/www/SiMantapSpasial
```

### 2. Install dependency PHP untuk produksi

```bash
composer install --no-dev --optimize-autoloader
```

### 3. Install dependency frontend dan build aset

```bash
npm install
npm run build
```

Setelah build selesai, folder `node_modules` tidak harus dipakai oleh web server. Yang dibutuhkan aplikasi adalah hasil build di folder `public/build`.

### 4. Buat dan atur file `.env`

```bash
cp .env.example .env
php artisan key:generate
```

Ubah konfigurasi penting berikut:

```env
APP_NAME="PE Bapperida"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-produksi-anda.go.id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simantap_spasial
DB_USERNAME=user_database
DB_PASSWORD=password_database

QUEUE_CONNECTION=database
SESSION_DRIVER=file
CACHE_STORE=file
```

Catatan penting:

- Jangan gunakan `APP_DEBUG=true` di produksi.
- Pastikan `APP_URL` sesuai domain produksi.
- Jangan membagikan file `.env` karena berisi kredensial database dan kunci aplikasi.

### 5. Jalankan migrasi database

Untuk instalasi pertama:

```bash
php artisan migrate --seed --force
```

Untuk update aplikasi yang sudah berjalan:

```bash
php artisan migrate --force
```

### 6. Optimasi konfigurasi Laravel

```bash
php artisan optimize
```

Jika ada perubahan `.env`, route, config, atau view, bersihkan cache lalu optimasi ulang:

```bash
php artisan optimize:clear
php artisan optimize
```

### 7. Atur permission folder storage dan cache

Folder berikut harus bisa ditulis oleh user web server:

```text
storage
bootstrap/cache
```

Contoh di Linux:

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

Sesuaikan `www-data` dengan user web server yang digunakan. Pada beberapa server, user web server bisa bernama `nginx`, `apache`, atau user hosting tertentu.

### 8. Arahkan web server ke folder `public`

Document root web server harus mengarah ke:

```text
/path/ke/SiMantapSpasial/public
```

Jangan arahkan domain ke folder root project, karena file seperti `.env`, `composer.json`, dan source code tidak boleh dapat diakses publik.

Contoh konfigurasi Nginx:

```nginx
server {
    listen 80;
    server_name domain-produksi-anda.go.id;
    root /var/www/SiMantapSpasial/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Setelah konfigurasi diubah, restart atau reload web server.

## Menjalankan Queue Worker

Konfigurasi default menggunakan `QUEUE_CONNECTION=database`. Jika aplikasi memakai job antrean, jalankan worker:

```bash
php artisan queue:work
```

Di produksi, jalankan queue worker menggunakan supervisor/process manager agar otomatis hidup kembali jika proses berhenti.

## Update Aplikasi

Saat ada versi baru, jalankan urutan berikut di server:

```bash
git pull
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan migrate --force
php artisan optimize:clear
php artisan optimize
```

Jika server menggunakan queue worker, restart worker setelah update:

```bash
php artisan queue:restart
```

## Perintah Harian yang Sering Dipakai

Menjalankan aplikasi lokal:

```bash
php artisan serve
```

Menjalankan Vite mode development:

```bash
npm run dev
```

Build aset frontend:

```bash
npm run build
```

Menjalankan migrasi:

```bash
php artisan migrate
```

Menjalankan seeder:

```bash
php artisan db:seed
```

Membersihkan cache:

```bash
php artisan optimize:clear
```

## Troubleshooting

Jika muncul error koneksi database:

- Pastikan MySQL/MariaDB berjalan.
- Pastikan database sudah dibuat.
- Pastikan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di `.env` benar.
- Jalankan ulang `php artisan optimize:clear` setelah mengubah `.env`.

Jika halaman tampil tanpa style:

- Jalankan `npm install`.
- Jalankan `npm run build`.
- Pastikan folder `public/build` ada.

Jika muncul error permission:

- Pastikan folder `storage` dan `bootstrap/cache` bisa ditulis oleh web server.

Jika login gagal dengan akun awal:

- Pastikan sudah menjalankan `php artisan migrate --seed`.
- Jika database sudah pernah diisi, cek data user di tabel `users`.

Jika perubahan `.env` tidak terbaca:

```bash
php artisan optimize:clear
```

## Catatan Keamanan Produksi

- Gunakan `APP_ENV=production`.
- Gunakan `APP_DEBUG=false`.
- Gunakan password database yang kuat.
- Ganti password akun admin bawaan setelah instalasi.
- Arahkan web server hanya ke folder `public`.
- Jangan upload atau membagikan file `.env`.
