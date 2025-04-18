# Laporan Progres Mingguan - PermataKiddo
**Kelompok**: 11
**Mitra**: TK Permata Bunda
**Pekan ke-**: 10
**Tanggal**: 18/04/2025

## Progress Summary
Pada Pekan 10, fokus utama adalah merancang struktur database dan membangun kerangka dasar (skeleton) untuk backend dan frontend. Kami telah berhasil menyelesaikan desain Entity Relationship Diagram (ERD) dan membuat tabel relasional awal. Selain itu, beberapa halaman dasar di Filament telah dibuat beserta routing otomatisnya, dan kerangka dasar untuk endpoint backend juga telah disiapkan.

## Accomplished Tasks
- **Membuat ERD dan Tabel Relasional Awal**
  
  [Link Tabel Relasional](https://github.com/PangeranSilaen/PermataKiddo/blob/cafa2507bc142531a041e6a96d2c9cce9c1039c6/Laporan/Gambar/Tabel%20Relasional.jpg)
  
  [Link ERD]()

  Berikut adalah penjelasan detail untuk ERD (Entity-Relationship Diagram) yang telah dibuat:

  ### Penjelasan ERD

  ERD ini menggambarkan struktur basis data untuk sistem PermataKiddo, sebuah aplikasi yang dirancang untuk mengelola informasi sekolah seperti siswa, guru, jadwal, dan pembayaran. ERD ini terdiri dari entitas-entitas yang saling berelasi, dengan atribut-atribut yang menjelaskan karakteristik masing-masing entitas.

  ---

  ### Entitas dan Atribut

  #### Role
  Entitas ini menyimpan informasi tentang peran pengguna dalam sistem.
  **Atribut:**
  - `RoleID` (INT, Primary Key): Mengidentifikasi peran secara unik.
  - `NamaRole` (VARCHAR): Nama peran (misalnya, Admin, Guru, Orang Tua).
  - `DeskripsiRole` (VARCHAR): Penjelasan singkat tentang peran tersebut.

  #### User
  Entitas ini menyimpan informasi login umum untuk semua pengguna.
  **Atribut:**
  - `UserID` (INT, Primary Key): Mengidentifikasi pengguna secara unik.
  - `Username` (VARCHAR, Unique): Nama pengguna untuk login.
  - `Password` (VARCHAR): Kata sandi pengguna.
  - `Email` (VARCHAR, Unique): Alamat email pengguna.
  - `JenisKelamin` (VARCHAR): Jenis kelamin pengguna.

  #### UserRole
  Entitas ini menghubungkan pengguna dengan peran mereka.
  **Atribut:**
  - `UserID` (INT, Foreign Key): Merujuk ke UserID di entitas User.
  - `RoleID` (INT, Foreign Key): Merujuk ke RoleID di entitas Role.

  #### Admin
  Entitas ini menyimpan informasi spesifik tentang admin.
  **Atribut:**
  - `AdminID` (INT, Primary Key)
  - `UserID` (INT, Foreign Key): Merujuk ke UserID di entitas User.

  #### Guru
  Entitas ini menyimpan informasi spesifik tentang guru.
  **Atribut:**
  - `GuruID` (INT, Primary Key): Mengidentifikasi guru secara unik.
  - `UserID` (INT, Foreign Key): Merujuk ke UserID di entitas User.
  - `NUPTK` (VARCHAR, Unique): Nomor Unik Pendidik dan Tenaga Kependidikan.
  - `Nama` (VARCHAR): Nama lengkap guru.

  #### OrangTua
  Entitas ini menyimpan informasi spesifik tentang orang tua siswa.
  **Atribut:**
  - `OrangTuaID` (INT, Primary Key): Mengidentifikasi orang tua secara unik.
  - `UserID` (INT, Foreign Key): Merujuk ke UserID di entitas User.

  #### Anak
  Entitas ini menyimpan informasi tentang siswa.
  **Atribut:**
  - `AnakID` (INT, Primary Key): Mengidentifikasi siswa secara unik.
  - `NamaAnak` (VARCHAR): Nama lengkap siswa.
  - `TanggalLahirAnak` (DATE): Tanggal lahir siswa.
  - `TempatLahirAnak` (VARCHAR): Tempat lahir siswa.
  - `NIK` (VARCHAR, Unique): Nomor Induk Kependudukan siswa.
  - `JenisKelamin` (VARCHAR): Jenis kelamin siswa.
  - `Agama` (VARCHAR): Agama siswa.
  - `NamaAyah` (VARCHAR): Nama ayah siswa.
  - `NamaIbu` (VARCHAR): Nama ibu siswa.
  - `PekerjaanAyah` (VARCHAR): Pekerjaan ayah siswa.
  - `PekerjaanIbu` (VARCHAR): Pekerjaan ibu siswa.
  - `Alamat` (VARCHAR): Alamat tempat tinggal siswa.

  #### Kelas
  Entitas ini menyimpan informasi tentang kelas.
  **Atribut:**
  - `KelasID` (INT, Primary Key): Mengidentifikasi kelas secara unik.
  - `NamaKelas` (VARCHAR): Nama kelas (misalnya, Kelas 1A).
  - `Tingkat` (VARCHAR): Tingkat kelas (misalnya, Tingkat 1).

  #### MuridKelas
  Entitas ini menghubungkan siswa dengan kelas mereka.
  **Atribut:**
  - `AnakID` (INT, Foreign Key): Merujuk ke AnakID di entitas Anak.
  - `KelasID` (INT, Foreign Key): Merujuk ke KelasID di entitas Kelas.

  #### GuruKelas
  Entitas ini menghubungkan guru dengan kelas yang mereka ajar.
  **Atribut:**
  - `GuruID` (INT, Foreign Key): Merujuk ke GuruID di entitas Guru.
  - `KelasID` (INT, Foreign Key): Merujuk ke KelasID di entitas Kelas.

  #### Jadwal
  Entitas ini menyimpan informasi tentang jadwal pelajaran.
  **Atribut:**
  - `JadwalID` (INT, Primary Key): Mengidentifikasi jadwal secara unik.
  - `GuruID` (INT, Foreign Key): Merujuk ke GuruID di entitas Guru.
  - `KelasID` (INT, Foreign Key): Merujuk ke KelasID di entitas Kelas.
  - `HariTanggal` (DATE): Hari dan tanggal pelajaran.
  - `NamaKegiatan` (VARCHAR): Nama kegiatan atau mata pelajaran.

  #### LaporanCapaianPembelajaran
  * Entitas ini menyimpan informasi tentang laporan capaian pembelajaran siswa.
  * **Atribut:**
      * `LaporanID` (INT, Primary Key): Mengidentifikasi laporan secara unik.
      * `AnakID` (INT, Foreign Key): Merujuk ke `AnakID` di entitas `Anak`.
      * `GuruID` (INT, Foreign Key): Merujuk ke `GuruID` di entitas `Guru`.
      * `Capaian1` hingga `Capaian8` (VARCHAR): Capaian pembelajaran siswa pada berbagai aspek.

  #### PembayaranSPP
  * Entitas ini menyimpan informasi tentang pembayaran SPP siswa.
  * **Atribut:**
      * `PembayaranID` (INT, Primary Key): Mengidentifikasi pembayaran secara unik.
      * `AnakID` (INT, Foreign Key): Merujuk ke `AnakID` di entitas `Anak`.
      * `TanggalPembayaran` (DATE): Tanggal pembayaran SPP.
      * `NominalPembayaran` (INT): Jumlah pembayaran SPP.
      * `ReceiptNumber` (VARCHAR): Nomor kwitansi pembayaran.
      * `StatusPembayaran` (VARCHAR): Status pembayaran (misalnya, Lunas, Belum Lunas).

  ---

  ### Relasi Antar Entitas

  ERD ini menggambarkan bagaimana entitas-entitas tersebut saling berelasi:
  - Seorang `Role` dapat dimiliki oleh banyak `User` melalui entitas penghubung `UserRole`.
  - Seorang `User` dapat memiliki banyak `Role` melalui entitas penghubung `UserRole`.
  - Seorang `User` dapat menjadi seorang `Admin`, `Guru`, atau `OrangTua`.
  - Seorang `OrangTua` dapat memiliki banyak `Anak`. (*Koreksi: Relasi mungkin User <-> Anak dan User (OrangTua) <-> Anak, atau Anak punya foreign key ke UserID OrangTua*)
  - Seorang `Anak` memiliki satu `OrangTua`. (*Koreksi: Lebih tepatnya, seorang Anak terhubung ke User Orang Tua*)
  - Seorang `Guru` mengajar banyak `Kelas`, dan sebuah `Kelas` diajar oleh banyak `Guru` melalui entitas penghubung `GuruKelas`.
  - Seorang `Anak` terdaftar di satu `Kelas`, dan sebuah `Kelas` memiliki banyak `Anak` melalui entitas penghubung `MuridKelas`.
  - Seorang `Guru` membuat banyak `Jadwal`.
  - Sebuah `Kelas` memiliki banyak `Jadwal`.
  - Seorang `Guru` membuat banyak `LaporanCapaianPembelajaran` untuk seorang `Anak`.
  - Seorang `Anak` memiliki banyak `PembayaranSPP`.

  ---

  ### Kesimpulan

  ERD ini memberikan gambaran yang jelas tentang struktur basis data yang diperlukan untuk sistem PermataKiddo.

- **Membuat Frontend Skeleton (Halaman Dasar Filament dengan Routing)**
  * Berhasil membuat resource dasar di Filament (misalnya `UserResource`, `StudentResource`, `TeacherResource`).
  * Halaman standar CRUD (List, Create, Edit, View) untuk resource tersebut otomatis ter-generate oleh Filament.
  * Routing otomatis dari Filament (`/admin/users`, `/admin/students`, `/admin/teachers`, dll.) sudah berfungsi.

- **Membuat Backend Skeleton (Endpoint Dasar)**
  * Menyiapkan Model Eloquent dasar sesuai dengan entitas di ERD (misalnya `User`, `Role`, `Student`, `Teacher`, `Kelas`).
  * Menyiapkan file migrasi database untuk membuat tabel-tabel sesuai ERD.
  * Menyiapkan dasar Panel Provider (`AdminPanelProvider`) di Filament.

## Challenges & Solutions
- **Challenge 1**: Memahami Konsep Routing dan Endpoint di Filament
  - **Solution**:
    # Penjelasan Routing di Filament

    Di Filament, endpoint atau routing seperti `/admin/students/create` diatur secara otomatis oleh Filament berdasarkan konfigurasi resource yang ada di dalam folder `app/Filament/Resources`. Filament menggunakan konvensi untuk mendefinisikan resource dan secara otomatis menghasilkan routing berdasarkan resource tersebut.

    ## Proses di Balik Layar

    1. **Resource Definition**
       File `StudentResource` di `app/Filament/Resources/StudentResource.php` mendefinisikan resource untuk `Student`. Filament membaca file ini untuk menentukan model, form, table, dan halaman terkait.

       ```php
       // app/Filament/Resources/StudentResource.php
       namespace App\Filament\Resources;

       use App\Models\Student; // Pastikan Model Student ada
       use Filament\Forms;
       use Filament\Forms\Form;
       use Filament\Resources\Resource;
       use Filament\Tables;
       use Filament\Tables\Table;

       class StudentResource extends Resource
       {
           protected static ?string $model = Student::class; // Sesuaikan dengan nama model Anda

           protected static ?string $navigationIcon = 'heroicon-o-academic-cap'; // Contoh icon

           public static function form(Form $form): Form
           {
               return $form->schema([
                   // Definisi field form di sini
                   Forms\Components\TextInput::make('nama_anak')->required(),
                   // ... field lainnya
               ]);
           }

           public static function table(Table $table): Table
           {
               return $table->columns([
                   // Definisi kolom tabel di sini
                   Tables\Columns\TextColumn::make('nama_anak'),
                   // ... kolom lainnya
               ])
               ->filters([
                   //
               ])
               ->actions([
                   Tables\Actions\EditAction::make(),
                   Tables\Actions\ViewAction::make(),
               ])
               ->bulkActions([
                   Tables\Actions\BulkActionGroup::make([
                       Tables\Actions\DeleteBulkAction::make(),
                   ]),
               ]);
           }

           public static function getRelations(): array
           {
               return [
                   // Definisi relasi jika ada
               ];
           }

           public static function getPages(): array
           {
               return [
                   'index' => Pages\ListStudents::route('/'),
                   'create' => Pages\CreateStudent::route('/create'),
                   'edit' => Pages\EditStudent::route('/{record}/edit'),
                   'view' => Pages\ViewStudent::route('/{record}'), // Tambahkan jika perlu view page
               ];
           }
       }
       ```

    2. **Page Definition**
       File `CreateStudent` di `app/Filament/Resources/StudentResource/Pages/CreateStudent.php` mendefinisikan halaman untuk membuat data baru (`/create`). Halaman lain seperti `ListStudents`, `EditStudent` juga ada di direktori `Pages`.

       ```php
       // app/Filament/Resources/StudentResource/Pages/CreateStudent.php
       namespace App\Filament\Resources\StudentResource\Pages;

       use App\Filament\Resources\StudentResource;
       use Filament\Actions;
       use Filament\Resources\Pages\CreateRecord;

       class CreateStudent extends CreateRecord
       {
           protected static string $resource = StudentResource::class;

           // Optional: Redirect after creation
           protected function getRedirectUrl(): string
           {
               return $this->getResource()::getUrl('index');
           }
       }
       ```

    3. **Routing Otomatis**
       Filament secara otomatis mendaftarkan routing berdasarkan resource dan halaman yang ditemukan di folder `app/Filament/Resources`. Hal ini dilakukan melalui metode `discoverResources` di Panel Provider (contoh: `AdminPanelProvider.php`).

       ```php
       // app/Providers/Filament/AdminPanelProvider.php
       namespace App\Providers\Filament;

       use Filament\Http\Middleware\Authenticate;
       use Filament\Http\Middleware\DisableBladeIconComponents;
       use Filament\Http\Middleware\DispatchServingFilamentEvent;
       use Filament\Pages;
       use Filament\Panel;
       use Filament\PanelProvider;
       use Filament\Support\Colors\Color;
       use Filament\Widgets;
       use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
       use Illuminate\Cookie\Middleware\EncryptCookies;
       use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
       use Illuminate\Routing\Middleware\SubstituteBindings;
       use Illuminate\Session\Middleware\AuthenticateSession;
       use Illuminate\Session\Middleware\StartSession;
       use Illuminate\View\Middleware\ShareErrorsFromSession;

       class AdminPanelProvider extends PanelProvider
       {
           public function panel(Panel $panel): Panel
           {
               return $panel
                   ->default()
                   ->id('admin')
                   ->path('admin') // Path dasar panel
                   ->login() // Mengaktifkan halaman login bawaan Filament
                   ->colors([
                       'primary' => Color::Amber,
                   ])
                   // Menemukan resource secara otomatis
                   ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
                   // Menemukan page secara otomatis
                   ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
                   ->pages([
                       Pages\Dashboard::class,
                   ])
                   // Menemukan widget secara otomatis
                   ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
                   ->widgets([
                       // Widgets\AccountWidget::class, // Contoh widget bawaan
                       // Widgets\FilamentInfoWidget::class, // Contoh widget bawaan
                   ])
                   ->middleware([
                       EncryptCookies::class,
                       AddQueuedCookiesToResponse::class,
                       StartSession::class,
                       AuthenticateSession::class,
                       ShareErrorsFromSession::class,
                       VerifyCsrfToken::class,
                       SubstituteBindings::class,
                       DisableBladeIconComponents::class,
                       DispatchServingFilamentEvent::class,
                   ])
                   ->authMiddleware([
                       Authenticate::class, // Middleware autentikasi Filament
                   ]);
           }
       }
       ```

       Dengan ini, Filament akan membuat routing seperti:
       - `/admin/students` untuk daftar siswa (`ListStudents`).
       - `/admin/students/create` untuk membuat siswa baru (`CreateStudent`).
       - `/admin/students/{record}/edit` untuk mengedit siswa (`EditStudent`).

    4. **Middleware dan Path Panel**
       Path dasar `/admin` diatur di `AdminPanelProvider` melalui metode `->path('admin')`. Middleware autentikasi (`Authenticate::class`) juga diterapkan di sini untuk melindungi panel.

    ## Kesimpulan
    Routing di Filament tidak memerlukan penulisan manual di `routes/web.php` untuk resource panel. Filament secara otomatis menangani routing berdasarkan struktur Resource dan Pages yang dibuat di direktori `app/Filament`, yang dikonfigurasi melalui Panel Provider.

- **Challenge 2**: Membuat ERD dan Tabel Relasional yang Sesuai Kebutuhan
  - **Solution**: Proses perancangan ERD dilakukan dengan menganalisis kebutuhan fungsional dari SKPL dan hasil diskusi Pekan 9. Kami mengidentifikasi entitas utama (User, Role, Anak, Guru, Kelas, SPP, Laporan Capaian, Jadwal), atribut-atribut penting, dan relasi antar entitas. Hasilnya adalah struktur ERD yang dijelaskan pada bagian "Accomplished Tasks" di atas, yang kemudian diterjemahkan menjadi skema tabel relasional dan file migrasi Laravel. Iterasi dilakukan untuk memastikan normalisasi dasar dan keterhubungan data yang logis.

## Next Week Plan
- Implementasi sistem autentikasi (login/register) menggunakan fitur bawaan Filament dan route custom jika diperlukan untuk Orang Tua.
- Implementasi fitur inti #1: CRUD (Create, Read, Update, Delete) untuk **Manajemen Data Siswa** (Anak) secara fungsional di Filament.
- Integrasi awal frontend (Filament forms/tables) dengan backend (Eloquent models) untuk fitur Manajemen Data Siswa.
- Persiapan demo singkat progres Pekan 10 dan 11 untuk mitra.

## Contributions
- **Avhilla Catton Andalucia**: Merancang ERD
- **Maulana Malik Ibrahim**: Membuat ERD
- **Pangeran Borneo Silaen**: Setup Proyek Awal, Konfigurasi Filament Panel, Membuat Resource Filament A
- **Varrel Kaleb Ropard Pasaribu**: Analisis Kebutuhan ERD, Dokumentasi]

## Screenshots / Demo
[Link Gambar 1](https://github.com/PangeranSilaen/PermataKiddo/blob/main/Laporan/Gambar/admin.png)
[Link Gambar 2](https://github.com/PangeranSilaen/PermataKiddo/blob/main/Laporan/Gambar/admin1.png)