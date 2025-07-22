@extends('layouts.form-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('HomeCss/form.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
@endsection
