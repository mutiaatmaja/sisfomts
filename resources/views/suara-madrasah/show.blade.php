@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2 mt-2">
        <div class="col-12">
            <a href="{{ route('suara-madrasah.semua-laporan') }}" class="btn btn-primary mr-2">Kembali</a>

        </div>

    </div>
    <h3 class="mb-4">Detail Aduan</h3>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Responden</h5>
            <p><strong>Nama Responden:</strong> {{ $aduan->nama_responden ?? 'Anonim' }}</p>
            <p><strong>No. HP:</strong> {{ $aduan->hp_responden ?? 'Tidak diketahui' }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Aduan</h5>
            <p><strong>Tipe Aduan:</strong> {{ ucfirst(str_replace('_', ' ', $aduan->tipe_aduan)) }}</p>
            <p><strong>Teks Suara:</strong><br> {{ $aduan->teks_suara ?? '-' }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Data Terlapor</h5>
            <p><strong>Apa kejadian:</strong><br> {{ $aduan->apa }}</p>
            <p><strong>Siapa yang dilaporkan:</strong> {{ $aduan->siapa }}</p>
            <p><strong>Kapan:</strong> {{ \Carbon\Carbon::parse($aduan->kapan)->format('d M Y') }}</p>
            <p><strong>Di mana:</strong> {{ $aduan->dimana }}</p>
            <p><strong>Mengapa:</strong><br> {{ $aduan->mengapa }}</p>
            <p><strong>Bagaimana prosesnya:</strong><br> {{ $aduan->bagaimana }}</p>
        </div>
    </div>

    @if ($aduan->lampiran)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Lampiran</h5>
                <p>
                    <a href="{{ asset('storage/' . $aduan->lampiran) }}" target="_blank" class="btn btn-outline-primary">
                        Lihat Lampiran
                    </a>
                </p>
            </div>
        </div>
    @endif

</div>
@endsection
