<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PermataKiddo SIAKAD')</title>
    <link rel="stylesheet" href="{{ asset('css/modern.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('styles')
</head>
<body>
    <div class="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/" class="navbar-brand">PermataKiddo</a>
            @auth
            <div>
                <span class="nav-text">Selamat datang, {{ Auth::user()->name }}</span>
            </div>
            @endauth
        </div>
    </div>
    
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger animate-fade-in">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="mt-4 p-4 text-center text-light" style="background-color:var(--primary-dark)">
        <div class="container">
            <p class="mb-1">&copy; {{ date('Y') }} PermataKiddo SIAKAD</p>
            <p class="mb-0" style="font-size:0.9rem">Sistem Informasi Akademik Sekolah</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
