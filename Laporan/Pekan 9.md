# Rencana Proyek PermataKiddo - Pekan 9: Requirement Gathering & Planning

**Fokus Pekan Ini:** Mengumpulkan kebutuhan detail dari mitra, mendefinisikan lingkup awal (MVP), merancang tampilan awal, menyiapkan infrastruktur dasar proyek, dan memilih teknologi pendukung.

---

## Timeline
* **Detail Timeline:** Setelah beberapa fitur MVP atau tampilan awal dari website PermataKiddo telah dibuat kami akan memberikan hasil nya kepada mitra dan menyesuaikan jadwal jadi tidak ada jadwal pasti. Namun untuk pengujian sistem dan perbaikan secara menyeluruh akan dilakukan dibulan Mei.

## a. Pertemuan dengan Mitra untuk Identifikasi Kebutuhan

* **Deskripsi Kebutuhan Mitra:** TK Permata Bunda sebagai mitra dalam proyek pengembangan sistem informasi PermataKiddo memiliki kebutuhan utama untuk meningkatkan efisiensi dan efektivitas pengelolaan aktivitas akademik di lingkungan sekolah. Selama ini, pihak sekolah menghadapi kendala dalam penggunaan aplikasi Dapodik karena sistem tersebut bersifat umum dan mencakup jenjang pendidikan dari TK hingga SLB, sehingga kurang sesuai untuk kebutuhan operasional spesifik di tingkat taman kanak-kanak. Oleh karena itu, TK Permata Bunda membutuhkan sebuah sistem yang dapat mendukung proses pendaftaran siswa secara online, manajemen data murid dan guru yang terintegrasi, serta pengaturan jadwal kegiatan belajar. Selain itu, mitra juga membutuhkan fitur pelaporan capaian pembelajaran yang dapat diakses oleh orang tua, serta sistem pembayaran SPP yang praktis dan dapat dilakukan secara digital. Dengan antarmuka yang user-friendly dan aksesibilitas yang baik, sistem ini diharapkan mampu meningkatkan transparansi, komunikasi, dan kolaborasi antara pihak sekolah, guru, dan orang tua murid.


## b. Menentukan Fitur MVP (Minimum Viable Product)

* **Fitur Kandidat MVP:**
    * **Autentikasi Pengguna:**
        * Login untuk Admin, Guru, dan Orang Tua.
        * Register untuk Orang Tua (sesuai revisi A SKPL).
        * *Catatan: Akun Guru & Admin dibuat manual oleh Admin.*
    * **Manajemen Data Dasar (oleh Admin):**
        * Kelola Data Siswa (Tambah, Lihat, Ubah, Hapus - CRUD).
        * Kelola Data Guru (CRUD).
        * Kelola Data Kelas.
    * **Manajemen Akademik (oleh Guru):**
        * Input Absensi Siswa. (Saat ini masih aman dan tidak ada masalah jadi tidak terlalu dibutuhkan tapi dipertimbangkan)
        * Input Capaian Pembelajaran/Penilaian Siswa.
        * Lihat Data Siswa per Kelas.
    * **Fitur Orang Tua:**
        * Lihat Data Anak.
        * Lihat Absensi Anak.
        * Lihat Capaian Pembelajaran/Penilaian Anak.
        * Lihat Tagihan SPP.
    * **Manajemen SPP (oleh Admin):**
        * Generate Tagihan SPP (otomatis/manual).
        * Kelola Status Pembayaran SPP (menandai lunas).
        * *(Fitur pembayaran online mungkin ditunda pasca-MVP jika kompleksitas tinggi, fokus pada pencatatan dulu tapi jika memungkinkan akan menggunakan payment gateway Midtrans)*.
* **Tindakan:**
    * Tim pengembang (Kelompok 11) mendiskusikan prioritas berdasarkan hasil meeting.
    * Finalisasi daftar fitur MVP.
    * Konfirmasi ulang daftar MVP dengan mitra (jika diperlukan).
* **Output:** Daftar Fitur MVP yang Disepakati.

## c. Membuat Wireframe/Mockup Awal


