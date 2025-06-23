<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap KTP {{ $kelas->nama_kelas }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; }
        table { border-collapse: collapse; width: 100%; margin: 0 auto; }
        th, td { border: 1px solid #333; padding: 5px; text-align: center; }
        th { background: #f2f2f2; }
        img { border-radius: 6px; }
    </style>
</head>
<body>
    <h1>REKAP KTP {{ $kelas->nama_kelas }}</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesertaDidiks as $i => $siswa)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $siswa->user->name ?? '-' }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->user->nik ?? '-' }}</td>
                    <td>{{ $siswa->user->jenis_kelamin ?? '-' }}</td>
                    <td>{{ isset($siswa->user->tempat_lahir) ? ucwords(strtolower($siswa->user->tempat_lahir)) : '-' }}</td>
                    <td>
                        @if(!empty($siswa->user->tanggal_lahir))
                            {{ \Carbon\Carbon::parse($siswa->user->tanggal_lahir)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($siswa->user->foto)
                            <img src="{{ public_path('storage/' . $siswa->user->foto) }}" alt="Foto" width="100">
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
