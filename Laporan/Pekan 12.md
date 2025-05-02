# Laporan Progres Mingguan - PermataKiddo
**Kelompok**: 11  
**Mitra**: TK Permata Bunda  
**Pekan ke-**: 12  
**Tanggal**: 02/05/2025  

- **Avhilla Catton Andalucia**: 10231021
- **Maulana Malik Ibrahim**: 10231051
- **Pangeran Borneo Silaen**: 10231073
- **Varrel Kaleb Ropard Pasaribu**: 10231089

## Progress Summary
Pada Pekan 12, fokus utama tim adalah mengembangkan fitur Core #2 (Manajemen Guru) dan #3 (Manajemen Jadwal/Schedule) sesuai dengan deliverables yang telah ditentukan. Kami berhasil mengimplementasikan sistem manajemen guru dengan fitur CRUD lengkap, membangun sistem pengelolaan jadwal yang terintegrasi dengan data guru, dan melakukan perbaikan UI/UX untuk meningkatkan pengalaman pengguna. Selain itu, kami juga telah menyelesaikan pengujian unit test untuk memvalidasi fungsionalitas yang telah diimplementasikan.

## Accomplished Tasks
- **Implementasi Fitur Manajemen Guru (CRUD)**

  ### 1. Deskripsi Fitur

  Fitur Manajemen Guru merupakan fitur utama untuk pengelolaan data guru di TK Permata Bunda. Fitur ini dirancang agar admin dapat dengan mudah mengelola informasi guru, termasuk data pribadi, spesialisasi, dan informasi kontak. Implementasi fitur ini mencakup operasi CRUD (Create, Read, Update, Delete) lengkap dengan antarmuka yang intuitif.

  #### Fitur-fitur Manajemen Guru
  - Menambahkan data guru baru (Create)
  - Menampilkan daftar dan detail guru (Read)
  - Mengubah informasi guru (Update)
  - Menghapus data guru (Delete)
  - Pencarian dan filter data guru

  ### 2. Implementasi Model Teacher

  Model `Teacher` dibuat untuk merepresentasikan entitas guru dalam database. Model ini memiliki relasi dengan model `User` dan `Schedule`, serta memiliki atribut-atribut penting seperti berikut:

  ```php
  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;
  use Illuminate\Database\Eloquent\Relations\HasMany;

  class Teacher extends Model
  {
      use HasFactory;

      protected $fillable = [
          'user_id',
          'name',
          'employee_id',
          'specialization',
          'phone_number',
          'address',
          'photo',
          'join_date',
          'status',
          'bio',
      ];

      protected $casts = [
          'join_date' => 'date',
      ];

      /**
       * Get the user associated with the teacher.
       */
      public function user(): BelongsTo
      {
          return $this->belongsTo(User::class);
      }

      /**
       * Get the schedules for the teacher.
       */
      public function schedules(): HasMany
      {
          return $this->hasMany(Schedule::class);
      }

      /**
       * Get the achievements recorded by this teacher.
       */
      public function achievements(): HasMany
      {
          return $this->hasMany(Achievement::class);
      }
  }
  ```

  ### 3. Implementasi TeacherResource di Filament

  Kami mengimplementasikan `TeacherResource` menggunakan Filament untuk menyediakan antarmuka yang intuitif bagi admin dalam mengelola data guru. Resource ini mencakup form untuk operasi create dan update, tabel untuk menampilkan daftar guru, serta aksi untuk view, edit, dan delete.

  ```php
  namespace App\Filament\Resources;

  use App\Filament\Resources\TeacherResource\Pages;
  use App\Models\Teacher;
  use App\Models\User;
  use Filament\Forms;
  use Filament\Forms\Form;
  use Filament\Resources\Resource;
  use Filament\Tables;
  use Filament\Tables\Table;
  use Illuminate\Database\Eloquent\Builder;

  class TeacherResource extends Resource
  {
      protected static ?string $model = Teacher::class;

      protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
      
      protected static ?string $navigationGroup = 'Manajemen Akademik';
      
      protected static ?string $recordTitleAttribute = 'name';

      public static function form(Form $form): Form
      {
          return $form
              ->schema([
                  Forms\Components\Section::make('Informasi Dasar Guru')
                      ->schema([
                          Forms\Components\Select::make('user_id')
                              ->label('Akun Pengguna')
                              ->options(
                                  User::where('role', 'teacher')
                                      ->pluck('name', 'id')
                              )
                              ->required()
                              ->searchable()
                              ->createOptionForm([
                                  Forms\Components\TextInput::make('name')
                                      ->required()
                                      ->maxLength(255),
                                  Forms\Components\TextInput::make('email')
                                      ->email()
                                      ->required()
                                      ->maxLength(255),
                                  Forms\Components\TextInput::make('password')
                                      ->password()
                                      ->required()
                                      ->maxLength(255),
                                  Forms\Components\Hidden::make('role')
                                      ->default('teacher'),
                              ]),
                          Forms\Components\TextInput::make('name')
                              ->label('Nama Lengkap')
                              ->required()
                              ->maxLength(255),
                          Forms\Components\TextInput::make('employee_id')
                              ->label('ID Pegawai')
                              ->required()
                              ->maxLength(20)
                              ->unique(ignoreRecord: true),
                          Forms\Components\TextInput::make('specialization')
                              ->label('Spesialisasi')
                              ->required()
                              ->maxLength(100),
                          Forms\Components\TextInput::make('phone_number')
                              ->label('Nomor Telepon')
                              ->tel()
                              ->required()
                              ->maxLength(15),
                      ])
                      ->columns(2),
                      
                  Forms\Components\Section::make('Informasi Tambahan')
                      ->schema([
                          Forms\Components\Textarea::make('address')
                              ->label('Alamat')
                              ->maxLength(255)
                              ->columnSpanFull(),
                          Forms\Components\FileUpload::make('photo')
                              ->label('Foto')
                              ->image()
                              ->directory('teachers')
                              ->preserveFilenames(),
                          Forms\Components\DatePicker::make('join_date')
                              ->label('Tanggal Bergabung')
                              ->required(),
                          Forms\Components\Select::make('status')
                              ->label('Status')
                              ->options([
                                  'active' => 'Aktif',
                                  'inactive' => 'Tidak Aktif',
                                  'on_leave' => 'Cuti',
                              ])
                              ->required()
                              ->default('active'),
                          Forms\Components\Textarea::make('bio')
                              ->label('Biografi')
                              ->maxLength(500)
                              ->columnSpanFull(),
                      ])
                      ->columns(2),
              ]);
      }

      public static function table(Table $table): Table
      {
          return $table
              ->columns([
                  Tables\Columns\ImageColumn::make('photo')
                      ->label('Foto')
                      ->circular(),
                  Tables\Columns\TextColumn::make('name')
                      ->label('Nama')
                      ->searchable()
                      ->sortable(),
                  Tables\Columns\TextColumn::make('employee_id')
                      ->label('ID Pegawai')
                      ->searchable(),
                  Tables\Columns\TextColumn::make('specialization')
                      ->label('Spesialisasi')
                      ->searchable(),
                  Tables\Columns\TextColumn::make('join_date')
                      ->label('Tanggal Bergabung')
                      ->date('d M Y')
                      ->sortable(),
                  Tables\Columns\TextColumn::make('status')
                      ->label('Status')
                      ->badge()
                      ->color(fn (string $state): string => match($state) {
                          'active' => 'success',
                          'inactive' => 'danger',
                          'on_leave' => 'warning',
                          default => 'gray',
                      })
                      ->formatStateUsing(fn (string $state): string => match($state) {
                          'active' => 'Aktif',
                          'inactive' => 'Tidak Aktif',
                          'on_leave' => 'Cuti',
                          default => $state,
                      }),
              ])
              ->filters([
                  Tables\Filters\SelectFilter::make('status')
                      ->label('Status')
                      ->options([
                          'active' => 'Aktif',
                          'inactive' => 'Tidak Aktif',
                          'on_leave' => 'Cuti',
                      ]),
                  Tables\Filters\SelectFilter::make('specialization')
                      ->label('Spesialisasi')
                      ->options(
                          Teacher::pluck('specialization', 'specialization')
                              ->unique()
                              ->toArray()
                      ),
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
              TeacherResource\RelationManagers\SchedulesRelationManager::class,
          ];
      }

      public static function getPages(): array
      {
          return [
              'index' => Pages\ListTeachers::route('/'),
              'create' => Pages\CreateTeacher::route('/create'),
              'view' => Pages\ViewTeacher::route('/{record}'),
              'edit' => Pages\EditTeacher::route('/{record}/edit'),
          ];
      }
  }
  ```

  ### 4. Implementasi Migrasi untuk Tabel Teachers

  Kami membuat migrasi untuk tabel `teachers` yang menyimpan data guru. Struktur tabel ini dirancang untuk menyimpan informasi guru yang lengkap.

  ```php
  // 2025_04_23_120000_create_teachers_table.php
  public function up(): void
  {
      Schema::create('teachers', function (Blueprint $table) {
          $table->id();
          $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
          $table->string('name');
          $table->string('employee_id', 20)->unique();
          $table->string('specialization', 100);
          $table->string('phone_number', 15);
          $table->text('address')->nullable();
          $table->string('photo')->nullable();
          $table->date('join_date');
          $table->enum('status', ['active', 'inactive', 'on_leave'])->default('active');
          $table->text('bio')->nullable();
          $table->timestamps();
      });
  }
  ```

  ### 5. Fitur Tambahan Teacher Resource

  Selain operasi CRUD dasar, kami juga mengimplementasikan beberapa fitur tambahan untuk meningkatkan pengalaman pengguna dalam mengelola data guru:

  #### Filter dan Pencarian
  Admin dapat mencari guru berdasarkan nama, ID pegawai, atau spesialisasi, serta memfilter guru berdasarkan status atau spesialisasi.

  #### Detail View
  Halaman detail guru menampilkan informasi guru secara terstruktur dan rapi, termasuk foto, informasi kontak, dan jadwal mengajar.

  #### Relasi dengan Jadwal
  Implementasi `SchedulesRelationManager` memungkinkan admin untuk melihat dan mengelola jadwal mengajar guru langsung dari halaman detail guru.

