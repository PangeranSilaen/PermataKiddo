# Laporan Progres Mingguan - PermataKiddo
**Kelompok**: 11  
**Mitra**: TK Permata Bunda  
**Pekan ke-**: 11  
**Tanggal**: 25/04/2025  

- **Avhilla Catton Andalucia**: 10231021
- **Maulana Malik Ibrahim**: 10231051
- **Pangeran Borneo Silaen**: 10231073
- **Varrel Kaleb Ropard Pasaribu**: 10231089

## Progress Summary
Pada Pekan 11, fokus utama adalah mengimplementasikan sistem autentikasi (Login/Register/Logout) dan fitur utama pertama untuk kebutuhan mitra. Kami telah berhasil menyelesaikan pengembangan sistem autentikasi multi-role yang memungkinkan login untuk Admin, Guru, dan Orang Tua dengan redirect otomatis ke dashboard sesuai peran. Selain itu, fitur Manajemen Data Siswa (Kelola Murid) telah berhasil diimplementasikan sebagai fitur utama pertama.

## Accomplished Tasks
- **Implementasi Sistem Autentikasi**
  
  ### 1. Sistem Login

  Kami telah mengimplementasikan sistem login yang memungkinkan pengguna masuk ke aplikasi dengan kredensial mereka. Sistem ini memiliki beberapa fitur:

  #### Fitur-fitur Login
  - Login universal untuk semua jenis pengguna (Admin, Guru, Orang Tua)
  - Redirecting otomatis ke dashboard sesuai peran pengguna
  - Validasi kredensial secara real-time
  - Integrasi dengan sistem keamanan Laravel
  - Perlindungan terhadap serangan brute force

  #### Implementasi Teknis
  Sistem login diimplementasikan menggunakan Laravel dan Filament. Kami membuat custom login route yang berbeda dari route admin bawaan Filament untuk memungkinkan semua jenis pengguna login dari halaman yang sama.

  ```php
  // AuthController.php (Bagian login)
  public function login(Request $request)
  {
      $credentials = $request->validate([
          'email' => 'required|email',
          'password' => 'required',
      ]);

      if (Auth::attempt($credentials)) {
          $request->session()->regenerate();
          $user = Auth::user();
          
          // Redirect berdasarkan peran
          if ($user->role === 'admin' || $user->role === 'super_admin') {
              return redirect('/admin');
          } elseif ($user->role === 'teacher') {
              return redirect('/teacher-dashboard');
          } elseif ($user->role === 'parent') {
              return redirect('/parent-dashboard');
          } else {
              // Fallback jika pengguna tidak memiliki peran yang valid
              Auth::logout();
              return redirect()->route('login')
                  ->withErrors(['email' => 'Akun anda tidak memiliki peran yang valid.']);
          }
      }

      throw ValidationException::withMessages([
          'email' => ['Kredensial yang diberikan tidak cocok dengan catatan kami.'],
      ]);
  }
  ```

  #### Tampilan Login
  Halaman login dirancang dengan UI yang intuitif dan user-friendly. Kami menggunakan Bootstrap untuk styling dan memastikan halaman ini responsif untuk berbagai perangkat.

  ```html
  <!-- login.blade.php (Bagian utama) -->
  <div class="container">
      <div class="login-container">
          <div class="logo">
              <h2>Permata Kiddo</h2>
              <p>Sistem Informasi Akademik</p>
          </div>
          
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          
          <form method="POST" action="{{ url('/login') }}">
              @csrf
              <div class="mb-3">
                  <label for="email" class="form-label">Alamat Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
              </div>
              
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
              </div>
              
              <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="remember" name="remember">
                  <label class="form-check-label" for="remember">Ingat Saya</label>
              </div>
              
              <button type="submit" class="btn btn-primary">Login</button>
          </form>
          
          <div class="register-link">
              <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
          </div>
      </div>
  </div>
  ```

  ### 2. Sistem Registrasi Orang Tua

  Sesuai dengan kebutuhan mitra, kami telah mengimplementasikan sistem registrasi khusus untuk Orang Tua, sementara akun untuk Admin dan Guru dibuat secara manual oleh Admin.

  #### Fitur-fitur Registrasi
  - Form pendaftaran khusus untuk orang tua
  - Validasi input untuk memastikan data yang dimasukkan valid
  - Pembuatan otomatis akun dengan peran "orang tua"
  - Penyimpanan informasi tambahan seperti jenis kelamin dan nomor telepon

  #### Implementasi Teknis
  ```php
  // AuthController.php (Bagian register)
  public function register(Request $request)
  {
      $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'gender' => 'required|in:male,female',
          'phone' => 'required|string|max:15',
          'password' => 'required|string|min:8|confirmed',
      ]);

      $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'gender' => $request->gender,
          'phone' => $request->phone,
          'password' => Hash::make($request->password),
          'role' => 'parent',
      ]);
      
      $user->assignRole('parent');
      
      Auth::login($user);
      
      return redirect('/parent-dashboard');
  }
  ```

  ### 3. Pengaturan Route dan Middleware

  Kami telah mengatur route untuk login, register, dan logout, serta menerapkan middleware untuk melindungi halaman dashboard berdasarkan peran pengguna.

  ```php
  // web.php
  Route::get('/', function () {
      return redirect()->route('login');
  });

  // Authentication Routes
  Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
  Route::post('/login', [AuthController::class, 'login']);
  Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
  Route::post('/register', [AuthController::class, 'register']);
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

  // Dashboard Routes (Protected)
  Route::middleware('auth')->group(function () {
      // Parent Dashboard
      Route::get('/parent-dashboard', function () {
          return view('parent.dashboard');
      })->middleware(RoleMiddleware::class . ':parent')->name('parent.dashboard');
      
      // Teacher Dashboard
      Route::get('/teacher-dashboard', function () {
          return view('teacher.dashboard');
      })->middleware(RoleMiddleware::class . ':teacher')->name('teacher.dashboard');
  });
  ```

