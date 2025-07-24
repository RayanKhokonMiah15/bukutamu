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
                        @php
                            // Ambil data tamu hari ini yang statusnya masih null (belum diproses)
                            $today = now()->toDateString();
                            $unprocessedTodayList = \App\Models\BukuTamu::whereDate('waktu_datang', $today)->whereNull('status')->get();
                            $unprocessedToday = $unprocessedTodayList->count();
                            // Untuk JSON, gunakan array_map agar tidak error blade
                            $unprocessedTodayArray = $unprocessedTodayList->map(function($t){
                                return [
                                    'nama' => $t->nama,
                                    'alamat' => $t->alamat,
                                    'no_telepon' => $t->no_telepon,
                                    'keperluan' => $t->keperluan
                                ];
                            })->values()->toArray();
                        @endphp
                        @if($unprocessedToday > 0)
                            <div class="alert alert-warning mt-3 mb-0 p-2 small d-flex align-items-center justify-content-center" style="font-size:1rem;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <span><b>{{ $unprocessedToday }}</b> tamu hari ini belum diproses!</span>
                                <button id="btnShowUnprocessed" class="btn btn-sm btn-outline-primary ms-3 py-0 px-2" type="button" style="font-size:0.95rem;">Lihat</button>
                            </div>
                            @push('scripts')
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    if (!window.__reminderShown) {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Pengingat! Ada tamu hari ini yang belum diproses',
                                            text: 'Segera proses tamu hari ini agar tidak terlewat.',
                                            confirmButtonText: 'OK',
                                            timer: 6000
                                        });
                                        window.__reminderShown = true;
                                    }
                                    // Data tamu belum diproses hari ini
                                    var unprocessedData = @json($unprocessedTodayArray);
                                    var btn = document.getElementById('btnShowUnprocessed');
                                    if(btn) {
                                        btn.addEventListener('click', function() {
                                            let html = '<div class="table-responsive"><table class="table table-bordered table-sm mb-0"><thead><tr><th>Nama</th><th>Alamat</th><th>No. Telp</th><th>Keperluan</th></tr></thead><tbody>';
                                            if(unprocessedData.length > 0) {
                                                unprocessedData.forEach(function(row) {
                                                    html += '<tr>' + [row.nama, row.alamat, row.no_telepon, row.keperluan].map(function(col){ return '<td>'+col+'</td>'; }).join('') + '</tr>';
                                                });
                                            } else {
                                                html += '<tr><td colspan="4" class="text-center">Tidak ada tamu belum diproses.</td></tr>';
                                            }
                                            html += '</tbody></table></div>';
                                            Swal.fire({
                                                title: 'Tamu Hari Ini Belum Diproses',
                                                html: html,
                                                width: 700,
                                                confirmButtonText: 'Tutup',
                                            });
                                        });
                                    }
                                });
                            </script>
                            @endpush
                        @endif
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

        <!-- Tabel Data Tamu Bulanan -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white fw-bold d-flex justify-content-between align-items-center">
                        <span>Data Tamu Bulan {{ DateTime::createFromFormat('!m', $selectedMonth)->format('F') }} {{ $selectedYear }}</span>
                        <a href="{{ route('admin.buku-tamu.export-pdf', ['bulan' => $selectedMonth, 'tahun' => $selectedYear]) }}" target="_blank" class="btn btn-light btn-sm fw-bold">
                            <i class="fas fa-file-pdf text-danger me-1"></i> Export PDF
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No. Telepon</th>
                                        <th>Keperluan</th>
                                        <th>Waktu Datang</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($guestsMonth as $i => $guest)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $guest->nama }}</td>
                                            <td>{{ $guest->alamat }}</td>
                                            <td>{{ $guest->no_telepon }}</td>
                                            <td>{{ $guest->keperluan }}</td>
                                            <td>{{ $guest->waktu_datang ? \Carbon\Carbon::parse($guest->waktu_datang)->format('d-m-Y H:i') : '-' }}</td>
                                            <td>
                                                @if($guest->status === 'accept')
                                                    <span class="badge bg-success">Diterima</span>
                                                @elseif($guest->status === 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($guest->status === 'reject')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                    <span class="badge bg-secondary">Belum Diproses</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data tamu untuk bulan ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
