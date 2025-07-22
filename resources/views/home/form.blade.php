@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('HomeCss/form.css') }}">


@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('HomeCss/form.css') }}">
@endpush

@section('content')
    <div class="container-fluid form-container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-9 col-lg-10">
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
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                    id="nama" name="nama" value="{{ old('nama') }}" required
                                    placeholder="Masukkan nama lengkap">
                                <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Instansi -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('instansi') is-invalid @enderror" 
                                    id="instansi" name="instansi" value="{{ old('instansi') }}" required
                                    placeholder="Masukkan nama instansi">
                                <label for="instansi">Instansi <span class="text-danger">*</span></label>
                                @error('instansi')
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
                                <input type="datetime-local" class="form-control @error('waktu_datang') is-invalid @enderror" 
                                    id="waktu_datang" name="waktu_datang" 
                                    value="{{ old('waktu_datang', now()->format('Y-m-d\TH:i')) }}" required>
                                <label for="waktu_datang">Waktu Datang <span class="text-danger">*</span></label>
                                @error('waktu_datang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Foto Wajah -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">
                                        <i class="fas fa-camera me-2 text-muted"></i>Foto Wajah
                                    </label>
                                    <small class="text-muted">Format: JPG, PNG (Maks. 2MB)</small>
                                </div>

                                <div class="custom-file-wrapper">
                                    <input type="file" class="form-control custom-file-input @error('foto_wajah') is-invalid @enderror"
                                        id="foto_wajah" name="foto_wajah"
                                        accept="image/jpeg,image/png"
                                        onchange="previewImage(this)">
                                    <span class="custom-file-label" id="file-label">Pilih file wajah</span>
                                </div>

                                @error('foto_wajah')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror

                                <div id="imagePreview" class="mt-3 d-none">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body p-2 text-center">
                                            <img src="#" alt="Preview" class="rounded img-fluid" 
                                                style="max-height: 200px; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                            </div>


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
    
    <script>
    /**
     * Inisialisasi smooth scroll untuk anchor links
     */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    /**
     * Preview gambar yang diupload dengan animasi
     * @param {HTMLInputElement} input - Input file element
     */
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
@endsection