* **Link Mockup (figma):** [Link Figma](https://www.figma.com/design/XwryuEr1pP3SRyV1YHPVyl/MOCKUP?node-id=0-1&t=GCkGfiFzZ09L4sXv-1)
* **Deskripsi Wireframe:**
    * **Layout Umum:**
        * **Sidebar Kiri:** Berisi menu navigasi utama sesuai peran pengguna (e.g., Dashboard, Data Siswa, Data Guru, Akademik, SPP, Pengaturan, Logout). Menu aktif akan ditandai. Akan ada logo atau nama aplikasi di bagian atas sidebar.
        * **Header Atas:** Berisi judul halaman saat ini, mungkin nama pengguna yang login dan tombol notifikasi atau profil.
        * **Area Konten Utama:** Tempat menampilkan konten sesuai menu yang dipilih (tabel data, formulir, detail informasi, dll.).
    * **Halaman Login:** Formulir sederhana dengan input untuk email/username, password, dan tombol "Login". Ada tautan ke halaman "Register" (untuk Orang Tua).
    * **Halaman Register (Orang Tua):** Formulir dengan input untuk data diri Orang Tua dan data Anak, password, konfirmasi password, dan tombol "Register".
    * **Dashboard (Contoh Admin):** Menampilkan ringkasan informasi penting (jumlah siswa, guru, status SPP terbaru, dll.) dalam bentuk kartu (cards) atau widget sederhana.
    * **Halaman Data (e.g., Data Siswa - Admin):**
        * Judul Halaman ("Data Siswa").
        * Tombol "Tambah Siswa Baru".
        * Area Filter/Pencarian (opsional).
        * Tabel menampilkan daftar siswa dengan kolom relevan (NIS, Nama, Kelas, Aksi). Kolom "Aksi" berisi tombol/ikon untuk "Lihat Detail", "Ubah", "Hapus".
    * **Formulir Tambah/Ubah (e.g., Tambah Siswa):** Judul formulir, field input sesuai data yang dibutuhkan (NIS, Nama, Tanggal Lahir, Kelas, Data Orang Tua, dll.), tombol "Simpan" dan "Batal".
    * **Halaman Input Nilai (Guru):** Pemilih kelas/siswa, tabel atau daftar aspek penilaian dengan input (angka/ceklis/dropdown) untuk memasukkan nilai/capaian, tombol "Simpan Nilai".
    * **Halaman Tagihan SPP (Orang Tua):** Menampilkan daftar tagihan SPP anak (bulan/tahun, nominal, status: Lunas/Belum Lunas/Jatuh Tempo). Mungkin ada tombol "Detail" atau "Cara Pembayaran" (jika belum ada pembayaran online).


## d. Menyiapkan Struktur Proyek dan Repository

* **Hasil dan langkah:**
    1.  **Repository:**
        * Link Repository: [PermataKiddo GitHub](https://github.com/PangeranSilaen/PermataKiddo)

    2.  **Struktur Proyek (Laravel 11):**
        * Membuat proyek Laravel baru menggunakan Composer:
            ```bash
            composer create-project laravel/laravel permata-kiddo
            ```
        * Mengkonfigurasi file `.env` untuk koneksi database MySQL (DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
        * Menjalankan migrasi awal: `php artisan migrate`.
    3.  **Instalasi dan Setup Filament v3:**
        * Install package Filament menggunakan Composer:
            ```bash
            composer require filament/filament:"^3.0" -W
            ```
            * *(Flag `-W` digunakan untuk memperbolehkan versi dev dan major update jika diperlukan, sesuai standar Filament v3)*
        * Menjalankan perintah instalasi Filament untuk membuat Panel Provider default untuk admin:
            ```bash
            php artisan filament:install --panels
            ```
        * Menghasilkan file seperti `app/Providers/Filament/AdminPanelProvider.php`.
        * Membuat user pertama untuk panel admin:
            ```bash
            php artisan make:filament-user
            ```

## e. Menentukan Teknologi Pendukung

* **Teknologi Utama (Sudah Ditentukan):** Laravel 11 (Framework PHP), Filament v3 (Admin Panel Builder), MySQL (Database).
* **Teknologi Pendukung & Bawaan Laravel/Filament:**
    * **Backend (Laravel):**
        * **ORM:** Eloquent (Built-in).
        * **Templating Engine:** Blade (Built-in).
        * **Routing:** Laravel Router (Built-in).
        * **Authentication:**
            * Filament menyediakan sistem login bawaan untuk panelnya, terintegrasi dengan Auth Laravel.
            * Untuk registrasi Orang Tua (yang tidak melalui panel admin utama), bisa menggunakan route dan controller custom, atau mempertimbangkan instalasi `Laravel Breeze` (API only / Blade non-SPA) jika diperlukan scaffolding dasar di luar Filament. *Keputusan awal: Menggunakan auth bawaan Filament untuk Admin/Guru, buat route/controller custom untuk registrasi Orang Tua jika diperlukan.*
        * **Authorization:** Laravel Gates & Policies (Built-in).
        * **Validation:** Laravel Validator (Built-in), Filament Forms menggunakan ini di belakang layar.
        * **Password Hashing:** `Hash` Facade (Built-in, default bcrypt).
        * **Antrian & Jadwal:** Laravel Queues & Scheduler (Built-in, berguna untuk tugas background seperti generate SPP).
    * **Frontend (Filament/Blade):**
        * **UI Components:** Komponen bawaan Filament (Forms, Tables, Infolists, Widgets, Actions, Notifications).
        * **Styling:** Tailwind CSS (Built-in dan dikonfigurasi oleh Filament). Kustomisasi tema bisa dilakukan melalui Panel Provider langsung atau di file `tailwind.config.js`.
        * **JavaScript Interactivity:** Alpine.js (Built-in dependency Filament), Livewire (Built-in dependency Filament untuk interaksi dinamis).
        * **Charts/Visualisasi:** Filament menyediakan Chart Widgets (`filament/widgets`). Mungkin perlu install library charting JS seperti `Chart.js` jika belum ter-include dependensinya.
    * **Database:**
        * Menggunakan Database MySQL di phpmyadmin.
    * **Package Tambahan yang Mungkin Diperlukan:**
        * `spatie/laravel-permission`: Sangat umum digunakan untuk manajemen Roles & Permissions yang kompleks, terintegrasi baik dengan Filament. *Yang kami gunakan: Kami akan menggunakan plugin filament yakni SHIELD dalam pembuatan RBAC (Role Based Access Control).*
        * `spatie/laravel-medialibrary`: Masih menjadi opsi jika diperlukan manajemen upload file yang lebih advanced (misal: foto siswa, bukti bayar SPP).
        * Plugin Filament spesifik: detail shield ada di [dokumentasi plugin SHIELD](https://filamentphp.com/plugins/bezhansalleh-shield).
    * **Development Tools:**
        * **Code Formatting/Styling:** `Laravel Pint` (Built-in di Laravel 11).
        * **Debugging:**  `Xdebug` (untuk debugging step-by-step).
        * **Local Development Environment:** `Laragon` Windows
        * **Versi bahasa PHP:** minimal `PHP 8.2^` 
