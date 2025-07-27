@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Tamu Bulan {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #f2f2f2; }
        h2 { margin-bottom: 0; }
    </style>
</head>
<body>
    <h2>Data Tamu Bulan {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</h2>
    <table>
        <thead>
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
            @foreach($guestsMonth as $i => $guest)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $guest->nama }}</td>
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
