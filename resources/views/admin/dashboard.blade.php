@extends('admin.layout')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
            <h2>Daftar Tamu</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
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
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3"></i>
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

@section('content')
    <div class="dashboard-container">
        <h2 class="dashboard-title">� Daftar Tamu</h2>

        @if(session('success'))
            <div class="success-message">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="tamu-container">
            @forelse($tamus as $tamu)
                <div class="tamu-card">
                    <div class="tamu-content">
                        {{-- Header --}}
                        <div class="tamu-header">
                            <div class="tamu-info">
                                <div>
                                    <span class="tamu-date">{{ $tamu->waktu_datang->format('d M Y • H:i') }}</span>
                                    <h3 class="tamu-name">{{ $tamu->nama }}</h3>
                                    <p class="tamu-institution">{{ $tamu->instansi }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Tamu --}}
                        <div class="tamu-details">
                            <div class="detail-item">
                                <span class="detail-label">📞 No. Telepon:</span>
                                <span class="detail-value">{{ $tamu->no_telepon ?? '-' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">� Keperluan:</span>
                                <p class="detail-value">{{ $tamu->keperluan }}</p>
                            </div>
                        </div>

                        {{-- Foto Wajah --}}
                        @if($tamu->foto_wajah)
                            <div class="image-container">
                                <div class="image-wrapper">
                                    <div class="image-frame">
                                        <img src="{{ asset('storage/' . $tamu->foto_wajah) }}"
                                             alt="Foto Tamu"
                                             class="tamu-image"
                                             onclick="openImageViewer(this.src)"
                                             loading="lazy"
                                             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%23999999\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3E%3Cline x1=\'18\' y1=\'6\' x2=\'6\' y2=\'18\'%3E%3C/line%3E%3Cline x1=\'6\' y1=\'6\' x2=\'18\' y2=\'18\'%3E%3C/line%3E%3C/svg%3E'; this.classList.add('p-8');">
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Info Grid --}}
                        <div class="info-grid">
                            <div class="info-card">
                                <span class="info-label">👤 Nama Pelaku</span>
                                <div class="info-value">{{ in_array($report->nama_pelaku, ["Tidak Diketahui", "tidak diketahui"]) ? "❓ Tidak Diketahui" : $report->nama_pelaku }}</div>
                            </div>
                            <div class="info-card">
                                <span class="info-label">🏫 Kelas</span>
                                <div class="info-value">{{ in_array($report->kelas_pelaku, ["Tidak Diketahui", "tidak diketahui"]) ? "❓ Tidak Diketahui" : $report->kelas_pelaku }}</div>
                            </div>
                            <div class="info-card">
                                <span class="info-label">🎓 Jurusan</span>
                                <div class="info-value">{{ in_array($report->jurusan_pelaku, ["Tidak Diketahui", "tidak diketahui"]) ? "❓ Tidak Diketahui" : $report->jurusan_pelaku }}</div>
                            </div>
                            <div class="info-card">
                                <span class="info-label">🎭 Peran</span>
                                <div class="info-value">{{ ucfirst($report->peran) }}</div>
                            </div>
                        </div>

                        {{-- Reporter Info --}}
                        <div class="reporter-section">
                            <h4 class="reporter-title">🕵️ Identitas Pelapor</h4>

                            @if($report->is_anonymous)
                                <p class="anonymous-info">🔒 Laporan Anonim</p>
                            @else
                                <div class="reporter-info">
                                    @if($report->reporter_name || $report->reporter_class || $report->reporter_major)
                                        <div class="reporter-grid">
                                            @if($report->reporter_name)
                                                <div class="reporter-field">
                                                    <span class="reporter-label">Nama</span>
                                                    <span class="reporter-value">{{ $report->reporter_name }}</span>
                                                </div>
                                            @endif
                                            @if($report->reporter_class)
                                                <div class="reporter-field">
                                                    <span class="reporter-label">Kelas</span>
                                                    <span class="reporter-value">{{ $report->reporter_class }}</span>
                                                </div>
                                            @endif
                                            @if($report->reporter_major)
                                                <div class="reporter-field">
                                                    <span class="reporter-label">Jurusan</span>
                                                    <span class="reporter-value">{{ $report->reporter_major }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <svg class="empty-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <p class="empty-text">Belum ada tamu yang tercatat</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Image Viewer Modal --}}
    <div id="imageViewer" class="image-viewer">
        <span class="close-button" onclick="closeImageViewer()">&times;</span>
        <img id="expandedImage" src="" alt="Expanded image">
    </div>

    <script>
        function openImageViewer(imgSrc) {
            document.getElementById("imageViewer").style.display = "flex";
            document.getElementById("expandedImage").src = imgSrc;
        }

        function closeImageViewer() {
            document.getElementById("imageViewer").style.display = "none";
        }
    </script>
@endsection
