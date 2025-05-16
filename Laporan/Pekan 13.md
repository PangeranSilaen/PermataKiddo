# Laporan Progres Mingguan - PermataKiddo
**Kelompok**: 11  
**Mitra**: TK Permata Bunda  
**Pekan ke-**: 13  
**Tanggal**: 09/05/2025  

- **Avhilla Catton Andalucia**: 10231021
- **Maulana Malik Ibrahim**: 10231051
- **Pangeran Borneo Silaen**: 10231073
- **Varrel Kaleb Ropard Pasaribu**: 10231089

## Progress Summary
Pada Pekan 13, tim berhasil mengembangkan fitur Admin Dashboard dengan visualisasi data yang komprehensif dan mengimplementasikan sistem pembayaran SPP lengkap dengan fitur CRUD. Dashboard admin kini menyajikan informasi statistik dan grafik yang memberikan gambaran lengkap tentang status sekolah, termasuk jumlah siswa, guru, dan tren pembayaran. Sistem pembayaran SPP telah dilengkapi dengan manajemen kode pembayaran, status, bukti pembayaran, dan riwayat transaksi.

## Accomplished Tasks
- **Implementasi Admin Dashboard & Data Visualization**

  ### 1. Deskripsi Fitur Dashboard
  ![Dashboard Admin](https://github.com/PangeranSilaen/PermataKiddo/blob/main/Laporan/Gambar/Admin%20Panel.png?raw=true)    
  Admin Dashboard merupakan fitur utama yang memberikan gambaran komprehensif tentang status dan aktivitas sekolah TK Permata Bunda melalui visualisasi data yang interaktif. Dashboard ini menyediakan berbagai statistik penting, grafik, dan indikator performa yang memudahkan admin untuk memantau dan menganalisis data sekolah.

  #### Komponen Dashboard Utama
  - Statistik jumlah siswa, guru, dan pengguna sistem
  - Informasi pembayaran SPP bulanan
  - Grafik tren pembayaran bulanan
  - Visualisasi distribusi pengguna berdasarkan peran

  ### 2. Implementasi Statistik Dashboard
  ![Visualisasi Data](https://github.com/PangeranSilaen/PermataKiddo/blob/main/Laporan/Gambar/Data%20Visualization.png?raw=true)

  Dashboard dilengkapi dengan statistik penting yang menyajikan informasi dalam bentuk kartu yang mudah dibaca. Setiap kartu menampilkan angka dan deskripsi yang relevan. Implementasi menggunakan `StatsOverviewWidget` dari Filament yang menampilkan empat statistik utama:
  
  - Total Siswa: Menampilkan jumlah siswa terdaftar dengan grafik mini tren pertumbuhan
  - Total Guru: Menampilkan jumlah guru aktif dengan grafik mini aktivitas
  - Total Pengguna: Menampilkan total pengguna sistem dengan distribusi berdasarkan peran
  - Pembayaran Bulan Ini: Menampilkan total nominal pembayaran pada bulan berjalan

  Statistik ini diimplementasikan dengan menghubungkan widget ke model-model terkait seperti Student, Teacher, User, dan Payment, sehingga data yang ditampilkan selalu mengikuti perkembangan terbaru dari database.

  ### 3. Implementasi Grafik Tren Pembayaran

  Dashboard menyajikan grafik tren pembayaran bulanan yang memungkinkan admin untuk memantau kinerja keuangan sekolah dari waktu ke waktu. Grafik ini menampilkan jumlah pembayaran dan jumlah transaksi untuk setiap bulan dalam satu tahun ajaran.
  
  Fitur utama dari grafik tren pembayaran:
  - Visualisasi multi-axis dengan sumbu kiri untuk nominal pembayaran (dalam jutaan Rupiah) dan sumbu kanan untuk jumlah transaksi
  - Data dikelompokkan berdasarkan bulan untuk memberikan gambaran pola pembayaran sepanjang tahun
  - Implementasi dengan Chart.js melalui Filament ChartWidget yang responsif dan interaktif
  - Normalisasi data untuk memastikan skala yang tepat pada grafik

  ### 4. Implementasi Grafik Distribusi Pengguna

  Dashboard menampilkan grafik pie yang memvisualisasikan distribusi pengguna berdasarkan peran (guru, orang tua, admin, dll), memberikan gambaran cepat tentang komposisi pengguna sistem.
  
  Kelebihan grafik distribusi pengguna:
  - Representasi visual yang jelas dengan warna berbeda untuk setiap peran pengguna
  - Menampilkan hanya peran yang memiliki pengguna aktif untuk menghindari grafik yang terlalu padat
  - Implementasi dengan Chart.js melalui ChartWidget Filament
  - Kalkulasi otomatis persentase distribusi dari total pengguna

  ### 5. Integrasi Dashboard dengan Sistem Pembayaran

  Dashboard terintegrasi dengan sistem pembayaran SPP, menampilkan informasi terkini tentang status pembayaran dan tren pembayaran. Ini memungkinkan admin untuk dengan cepat mengidentifikasi pola pembayaran dan melacak pendapatan sekolah.
  
  Fitur integrasi yang diimplementasikan:
  - Widget statistik yang menampilkan total pembayaran bulan berjalan
  - Chart pembayaran yang otomatis menyesuaikan dengan data terbaru
  - Filter periode untuk melihat data pembayaran berdasarkan rentang waktu tertentu
  - Indikator status pembayaran dengan warna yang berbeda berdasarkan status

- **Implementasi Fitur Pembayaran SPP (CRUD)**

  ### 1. Deskripsi Fitur Pembayaran SPP
  ![Read Payment](https://github.com/PangeranSilaen/PermataKiddo/blob/main/Laporan/Gambar/Read%20Payment.png?raw=true) <br>
  ![Create Payment](https://github.com/PangeranSilaen/PermataKiddo/blob/main/Laporan/Gambar/Create%20Payment.png?raw=true)

  Fitur pembayaran SPP adalah komponen penting untuk administrasi keuangan di TK Permata Bunda. Sistem ini memungkinkan admin untuk mencatat, melacak, dan mengelola semua pembayaran SPP siswa dengan fitur CRUD lengkap dan pencatatan bukti pembayaran.

  #### Fitur-fitur Pembayaran SPP
  - Pencatatan pembayaran SPP dengan kode unik
  - Pencatatan dan upload bukti pembayaran
  - Manajemen status pembayaran (paid, pending, cancelled, refunded)
  - Riwayat pembayaran per siswa dan periode
  - Filter dan pencarian pembayaran

  ### 2. Implementasi Model Payment

  Model `Payment` dibuat untuk merepresentasikan entitas pembayaran dalam database. Model ini memiliki relasi dengan model `Student` dan memiliki atribut-atribut penting seperti receipt_number, payment_type, amount, payment_date, payment_method, month, academic_year, status, payment_proof, dan notes.
  
  Model ini juga dilengkapi dengan beberapa fitur kunci:
  - Relasi belongsTo dengan model Student untuk menghubungkan setiap pembayaran dengan siswa tertentu
  - Method generateReceiptNumber untuk membuat kode pembayaran unik secara otomatis
  - Type casting untuk atribut payment_date agar dikonversi ke format tanggal yang tepat

  ### 3. Implementasi PaymentResource di Filament

  PaymentResource diimplementasikan untuk menyediakan antarmuka pengelolaan pembayaran yang intuitif bagi admin. Resource ini mencakup:
  
  - Form yang terstruktur dengan dua section utama: Payment Information dan Payment Details
  - Field interaktif untuk pemilihan siswa dengan fitur pencarian
  - Pilihan tipe pembayaran dengan preview format kode pembayaran
  - Input nominal pembayaran dengan format mata uang
  - Upload bukti pembayaran dengan preview gambar
  - Pilihan tanggal, metode pembayaran, bulan, tahun ajaran, dan status
  - Field untuk catatan tambahan
  
  Tabel pembayaran dirancang dengan kolom-kolom penting:
  - Kode pembayaran dengan fitur copy
  - Nama siswa yang dapat disortir dan dicari
  - Tipe pembayaran dengan badge
  - Status dengan warna yang berbeda sesuai status
  - Nominal dengan format mata uang
  - Tanggal pembayaran yang dapat disortir
  - Metode pembayaran dan tahun ajaran
  - Thumbnail bukti pembayaran
  
  Resource ini juga dilengkapi dengan filter berdasarkan tipe pembayaran dan status, serta aksi view, edit, dan delete untuk manajemen data.

  ### 4. Implementasi Migrasi untuk Tabel Payments

  Migrasi dibuat untuk tabel `payments` dengan struktur yang terorganisir untuk menyimpan semua informasi pembayaran. Kolom-kolom utama mencakup:
  
  - Foreign key ke tabel students dengan constraint cascade on delete
  - Kolom receipt_number dengan constraint unique
  - Enum untuk payment_type dengan opsi 'spp' dan 'other'
  - Decimal amount dengan presisi 12,2 untuk nominal pembayaran
  - Kolom date untuk payment_date
  - Kolom-kolom string untuk payment_method, month, dan academic_year
  - Enum status dengan opsi 'paid', 'pending', 'cancelled', dan 'refunded'
  - Kolom string untuk payment_proof dan text untuk notes
  - Timestamps untuk created_at dan updated_at

  ### 5. Generasi Otomatis Nomor Kwitansi

  Sistem pembayaran SPP dilengkapi dengan fitur generasi otomatis nomor kwitansi yang memastikan setiap pembayaran memiliki kode unik. Implementasi ini menggunakan kombinasi PaymentObserver yang memantau event creating pada model Payment dan method generateReceiptNumber yang membuat format kode sesuai dengan tipe pembayaran ('SPP-' atau 'LYN-') diikuti dengan nomor urut yang diformat dengan padding nol.

  ### 6. Widget Chart Pembayaran

  Untuk memvisualisasikan data pembayaran, widget chart pembayaran diimplementasikan untuk menampilkan tren pembayaran SPP bulanan. Widget ini membantu admin memahami pola pembayaran dan mengidentifikasi tren keuangan.
  
  Fitur utama widget chart pembayaran:
  - Menampilkan data pembayaran per bulan dalam satu tahun
  - Normalisasi data ke dalam jutaan Rupiah untuk skala yang lebih mudah dibaca
  - Implementasi dengan Filament ChartWidget yang responsif
  - Filter tahunan untuk melihat data pembayaran berdasarkan tahun tertentu
  - Styling chart dengan warna dan fill yang menarik secara visual

## Challenges & Solutions
- **Challenge 1**: Mengintegrasikan Visualisasi Data yang Responsif dan Informatif
  - **Solution**: Untuk mengatasi tantangan dalam membuat visualisasi data yang responsif dan informatif, kami menggunakan Chart.js melalui Filament Chart Widgets dengan konfigurasi khusus untuk tampilan multi-axis. Kami juga mengimplementasikan normalisasi data untuk memastikan skala yang tepat pada grafik, sehingga tren data dapat terlihat dengan jelas.

- **Challenge 2**: Implementasi Sistem Pembayaran dengan Pencatatan Bukti Pembayaran
  - **Solution**: Kami menghadapi tantangan dalam implementasi sistem upload dan penampilan bukti pembayaran. Solusinya adalah dengan memanfaatkan fitur FileUpload Filament yang diintegrasikan dengan sistem penyimpanan Laravel, serta konfigurasi visibility untuk memastikan keamanan akses file bukti pembayaran.

- **Challenge 3**: Integrasi Dashboard dengan Sistem Pembayaran SPP
  - **Solution**: Tantangan dalam mengintegrasikan dashboard dengan sistem pembayaran SPP diatasi dengan membuat abstraksi data yang tepat melalui model dan query builder Laravel. Kami membuat service khusus untuk mengolah data pembayaran sebelum ditampilkan di widget dashboard, sehingga data yang disajikan selalu real-time dan akurat.

## Next Week Plan
- Implementasi fitur laporan keuangan dengan pilihan export format PDF dan Excel.
- Pengembangan fitur notifikasi pembayaran untuk siswa dan orang tua.
- Integrasi dengan metode pembayaran digital pihak ketiga (payment gateway).
- Implementasi fitur pencarian dan filter lanjutan untuk sistem pembayaran SPP.

## Contributions
- **Avhilla Catton Andalucia**: Pengembangan UI/UX form pembayaran SPP dan widget statistik
- **Maulana Malik Ibrahim**: Pengembangan fitur pembayaran SPP, migrasi, dan model
- **Pangeran Borneo Silaen**: Implementasi visualisasi data dengan dan integrasi model
- **Varrel Kaleb Ropard Pasaribu**: Pengembangan UI/UX form pembayaran SPP dan dokumentasi laporan

## Screenshots / Demo
- [Dashboard Admin dengan Statistik dan Visualisasi](https://github.com/PangeranSilaen/PermataKiddo/blob/main/Laporan/Gambar/Admin%20Panel.png)
- [Halaman Payment](https://github.com/PangeranSilaen/PermataKiddo/blob/main/Laporan/Gambar/Read%20Payment.png)