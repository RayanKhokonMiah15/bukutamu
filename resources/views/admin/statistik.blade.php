@extends('admin.layout')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 fw-bold text-primary"><i class="fas fa-chart-bar me-2"></i>Statistik Tamu</h2>
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card shadow border-0 text-center h-100 bg-light">
                    <div class="card-body py-4">
                        <div class="mb-2"><i class="fas fa-users fa-2x text-primary"></i></div>
                        <h6 class="card-title text-uppercase">Total Tamu</h6>
                        <p class="display-5 fw-bold mb-0">{{ $totalTamu }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0 text-center h-100 bg-success bg-opacity-10">
                    <div class="card-body py-4">
                        <div class="mb-2"><i class="fas fa-user-check fa-2x text-success"></i></div>
                        <h6 class="card-title text-uppercase">Tamu Diterima</h6>
                        <p class="display-5 fw-bold mb-0">{{ $totalAccept }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0 text-center h-100 bg-danger bg-opacity-10">
                    <div class="card-body py-4">
                        <div class="mb-2"><i class="fas fa-user-times fa-2x text-danger"></i></div>
                        <h6 class="card-title text-uppercase">Tamu Ditolak</h6>
                        <p class="display-5 fw-bold mb-0">{{ $totalReject }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow border-0 text-center h-100 bg-info bg-opacity-10">
                    <div class="card-body py-4">
                        <div class="mb-2"><i class="fas fa-calendar-day fa-2x text-info"></i></div>
                        <h6 class="card-title text-uppercase">Tamu Hari Ini</h6>
                        <p class="display-5 fw-bold mb-0">{{ $totalToday }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow border-0 text-center h-100 bg-warning bg-opacity-10">
                    <div class="card-body py-4">
                        <form method="GET" class="mb-3">
                            <div class="row g-2 align-items-end justify-content-center">
                                <div class="col-auto">
                                    <label for="bulan" class="form-label mb-0">Bulan</label>
                                    <select name="bulan" id="bulan" class="form-select">
                                        @for($m = 1; $m <= 12; $m++)
                                            <option value="{{ sprintf('%02d', $m) }}" {{ $selectedMonth == sprintf('%02d', $m) ? 'selected' : '' }}>{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <label for="tahun" class="form-label mb-0">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-select">
                                        @for($y = now()->year; $y >= now()->year - 5; $y--)
                                            <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-warning text-white fw-bold">Tampilkan</button>
                                </div>
                            </div>
                        </form>
                        <div class="mb-2"><i class="fas fa-calendar-alt fa-2x text-warning"></i></div>
                        <h6 class="card-title text-uppercase mb-3">Tamu Bulan Ini</h6>
                        <p class="display-5 fw-bold mb-0">{{ $totalMonth }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