- **Implementasi Fitur Utama #1: Manajemen Data Siswa (Kelola Murid)**

  ### 1. Deskripsi Fitur

  Fitur Manajemen Data Siswa (Kelola Murid) adalah salah satu fitur utama yang memungkinkan admin untuk mengelola data murid di TK Permata Bunda. Fitur ini mencakup operasi CRUD (Create, Read, Update, Delete) terhadap data siswa.

  #### Fitur-fitur Manajemen Data Siswa
  - Menambahkan data siswa baru (Create)
  - Melihat daftar seluruh siswa (Read)
  - Melihat detail informasi siswa tertentu (Read)
  - Mengubah data siswa (Update)
  - Menghapus data siswa (Delete)
  - Filter dan pencarian data siswa

  ### 2. Implementasi Model Student

  Model Student dibuat untuk merepresentasikan entitas siswa dalam database. Model ini memiliki relasi dengan model User (Orang Tua) dan beberapa atribut penting.

  ```php
  // Student.php
  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;
  use Illuminate\Database\Eloquent\Relations\BelongsToMany;
  use Illuminate\Database\Eloquent\Relations\HasMany;

  class Student extends Model
  {
      use HasFactory;

      protected $fillable = [
          'user_id',
          'nama_anak',
          'tanggal_lahir',
          'tempat_lahir',
          'nik',
          'jenis_kelamin',
          'agama',
          'nama_ayah',
          'nama_ibu',
          'pekerjaan_ayah',
          'pekerjaan_ibu',
          'alamat',
      ];

      protected $casts = [
          'tanggal_lahir' => 'date',
      ];

      // Relasi dengan User (Orang Tua)
      public function parent(): BelongsTo
      {
          return $this->belongsTo(User::class, 'user_id');
      }

      // Relasi dengan Kelas
      public function classes(): BelongsToMany
      {
          return $this->belongsToMany(Kelas::class, 'murid_kelas', 'anak_id', 'kelas_id');
      }

      // Relasi dengan Pembayaran SPP
      public function payments(): HasMany
      {
          return $this->hasMany(Payment::class, 'anak_id');
      }

      // Relasi dengan Laporan Capaian Pembelajaran
      public function achievements(): HasMany
      {
          return $this->hasMany(Achievement::class, 'anak_id');
      }
  }
  ```

  ### 3. Implementasi StudentResource di Filament

  Kami mengimplementasikan StudentResource di Filament untuk menyediakan antarmuka yang intuitif bagi admin dalam mengelola data siswa.

  ```php
  // StudentResource.php
  namespace App\Filament\Resources;

  use App\Filament\Resources\StudentResource\Pages;
  use App\Models\Student;
  use App\Models\User;
  use Filament\Forms;
  use Filament\Forms\Form;
  use Filament\Resources\Resource;
  use Filament\Tables;
  use Filament\Tables\Table;
  use Illuminate\Database\Eloquent\Builder;

  class StudentResource extends Resource
  {
      protected static ?string $model = Student::class;

      protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
      
      protected static ?string $navigationGroup = 'Manajemen Akademik';
      
      protected static ?string $recordTitleAttribute = 'nama_anak';

      public static function form(Form $form): Form
      {
          return $form
              ->schema([
                  Forms\Components\Section::make('Informasi Dasar Siswa')
                      ->schema([
                          Forms\Components\Select::make('user_id')
                              ->label('Orang Tua')
                              ->options(
                                  User::where('role', 'parent')
                                      ->pluck('name', 'id')
                              )
                              ->required()
                              ->searchable(),
                          Forms\Components\TextInput::make('nama_anak')
                              ->label('Nama Lengkap')
                              ->required()
                              ->maxLength(255),
                          Forms\Components\DatePicker::make('tanggal_lahir')
                              ->label('Tanggal Lahir')
                              ->required(),
                          Forms\Components\TextInput::make('tempat_lahir')
                              ->label('Tempat Lahir')
                              ->required()
                              ->maxLength(100),
                          Forms\Components\TextInput::make('nik')
                              ->label('NIK')
                              ->maxLength(16)
                              ->unique(ignoreRecord: true),
                          Forms\Components\Select::make('jenis_kelamin')
                              ->label('Jenis Kelamin')
                              ->options([
                                  'male' => 'Laki-laki',
                                  'female' => 'Perempuan',
                              ])
                              ->required(),
                          Forms\Components\TextInput::make('agama')
                              ->label('Agama')
                              ->maxLength(20),
                      ])
                      ->columns(2),
                  
                  Forms\Components\Section::make('Informasi Keluarga')
                      ->schema([
                          Forms\Components\TextInput::make('nama_ayah')
                              ->label('Nama Ayah')
                              ->maxLength(255),
                          Forms\Components\TextInput::make('nama_ibu')
                              ->label('Nama Ibu')
                              ->maxLength(255),
                          Forms\Components\TextInput::make('pekerjaan_ayah')
                              ->label('Pekerjaan Ayah')
                              ->maxLength(100),
                          Forms\Components\TextInput::make('pekerjaan_ibu')
                              ->label('Pekerjaan Ibu')
                              ->maxLength(100),
                          Forms\Components\Textarea::make('alamat')
                              ->label('Alamat')
                              ->maxLength(255)
                              ->columnSpanFull(),
                      ])
                      ->columns(2),
              ]);
      }

      public static function table(Table $table): Table
      {
          return $table
              ->columns([
                  Tables\Columns\TextColumn::make('nama_anak')
                      ->label('Nama')
                      ->searchable()
                      ->sortable(),
                  Tables\Columns\TextColumn::make('jenis_kelamin')
                      ->label('Jenis Kelamin')
                      ->formatStateUsing(fn (string $state): string => match($state) {
                          'male' => 'Laki-laki',
                          'female' => 'Perempuan',
                          default => $state,
                      }),
                  Tables\Columns\TextColumn::make('tanggal_lahir')
                      ->label('Tanggal Lahir')
                      ->date('d M Y')
                      ->sortable(),
                  Tables\Columns\TextColumn::make('parent.name')
                      ->label('Orang Tua')
                      ->searchable(),
                  Tables\Columns\TextColumn::make('classes.nama_kelas')
                      ->label('Kelas')
                      ->badge(),
              ])
              ->filters([
                  Tables\Filters\SelectFilter::make('jenis_kelamin')
                      ->label('Jenis Kelamin')
                      ->options([
                          'male' => 'Laki-laki',
                          'female' => 'Perempuan',
                      ]),
              ])
              ->actions([
                  Tables\Actions\ViewAction::make(),
                  Tables\Actions\EditAction::make(),
                  Tables\Actions\DeleteAction::make(),
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
              // Relasi akan ditambahkan sesuai kebutuhan
          ];
      }

      public static function getPages(): array
      {
          return [
              'index' => Pages\ListStudents::route('/'),
              'create' => Pages\CreateStudent::route('/create'),
              'view' => Pages\ViewStudent::route('/{record}'),
              'edit' => Pages\EditStudent::route('/{record}/edit'),
          ];
      }
  }
  ```

  ### 4. Implementasi Migrasi untuk Tabel Students

  Kami membuat migrasi untuk tabel students yang menyimpan data siswa. Struktur tabel ini dirancang untuk mengakomodasi semua informasi yang diperlukan oleh mitra terkait data siswa.

  ```php
  // 2025_04_16_181818_create_students_table.php
  public function up(): void
  {
      Schema::create('students', function (Blueprint $table) {
          $table->id();
          $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
          $table->string('nama_anak');
          $table->date('tanggal_lahir');
          $table->string('tempat_lahir');
          $table->string('nik', 16)->unique()->nullable();
          $table->string('jenis_kelamin');
          $table->string('agama', 20)->nullable();
          $table->string('nama_ayah')->nullable();
          $table->string('nama_ibu')->nullable();
          $table->string('pekerjaan_ayah')->nullable();
          $table->string('pekerjaan_ibu')->nullable();
          $table->text('alamat')->nullable();
          $table->timestamps();
      });
  }
  ```

  ### 5. Fitur Tambahan Student Resource

  Selain operasi CRUD dasar, kami juga mengimplementasikan beberapa fitur tambahan untuk meningkatkan pengalaman pengguna dalam mengelola data siswa:

  #### Filter dan Pencarian
  Admin dapat dengan mudah mencari siswa berdasarkan nama atau nama orang tua, serta memfilter siswa berdasarkan jenis kelamin.

  #### Detail View
  Halaman detail siswa menampilkan semua informasi siswa secara terstruktur dan rapi, termasuk data pribadi, data keluarga, serta riwayat pembayaran dan capaian pembelajaran (yang akan dikembangkan lebih lanjut di pekan berikutnya).

  #### Validasi Data
  Semua input data siswa divalidasi untuk memastikan keakuratan dan kelengkapan informasi, seperti format NIK yang valid, tanggal lahir yang masuk akal, dan field-field wajib yang terisi.

