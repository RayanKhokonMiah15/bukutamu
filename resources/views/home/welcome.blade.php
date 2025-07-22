@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Buku Tamu - Pengadilan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('HomeCss/style.css') }}">
</head>
<body>
   

    <!-- Hero Section -->
    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    Selamat Datang di Sistem Buku Tamu Digital
                </h1>
                <p class="hero-description">
                    Sistem pencatatan tamu modern untuk melayani dengan lebih baik. 
                    Komitmen kami untuk transparansi dan efisiensi dalam pelayanan publik.
                </p>
                <div class="button-group">
                    <a href="#" class="primary-button">
                        Daftar Kunjungan
                    </a>
                    <a href="#" class="secondary-button">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('ImageHome/ptun.jpg') }}"
                     alt="Justice Illustration" 
                     class="featured-image">
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="container">
            <h2 class="features-title">Layanan Kami</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-clipboard-list feature-icon"></i>
                    <h3 class="feature-title">Pencatatan Digital</h3>
                    <p class="feature-description">Sistem pencatatan modern yang efisien dan akurat</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-clock feature-icon"></i>
                    <h3 class="feature-title">Pelayanan Cepat</h3>
                    <p class="feature-description">Proses administrasi yang cepat dan tepat</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <h3 class="feature-title">Keamanan Data</h3>
                    <p class="feature-description">Perlindungan data tamu yang terjamin</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="copyright">
                    <p>&copy; 2025 Sistem Buku Tamu. All rights reserved.</p>
                </div>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
