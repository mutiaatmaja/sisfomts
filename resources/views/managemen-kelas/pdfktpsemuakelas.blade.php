<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Daftar Siswa Semua Kelas</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        h2 {
            margin-bottom: 5px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <h1>DAFTAR SISWA SEMUA KELAS</h1>
    @foreach ($semuaKelas as $loopKelas => $kelas)
        @if ($loopKelas > 0)
            <div style="page-break-before: always;"></div>
        @endif
        <h2>Kelas: {{ $kelas->nama_kelas }}</h2>
        <p>Wali Kelas: {{ $kelas->wali_kelas->user->name ?? '-' }}</p>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas->peserta_didiks as $i => $siswa)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $siswa->user->name ?? '-' }}</td>
                        <td>{{ $siswa->nis }}</td>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ $siswa->user->jenis_kelamin ?? '-' }}</td>
                        <td>{{ isset($siswa->user->tempat_lahir) ? ucwords(strtolower($siswa->user->tempat_lahir)) : '-' }}
                        </td>
                        <td>
                            @if (!empty($siswa->user->tanggal_lahir))
                                {{ \Carbon\Carbon::parse($siswa->user->tanggal_lahir)->translatedFormat('d F Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($siswa->user->foto)
                                <img src="{{ public_path('storage/' . $siswa->user->foto) }}" alt="Foto"
                                    width="100">
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>

</html>
