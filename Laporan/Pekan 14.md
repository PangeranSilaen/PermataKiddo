# Laporan Progres Mingguan - PermataKiddo  
**Kelompok**: 11  
**Mitra**: TK Permata Bunda  
**Pekan ke-**: 14  
**Tanggal**: 16/05/2025  

- **Avhilla Catton Andalucia**: 10231021  
- **Maulana Malik Ibrahim**: 10231051  
- **Pangeran Borneo Silaen**: 10231073  
- **Varrel Kaleb Ropard Pasaribu**: 10231089  

## Progress Summary
Pada pekan ini, tim fokus pada proses polishing aplikasi, perbaikan bug, dan pengujian usability dengan minimal 3 user. Semua fitur utama telah diuji dan diperbaiki sesuai hasil temuan bug.

## Daftar Bug & Solusi
Berikut adalah beberapa bug yang ditemukan dan solusinya:

1. **Widget Statistik Terlihat oleh Guru**  
   Solusi: Reset cache permission dan atur ulang permission di panel Shield.
2. **Error Kolom Status di Payment Tidak Bisa Inline Edit**  
   Solusi: Ubah ke SelectColumn agar bisa diedit langsung.
3. **Error Method actionsLabel dan actionsHeading Tidak Ada**  
   Solusi: Hapus pemanggilan method tersebut di seluruh resource.
4. **Error Kolom Status di RegistrationResource**  
   Solusi: Ganti dengan TextColumn atau BadgeColumn.
5. **Error Gambar Tidak Terbaca**  
   Solusi: Perbaiki symlink storage dengan `php artisan storage:link`.
6. **Error Kolom Capaian di Achievement Selalu 0**  
   Solusi: Pastikan kolom bertipe json, tambahkan accessor, dan tampilkan kolom virtual.
7. **Error Kolom Achievements Tidak Ada**  
   Solusi: Tambah kolom achievements di tabel.
8. **Data Capaian Tidak Tersimpan**  
   Solusi: Pastikan field achievements ada di $fillable dan form.
9. **Error Migrasi Drop Kolom yang Sudah Tidak Ada**  
   Solusi: Edit/hapus migrasi bermasalah.
10. **Menu Online Registration Ganda**  
    Solusi: Hapus page Filament yang tidak diperlukan.
11. **Widget Statistik & Pendaftaran Online Masih Terlihat oleh Guru**  
    Solusi: Tambahkan pengecekan role di method canView pada widget.
12. **Warning Merah Undefined Method 'user' di Widget**  
    Solusi: Gunakan Auth::user() pada method canView.

## Hasil Pengujian Minimal 3 User

| No | User         | Fitur yang Diuji                                                                 | Status    |
|----|--------------|----------------------------------------------------------------------------------|-----------|
| 1  | Admin        | Login, CRUD user, CRUD jadwal, CRUD murid, CRUD guru, CRUD capaian, CRUD kelas, CRUD pembayaran SPP, lihat/terima/hapus pendaftaran online, logout | Berhasil  |
| 2  | Guru         | Login, lihat jadwal, lihat murid, lihat guru, CRUD capaian pembelajaran, logout   | Berhasil  |
| 3  | Orang Tua    | Login, register, lihat tagihan & bayar SPP, lihat jadwal anak, lihat capaian anak, lihat & tambah pendaftaran online, logout | Berhasil  |

Semua fitur utama untuk ketiga role user telah diuji dan berjalan dengan baik.

## Deployment Plan
Aplikasi direncanakan akan dideploy menggunakan layanan Hostinger dengan setup domain khusus. Namun, proses deployment masih akan dipertimbangkan lebih lanjut mengingat adanya biaya dan konfigurasi yang tidak selalu mudah untuk lingkungan production.


## Contributions
- **Avhilla Catton Andalucia**: Bugfixing, pengujian, dan usability
- **Maulana Malik Ibrahim**: Bugfixing, pengujian, dan usability
- **Pangeran Borneo Silaen**: Bugfixing, pengujian usability, dan perbaikan migrasi/model
- **Varrel Kaleb Ropard Pasaribu**: Bugfixing, pengujian usability, dan dokumentasi laporan

