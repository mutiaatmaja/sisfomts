@php use Milon\Barcode\Facades\DNS1DFacade as DNS1D; @endphp
<style>
    .idcard-row {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 32px;
        margin: 40px 0;
    }
    .idcard-container, .idcard-back {
        width: 336px;
        height: 204px;
        background: url('{{ asset('gambarutama/card/back2.png') }}') no-repeat center center;
        background-size: cover;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        position: relative;
        overflow: hidden;
        padding: 0;
        display: flex;
        flex-direction: row;
    }
    .idcard-container-front, .idcard-front {
        width: 336px;
        height: 204px;
        background: url('{{ asset('gambarutama/card/front2.png') }}') no-repeat center center;
        background-size: cover;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        position: relative;
        overflow: hidden;
        padding: 0;
        display: flex;
        flex-direction: row;
    }
    .barcode-vertical {
        width: 20px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff8;
        position: relative;
        z-index: 2;
    }
    .barcode-vertical img {
        width: 20px;
        height: 180px;
        object-fit: contain;
        writing-mode: vertical-lr;
        transform: rotate(180deg);
    }
    .idcard-content-area {
        flex: 1;
        position: relative;
        height: 100%;
        padding-left: 16px;
        padding-right: 12px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .idcard-logo {
        position: absolute;
        top: 12px;
        left: 32px;
        width: 48px;
        height: 48px;
        object-fit: contain;
        z-index: 3;
    }
    .idcard-foto {
        position: absolute;
        top: 24px;
        right: 16px;
        width: 64px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #fff;
        background: #eee;
        z-index: 3;
    }
    .idcard-content {
        position: absolute;
        left: 90px;
        top: 24px;
        right: 96px;
        color: #222;
        font-family: 'Arial', sans-serif;
        z-index: 3;
    }
    .idcard-title {
        position: absolute;
        top: 10px;
        left: 0;
        width: 100%;
        text-align: center;
        font-size: 1.05em;
        font-weight: bold;
        color: #1a237e;
        letter-spacing: 1px;
        text-shadow: 0 1px 2px #fff;
        z-index: 3;
    }
    .idcard-nama {
        font-size: 0.95em;
        font-weight: bold;
        margin-top: 25px;
        margin-left: 20px;
        margin-bottom: 2px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .idcard-tempat {
        font-size: 0.95em;
        margin-left: 19px;
        margin-top: 24px;
    }
    .idcard-nisn {
        margin-left: 20px;
        margin-top: 35px;
        font-size: 0.9em;
        margin-bottom: 1px;
    }
    .idcard-tanggal {
        margin-left: 20px;
        margin-top: 26px;
        font-size: 0.9em;
        margin-bottom: 1px;
    }
    .idcard-footer {
        position: absolute;
        bottom: 10px;
        left: 16px;
        right: 16px;
        font-size: 0.8em;
        color: #555;
        text-align: right;
        z-index: 3;
    }
    .idcard-qrcode {
        position: absolute;
        right: 241px;
        bottom: 12px;
        width: 54px;
        height: 54px;
        background: #fff;
        border-radius: 6px;
        padding: 2px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
    }
    .idcard-back-content {
        position: absolute;
        left: 90px;
        top: 60px;
        right: 16px;
        color: #222;
        font-family: 'Arial', sans-serif;
        font-size: 0.98em;
        z-index: 3;
    }
    .idcard-back-info {
        position: absolute;
        top: 20px;
        left: 90px;
        width: calc(100% - 100px);
        text-align: center;
        font-size: 0.85em;
        color: #333;
        padding: 0 8px;
        z-index: 3;
    }
</style>
<div class="idcard-row" style="flex-direction: column;">
    <!-- Lembar Depan -->
    <div class="idcard-front">
        <div class="idcard-content-area">
            <div class="idcard-title"></div>
            <br />
            <div class="idcard-back-info">
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
            <img src="{{ $pesertaDidik->user->foto ? asset('storage/' . $pesertaDidik->user->foto) : 'https://bootdey.com/img/Content/avatar/avatar7.png' }}" style="width: 64px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid #fff; background: #eee; margin-right: 16px; margin-top:5px;" alt="Foto Siswa">
            <div style="flex:1;">
                <div class="idcard-nisn">{{ $pesertaDidik->nisn }}</div>
                <div class="idcard-nama">{{ $pesertaDidik->user->name }}</div>
                <div class="idcard-tempat">{{ $pesertaDidik->user->tempat_lahir ?? '-' }}</div>

                <div class="idcard-tanggal">{{ \Carbon\Carbon::parse($pesertaDidik->user->tanggal_lahir)->translatedFormat('d F Y') ?? '-' }}</div>

            </div>
        </div>
        <div class="idcard-qrcode">
            {!! Quar::generate('Quar package create qr code'); !!}
        </div>
    </div>
</div>
