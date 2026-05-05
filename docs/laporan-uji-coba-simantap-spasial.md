# Laporan Uji Coba Sistem

## Informasi Pengujian

- Nama fitur: SiMantap Spasial - Generate XML
- URL pengujian: `/simantapSpasial`
- Jenis pengujian: Feature test sederhana
- Tujuan: Memastikan halaman generator XML SiMantap Spasial dapat dibuka dan komponen utama form tampil dengan benar.

## Skenario Uji

| No. | Skenario | Langkah Uji | Hasil yang Diharapkan | Status |
| --- | --- | --- | --- | --- |
| 1 | Membuka halaman SiMantap Spasial | Akses URL `/simantapSpasial` melalui HTTP GET | Sistem mengembalikan status HTTP 200 | Lulus |
| 2 | Validasi konten utama halaman | Periksa tampilan teks `SiMantap Spasial`, `Generate XML`, `Nama Dinas`, dan `Nama Data Spasial` | Komponen utama form tampil pada halaman | Lulus |
| 3 | Validasi data OPD | Siapkan data uji OPD Bapperida, lalu buka halaman | Data OPD muncul sebagai pilihan pada field Nama Dinas | Lulus |
| 4 | Validasi kuota generate XML | Buka halaman dengan cache testing kosong | Kuota harian tampil `10/10` | Lulus |
| 5 | Validasi captcha | Buka halaman dan periksa session captcha | Sistem membuat session `simantap_spasial_captcha_answer` | Lulus |

## Data Uji

| Field | Nilai |
| --- | --- |
| Nama OPD | Badan Perencanaan Pembangunan, Riset dan Inovasi Daerah |
| Akronim OPD | Bapperida |
| Kepala OPD | Kepala Bapperida |
| Jabatan | Kepala Badan |
| Telepon | 081234567890 |
| Alamat | Jl. Contoh No. 1 |
| Kode Pos | 76111 |
| Email | bapperida@example.test |

## Bukti Implementasi

- File test: `tests/Feature/SimantapSpasialPageTest.php`
- Perintah uji spesifik yang dijalankan:

```bash
/Users/ihsan/Library/Application\ Support/Herd/bin/php artisan test tests/Feature/SimantapSpasialPageTest.php
```

- Hasil uji: `PASS` - 1 test lulus dengan 10 assertions.
- Perintah pengecekan format:

```bash
/Users/ihsan/Library/Application\ Support/Herd/bin/php vendor/bin/pint --test tests/Feature/SimantapSpasialPageTest.php
```

- Hasil pengecekan format: `passed`.

## Kesimpulan

Berdasarkan pengujian sederhana, halaman `/simantapSpasial` berhasil diakses, menampilkan form generator XML, menampilkan data OPD, menampilkan sisa kuota generate XML, dan membuat session captcha. Hasil ini dapat digunakan sebagai evidence awal uji coba sistem untuk fitur SiMantap Spasial.
