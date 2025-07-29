@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Tamu Bulan {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</title>
    <style>
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 11px;
            margin: 0;
            padding: 20px;
            background: #ffffff;
            color: #2d3748;
            line-height: 1.4;
        }
        .header-section {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
        }
        .logo {
            width: 70px;
            height: auto;
            margin-bottom: 10px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            color: #1a365d;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .subtitle {
            font-size: 14px;
            color: #4a5568;
            margin: 5px 0;
        }
        .period {
            display: inline-block;
            background: #edf2f7;
            padding: 5px 15px;
            border-radius: 15px;
            color: #2d3748;
            font-size: 11px;
            margin-top: 10px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        th { 
            background: #2d3748;
            color: white;
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
            padding: 12px 8px;
            text-align: center;
            letter-spacing: 0.5px;
        }
        td { 
            padding: 10px 8px;
            border-bottom: 1px solid #e2e8f0;
            color: #4a5568;
            font-size: 10px;
        }
        tr:nth-child(even) {
            background: #f8fafc;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .text-center {
            text-align: center;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: 600;
        }
        .status-accepted {
            background: #c6f6d5;
            color: #276749;
        }
        .status-pending {
            background: #feebc8;
            color: #c05621;
        }
        .status-rejected {
            background: #fed7d7;
            color: #c53030;
        }
        .status-unprocessed {
            background: #e2e8f0;
            color: #4a5568;
        }
        .foto-tamu {
            width: 50px;
            height: 50px;
            display: block;
            margin: 0 auto;
            border: 1px solid #ddd;
            object-fit: cover;
            border-radius: 4px;
            background-color: #fff;
        }
        .text-center {
            text-align: center;
        }
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }
        .status-diterima { color: #0a6640; }
        .status-pending { color: #947600; }
        .status-ditolak { color: #c41e3a; }
        .status-belum { color: #666; }
    </style>
</head>
<body>
    <div class="header-section">
        <img src="{{ public_path('ImageHome/logoptun-removebg-preview.png') }}" alt="Logo PTUN" class="logo">
        <div class="title">Pengadilan Tata Usaha Negara Bandung</div>
        <div class="subtitle">Buku Tamu Digital</div>
        <div class="period">
            Periode: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Nama</th>
                <th style="width: 8%;">Foto</th>
                <th style="width: 22%;">Alamat</th>
                <th style="width: 12%;">No. Telepon</th>
                <th style="width: 20%;">Keperluan</th>
                <th style="width: 10%;">Tanggal</th>
                <th style="width: 8%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guestsMonth as $i => $guest)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $guest->nama }}</td>
                    <td class="text-center">
                        @if(isset($guest->foto_base64))
                            <img src="{{ $guest->foto_base64 }}" 
                                 alt="Foto {{ $guest->nama }}" 
                                 class="foto-tamu">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $guest->alamat }}</td>
                    <td class="text-center">{{ $guest->no_telepon ?: '-' }}</td>
                    <td>{{ $guest->keperluan }}</td>
                    <td class="text-center" style="color: #4a5568;">
                        {{ $guest->waktu_datang ? Carbon::parse($guest->waktu_datang)->format('d/m/Y') : '-' }}
                    </td>
                    <td class="text-center">
                        @if($guest->status === 'accept')
                            <span class="status-badge status-accepted">Diterima</span>
                        @elseif($guest->status === 'pending')
                            <span class="status-badge status-pending">Pending</span>
                        @elseif($guest->status === 'reject')
                            <span class="status-badge status-rejected">Ditolak</span>
                        @else
                            <span class="status-badge status-unprocessed">Belum Diproses</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
