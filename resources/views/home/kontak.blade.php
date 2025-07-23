@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('HomeCss/kontak.css') }}">
@endpush

@section('content')
<div class="contact-container">
    <div class="contact-header">
        <h1 class="contact-title">Hubungi Kami</h1>
        <p class="contact-subtitle">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami melalui berbagai saluran komunikasi yang tersedia.</p>
    </div>

    <div class="contact-content">
        <div class="contact-info">
            <div class="info-section">
                <h3 class="info-title">
                    <i class="fas fa-map-marker-alt"></i>
                    Alamat
                </h3>
                <p class="info-content">
                    Jl. Diponegoro No.34, Citarum, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40115
                </p>
            </div>

            <div class="info-section">
                <h3 class="info-title">
                    <i class="fas fa-phone-alt"></i>
                    Telepon
                </h3>
                <p class="info-content">
                    <a href="tel:+622234230325">(022) 7213-999</a>
                </p>
            </div>

            <div class="info-section">
                <h3 class="info-title">
                    <i class="fas fa-envelope"></i>
                    Email
                </h3>
                <p class="info-content">
                    <a href="mailto:ptun.bandung@gmail.com">informasi@ptun-bandung.go.id</a>
                </p>
            </div>

            <div class="info-section">
                <h3 class="info-title">
                    <i class="fas fa-clock"></i>
                    Jam Operasional
                </h3>
                <p class="info-content">
                    Senin - Jumat<br>
                    08:00 - 16:30 WIB
                </p>
            </div>

            <div class="info-section">
                <h3 class="info-title">
                    <i class="fas fa-share-alt"></i>
                    Media Sosial
                </h3>
                <div class="social-links">
                    <a href="#" class="social-link" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="contact-map">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.764602770798!2d107.61486731477269!3d-6.922777694998633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e64c5e8866e5%3A0x37be7ac9d575f7ed!2sPengadilan%20Tata%20Usaha%20Negara%20Bandung!5e0!3m2!1sen!2sid!4v1647829738254!5m2!1sen!2sid"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>
@endsection
