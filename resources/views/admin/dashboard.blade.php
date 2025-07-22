@extends('admin.layout')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">📋 Daftar Tamu</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Waktu</th>
                                <th>Nama</th>
                                <th>Instansi</th>
                                <th>No. Telepon</th>
                                <th>Keperluan</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tamus as $tamu)
                                <tr>
                                    <td>{{ $tamu->waktu_datang->format('d M Y H:i') }}</td>
                                    <td>{{ $tamu->nama }}</td>
                                    <td>{{ $tamu->instansi }}</td>
                                    <td>{{ $tamu->no_telepon ?? '-' }}</td>
                                    <td>{{ $tamu->keperluan }}</td>
                                    <td>
                                        @if($tamu->foto_wajah)
                                            <img src="{{ asset('storage/' . $tamu->foto_wajah) }}" 
                                                 alt="Foto {{ $tamu->nama }}" 
                                                 class="img-thumbnail"
                                                 style="height: 50px; width: 50px; object-fit: cover;"
                                                 onclick="window.open(this.src)">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <p class="mb-0">Belum ada tamu yang tercatat</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
