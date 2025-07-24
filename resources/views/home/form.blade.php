@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('HomeCss/form.css') }}">


@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('HomeCss/form.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="container-fluid form-container">
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
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">
                                        <i class="fas fa-camera me-2 text-muted"></i>Foto Wajah (Live)
                                    </label>
                                    <small class="text-muted">Ambil foto langsung dari kamera</small>
                                </div>
                                <div class="d-flex justify-content-center mb-2">
                                    <button type="button" class="btn btn-primary" id="startCameraBtn">
                                        <i class="fas fa-video"></i> Aktifkan Kamera
                                    </button>
                                </div>
                                <div class="text-center mb-2 position-relative">
                                    <video id="video" width="320" height="240" playsinline style="border-radius: 8px; background: #eee; display:none; transform: scaleX(-1);"></video>
                                    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                                    <button type="button" class="btn btn-warning btn-sm mt-2" id="closeCameraBtn" style="display:none; position: absolute; right: 0; top: 0;">Tutup Kamera</button>
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
    
    <script>
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
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonText: 'OK',
        timer: 2500
    }).then(function() {
        window.location.href = '{{ route('home') }}';
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