- **Implementasi Fitur Jadwal/Schedule (CRUD)**

  ### 1. Deskripsi Fitur

  Fitur Jadwal (Schedule) merupakan fitur untuk mengatur dan mengelola jadwal mengajar guru di TK Permata Bunda. Fitur ini memungkinkan admin untuk membuat jadwal kelas, menentukan guru pengajar, dan mengatur waktu dan ruangan. Implementasi fitur ini mencakup operasi CRUD lengkap.

  #### Fitur-fitur Jadwal
  - Membuat jadwal baru (Create)
  - Melihat daftar dan detail jadwal (Read)
  - Mengubah jadwal (Update)
  - Menghapus jadwal (Delete)
  - Filter dan pencarian jadwal

  ### 2. Implementasi Model Schedule

  Model `Schedule` dibuat untuk merepresentasikan entitas jadwal dalam database. Model ini memiliki relasi dengan model `Teacher` dan memiliki atribut-atribut penting seperti berikut:

  ```php
  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;

  class Schedule extends Model
  {
      use HasFactory;

      protected $fillable = [
          'teacher_id',
          'subject_name',
          'day_of_week',
          'start_time',
          'end_time',
          'room',
          'class_group',
          'notes',
          'status',
      ];

      protected $casts = [
          'start_time' => 'datetime',
          'end_time' => 'datetime',
      ];

      /**
       * Get the teacher that owns the schedule.
       */
      public function teacher(): BelongsTo
      {
          return $this->belongsTo(Teacher::class);
      }
  }
  ```

  ### 3. Implementasi ScheduleResource di Filament

  Kami mengimplementasikan `ScheduleResource` menggunakan Filament untuk menyediakan antarmuka yang intuitif bagi admin dalam mengelola jadwal. Resource ini mencakup form untuk operasi create dan update, tabel untuk menampilkan daftar jadwal, serta aksi untuk view, edit, dan delete.

  ```php
  namespace App\Filament\Resources;

  use App\Filament\Resources\ScheduleResource\Pages;
  use App\Models\Schedule;
  use App\Models\Teacher;
  use Filament\Forms;
  use Filament\Forms\Form;
  use Filament\Resources\Resource;
  use Filament\Tables;
  use Filament\Tables\Table;
  use Illuminate\Database\Eloquent\Builder;

  class ScheduleResource extends Resource
  {
      protected static ?string $model = Schedule::class;

      protected static ?string $navigationIcon = 'heroicon-o-calendar';
      
      protected static ?string $navigationGroup = 'Manajemen Akademik';
      
      protected static ?string $recordTitleAttribute = 'subject_name';

      public static function form(Form $form): Form
      {
          return $form
              ->schema([
                  Forms\Components\Select::make('teacher_id')
                      ->label('Guru')
                      ->options(
                          Teacher::where('status', 'active')
                              ->pluck('name', 'id')
                      )
                      ->required()
                      ->searchable()
                      ->preload(),
                  Forms\Components\TextInput::make('subject_name')
                      ->label('Nama Mata Pelajaran')
                      ->required()
                      ->maxLength(255),
                  Forms\Components\Select::make('day_of_week')
                      ->label('Hari')
                      ->options([
                          'Monday' => 'Senin',
                          'Tuesday' => 'Selasa',
                          'Wednesday' => 'Rabu',
                          'Thursday' => 'Kamis',
                          'Friday' => 'Jumat',
                          'Saturday' => 'Sabtu',
                      ])
                      ->required(),
                  Forms\Components\TimePicker::make('start_time')
                      ->label('Waktu Mulai')
                      ->required()
                      ->seconds(false),
                  Forms\Components\TimePicker::make('end_time')
                      ->label('Waktu Selesai')
                      ->required()
                      ->seconds(false)
                      ->after('start_time'),
                  Forms\Components\TextInput::make('room')
                      ->label('Ruangan')
                      ->required()
                      ->maxLength(50),
                  Forms\Components\TextInput::make('class_group')
                      ->label('Kelompok Kelas')
                      ->required()
                      ->maxLength(50),
                  Forms\Components\Textarea::make('notes')
                      ->label('Catatan')
                      ->maxLength(500),
                  Forms\Components\Select::make('status')
                      ->label('Status')
                      ->options([
                          'active' => 'Aktif',
                          'cancelled' => 'Dibatalkan',
                          'rescheduled' => 'Dijadwalkan Ulang',
                      ])
                      ->required()
                      ->default('active'),
              ]);
      }

      public static function table(Table $table): Table
      {
          return $table
              ->columns([
                  Tables\Columns\TextColumn::make('teacher.name')
                      ->label('Guru')
                      ->searchable()
                      ->sortable(),
                  Tables\Columns\TextColumn::make('subject_name')
                      ->label('Mata Pelajaran')
                      ->searchable(),
                  Tables\Columns\TextColumn::make('day_of_week')
                      ->label('Hari')
                      ->formatStateUsing(fn (string $state): string => match($state) {
                          'Monday' => 'Senin',
                          'Tuesday' => 'Selasa',
                          'Wednesday' => 'Rabu',
                          'Thursday' => 'Kamis',
                          'Friday' => 'Jumat',
                          'Saturday' => 'Sabtu',
                          default => $state,
                      })
                      ->sortable(),
                  Tables\Columns\TextColumn::make('start_time')
                      ->label('Mulai')
                      ->time('H:i')
                      ->sortable(),
                  Tables\Columns\TextColumn::make('end_time')
                      ->label('Selesai')
                      ->time('H:i')
                      ->sortable(),
                  Tables\Columns\TextColumn::make('room')
                      ->label('Ruangan')
                      ->searchable(),
                  Tables\Columns\TextColumn::make('class_group')
                      ->label('Kelas')
                      ->searchable()
                      ->sortable(),
                  Tables\Columns\TextColumn::make('status')
                      ->badge()
                      ->color(fn (string $state): string => match($state) {
                          'active' => 'success',
                          'cancelled' => 'danger',
                          'rescheduled' => 'warning',
                          default => 'gray',
                      })
                      ->formatStateUsing(fn (string $state): string => match($state) {
                          'active' => 'Aktif',
                          'cancelled' => 'Dibatalkan',
                          'rescheduled' => 'Dijadwalkan Ulang',
                          default => $state,
                      }),
              ])
              ->filters([
                  Tables\Filters\SelectFilter::make('day_of_week')
                      ->label('Hari')
                      ->options([
                          'Monday' => 'Senin',
                          'Tuesday' => 'Selasa',
                          'Wednesday' => 'Rabu',
                          'Thursday' => 'Kamis',
                          'Friday' => 'Jumat',
                          'Saturday' => 'Sabtu',
                      ]),
                  Tables\Filters\SelectFilter::make('teacher_id')
                      ->label('Guru')
                      ->relationship('teacher', 'name'),
                  Tables\Filters\SelectFilter::make('status')
                      ->label('Status')
                      ->options([
                          'active' => 'Aktif',
                          'cancelled' => 'Dibatalkan',
                          'rescheduled' => 'Dijadwalkan Ulang',
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
              'index' => Pages\ListSchedules::route('/'),
              'create' => Pages\CreateSchedule::route('/create'),
              'view' => Pages\ViewSchedule::route('/{record}'),
              'edit' => Pages\EditSchedule::route('/{record}/edit'),
          ];
      }
  }
  ```

  ### 4. Implementasi Migrasi untuk Tabel Schedules

  Kami membuat migrasi untuk tabel `schedules` yang menyimpan data jadwal. Struktur tabel ini dirancang untuk menyimpan informasi jadwal yang lengkap dan terorganisir.

  ```php
  // 2025_04_24_130000_create_schedules_table.php
  public function up(): void
  {
      Schema::create('schedules', function (Blueprint $table) {
          $table->id();
          $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
          $table->string('subject_name');
          $table->string('day_of_week');
          $table->time('start_time');
          $table->time('end_time');
          $table->string('room', 50);
          $table->string('class_group', 50);
          $table->text('notes')->nullable();
          $table->enum('status', ['active', 'cancelled', 'rescheduled'])->default('active');
          $table->timestamps();
      });
  }
  ```

  ### 5. Pengaturan Relasi antara Teacher dan Schedule

  Untuk memudahkan pengelolaan jadwal guru, kami mengimplementasikan `SchedulesRelationManager` yang memungkinkan admin untuk mengelola jadwal langsung dari halaman detail guru.

  ```php
  namespace App\Filament\Resources\TeacherResource\RelationManagers;

  use Filament\Forms;
  use Filament\Forms\Form;
  use Filament\Resources\RelationManagers\RelationManager;
  use Filament\Tables;
  use Filament\Tables\Table;

  class SchedulesRelationManager extends RelationManager
  {
      protected static string $relationship = 'schedules';

      protected static ?string $recordTitleAttribute = 'subject_name';

      public function form(Form $form): Form
      {
          return $form
              ->schema([
                  Forms\Components\TextInput::make('subject_name')
                      ->label('Nama Mata Pelajaran')
                      ->required()
                      ->maxLength(255),
                  Forms\Components\Select::make('day_of_week')
                      ->label('Hari')
                      ->options([
                          'Monday' => 'Senin',
                          'Tuesday' => 'Selasa',
                          'Wednesday' => 'Rabu',
                          'Thursday' => 'Kamis',
                          'Friday' => 'Jumat',
                          'Saturday' => 'Sabtu',
                      ])
                      ->required(),
                  Forms\Components\TimePicker::make('start_time')
                      ->label('Waktu Mulai')
                      ->required()
                      ->seconds(false),
                  Forms\Components\TimePicker::make('end_time')
                      ->label('Waktu Selesai')
                      ->required()
                      ->seconds(false)
                      ->after('start_time'),
                  Forms\Components\TextInput::make('room')
                      ->label('Ruangan')
                      ->required()
                      ->maxLength(50),
                  Forms\Components\TextInput::make('class_group')
                      ->label('Kelompok Kelas')
                      ->required()
                      ->maxLength(50),
                  Forms\Components\Textarea::make('notes')
                      ->label('Catatan')
                      ->maxLength(500),
                  Forms\Components\Select::make('status')
                      ->label('Status')
                      ->options([
                          'active' => 'Aktif',
                          'cancelled' => 'Dibatalkan',
                          'rescheduled' => 'Dijadwalkan Ulang',
                      ])
                      ->required()
                      ->default('active'),
              ]);
      }

      public function table(Table $table): Table
      {
          return $table
              ->columns([
                  Tables\Columns\TextColumn::make('subject_name')
                      ->label('Mata Pelajaran'),
                  Tables\Columns\TextColumn::make('day_of_week')
                      ->label('Hari')
                      ->formatStateUsing(fn (string $state): string => match($state) {
                          'Monday' => 'Senin',
                          'Tuesday' => 'Selasa',
                          'Wednesday' => 'Rabu',
                          'Thursday' => 'Kamis',
                          'Friday' => 'Jumat',
                          'Saturday' => 'Sabtu',
                          default => $state,
                      }),
                  Tables\Columns\TextColumn::make('start_time')
                      ->label('Mulai')
                      ->time('H:i'),
                  Tables\Columns\TextColumn::make('end_time')
                      ->label('Selesai')
                      ->time('H:i'),
                  Tables\Columns\TextColumn::make('room')
                      ->label('Ruangan'),
                  Tables\Columns\TextColumn::make('class_group')
                      ->label('Kelas'),
                  Tables\Columns\TextColumn::make('status')
                      ->badge()
                      ->color(fn (string $state): string => match($state) {
                          'active' => 'success',
                          'cancelled' => 'danger',
                          'rescheduled' => 'warning',
                          default => 'gray',
                      })
                      ->formatStateUsing(fn (string $state): string => match($state) {
                          'active' => 'Aktif',
                          'cancelled' => 'Dibatalkan',
                          'rescheduled' => 'Dijadwalkan Ulang',
                          default => $state,
                      }),
              ])
              ->filters([
                  Tables\Filters\SelectFilter::make('day_of_week')
                      ->label('Hari')
                      ->options([
                          'Monday' => 'Senin',
                          'Tuesday' => 'Selasa',
                          'Wednesday' => 'Rabu',
                          'Thursday' => 'Kamis',
                          'Friday' => 'Jumat',
                          'Saturday' => 'Sabtu',
                      ]),
                  Tables\Filters\SelectFilter::make('status')
                      ->label('Status')
                      ->options([
                          'active' => 'Aktif',
                          'cancelled' => 'Dibatalkan',
                          'rescheduled' => 'Dijadwalkan Ulang',
                      ]),
              ])
              ->headerActions([
                  Tables\Actions\CreateAction::make(),
              ])
              ->actions([
                  Tables\Actions\EditAction::make(),
                  Tables\Actions\DeleteAction::make(),
              ])
              ->bulkActions([
                  Tables\Actions\BulkActionGroup::make([
                      Tables\Actions\DeleteBulkAction::make(),
                  ]),
              ]);
      }
  }
  ```

