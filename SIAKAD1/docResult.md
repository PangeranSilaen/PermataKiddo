# Dokumentasi Proyek PermataKiddo

## 1. Penjelasan Tentang Codebase
Proyek ini dibangun menggunakan Laravel (versi 11) dan Filament (versi 3) untuk membuat aplikasi Sistem Informasi Akademik (SIAKAD). Fitur utama meliputi:
- Manajemen Data Siswa, Guru, Jadwal, Prestasi, dan Pembayaran.
- Panel admin interaktif dengan UI Filament Resources dan Pages.
- Authentikasi dan otorisasi user menggunakan Laravel Breeze/Filament Auth.
- Database SQLite/MySQL dengan migrasi dan seeder.

Struktur direktori utama:
- `app/Models/` → Definisi model Eloquent (Student, Teacher, Schedule, Achievement, Payment, User).
- `app/Http/Controllers/` → Logika kontrol endpoint jika diperlukan.
- `app/Filament/Resources/` → Definisi Resource Filament untuk CRUD.
- `database/migrations/` → File migrasi skema tabel.
- `database/seeders/` → Data awal untuk seeder.
- `resources/views/` → Blade view dasar (contoh: welcome).
- `routes/web.php` → Routing aplikasi web.

## 2. Project Requirements
- PHP >= 8.2
- Composer
- Laravel ^11.0
- Filament ^3.2.0 (`composer require filament/filament`)
- BezhanSalleh/Filament-Shield ^3.3 (`composer require bezhansalleh/filament-shield`)
- Ekstensi PHP: `intl`, `mbstring`, `pdo_sqlite`/`pdo_mysql`, `openssl`, `tokenizer`, `xml`.
- Node.js & npm (untuk asset bundling Vite)

### 2.1 Instalasi dan Konfigurasi Filament Shield
1. Tambahkan paket Shield:
   ```bash
   composer require bezhansalleh/filament-shield
   ```
2. Publish konfigurasi dan assets:
   ```bash
   php artisan vendor:publish --tag=filament-shield-config
   ```
   - File konfigurasi akan dibuat di `config/filament-shield.php`.
3. Jalankan installer Shield untuk membuat tabel permission:
   ```bash
   php artisan filament-shield:install
   ```
4. Generate super admin (user awal dengan semua akses):
   ```bash
   php artisan filament-shield:super-admin
   ```
   - Ikuti prompt untuk membuat akun admin.
5. Sinkronkan konfigurasi dan permission ke database:
   ```bash
   php artisan shield:sync
   ```
   - Perintah ini akan membaca `config/filament-shield.php` dan membuat permission default untuk setiap Resource dan Page.

## 3. Tahap Instalasi (Step by Step)
1. Clone repositori:
   ```bash
   git clone <repo-url> siakad1
   cd siakad1
   ```
2. Instal dependensi PHP:
   ```bash
   composer install
   ```
3. (Opsional setelah composer install) Konfigurasi Filament Shield seperti pada bagian 2.1.
4. Duplikasi file environment dan atur variabel:
   ```bash
   cp .env.example .env
   ```
   - Set `DB_CONNECTION=sqlite` dan buat file `database/database.sqlite`, atau sesuaikan `DB_*` untuk MySQL.
5. Generate application key:
   ```bash
   php artisan key:generate
   ```
6. Jalankan migrasi dan seeder default:
   ```bash
   php artisan migrate --seed
   ```
7. Instal dependensi frontend dan compile assets:
   ```bash
   npm install
   npm run dev
   ```
8. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

## 4. Tahap Pembuatan dari Awal (Scratch)
1. Inisialisasi proyek Laravel baru:
   ```bash
   composer create-project laravel/laravel siakad1
   cd siakad1
   ```
2. Instal Filament:
   ```bash
   composer require filament/filament
   php artisan filament:install
   ```
3. Konfigurasi `.env` untuk database.
4. Buat user admin Filament:
   ```bash
   php artisan make:filament-user
   ```
5. Jalankan migrasi:
   ```bash
   php artisan migrate
   ```
6. Pastikan aplikasi berjalan:
   ```bash
   php artisan serve
   ```

## 5. Tahap Pembuatan Setiap Fitur (Resource di Filament)
Setiap fitur dikelola sebagai Resource di Filament dengan hak akses diatur oleh Shield.

### 5.1 Resource Siswa (Student)
1. Buat Resource lengkap beserta form dan tabel:
   ```bash
   php artisan make:filament-resource Student
   ```
2. Buka file `app/Filament/Resources/StudentResource.php` dan atur form schema:
   - `TextInput::make('name')->label('Nama')->required()->maxLength(255)`
   - `TextInput::make('email')->label('Email')->required()->email()`
   - `DatePicker::make('date_of_birth')->label('Tanggal Lahir')->required()`
   - Tambahkan komponen lain sesuai kebutuhan (Select, Checkbox, dll).
