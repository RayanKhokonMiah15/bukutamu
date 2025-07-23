@extends('admin.layout')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">📋 Daftar Tamu</h2>

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
                                        <form action="{{ route('tamu.destroy', $tamu->id) }}" method="POST" style="display:inline-block; margin-top:5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data tamu ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
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
