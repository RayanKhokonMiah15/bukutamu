<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku Tamu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            color: #333;
        }
        .form-container {
            margin-top: 2rem;
            margin-bottom: 2rem;
            position: relative;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.03);
            background: white;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background-color: #000;
            padding: 1.5rem 2rem;
            border: none;
        }
        .card-header h5 {
            font-weight: 500;
            font-size: 1.25rem;
            color: #fff;
            margin: 0;
            position: relative;
            display: inline-block;
        }
        .card-header h5:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 2px;
            background: #fff;
        }
        .card-body {
            padding: 2rem;
            background-color: white;
        }
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        .form-label {
            font-weight: 500;
            color: #000;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            display: inline-block;
        }
        .form-control {
            border: none;
            border-bottom: 1px solid #e0e0e0;
            border-radius: 0;
            padding: 0.75rem 0;
            font-size: 1rem;
            background: transparent;
            transition: all 0.3s;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #000;
            background: rgba(0, 0, 0, 0.01);
        }
        .form-control::placeholder {
            color: #ccc;
            font-size: 0.9rem;
        }
        textarea.form-control {
            border: 1px solid #e0e0e0;
            padding: 0.75rem;
            min-height: 120px;
        }
        .btn {
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 50px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn:after {
            content: '';
            position: absolute;
            width: 0%;
            height: 100%;
            top: 0;
            left: -40px;
            transform: skew(45deg);
            background-color: rgba(255,255,255,0.2);
            transition: all 0.5s;
        }
        .btn:hover:after {
            width: 140%;
        }
        .btn-primary {
            background-color: #000;
            border: 1px solid #000;
            color: white;
        }
        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
            color: white;
            transform: translateY(-2px);
        }
        .btn-secondary {
            background-color: transparent;
            border: 1px solid #000;
            color: #000;
        }
        .btn-secondary:hover {
            background-color: #000;
            color: white;
            transform: translateY(-2px);
        }
        .alert {
            border: none;
            border-radius: 8px;
            padding: 1rem 1.5rem;
        }
        .alert-success {
            background-color: rgba(0, 0, 0, 0.05);
            color: #000;
        }
        .invalid-feedback {
            font-size: 0.8rem;
            color: #dc3545;
            margin-top: 0.25rem;
        }
        #imagePreview {
            transition: all 0.3s ease;
        }
        #imagePreview img {
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        #imagePreview img:hover {
            transform: scale(1.02);
        }
        .form-floating {
            position: relative;
        }
        .text-danger {
            font-size: 0.8rem;
            font-weight: 500;
        }
        /* Custom file input */
        .form-control[type="file"] {
            border: 1px solid #e0e0e0;
            padding: 0.5rem;
            border-radius: 8px;
        }
        /* Custom datetime input */
        input[type="datetime-local"] {
            border: 1px solid #e0e0e0;
            padding: 0.5rem;
            border-radius: 8px;
        }
        /* Animasi loading untuk submit */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }
        .btn-loading:after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: button-loading-spinner 0.8s linear infinite;
        }
        @keyframes button-loading-spinner {
            from {
                transform: rotate(0turn);
            }
            to {
                transform: rotate(1turn);
            }
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">Form Buku Tamu</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tamu.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                    id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Instansi -->
                            <div class="mb-3">
                                <label for="instansi" class="form-label">Instansi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('instansi') is-invalid @enderror" 
                                    id="instansi" name="instansi" value="{{ old('instansi') }}" required>
                                @error('instansi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- No Telepon -->
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control @error('no_telepon') is-invalid @enderror" 
                                    id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                                    placeholder="Contoh: 081234567890">
                                @error('no_telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Keperluan -->
                            <div class="mb-3">
                                <label for="keperluan" class="form-label">Keperluan <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('keperluan') is-invalid @enderror" 
                                    id="keperluan" name="keperluan" rows="3" required>{{ old('keperluan') }}</textarea>
                                @error('keperluan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Waktu Datang -->
                            <div class="mb-3">
                                <label for="waktu_datang" class="form-label">Waktu Datang <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('waktu_datang') is-invalid @enderror" 
                                    id="waktu_datang" name="waktu_datang" 
                                    value="{{ old('waktu_datang', now()->format('Y-m-d\TH:i')) }}" required>
                                @error('waktu_datang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Foto Wajah -->
                            <div class="mb-4">
                                <label for="foto_wajah" class="form-label">Foto Wajah</label>
                                <input type="file" class="form-control @error('foto_wajah') is-invalid @enderror" 
                                    id="foto_wajah" name="foto_wajah" accept="image/*"
                                    onchange="previewImage(this)">
                                @error('foto_wajah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="imagePreview" class="mt-2 d-none">
                                    <img src="#" alt="Preview" class="img-thumbnail" style="max-height: 200px">
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('home') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
    // Animasi smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Preview gambar dengan animasi
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const image = preview.querySelector('img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                image.src = e.target.result;
                preview.classList.remove('d-none');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            image.src = '#';
            preview.classList.add('d-none');
        }
    }
    </script>
</body>
</html>
