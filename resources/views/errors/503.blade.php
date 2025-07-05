@extends('errors.layout')

@section('title', '503 Service Unavailable')

@section('content')
    <div class="error-code">503</div>
    <div class="error-icon">🛠️</div>
    <h1 class="error-title">Layanan Tidak Tersedia</h1>
    <p class="error-message">
        Maaf, layanan sedang dalam pemeliharaan atau tidak tersedia sementara.
        Tim kami sedang bekerja untuk mengembalikan layanan secepat mungkin.
    </p>
    <div class="error-actions">
        <a href="javascript:location.reload()" class="btn-error btn-primary-error">Coba Lagi</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
