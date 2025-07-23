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
                    <a href="https://www.facebook.com/share/1CnzYc9yij/" class="social-link" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://x.com/ptunbandung" class="social-link" title="X">
                        <i class="fab fa-x"></i>
                    </a>
                    <a href="https://www.instagram.com/ptun.bandung?igsh=MWViZmJoc3Z6amQ5cg==" class="social-link" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://youtube.com/@ptun_bandung?si=RDAJ-WZod8NeHA9p" class="social-link" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="contact-map">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.908937408077!2d107.61999157408611!3d-6.901493193097789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7b36810984d%3A0x5dba7e349b2693e7!2sPengadilan%20Tata%20Usaha%20Negara%20Bandung!5e0!3m2!1sid!2sid!4v1753286169036!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>
@endsection
