@extends('admin.layout')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>📋 Daftar Tamu</h2>
            <div class="export-section">
                <form action="{{ route('admin.buku-tamu.export-pdf') }}" method="GET" class="d-flex align-items-center">
                    <select name="bulan" class="form-control mr-2" style="width: 100px;">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" 
                                {{ date('m') == $i ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                            </option>
                        @endfor
                    </select>
                    <select name="tahun" class="form-control mr-2" style="width: 100px;">
                        @for($i = date('Y'); $i >= date('Y')-5; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Keperluan</th>
                                <th>Waktu Datang</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tamus as $tamu)
                                <tr>
                                    <td>{{ $tamu->nama }}</td>
                                    <td>{{ $tamu->alamat }}</td>
                                    <td>{{ $tamu->no_telepon ?? '-' }}</td>
                                    <td>{{ $tamu->keperluan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($tamu->waktu_datang)->format('d M Y') }}</td>
                                    <td>
                                        @if($tamu->foto_wajah)
                                            <img src="{{ asset('storage/' . $tamu->foto_wajah) }}" 
                                                 alt="Foto {{ $tamu->nama }}" 
                                                 class="img-thumbnail foto-zoom"
                                                 style="height: 50px; width: 50px; object-fit: cover; cursor: pointer;"
                                                 data-src="{{ asset('storage/' . $tamu->foto_wajah) }}">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                        <div class="d-flex flex-wrap gap-1 mt-2">
                                            @if(isset($tamu->status) && $tamu->status === 'pending')
                                                <form action="{{ route('tamu.accept', $tamu->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" title="Accept"><i class="fas fa-check"></i></button>
                                                </form>
                                                <form action="{{ route('tamu.reject', $tamu->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Reject"><i class="fas fa-times"></i></button>
                                                </form>
                                            @else
                                                <form action="{{ route('tamu.accept', $tamu->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" title="Accept"><i class="fas fa-check"></i></button>
                                                </form>
                                                @if(!isset($tamu->status) || $tamu->status === null)
                                                <form action="{{ route('tamu.pending', $tamu->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning" title="Pending"><i class="fas fa-hourglass-half"></i></button>
                                                </form>
                                                @endif
                                                <form action="{{ route('tamu.reject', $tamu->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Reject"><i class="fas fa-times"></i></button>
                                                </form>
                                            @endif
                                            <!-- Fitur hapus data di-nonaktifkan pada dashboard -->
                                        </div>
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

<!-- Modal Zoom Foto -->
<div class="modal fade" id="zoomFotoModal" tabindex="-1" aria-labelledby="zoomFotoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="zoomFotoLabel">Foto Wajah Tamu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="zoomFotoImg" src="#" alt="Zoom Foto" style="max-width:100%; max-height:70vh; border-radius:10px;">
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.foto-zoom').forEach(function(img) {
    img.addEventListener('click', function() {
        var src = this.getAttribute('data-src');
        var modalImg = document.getElementById('zoomFotoImg');
        modalImg.src = src;
        var modal = new bootstrap.Modal(document.getElementById('zoomFotoModal'));
        modal.show();
    });
});
</script>
@endpush
@endsection
