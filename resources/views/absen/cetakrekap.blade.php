<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-hadir {
            color: #28a745;
            font-weight: bold;
        }
        .status-sakit {
            color: #ffc107;
            font-weight: bold;
        }
        .status-ijin {
            color: #17a2b8;
            font-weight: bold;
        }
        .status-alpha {
            color: #dc3545;
            font-weight: bold;
        }
        .status-secondary {
            color: #6c757d;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
        }
        @media print {
            body {
                margin: 0;
                font-size: 10px;
            }
            .header h1 {
                font-size: 16px;
            }
            th, td {
                font-size: 9px;
                padding: 4px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>REKAP ABSENSI PESERTA DIDIK</h1>
        <p>Kelas: {{ $kelasName ?? 'Tidak Diketahui' }}</p>
        <p>Periode:
            @if($waktu == 'hari_ini')
                Hari Ini ({{ Carbon\Carbon::today()->isoFormat('dddd, D MMMM Y') }})
            @elseif($waktu == 'kemarin')
                Kemarin ({{ Carbon\Carbon::yesterday()->isoFormat('dddd, D MMMM Y') }})
            @elseif($waktu == 'minggu_ini')
                Minggu Ini ({{ Carbon\Carbon::now()->startOfWeek()->isoFormat('D MMMM Y') }} - {{ Carbon\Carbon::now()->endOfWeek()->isoFormat('D MMMM Y') }})
            @elseif($waktu == 'bulan_ini')
                Bulan Ini ({{ Carbon\Carbon::now()->isoFormat('MMMM Y') }})
            @elseif($waktu == 'custom_date')
                {{ $customDate ? Carbon\Carbon::parse($customDate)->isoFormat('dddd, D MMMM Y') : 'Tanggal Belum Dipilih' }}
            @else
                {{ ucfirst(str_replace('_', ' ', $waktu)) }}
            @endif
        </p>
        <p>Tanggal Cetak: {{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y HH:mm') }}</p>
    </div>

    @if ($waktu == 'hari_ini')
        @if ($seluruhAbsensi)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seluruhAbsensi as $index => $absen)
                        @php
                            $absensi = $absen->pesertaDidik->absensi->first();
                            $status = $absensi->status ?? null;
                            $statusClass = 'status-secondary';
                            if ($status === 'hadir') {
                                $statusClass = 'status-hadir';
                            } elseif ($status === 'alpha') {
                                $statusClass = 'status-alpha';
                            } elseif ($status === 'ijin') {
                                $statusClass = 'status-ijin';
                            } elseif ($status === 'sakit') {
                                $statusClass = 'status-sakit';
                            }
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $absen->pesertaDidik->user->name ?? '' }}</td>
                            <td>{{ $absen->pesertaDidik->nis ?? '' }}</td>
                            <td>{{ $absen->pesertaDidik->nisn ?? '' }}</td>
                            <td>{{ $absen->kelas->nama_kelas }}</td>
                            <td class="{{ $statusClass }}">{{ ucfirst($status ?? '-') }}</td>
                            <td>{{ $absensi?->tanggal ? Carbon\Carbon::parse($absensi->tanggal)->format('H:i') : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @elseif($waktu == 'kemarin')
        @if ($seluruhAbsensi)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seluruhAbsensi as $index => $absen)
                        @php
                            $absensi = $absen->pesertaDidik->absensi->first();
                            $status = $absensi->status ?? null;
                            $statusClass = 'status-secondary';
                            if ($status === 'hadir') {
                                $statusClass = 'status-hadir';
                            } elseif ($status === 'alpha') {
                                $statusClass = 'status-alpha';
                            } elseif ($status === 'ijin') {
                                $statusClass = 'status-ijin';
                            } elseif ($status === 'sakit') {
                                $statusClass = 'status-sakit';
                            }
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $absen->pesertaDidik->user->name ?? '' }}</td>
                            <td>{{ $absen->pesertaDidik->nis ?? '' }}</td>
                            <td>{{ $absen->pesertaDidik->nisn ?? '' }}</td>
                            <td>{{ $absen->kelas->nama_kelas }}</td>
                            <td class="{{ $statusClass }}">{{ ucfirst($status ?? '-') }}</td>
                            <td>
                                @if ($absensi?->tanggal)
                                    {{ Carbon\Carbon::parse($absensi->tanggal)->isoFormat('dddd, D MMMM Y') }}<br>
                                    {{ Carbon\Carbon::parse($absensi->tanggal)->format('H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @elseif($waktu == 'custom_date')
        @if ($seluruhAbsensi)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seluruhAbsensi as $index => $absen)
                        @php
                            $absensi = $absen->pesertaDidik->absensi->first();
                            $status = $absensi->status ?? null;
                            $statusClass = 'status-secondary';
                            if ($status === 'hadir') {
                                $statusClass = 'status-hadir';
                            } elseif ($status === 'alpha') {
                                $statusClass = 'status-alpha';
                            } elseif ($status === 'ijin') {
                                $statusClass = 'status-ijin';
                            } elseif ($status === 'sakit') {
                                $statusClass = 'status-sakit';
                            }
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $absen->pesertaDidik->user->name ?? '' }}</td>
                            <td>{{ $absen->pesertaDidik->nis ?? '' }}</td>
                            <td>{{ $absen->pesertaDidik->nisn ?? '' }}</td>
                            <td>{{ $absen->kelas->nama_kelas }}</td>
                            <td class="{{ $statusClass }}">{{ ucfirst($status ?? '-') }}</td>
                            <td>
                                @if ($absensi?->tanggal)
                                    {{ Carbon\Carbon::parse($absensi->tanggal)->isoFormat('dddd, D MMMM Y') }}<br>
                                    {{ Carbon\Carbon::parse($absensi->tanggal)->format('H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @else
        @if ($seluruhAbsensi)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Hadir</th>
                        <th>Sakit</th>
                        <th>Ijin</th>
                        <th>Alpa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seluruhAbsensi as $index => $absen)
                        @php
                            $absensi = $absen->pesertaDidik->absensi;
                            $hadir = $absensi->where('status', 'hadir')->count();
                            $ijin = $absensi->where('status', 'ijin')->count();
                            $sakit = $absensi->where('status', 'sakit')->count();
                            $alpa = $absensi->where('status', 'alpha')->count();
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $absen->pesertaDidik->user->name ?? '' }}</td>
                            <td>{{ $absen->pesertaDidik->nis ?? '' }}</td>
                            <td>{{ $absen->pesertaDidik->nisn ?? '' }}</td>
                            <td>{{ $absen->kelas->nama_kelas }}</td>
                            <td>{{ $hadir }}</td>
                            <td>{{ $sakit }}</td>
                            <td>{{ $ijin }}</td>
                            <td>{{ $alpa }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif

    <div class="footer">
        <p>Dicetak pada: {{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y HH:mm:ss') }}</p>
    </div>
</body>

</html>