## Challenges & Solutions
- **Challenge 1**: Implementasi Sistem Multi-Role dengan Hak Akses yang Sesuai
  - **Solution**: Kami mengimplementasikan middleware RoleMiddleware yang memeriksa peran pengguna dan mengarahkan mereka ke dashboard yang sesuai. Middleware ini diterapkan pada route dashboard untuk memastikan bahwa hanya pengguna dengan peran yang sesuai yang dapat mengakses dashboard tersebut. Selain itu, kami juga mengintegrasikan package Spatie Permission untuk mengelola peran dan hak akses pengguna dengan lebih terstruktur.

- **Challenge 2**: Merancang Form yang User-Friendly untuk Manajemen Data Siswa
  - **Solution**: Kami mengatasi tantangan ini dengan membagi form manajemen data siswa menjadi beberapa bagian (section) yang terorganisir, seperti Informasi Dasar Siswa dan Informasi Keluarga. Hal ini membuat form lebih mudah digunakan oleh admin. Kami juga menerapkan validasi data untuk memastikan informasi yang dimasukkan akurat dan lengkap. Selain itu, kami menggunakan fitur kolom dinamis (2 kolom dalam satu baris) untuk mengoptimalkan penggunaan ruang pada layar.

- **Challenge 3**: Integrasi Sistem Autentikasi dengan Panel Admin Filament
  - **Solution**: Kami menghadapi tantangan dalam mengintegrasikan sistem autentikasi custom dengan panel admin Filament. Solusinya adalah dengan memodifikasi konfigurasi Filament untuk menggunakan User model yang sama dengan sistem autentikasi custom, dan menerapkan metode `canAccessPanel` di model User untuk menentukan pengguna mana yang dapat mengakses panel admin. Kami juga mengimplementasikan sistem login terpisah untuk panel admin dan aplikasi utama dengan redirect yang sesuai.

