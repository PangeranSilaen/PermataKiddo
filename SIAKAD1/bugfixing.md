# Dokumentasi Bugfixing SIAKAD1

## Daftar Bug & Solusi

### 1. Widget Statistik Terlihat oleh Guru
**Bug:** Guru bisa melihat widget statistik (StatsOverview, PieChart, dsb) meski tidak punya permission di Shield.
**Solusi:** Reset cache permission dengan `php artisan shield:cache-reset` atau `php artisan optimize:clear`. Jika masih bermasalah, jalankan `php artisan shield:generate` dan atur ulang permission di panel Shield.

---

### 2. Error Kolom Status di Payment Tidak Bisa Inline Edit
**Bug:** Kolom status pembayaran tidak bisa diubah langsung dari list.
**Solusi:** Ubah kolom status di PaymentResource menjadi SelectColumn agar bisa diubah langsung tanpa masuk menu edit.

---

### 3. Error Method `actionsLabel` dan `actionsHeading` Tidak Ada
**Bug:** Error `Method Filament\Tables\Table::actionsLabel does not exist` dan `actionsHeading does not exist`.
**Solusi:** Hapus semua pemanggilan method tersebut di seluruh resource. Filament versi baru tidak mendukung method ini.

---

### 4. Error Kolom Status di RegistrationResource
**Bug:** Menggunakan SelectColumn dengan method `colors()` menyebabkan error.
**Solusi:** Ganti dengan TextColumn atau BadgeColumn (jika tidak deprecated) dan gunakan method `color()` atau `badge()`.

---

### 5. Error Gambar Tidak Terbaca
**Bug:** Gambar tidak bisa diakses dari public/storage.
**Solusi:** Hapus symlink/folder public/storage, lalu jalankan `php artisan storage:link` setelah memastikan folder storage/app/public dan storage/framework sudah ada.

---

### 6. Error Kolom Capaian di Achievement Selalu 0
**Bug:** Kolom jumlah capaian selalu 0 meski data tersimpan.
**Solusi:**
- Pastikan kolom achievements bertipe json dan nullable di database.
- Tambahkan accessor getAchievementsCountAttribute di model Achievement untuk menghitung jumlah capaian.
- Tampilkan kolom virtual `achievements_count` di resource Achievement.

---

### 7. Error Kolom Achievements Tidak Ada
**Bug:** Error saat create/edit capaian: kolom achievements tidak ada di tabel.
**Solusi:** Buat migrasi untuk menambah kolom achievements bertipe json dan nullable pada tabel achievements.

---

### 8. Data Capaian Tidak Tersimpan
**Bug:** Data capaian tidak tersimpan meski sudah dipilih di form.
**Solusi:** Pastikan field achievements ada di $fillable model Achievement dan di form resource menggunakan nama field yang sama.

---

### 9. Error Migrasi Drop Kolom yang Sudah Tidak Ada
**Bug:** Error migrasi saat drop kolom yang sudah tidak ada (score, achievement_type).
**Solusi:** Hapus file migrasi yang menyebabkan error atau edit migrasi agar hanya drop kolom jika ada.

---

### 10. Menu Online Registration Ganda
**Bug:** Menu Online Registration muncul dua kali di sidebar.
**Solusi:** Hapus page/halaman Filament yang tidak diperlukan agar hanya resource utama yang tampil di sidebar.

---

### 11. Widget Statistik & Pendaftaran Online Masih Terlihat oleh Guru
**Bug:** Widget statistik (StatsOverview, PaymentOverviewChart, UserRoleChart) dan resource pendaftaran online masih bisa diakses/terlihat oleh role guru meski permission sudah diatur di Shield.
**Solusi:**
- Tambahkan method `canView()` pada setiap widget statistik dengan pengecekan role menggunakan `Auth::user()->hasRole(['admin', 'super_admin'])`.
- Import `use Illuminate\Support\Facades\Auth;` di setiap file widget.
- Jalankan `php artisan shield:cache-reset` dan `php artisan shield:generate` untuk memastikan permission ter-refresh dan ter-generate ulang.
- Pastikan policy resource pendaftaran online sudah benar.

---

### 12. Warning Merah Undefined Method 'user' di Widget
**Bug:** Muncul warning merah undefined method 'user' pada method canView di widget.
**Solusi:**
- Gunakan `Auth::user()` (dengan import Auth) pada method canView, bukan `auth()->user()`.
- Contoh:
  ```php
  use Illuminate\Support\Facades\Auth;
  public static function canView(): bool
  {
      return Auth::user() && Auth::user()->hasRole(['admin', 'super_admin']);
  }
  ```
- Dengan cara ini, warning hilang dan pembatasan akses tetap berjalan baik.
