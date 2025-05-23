# 📘 Panduan Pengguna Sistem PermataKiddo

---

## Daftar Isi
1. Pendahuluan  
2. Memulai  
3. Masuk & Registrasi  
   3.1. Registrasi  
   3.2. Login  
4. Dashboard  
5. Fitur Utama  
   5.1. Pendaftaran Siswa Baru  
   5.2. Manajemen Data Murid & Guru  
   5.3. Manajemen Jadwal  
   5.4. Capaian Pembelajaran  
   5.5. Pembayaran SPP  
6. Logout  
7. Alur Kerja Sistem  
8. Hak Akses & Role  
9. Keamanan  
10. Catatan Teknis  

---

## 1. Pendahuluan
Selamat datang di sistem *PermataKiddo*. Panduan ini akan membantu Anda memahami dan menggunakan semua fitur utama sistem, dari registrasi hingga pelaporan akademik dan pembayaran.

---

## 2. Memulai
- Buka browser Anda.
- Akses sistem PermataKiddo melalui URL resmi yang diberikan oleh sekolah.

---

## 3. Masuk & Registrasi

### 3.1. Registrasi (Orang Tua)
- Klik tombol *Register*.
- Isi formulir: email, nama, no. telepon, username, password, jenis kelamin.
- Jika valid, akun akan dibuat dan langsung bisa digunakan untuk login.
- Jika data tidak valid (misalnya email sudah terdaftar), sistem akan memberikan notifikasi error.

### 3.2. Login
- Masukkan email dan password.
- Klik *Login*.
- Jika berhasil, Anda akan diarahkan ke Dashboard.
- Jika gagal, sistem akan menampilkan pesan kesalahan.

---

## 4. Dashboard
Setelah login, Anda akan masuk ke dashboard sesuai peran:
- Admin: akses ke seluruh modul manajemen data.
- Guru: akses data siswa, capaian pembelajaran, absensi, status pembayaran, data kelas, jadwal, akses data guru.
- Orang Tua: akses laporan capaian, jadwal, dan status pembayaran.

---

## 5. Fitur Utama

### 5.1. Pendaftaran Siswa Baru
- Orang tua mengisi formulir pendaftaran anak secara online.
- Input: Nama, tanggal lahir, jenis kelamin, foto anak, alamat, nama orang tua/wali, nomor telepon orang tua, email orang tua.
- Output: Notifikasi sukses setelah pendaftaran berhasil.

### 5.2. Manajemen Data Murid & Guru
*(Admin)*
- *List Data*: Menampilkan daftar siswa dan guru.
- *Tambah Data*: Menginput siswa/guru baru.
- *Edit Data*: Memperbarui informasi data.
- *Hapus Data*: Menghapus data dengan konfirmasi.
- *Detail Data*: Melihat rincian lengkap data siswa/guru.

### 5.3. Manajemen Jadwal
*(Admin*)
- *List Jadwal*: Menampilkan daftar kegiatan & jadwal belajar.
- *Tambah Jadwal*: Mengisi dan menjadwalkan kegiatan akademik.
- *Edit & Hapus*: Mengatur ulang jadwal atau menghapusnya sesuai kebutuhan.
- Notifikasi “jadwal berhasil ditambahkan” muncul setelah penyimpanan.

*(Guru*)
- *List Jadwal*: Menampilkan daftar kegiatan & jadwal belajar.

### 5.4. Capaian Pembelajaran
*(Admin dan Guru)*
- *Laporan Nilai*: menandai capaian siswa berdasarkan indikator.
- *Tambah Laporan*: Input nilai dan catatan.
- *Edit & Hapus*: Koreksi atau hapus laporan jika perlu.

*(Orang Tua)* 
- *Melihat laporan*: bisa melihat hasil capaian anak secara langsung.

### 5.5. Pembayaran SPP
- *Admin*: menetapkan tagihan SPP per siswa.
- *Guru*: melihat status pembayaran.
- *Orang Tua*:
  - Melihat tagihan & status pembayaran.
  - Melakukan pembayaran melalui metode transfer/bank/e-wallet.
  - Mengunggah bukti pembayaran untuk konfirmasi.

---

## 6. Logout
- Klik menu profil → Logout.
- Sesi akan berakhir dan kembali ke halaman login.

---

## 7. Alur Kerja Sistem
1. Akses website PermataKiddo.
2. Registrasi akun (Orang Tua) → Login.
3. Navigasi dashboard.
4. Gunakan fitur sesuai peran (lihat jadwal, input nilai, kelola data, dll).
5. Logout setelah selesai.

---

## 8. Hak Akses & Role

Sistem PermataKiddo memiliki tiga jenis pengguna: **Admin**, **Guru**, dan **Orang Tua**.

### 🧑‍💼 Admin
Memiliki akses penuh terhadap seluruh data dan fitur:
- Login & Logout
- Melihat, menambah, menghapus, dan mengubah akun guru dan orang tua 
- Melihat, menambah, menghapus, dan mengubah data murid dan guru
- Melihat, menambah, menghapus, dan mengubah jadwal belajar & kegiatan sekolah
- Melihat, menambah, menghapus, dan mengubah laporan capaian pembelajaran siswa
- Verifikasi pendaftaran online
- Melihat, menambah, menghapus, dan mengubah tagihan dan memantau status pembayaran SPP

### 👩‍🏫 Guru
Memiliki akses terbatas pada fitur akademik:
- Login & Logout
- Melihat jadwal kegiatan
- Melihat data murid di kelasnya
- Melihat, menambah, menghapus, dan mengubah capaian pembelajaran murid
- Melihat status pembayaran SPP

### 👨‍👩‍👧 Orang Tua
Memiliki akses hanya pada data anak sendiri:
- Registrasi akun
- Login & Logout
- Mengisi formulir pendaftaran siswa baru
- Melihat jadwal anak
- Melihat capaian pembelajaran anak
- Melihat status tagihan SPP
- Melakukan pembayaran SPP secara online

---

## 9. Keamanan
- Password terenkripsi.
- Validasi input saat pengisian data.
- Konfirmasi pada setiap aksi sensitif (hapus data).
- Otentikasi login & sesi pengguna dijaga dengan baik.

---

*© 2025 - PermataKiddo*  
Dikembangkan oleh: Kelompok 11 – Institut Teknologi Kalimantan