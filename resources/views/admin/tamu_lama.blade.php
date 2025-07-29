@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Data Tamu Lebih dari 1 Tahun</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($tamus->isEmpty())
        <div class="alert alert-info">Tidak ada data tamu yang lebih dari 1 tahun.</div>
    @else
        <div class="mb-3">
            <form action="{{ route('admin.reset.tamu') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua data tamu yang lebih dari 1 tahun?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus Semua Data Tamu Lama</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Keperluan</th>
                        <th>Waktu Datang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tamus as $tamu)
                        <tr>
                            <td>{{ $tamu->nama }}</td>
                            <td>{{ $tamu->email }}</td>
                            <td>{{ $tamu->no_hp }}</td>
                            <td>{{ $tamu->keperluan }}</td>
                            <td>{{ \Carbon\Carbon::parse($tamu->waktu_datang)->translatedFormat('d F Y') }}</td>
                            <td>
                                @if ($tamu->status === 'accept')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif ($tamu->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($tamu->status === 'reject')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">Belum Diproses</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
