<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Buku Tamu - Pengadilan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('HomeCss/style.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Header/Navigation -->
    <nav class="nav-container">
        <div class="container">
            <div class="nav-content">
                <div class="nav-brand">
                    <img src="{{ asset('ImageHome/logoptun-removebg-preview.png') }}" alt="PTUN Logo" class="nav-logo">
                    <span class="nav-title">Pengadilan Tata Usaha Negara Bandung</span>
                </div>
                <div class="nav-menu">
                    <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                    <a href="{{ route('user.form') }}" class="nav-link">Isi Buku Tamu</a>
                    <a href="{{ route('about') }}" class="nav-link">Tentang</a>
                    <a href="{{ route('kontak') }}" class="nav-link">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