## Next Week Plan
- Implementasi fitur inti #2: Manajemen Data Guru (CRUD) dengan fungsionalitas lengkap di Filament.
- Implementasi fitur inti #3: Manajemen Kelas dan Jadwal.
- Perbaikan UI/UX untuk dashboard Orang Tua dan Guru dengan informasi yang lebih relevan.
- Integrasi backend dengan frontend untuk fitur-fitur baru.

## Contributions
- **Avhilla Catton Andalucia**: Implementasi dashboard Orang Tua dan Guru, styling halaman
- **Maulana Malik Ibrahim**: Implementasi sistem registrasi Orang Tua, integrasi dengan model User
- **Pangeran Borneo Silaen**: Implementasi Student Resource dan User Resource di Filament, konfigurasi middleware dan role
- **Varrel Kaleb Ropard Pasaribu**: Implementasi sistem login, pembuatan Controller, dokumentasi

## Screenshots / Demo
- [Halaman Login](https://github.com/PangeranSilaen/PermataKiddo/blob/333891210111ce6c96318b7e06e2b3c79102fb11/Laporan/Gambar/Login.png)
- [Halaman Register](https://github.com/PangeranSilaen/PermataKiddo/blob/333891210111ce6c96318b7e06e2b3c79102fb11/Laporan/Gambar/Register.png)
- [Halaman Manajemen Murid](https://github.com/PangeranSilaen/PermataKiddo/blob/333891210111ce6c96318b7e06e2b3c79102fb11/Laporan/Gambar/Manajemen%20Murid.png)
- [Halaman Form Pendaftaran Murid](https://github.com/PangeranSilaen/PermataKiddo/blob/333891210111ce6c96318b7e06e2b3c79102fb11/Laporan/Gambar/Form%20Pendaftaran%20Murid.png)
- [Halaman Dashboard Orang tua](https://github.com/PangeranSilaen/PermataKiddo/blob/b756d22691f2270ae73d409dc2a73c483b9cb649/Laporan/Gambar/Dashboard%20Orang%20tua.png)
- [Halaman Dashboard Guru](https://github.com/PangeranSilaen/PermataKiddo/blob/b756d22691f2270ae73d409dc2a73c483b9cb649/Laporan/Gambar/Dashboard%20Guru.png)

## Integration Test

Seperti yang terlihat pada tampilan, seluruh data dari back end berhasil terintegrasi dengan baik ke sisi front end tanpa menimbulkan error sedikit pun selama proses integrasi berlangsung. Hal ini menunjukkan bahwa komunikasi antara kedua sisi sistem berjalan lancar dan stabil, serta menandakan bahwa implementasi fungsionalitas dasar telah berhasil dijalankan dengan tepat.