3. Atur kolom pada katalog (`table`):
   - `TextColumn::make('id')->label('ID')->sortable()`
   - `TextColumn::make('name')->label('Nama')->searchable()->sortable()`
   - `TextColumn::make('email')->label('Email')->searchable()`
   - `DateColumn::make('created_at')->label('Dibuat')`
4. Define relasi (jika ada) dengan method `relation()` atau `BelongsToSelect`.
5. Publikasikan permission default Shield untuk Resource Student:
   ```bash
   php artisan shield:sync
   ```
6. Cek dan atur role di `FilamentResourcesRole` melalui UI admin.

### 5.2 Resource Guru (Teacher)
1. Generate resource:
   ```bash
   php artisan make:filament-resource Teacher
   ```
2. Buka `app/Filament/Resources/TeacherResource.php`, konfigurasi:
   - Form fields: `name`, `email`, `subject` (TextInput), `phone` (TextInput).
   - Table columns: `id`, `name`, `subject`, `email`, `created_at`.
3. Jalankan migrasi untuk memastikan tabel guru ada:
   ```bash
   php artisan migrate
   ```
4. Jalankan seeder jika tersedia:
   ```bash
   php artisan db:seed --class=TeacherSeeder
   ```
5. Sinkronisasi permission Shield:
   ```bash
   php artisan shield:sync
   ```

### 5.3 Resource Jadwal (Schedule)
1. Generate resource:
   ```bash
   php artisan make:filament-resource Schedule
   ```
2. Edit `ScheduleResource.php`:
   - Form: `BelongsToSelect::make('student_id')->relationship('student','name')`, `BelongsToSelect::make('teacher_id')->relationship('teacher','name')`, `DatePicker`, `TimePicker`.
   - Table: kolom `student.name`, `teacher.name`, `date`, `start_time`, `end_time`.
3. Tambah relasi di Model `Schedule`:
   ```php
   public function student() { return $this->belongsTo(Student::class); }
   public function teacher() { return $this->belongsTo(Teacher::class); }
   ```
4. Sinkronisasi Shield:
   ```bash
   php artisan shield:sync
   ```

### 5.4 Resource Prestasi (Achievement)
1. Generate resource:
   ```bash
   php artisan make:filament-resource Achievement
   ```
2. Konfigurasi form:
   - `BelongsToSelect::make('student_id')->relationship('student','name')`
   - `TextInput::make('title')->label('Judul Prestasi')->required()`
   - `Textarea::make('description')->label('Deskripsi')`
   - `DatePicker::make('achieved_at')->label('Tanggal')`
3. Tabel:
   - `TextColumn::make('student.name')->label('Siswa')`
   - `TextColumn::make('title')->label('Judul')`
   - `DateColumn::make('achieved_at')->label('Tanggal')`
4. Sinkron Shield:
   ```bash
   php artisan shield:sync
   ```

### 5.5 Resource Pembayaran (Payment)
1. Generate resource:
   ```bash
   php artisan make:filament-resource Payment
   ```
2. Form configuration:
   - `BelongsToSelect::make('student_id')->relationship('student','name')`
   - `TextInput::make('amount')->label('Jumlah Pembayaran')->required()->numeric()`
   - `Select::make('status')->options(['pending'=>'Pending','paid'=>'Lunas'])->required()`
   - `DatePicker::make('paid_at')->label('Tanggal Pembayaran')`
3. Table columns:
   - `TextColumn::make('student.name')->label('Siswa')`
   - `TextColumn::make('amount')->label('Jumlah')->money('idr')`
   - `TextColumn::make('status')->label('Status')`
   - `DateColumn::make('paid_at')->label('Dibayar Pada')`
4. Sinkron Shield:
   ```bash
   php artisan shield:sync
   ```

## 6. Penjelasan Step-by-Step yang Jelas
- `composer install`: Mengunduh paket dependensi.
- `php artisan key:generate`: Membuat APP_KEY di `.env` untuk keamanan.
- `php artisan migrate`: Membuat tabel database sesuai migrasi.
- `php artisan db:seed`: Mengisi data awal.
- `php artisan make:filament-resource`: Membuat kelas CRUD boilerplate di Filament.
- `npm run dev`: Mengcompile asset frontend.

Setiap perintah penting untuk memastikan struktur, keamanan, dan fungsionalitas aplikasi berjalan.

## 7. Additional Notes
- Dokumentasi ini tidak memuat seluruh kode, melainkan panduan file dan metode modifikasi.
- Dirancang untuk pemula Laravel & Filament dengan instruksi singkat dan mudah diikuti.
