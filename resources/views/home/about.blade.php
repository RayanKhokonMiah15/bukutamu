@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('HomeCss/about.css') }}">

@push('styles')
<style>

</style>
@endpush

@section('content')
<div class="about-container">
    <div class="container">
        <div class="about-header">
            <h1 class="about-title">Tentang PTUN Bandung</h1>
        </div>
        
        <div class="about-content">
            <div class="section">
                <h2 class="section-title">
                    <i class="fas fa-balance-scale"></i>
                    Apa itu PTUN?
                </h2>
                <div class="section-content">
                    <p>
                        Pengadilan Tata Usaha Negara (PTUN) Bandung adalah lembaga peradilan di Indonesia yang memiliki 
                        wewenang untuk memeriksa, memutus, dan menyelesaikan sengketa Tata Usaha Negara. PTUN merupakan 
                        salah satu pelaksana kekuasaan kehakiman bagi rakyat pencari keadilan terhadap sengketa Tata 
                        Usaha Negara.
                    </p>
                </div>
            </div>

            <div class="key-points">
                <h3 class="section-title">
                    <i class="fas fa-gavel"></i>
                    Tugas dan Wewenang PTUN
                </h3>
                <ul>
                    <li>Memeriksa, memutus, dan menyelesaikan sengketa Tata Usaha Negara</li>
                    <li>Mengadili perkara berkaitan dengan Keputusan Tata Usaha Negara (KTUN)</li>
                    <li>Memberikan perlindungan hukum bagi masyarakat dari tindakan pemerintah</li>
                    <li>Memastikan pelaksanaan pemerintahan sesuai dengan hukum yang berlaku</li>
                </ul>
            </div>

            <div class="section">
                <h2 class="section-title">
                    <i class="fas fa-landmark"></i>
                    Fungsi dan Peran
                </h2>
                <div class="section-content">
                    <p>
                        PTUN Bandung berfungsi sebagai pilar penting dalam sistem peradilan Indonesia, khususnya dalam 
                        ranah hukum administrasi negara. Pengadilan ini berperan vital dalam:
                    </p>
                    <div class="key-points">
                        <ul>
                            <li>Memberikan perlindungan hukum kepada warga negara</li>
                            <li>Menjamin penyelenggaraan pemerintahan yang bersih dan berwibawa</li>
                            <li>Menegakkan keadilan dalam hubungan antara pemerintah dan masyarakat</li>
                            <li>Mengawasi tindakan hukum pejabat atau badan Tata Usaha Negara</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">
                    <i class="fas fa-users"></i>
                    Pelayanan Masyarakat
                </h2>
                <div class="section-content">
                    <p>
                        PTUN Bandung berkomitmen untuk memberikan pelayanan prima kepada masyarakat dengan mengedepankan 
                        prinsip peradilan yang cepat, sederhana, dan biaya ringan. Kami terus berupaya meningkatkan 
                        kualitas pelayanan melalui modernisasi sistem administrasi dan peningkatan profesionalisme 
                        aparatur pengadilan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