- **UI Enhancement: Perbaikan Tampilan dan UX**

  ### 1. Deskripsi Perbaikan UI/UX

  Pada Pekan 12, kami melakukan berbagai perbaikan UI/UX untuk meningkatkan pengalaman pengguna dalam menggunakan aplikasi PermataKiddo. Perbaikan ini mencakup penggunaan tema yang konsisten, pengaturan layout yang lebih baik, dan peningkatan responsivitas antarmuka.

  ### 2. Implementasi Dark Mode dan Theme Switcher

  Kami mengimplementasikan fitur dark mode dan theme switcher yang memungkinkan pengguna untuk beralih antara tema terang dan gelap sesuai preferensi mereka.

  ```php
  // Konfigurasi dark mode di Panel Provider
  public function panel(Panel $panel): Panel
  {
      return $panel
          // ...konfigurasi lain...
          ->darkMode(true)
          ->viteTheme('resources/css/filament/admin/theme.css');
  }
  ```

  ### 3. Peningkatan Dashboard Admin

  Dashboard admin dioptimalkan dengan menambahkan widgets yang menampilkan informasi penting seperti jumlah guru, jumlah siswa, dan jadwal kelas hari ini. Widgets ini menyediakan ringkasan visual yang memudahkan admin untuk memantau kondisi terkini.

  ```php
  // Implementasi Dashboard Admin di Filament
  public function widgets(): array
  {
      return [
          StatsOverview::class,
          TeachersOverview::class,
          StudentsOverview::class,
          TodaySchedules::class,
      ];
  }
  ```

  ### 4. Peningkatan Layout dan Responsivitas

  Kami meningkatkan layout dan responsivitas aplikasi untuk memastikan pengalaman pengguna yang baik di berbagai perangkat, mulai dari desktop hingga mobile.

  ```php
  // Konfigurasi layout di Panel Provider
  public function panel(Panel $panel): Panel
  {
      return $panel
          // ...konfigurasi lain...
          ->sidebarCollapsibleOnDesktop()
          ->maxContentWidth('full')
          ->navigationGroups([
              NavigationGroup::make()
                  ->label('Manajemen Akademik')
                  ->icon('heroicon-o-academic-cap'),
              NavigationGroup::make()
                  ->label('Administrasi')
                  ->icon('heroicon-o-cog'),
              NavigationGroup::make()
                  ->label('Pengaturan')
                  ->icon('heroicon-o-wrench')
                  ->collapsed(),
          ]);
  }
  ```

  ### 5. Peningkatan Form dan Tabel

  Kami meningkatkan tampilan form dan tabel dengan menggunakan fitur-fitur Filament seperti layout multi-kolom, grouping input dengan section, dan penggunaan badge untuk status.

  ```php
  // Contoh penggunaan section dan multi-kolom di form
  Forms\Components\Section::make('Informasi Dasar Guru')
      ->schema([
          // ...input fields...
      ])
      ->columns(2);

  // Contoh penggunaan badge di kolom tabel
  Tables\Columns\TextColumn::make('status')
      ->badge()
      ->color(fn (string $state): string => match($state) {
          'active' => 'success',
          'inactive' => 'danger',
          'on_leave' => 'warning',
          default => 'gray',
      });
  ```

  ### 6. Perbaikan Navigasi

  Kami meningkatkan navigasi aplikasi dengan mengelompokkan menu ke dalam kategori yang logis dan menambahkan ikon yang intuitif untuk setiap menu.

  ```php
  // Contoh pengaturan navigasi di Resource
  protected static ?string $navigationGroup = 'Manajemen Akademik';
  protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
  protected static ?int $navigationSort = 3;
  ```

