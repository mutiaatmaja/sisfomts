@php
    use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Siswa</title>
    <style>
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; }
        .idcard-row { display: flex; flex-direction: row; justify-content: center; gap: 24px; margin: 0; }
        .idcard-container, .idcard-back {
            width: 336px; height: 204px;
            border: 1px solid #888;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            background: url('{{ asset('gambarutama/bg2.png') }}') no-repeat center center;
            background-size: cover;
            display: flex;
            flex-direction: row;
        }
        .barcode-vertical {
            width: 20px; height: 100%; display: flex; align-items: center; justify-content: center; background: #fff8; }
        .barcode-vertical img { width: 20px; height: 180px; object-fit: contain; writing-mode: vertical-lr; transform: rotate(-90deg); }
        .idcard-content-area { flex: 1; position: relative; height: 100%; padding-left: 8px; display: flex; flex-direction: row; align-items: flex-start; }
        .idcard-logo { position: absolute; top: 12px; left: 32px; width: 48px; height: 48px; object-fit: contain; }
        .idcard-title { position: absolute; top: 10px; left: 0; width: 100%; text-align: center; font-size: 1.05em; font-weight: bold; color: #1a237e; letter-spacing: 1px; }
        .idcard-back-info { position: absolute; top: 60px; left: 0; width: 100%; text-align: center; font-size: 0.85em; color: #333; padding: 0 8px; }
        .idcard-qrcode { position: absolute; right: 12px; bottom: 12px; width: 54px; height: 54px; background: #fff; border-radius: 6px; padding: 2px; display: flex; align-items: center; justify-content: center; }
        .idcard-nama { font-size: 1.1em; font-weight: bold; margin-bottom: 2px; text-transform: uppercase; letter-spacing: 0.5px; }
        .idcard-kelas { font-size: 0.95em; margin-bottom: 2px; }
        .idcard-nisn, .idcard-nis { font-size: 0.9em; margin-bottom: 1px; }
        .idcard-footer { font-size: 0.8em; color: #555; text-align: right; margin-top: 12px; }
    </style>
</head>
<body>
<div class="idcard-row">
    <!-- Lembar Depan -->
    <div class="idcard-back">
        <div class="idcard-content-area" style="flex-direction: column; align-items: flex-start;">
            <div class="idcard-title">Kartu Tanda Pelajar MTs 2 Mempawah</div>
            <img src="{{ asset('gambarutama/logomts.png') }}" class="idcard-logo" alt="Logo Sekolah">
            <div class="idcard-back-info">
                Kartu ini adalah identitas resmi siswa MTs 2 Mempawah. Simpan dan jaga kartu ini dengan baik. Jika hilang, segera lapor ke pihak sekolah.
            </div>
            <div class="idcard-qrcode">
                {{-- {!! Quar::qr(url('/verval/nisn/' . $pesertaDidik->nisn))->size(50)->margin(0) !!} --}}
            </div>
        </div>
    </div>
    <!-- Lembar Belakang -->
    <div class="idcard-container">
        <div class="barcode-vertical">
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($pesertaDidik->nisn, 'C128', 2, 60) }}" alt="Barcode NISN" style="transform: rotate(-90deg); width: 180px; height: 40px;" />
        </div>
        <div class="idcard-content-area" style="display: flex; flex-direction: row; align-items: flex-start; height: 100%; padding-left: 8px;">
            <div style="width:5px;"></div>
            <img src="{{ $pesertaDidik->user->foto ? asset('storage/' . $pesertaDidik->user->foto) : asset('gambarutama/avatar7.png') }}" style="width: 71px; height: 87px; object-fit: cover; border-radius: 8px; border: 2px solid #fff; background: #eee; margin-right: 16px; margin-top:5px;" alt="Foto Siswa">
            <div style="flex:1;">
                <div class="idcard-nama">{{ $pesertaDidik->user->name }}</div>
                <div class="idcard-kelas">Kelas: {{ $pesertaDidik->kelas->nama_kelas ?? '-' }}</div>
                <div class="idcard-nisn">NISN: {{ $pesertaDidik->nisn }}</div>
                <div class="idcard-nis">NIS: {{ $pesertaDidik->nis ?? '-' }}</div>
                <div class="idcard-footer">
                    <span>ID Card Siswa</span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
