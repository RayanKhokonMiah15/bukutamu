@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('HomeCss/form.css') }}">


@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('HomeCss/form.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Animasi untuk overlay setelah submit */
        .success-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Animasi untuk alert sukses */
        .swal2-popup {
            padding: 2em !important;
            border-radius: 20px !important;
            background: linear-gradient(145deg, #ffffff, #f0f0f0) !important;
            box-shadow: 0 25px 50px -12px rgba(0, 141, 0, 0.25) !important;
        }

        .swal2-title {
            font-size: 2em !important;
            background: linear-gradient(45deg, #008D00, #00b82e) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            font-weight: 700 !important;
            padding: 0.5em 0 !important;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)) !important;
        }

        .success-message {
            position: relative;
            background: #f0fff4;
            border: 2px solid #008D00;
            border-radius: 15px;
            padding: 2em;
            margin: 1em 0;
            overflow: hidden;
            transform: translateZ(0);
        }

        .success-message::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #008D00, #00b82e, #008D00);
            animation: loading 2s linear infinite;
        }

        @keyframes loading {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .countdown {
            margin-top: 1em;
            padding: 0.5em;
            background: rgba(0, 141, 0, 0.1);
            border-radius: 8px;
            font-weight: 500;
        }

        /* Animasi fade out custom */
        @keyframes customFadeOut {
            0% { 
                opacity: 1;
                transform: scale(1) translateY(0);
            }
            100% { 
                opacity: 0;
                transform: scale(0.95) translateY(-20px);
            }
        }

        .fade-out-custom {
            animation: customFadeOut 0.8s ease forwards;
        }
    </style>
@endpush

@section('content')
    <!-- Intro Overlay -->
    @if(!session('success'))
    <div class="intro-overlay">
        <div class="intro-content">
            <div class="intro-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <h1 class="intro-title">Selamat Datang</h1>
            <p class="intro-text">di Sistem Buku Tamu Digital PTUN Bandung</p>
            <button class="intro-button">
                <span>Mulai Mengisi</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
    @endif

    <div class="container-fluid form-container {{ !session('success') ? 'hidden-form' : 'visible' }}">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-9 col-lg-10">


                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">Form Buku Tamu</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('tamu.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Nama -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                    id="nama" name="nama" value="{{ old('nama') }}" required
                                    placeholder="Masukkan nama lengkap">
                                <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                                    id="alamat" name="alamat" value="{{ old('alamat') }}" required
                                    placeholder="Masukkan alamat lengkap">
                                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- No Telepon -->
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control @error('no_telepon') is-invalid @enderror" 
                                    id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                                    placeholder="Masukkan nomor telepon">
                                <label for="no_telepon">Nomor Telepon</label>
                                @error('no_telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Keperluan -->
                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('keperluan') is-invalid @enderror" 
                                    id="keperluan" name="keperluan" style="height: 100px" required
                                    placeholder="Masukkan keperluan">{{ old('keperluan') }}</textarea>
                                <label for="keperluan">Keperluan <span class="text-danger">*</span></label>
                                @error('keperluan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Waktu Datang -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('waktu_datang') is-invalid @enderror" 
                                    id="waktu_datang" name="waktu_datang" 
                                    value="{{ old('waktu_datang', now()->format('Y-m-d')) }}" required readonly>
                                <label for="waktu_datang">Waktu Datang <span class="text-danger">*</span></label>
                                @error('waktu_datang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Foto Wajah Live -->
                            <div class="mb-4">
                                <div class="text-center mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-camera me-2 text-muted"></i>Foto Wajah (Live)
                                    </label>
                                    <div class="text-muted small">Ambil foto langsung dari kamera</div>
                                </div>
                                <div class="camera-controls">
                                    <button type="button" class="btn btn-primary" id="startCameraBtn">
                                        <i class="fas fa-video"></i> Aktifkan Kamera
                                    </button>
                                </div>
                                <div class="text-center mb-2">
                                    <div class="d-flex justify-content-end mb-2" style="max-width: 320px; margin: 0 auto;">
                                        <button type="button" class="btn btn-warning btn-sm" id="closeCameraBtn" style="display:none;">
                                            <i class="fas fa-times"></i> Tutup Kamera
                                        </button>
                                    </div>
                                    <video id="video" width="320" height="240" playsinline style="border-radius: 8px; background: #eee; display:none; transform: scaleX(-1);"></video>
                                    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                                </div>
                                <div class="d-flex justify-content-center mb-2">
                                    <button type="button" class="btn btn-success" id="captureBtn" style="display:none;">
                                        <i class="fas fa-camera"></i> Ambil Foto
                                    </button>
                                </div>
                                <div id="photoPreview" class="mt-3 d-none text-center">
                                    <img id="photoResult" src="#" alt="Preview" class="rounded img-fluid" style="max-height: 200px; object-fit: contain;">
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-danger btn-sm" id="deletePhotoBtn">
                                            <i class="fas fa-trash"></i> Hapus Foto
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="foto_wajah" id="foto_wajah_hidden">
                                @error('foto_wajah')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div


                            <!-- Tombol Submit -->
                            <div class="row g-3">
                                <div class="col-6">
                                    <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 py-3">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary w-100 py-3">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript Dependencies --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <script>
    // Intro Animation Handler
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.querySelector('.intro-overlay');
        const form = document.querySelector('.form-container');
        const introButton = document.querySelector('.intro-button');

        // Hanya jalankan jika overlay ada (tidak dalam kondisi success)
        if (overlay && introButton) {
            introButton.addEventListener('click', function() {
                overlay.classList.add('fade-out');
                form.classList.add('visible');
                form.classList.remove('hidden-form');
                
                setTimeout(() => {
                    overlay.style.display = 'none';
                }, 500);
            });
        }
    });

    // Inisialisasi smooth scroll untuk anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });


    // SweetAlert sukses setelah submit
    @if(session('success'))
    let timerInterval;
    Swal.fire({
        title: '🌟 Pengisian Sukses! 🌟',
        html: `
            <div class="success-message">
                <div style="transform: scale(1.2); margin-bottom: 20px;">
                    <i class="fas fa-check-circle fa-bounce" style="color: #008D00; font-size: 4em;"></i>
                </div>
                <div style="margin-bottom: 15px;">
                    <h3 style="color: #008D00; font-size: 1.4em; margin-bottom: 10px; font-weight: 600;">
                        Data Berhasil Disimpan!
                    </h3>
                    <p style="color: #2f855a; font-size: 1.1em;">
                        Terima kasih atas kunjungan Anda di PTUN Bandung
                    </p>
                </div>
                <div class="countdown">
                    <i class="fas fa-clock-rotate-left"></i> 
                    Mengarahkan ke halaman about dalam <b style="color: #008D00"></b>
                </div>
            </div>
        `,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
            
            // Update countdown timer
            const b = toast.querySelector('b');
            timerInterval = setInterval(() => {
                b.textContent = Math.ceil(Swal.getTimerLeft() / 1000) + ' detik';
            }, 100);

            // Confetti effect
            const duration = 3000;
            const animationEnd = Date.now() + duration;
            const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

            const randomInRange = (min, max) => Math.random() * (max - min) + min;

            const interval = setInterval(function() {
                const timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }

                const particleCount = 50;

                // Confetti from multiple directions
                confetti(Object.assign({}, defaults, { 
                    particleCount,
                    origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 },
                    colors: ['#008D00', '#00b82e', '#4CAF50', '#8BC34A']
                }));
                confetti(Object.assign({}, defaults, { 
                    particleCount,
                    origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 },
                    colors: ['#008D00', '#00b82e', '#4CAF50', '#8BC34A']
                }));
            }, 250);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    }).then(function() {
        // Custom fade out animation
        const fadeOut = document.createElement('style');
        fadeOut.textContent = `
            @keyframes customFadeOut {
                from { opacity: 1; transform: scale(1); }
                to { opacity: 0; transform: scale(0.95); }
            }
            body {
                animation: customFadeOut 0.8s ease forwards !important;
            }
        `;
        document.head.appendChild(fadeOut);
        
        setTimeout(() => {
            window.location.href = '{{ route('about') }}';
        }, 800);
    });
    @endif

    // Inisialisasi Flatpickr untuk input tanggal
    flatpickr("#waktu_datang", {
        dateFormat: "Y-m-d",
        allowInput: true,
        disableMobile: true,
        locale: "id"
    });

    // Live Camera untuk Foto Wajah
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureBtn = document.getElementById('captureBtn');
    const startCameraBtn = document.getElementById('startCameraBtn');
    const photoPreview = document.getElementById('photoPreview');
    const photoResult = document.getElementById('photoResult');
    const fotoWajahHidden = document.getElementById('foto_wajah_hidden');
    const closeCameraBtn = document.getElementById('closeCameraBtn');
    let cameraStream = null;

    // Aktifkan kamera saat tombol diklik
    startCameraBtn.addEventListener('click', function() {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(stream) {
                    cameraStream = stream;
                    video.srcObject = stream;
                    video.style.display = 'block';
                    captureBtn.style.display = 'inline-block';
                    closeCameraBtn.style.display = 'inline-block';
                    startCameraBtn.style.display = 'none';
                    video.play();
                })
                .catch(function(err) {
                    alert('Tidak dapat mengakses kamera: ' + err.message);
                });
        } else {
            alert('Browser tidak mendukung akses kamera.');
        }
    });

    // Ambil foto dari video
    captureBtn.addEventListener('click', function() {
        const ctx = canvas.getContext('2d');
        // Reset transform
        ctx.setTransform(1, 0, 0, 1, 0, 0);
        // Flip horizontal agar tidak mirror
        ctx.translate(canvas.width, 0);
        ctx.scale(-1, 1);
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        // Kembalikan transform agar canvas siap untuk pengambilan berikutnya
        ctx.setTransform(1, 0, 0, 1, 0, 0);
        const dataUrl = canvas.toDataURL('image/png');
        photoResult.src = dataUrl;
        photoPreview.classList.remove('d-none');
        fotoWajahHidden.value = dataUrl;
        // Matikan kamera setelah ambil foto
        if (cameraStream) {
            cameraStream.getTracks().forEach(track => track.stop());
            video.style.display = 'none';
            captureBtn.style.display = 'none';
            closeCameraBtn.style.display = 'none';
            startCameraBtn.style.display = 'inline-block';
        }
    });

    // Tutup kamera tanpa ambil foto
    closeCameraBtn.addEventListener('click', function() {
        if (cameraStream) {
            cameraStream.getTracks().forEach(track => track.stop());
            cameraStream = null;
        }
        video.style.display = 'none';
        captureBtn.style.display = 'none';
        closeCameraBtn.style.display = 'none';
        startCameraBtn.style.display = 'inline-block';
    });

    // Hapus foto dan reset ke awal
    document.getElementById('deletePhotoBtn').addEventListener('click', function() {
        photoResult.src = '#';
        photoPreview.classList.add('d-none');
        fotoWajahHidden.value = '';
        // Tampilkan tombol kamera lagi
        startCameraBtn.style.display = 'inline-block';
    });
    </script>
@endsection