- **Unit Test: Minimal 3 Test Case untuk Fungsi-fungsi Penting**

  ### 1. Unit Test untuk Read Data Guru

  Test case ini memverifikasi bahwa sistem dapat menampilkan daftar guru dengan benar. Pengujian dilakukan dengan membuat beberapa data guru untuk keperluan testing, kemudian mengakses halaman daftar guru dan memverifikasi bahwa data guru tersebut ditampilkan dengan tepat di halaman tersebut.

  Hasil: [Link Screenshot Unit Test Read Guru](https://github.com/PangeranSilaen/PermataKiddo/blob/c6f13f225088060f5b5dff7bbd5ff7b08473c572/Laporan/Gambar/read.png)

  ### 2. Unit Test untuk Create Data Guru

  Test case ini memverifikasi bahwa sistem dapat membuat data guru baru dengan benar. Pengujian dilakukan dengan menyiapkan data guru baru, mengirimkan data tersebut melalui form pembuatan guru, dan memverifikasi bahwa data tersebut tersimpan dengan benar di database.

  Hasil: [Link Screenshot Unit Test Create Guru](https://github.com/PangeranSilaen/PermataKiddo/blob/c6f13f225088060f5b5dff7bbd5ff7b08473c572/Laporan/Gambar/create.png)

  ### 3. Unit Test untuk Update Data Guru

  Test case ini memverifikasi bahwa sistem dapat memperbarui data guru yang ada dengan benar. Pengujian dilakukan dengan membuat data guru untuk diupdate, menyiapkan data baru yang akan digunakan untuk update, mengirimkan data tersebut melalui form update, dan memverifikasi bahwa data tersebut berhasil diperbarui di database.

  Hasil: [Link Screenshot Unit Test Update Guru](https://github.com/PangeranSilaen/PermataKiddo/blob/c6f13f225088060f5b5dff7bbd5ff7b08473c572/Laporan/Gambar/update.png)

  ### 4. Unit Test untuk Delete Data Guru

  Test case ini memverifikasi bahwa sistem dapat menghapus data guru dengan benar. Pengujian dilakukan dengan membuat data guru untuk dihapus, mengirimkan request delete, dan memverifikasi bahwa data tersebut telah dihapus dari database.

  Hasil: [Link Screenshot Unit Test Delete Guru](https://github.com/PangeranSilaen/PermataKiddo/blob/c6f13f225088060f5b5dff7bbd5ff7b08473c572/Laporan/Gambar/delete1.png)
  
  Hasil: [Link Screenshot Unit Test Delete Guru 2](https://github.com/PangeranSilaen/PermataKiddo/blob/c6f13f225088060f5b5dff7bbd5ff7b08473c572/Laporan/Gambar/delete2.png)

## Challenges & Solutions
- **Challenge 1**: Mengintegrasikan Sistem Manajemen Guru dengan User Authentication
  - **Solution**: Kami menghadapi tantangan dalam mengintegrasikan data guru dengan user authentication, di mana setiap guru perlu memiliki akun user dengan peran yang sesuai. Solusinya adalah dengan membuat relasi one-to-one antara model `Teacher` dan `User`, serta menambahkan fitur create-option-form pada field `user_id` di `TeacherResource` yang memungkinkan admin untuk membuat akun user guru langsung dari form pembuatan guru.

- **Challenge 2**: Memastikan Validasi Jadwal yang Tidak Bertabrakan
  - **Solution**: Kami perlu memastikan bahwa jadwal yang dibuat tidak bertabrakan dengan jadwal lain untuk guru yang sama atau ruangan yang sama. Kami mengatasi ini dengan membuat aturan validasi custom yang memeriksa ketersediaan guru dan ruangan pada waktu tertentu sebelum menyimpan jadwal baru.

- **Challenge 3**: Mengoptimalkan Performa UI pada Data yang Banyak
  - **Solution**: Ketika jumlah data guru dan jadwal bertambah, performa UI bisa menurun. Kami mengatasinya dengan menerapkan teknik lazy loading dan pagination di tabel Filament, serta mengoptimalkan query database dengan menambahkan indeks pada kolom-kolom yang sering digunakan untuk pencarian dan filter.

## Next Week Plan
- Implementasi fitur inti #4: Manajemen Pembayaran SPP dengan integrasi metode pembayaran digital.
- Pengembangan fitur admin panel untuk pemantauan aktivitas sekolah.
- Implementasi fitur visualisasi data untuk dashboard admin.
- Peningkatan fitur pencarian dan filter untuk mempermudah manajemen data dengan volume besar.

## Contributions
- **Avhilla Catton Andalucia**: Implementasi UI Enhancement, styling dashboard, dan pembuatan widgets
- **Maulana Malik Ibrahim**: Pembuatan dan eksekusi Unit Test dan debugging
- **Pangeran Borneo Silaen**: Implementasi fitur Jadwal/Schedule, Manajemen Guru dan pengembangan relasi antar model
- **Varrel Kaleb Ropard Pasaribu**: Implementasi UI Enhancement, styling dashboard, pembuatan widgets dan dokumentasi laporan.

## Screenshots / Demo
- [Halaman Manajemen Guru](https://github.com/PangeranSilaen/PermataKiddo/raw/main/Laporan/Gambar/admin.png)
- [Halaman Jadwal & Kegiatan](https://github.com/PangeranSilaen/PermataKiddo/raw/main/Laporan/Gambar/admin1.png)