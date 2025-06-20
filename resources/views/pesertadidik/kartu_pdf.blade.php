@php
    use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kartu Siswa</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .idcard-row {
            width: 700px;
            margin: 0 auto;
        }

        .idcard-table {
            border-collapse: separate;
            border-spacing: 24px 0;
            width: 100%;
        }

        .idcard-cell {
            width: 336px;
            height: 204px;
            border: 1px solid #888;
            border-radius: 10px;
            background: #f8f8f8 url('{{ public_path('gambarutama/bg2.png') }}') no-repeat center center;
            background-size: cover;
            vertical-align: top;
            position: relative;
        }

        .barcode-td {
            width: 24px;
            vertical-align: top;
        }

        .foto-td {
            width: 70px;
            vertical-align: top;
        }

        .biodata-td {
            vertical-align: top;
            padding-left: 10px;
        }

        .logo-mts {
            position: absolute;
            top: 12px;
            left: 32px;
            width: 48px;
            height: 48px;
        }

        .idcard-title {
            text-align: center;
            font-size: 1.05em;
            font-weight: bold;
            color: #1a237e;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        .idcard-back-info {
            text-align: center;
            font-size: 0.85em;
            color: #333;
            margin: 60px 8px 0 8px;
        }

        .idcard-qrcode {
            position: absolute;
            right: 12px;
            bottom: 12px;
            width: 54px;
            height: 54px;
            background: #fff;
            border-radius: 6px;
            padding: 2px;
            display: inline-block;
        }

        .idcard-nama {
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .idcard-kelas {
            font-size: 0.95em;
            margin-bottom: 2px;
        }

        .idcard-nisn,
        .idcard-nis {
            font-size: 0.9em;
            margin-bottom: 1px;
        }

        .idcard-footer {
            font-size: 0.8em;
            color: #555;
            text-align: right;
            margin-top: 12px;
        }

    </style>
</head>

<body>
    <div class="idcard-row">
        <table class="idcard-table">
            <tr>
                <!-- Lembar Depan -->
                <td class="idcard-cell" style="position:relative;">
                    <div class="idcard-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kartu Tanda Pelajar MTs 2 Mempawah</div>
                    <img src="{{ public_path('gambarutama/logomts.png') }}" class="logo-mts" alt="Logo Sekolah">
                    <div class="idcard-back-info">
                        Kartu ini adalah identitas resmi siswa MTs 2 Mempawah. Simpan dan jaga kartu ini dengan baik. Jika
                        hilang, segera lapor ke pihak sekolah.
                    </div>
                    <div class="idcard-qrcode">
                        {{-- {!! Quar::qr(url('/verval/nisn/' . $pesertaDidik->nisn))->size(50)->margin(0) !!} --}}
                    </div>
                </td>
                <!-- Lembar Belakang -->
                <td class="idcard-cell">
                    <table style=" border-collapse:collapse;">
                        <tr>
                            <td class="barcode-td" style="vertical-align: middle; height: 204px; text-align: center;">
                                <img src="{{ $barcodePath }}" style="width:20px; height:120px; display:block; margin:0 auto;" />
                            </td>
                            <td class="foto-td">
                                <img src="{{ $pesertaDidik->user->foto ? public_path('storage/' . $pesertaDidik->user->foto) : public_path('gambarutama/avatar7.png') }}" style="width: 71px; height: 87px; border-radius: 8px; border: 2px solid #fff; background: #eee; margin-top:5px;" alt="Foto Siswa">
                            </td>
                            <td class="biodata-td">
                                <div class="idcard-nama">{{ $pesertaDidik->user->name }}</div>
                                <div class="idcard-kelas">Kelas: {{ $pesertaDidik->kelas->nama_kelas ?? '-' }}</div>
                                <div class="idcard-nisn">NISN: {{ $pesertaDidik->nisn }}</div>
                                <div class="idcard-nis">NIS: {{ $pesertaDidik->nis ?? '-' }}</div>
                                <div class="idcard-footer">
                                    <span>ID Card Siswa</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
