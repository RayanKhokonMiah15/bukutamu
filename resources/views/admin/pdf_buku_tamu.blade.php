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
            font-family: Arial, sans-serif; 
            font-size: 12px;
            margin: 20px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
        }
        th, td { 
            border: 1px solid #333; 
            padding: 8px; 
            text-align: left;
            vertical-align: middle;
        }
        th { 
            background: #f2f2f2;
            font-weight: bold;
        }
        h2 { 
            margin-bottom: 20px;
            color: #333;
            text-align: center;
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
    <h2>Data Tamu Bulan {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th style="width: 15%;">Nama</th>
                <th class="text-center" style="width: 10%;">Foto</th>
                <th style="width: 20%;">Alamat</th>
                <th style="width: 12%;">No. Telepon</th>
                <th style="width: 20%;">Keperluan</th>
                <th style="width: 10%;">Waktu Datang</th>
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
                    <td>{{ $guest->no_telepon }}</td>
                    <td>{{ $guest->keperluan }}</td>
                    <td>{{ $guest->waktu_datang ? Carbon::parse($guest->waktu_datang)->format('d-m-Y') : '-' }}</td>
                    <td>
                        @if($guest->status === 'accept')
                            Diterima
                        @elseif($guest->status === 'pending')
                            Pending
                        @elseif($guest->status === 'reject')
                            Ditolak
                        @else
                            Belum Diproses
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
