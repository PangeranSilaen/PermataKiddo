# Panduan Testing PermataKiddo

Dokumen ini memberikan panduan untuk menjalankan pengujian otomatis (automated testing) pada aplikasi PermataKiddo. Pengujian ini membantu memastikan fungsionalitas aplikasi bekerja dengan baik dan tidak ada regresi saat melakukan perubahan.

## Persiapan Lingkungan Testing

Sebelum menjalankan test, pastikan lingkungan testing telah dikonfigurasi dengan benar:

### 1. Konfigurasi Database Testing

Aplikasi PermataKiddo menggunakan database terpisah untuk lingkungan pengujian untuk memastikan data produksi tidak terpengaruh. File konfigurasi untuk lingkungan testing tersimpan dalam `.env.testing`.

```bash
# Contoh konfigurasi database di .env.testing
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=testing_db
DB_USERNAME=postgres
DB_PASSWORD=codetohero000
```

### 2. Membuat Database Testing

Pastikan database `testing_db` sudah dibuat di PostgreSQL:

```bash
# Buat database testing di PostgreSQL
psql -U postgres -c "CREATE DATABASE testing_db;"
```

## Menjalankan Pengujian

### 1. Menyiapkan Database Testing

Sebelum menjalankan test, siapkan struktur database dan data awal:

```bash
# Jalankan migrasi database dan seeder untuk lingkungan testing
php artisan migrate:fresh --seed --env=testing
```

Perintah ini akan:
- Menghapus semua tabel yang ada di database testing
- Membuat ulang struktur tabel berdasarkan migrasi
- Mengisi data awal melalui seeder

### 2. Menjalankan Semua Test

Untuk menjalankan semua test yang tersedia:

```bash
# Jalankan semua test dalam lingkungan testing
php artisan test --env=testing
```

### 3. Menjalankan Test Tertentu

Anda dapat menjalankan test tertentu dengan menyebutkan nama file atau class test:

```bash
# Menjalankan test register
php artisan test --filter=RegisterTest --env=testing

# Menjalankan test admin login
php artisan test --filter=AdminLoginTest --env=testing

# Menjalankan test jadwal
php artisan test --filter=ScheduleManagementTest --env=testing

# Menjalankan test guru
php artisan test --filter=TeacherManagementTest --env=testing

# Menjalankan test pembayaran
php artisan test --filter=PaymentTest --env=testing
```

## Jenis-jenis Test

PermataKiddo memiliki beberapa jenis test yang menguji berbagai aspek aplikasi:

1. **RegisterTest** - Menguji proses pendaftaran untuk Orang Tua
2. **AdminLoginTest** - Menguji sistem login untuk Admin
3. **ScheduleManagementTest** - Menguji pembuatan jadwal oleh Admin
4. **TeacherManagementTest** - Menguji penambahan data Guru oleh Admin
5. **PaymentTest** - Menguji pembayaran SPP oleh Orang Tua

## Menambahkan Test Baru

Untuk menambahkan test baru, gunakan perintah artisan:

```bash
# Membuat test feature baru
php artisan make:test NamaTestBaru
```

## Pemecahan Masalah

### Test Gagal

Jika test gagal, periksa beberapa hal berikut:

1. Pastikan database testing telah dikonfigurasi dengan benar
2. Pastikan semua tabel dan data yang diperlukan telah dibuat dengan `migrate:fresh --seed`
3. Periksa log error untuk informasi lebih detail
4. Pastikan model dan relasi yang digunakan dalam test sudah benar

### Error "Class not found"

Jika terjadi error "Class not found", jalankan:

```bash
composer dump-autoload
```

### Error Database

Jika terjadi error terkait database, pastikan:

1. Database `testing_db` sudah dibuat
2. User PostgreSQL memiliki akses ke database tersebut
3. Konfigurasi di `.env.testing` sudah benar

## Tips Pengujian

1. Gunakan `RefreshDatabase` trait untuk memastikan database bersih setiap kali menjalankan test
2. Gunakan `DatabaseMigrations` trait jika ingin migrasi dijalankan untuk setiap test class
3. Gunakan `WithFaker` trait untuk menghasilkan data random yang konsisten
4. Setiap test sebaiknya bersifat independen dan tidak bergantung pada hasil test lainnya