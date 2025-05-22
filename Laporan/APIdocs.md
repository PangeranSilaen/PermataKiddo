# PermataKiddo - Dokumentasi API

## Pendahuluan

Dokumen ini menyediakan dokumentasi untuk API PermataKiddo (Sistem Informasi Akademik), sebuah sistem informasi sekolah berbasis Laravel Filament. API ini menyediakan fungsionalitas untuk autentikasi, pendaftaran orang tua, pendaftaran siswa, dan pemrosesan pembayaran.

## URL Dasar

`http://127.0.0.1:8000`

## Autentikasi

Sebagian besar endpoint dilindungi dan memerlukan autentikasi. Sistem ini menggunakan sistem autentikasi bawaan Laravel.

### Endpoint Autentikasi

#### Login

- **URL**: `/login`
- **Metode**: POST
- **Deskripsi**: Mengautentikasi pengguna dan membuat sesi
- **Parameter**:
  - `email` (wajib): Alamat email pengguna
  - `password` (wajib): Kata sandi pengguna
- **Respons**: Mengalihkan ke dashboard yang sesuai berdasarkan peran pengguna
  - Pengguna orang tua → `/parent-dashboard`
  - Peran lain → `/admin`
- **Respons Error**: Error validasi jika kredensial tidak valid

#### Register (Pendaftaran)

- **URL**: `/register`
- **Metode**: POST
- **Deskripsi**: Membuat akun pengguna orang tua baru
- **Parameter**:
  - `name` (wajib): Nama lengkap
  - `email` (wajib): Alamat email unik
  - `gender` (wajib): Pilihan 'male' atau 'female'
  - `phone` (wajib): Nomor telepon
  - `password` (wajib): Kata sandi (minimal 8 karakter)
  - `password_confirmation` (wajib): Harus sama dengan password
- **Respons**: Mengalihkan ke `/parent-dashboard` setelah pendaftaran berhasil
- **Respons Error**: Error validasi untuk bidang yang tidak valid atau kosong

#### Logout

- **URL**: `/logout`
- **Metode**: POST
- **Deskripsi**: Mengeluarkan pengguna saat ini dan menginvalidasi sesi
- **Respons**: Mengalihkan ke halaman login

## Fitur untuk Orang Tua

### Pendaftaran Siswa oleh Orang Tua

#### Lihat Form Pendaftaran

- **URL**: `/parent/register`
- **Metode**: GET
- **Deskripsi**: Menampilkan formulir pendaftaran siswa
- **Autentikasi**: Diperlukan (Peran orang tua)
- **Respons**: Mengembalikan tampilan formulir pendaftaran

#### Kirim Pendaftaran

- **URL**: `/parent/register`
- **Metode**: POST
- **Deskripsi**: Mengirimkan pendaftaran siswa
- **Autentikasi**: Diperlukan (Peran orang tua)
- **Parameter**:
  - `name` (wajib): Nama lengkap siswa
  - `birth_date` (wajib): Tanggal lahir siswa
  - `gender` (wajib): Pilihan 'male' atau 'female'
  - `address` (wajib): Alamat rumah
  - `photo` (opsional): Foto siswa (gambar, maks 2MB)
  - `parent_name` (wajib): Nama lengkap orang tua
  - `parent_phone` (wajib): Nomor telepon orang tua
  - `parent_email` (opsional): Alamat email orang tua
- **Respons**: Mengalihkan ke dashboard orang tua dengan pesan sukses
- **Respons Error**: Error validasi untuk bidang yang tidak valid atau kosong

#### Alternatif Pendaftaran dengan Filament

- **URL**: `/pendaftaran-anak`
- **Metode**: GET
- **Deskripsi**: Mengakses halaman pendaftaran anak menggunakan Filament
- **Autentikasi**: Diperlukan (Peran orang tua)
- **Respons**: Menampilkan halaman pendaftaran Filament

### Proses Pembayaran

#### Lihat Detail Pembayaran

- **URL**: `/parent/pay/{payment}`
- **Metode**: GET
- **Deskripsi**: Menampilkan formulir pembayaran untuk pembayaran tertentu
- **Autentikasi**: Diperlukan (Peran orang tua)
- **Parameter**:
  - `payment` (wajib): ID pembayaran dalam URL
- **Respons**: Mengembalikan tampilan formulir pembayaran dengan detail pembayaran

#### Konfirmasi Pembayaran

- **URL**: `/parent/pay/{payment}/confirm`
- **Metode**: POST
- **Deskripsi**: Memproses dan mengkonfirmasi pembayaran
- **Autentikasi**: Diperlukan (Peran orang tua)
- **Parameter**:
  - `payment` (wajib): ID pembayaran dalam URL
  - `payment_method` (wajib): Metode pembayaran
  - `payment_proof` (opsional): File gambar bukti pembayaran (wajib jika bukan tunai)
- **Respons**: Mengalihkan ke dashboard orang tua dengan pesan sukses
- **Respons Error**: Error validasi untuk bidang yang tidak valid atau kosong

## Fitur Admin

Aplikasi ini menggunakan Filament untuk panel adminnya. Fungsi admin dapat diakses di `/admin` untuk pengguna yang berwenang dengan peran yang sesuai (guru dan administrator).

### Logout Kustom untuk Panel Admin

- **URL**: `/admin/logout`
- **Metode**: GET
- **Deskripsi**: Keluar dari panel admin
- **Respons**: Mengalihkan ke halaman login

### Pengalihan Login Admin

- **URL**: `/admin/login`
- **Metode**: GET
- **Deskripsi**: Mengalihkan ke halaman login utama
- **Respons**: Mengalihkan ke `/login`

## Akses Dashboard

### Dashboard Orang Tua

- **URL**: `/parent-dashboard`
- **Metode**: GET
- **Deskripsi**: Dashboard pengguna orang tua
- **Autentikasi**: Diperlukan (Peran orang tua)
- **Respons**: Mengembalikan tampilan dashboard orang tua

### Dashboard Guru

- **URL**: `/teacher-dashboard`
- **Metode**: GET
- **Deskripsi**: Mengalihkan guru ke panel admin
- **Autentikasi**: Diperlukan (Peran guru)
- **Respons**: Mengalihkan ke `/admin`

## Penanganan Error

API mengembalikan kode status HTTP yang sesuai:
- 200: Sukses
- 302: Pengalihan
- 401: Tidak Terotentikasi
- 403: Dilarang
- 422: Error Validasi
- 500: Error Server

## Format Respons

Sebagian besar respons dalam website ini adalah dalam format tampilan web (HTML), bukan dalam format API tradisional seperti JSON. Ini karena aplikasi dirancang terutama sebagai aplikasi web dengan antarmuka pengguna yang berbasis browser.

## Keamanan

Semua rute dilindungi oleh middleware autentikasi Laravel kecuali rute login dan register. Middleware peran tambahan (`RoleMiddleware`) digunakan untuk memastikan bahwa pengguna hanya dapat mengakses rute yang sesuai dengan peran mereka.

## Catatan

- Unggahan file memiliki batas ukuran maksimum 2MB
- Aplikasi ini menggunakan Laravel dan Filament untuk administrasi
- Terdapat integrasi dengan sistem manajemen peran dan izin
- RBAC (Shield) memastikan pengguna hanya dapat mengakses rute yang sesuai atau telah ditentukan.