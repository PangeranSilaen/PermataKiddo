**Tujuan Utama:** Membuat prototipe fungsional sistem akademik bernama PermataKiddo yang memiliki:

* Fitur Register (pendaftaran akun orang tua)
* Fitur Login (akses akun untuk orang tua dan guru)
* Fitur Pendaftaran Online (pendaftaran murid baru)
* Fitur Manajemen Data Murid & Guru (CRUD)
* Fitur Jadwal Belajar & Kegiatan (CRUD)
* Fitur Capaian Pembelajaran (CRUD)
* Fitur Pembayaran SPP
* Fitur Logout

**Role dan Akses:**

1.  **Admin:**
    * Akses Login dan Logout
    * CRUD Akun User
    * CRUD Jadwal
    * CRUD Data Murid
    * CRUD Data Guru
    * CRUD Laporan Capaian Pembelajaran
    * Melihat Status Pembayaran SPP
2.  **Guru:**
    * Akses Login dan Logout
    * Melihat Jadwal
    * Melihat Data Murid
    * Melihat Data Guru
    * CRUD Laporan Capaian Pembelajaran
    * Melihat Status Pembayaran SPP
3.  **Orang Tua:**
    * Akses Register, Login, dan Logout
    * Pendaftaran Online Murid
    * Melihat Jadwal
    * Melihat Laporan Capaian Pembelajaran
    * Melihat Tagihan SPP
    * Membayar SPP

**Instruksi Tambahan untuk Copilot Agent:**

1.  Implementasikan semua fitur yang disebutkan di atas.
3.  Pastikan manajemen akses berdasarkan role diimplementasikan dengan benar.
5.  Tambahkan validasi input yang diperlukan.
4.  Tambahkan komentar diatas fungsi/kode agar aku bisa memahami maksud kodenya.

**Plugin filament:**

Untuk mengatur manajemen akses install dan gunakan plugin filament bernama "shield".