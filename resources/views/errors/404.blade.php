@extends('errors.layout')

@section('title', '404 Not Found')

@section('content')
    <div class="error-code">404</div>
    <div class="error-icon">🔍</div>
    <h1 class="error-title">Halaman Tidak Ditemukan</h1>
    <p class="error-message">
        Maaf, halaman yang Anda cari tidak ditemukan atau telah dipindahkan.
        Silakan periksa kembali URL yang Anda masukkan atau gunakan menu navigasi.
    </p>
    <div class="error-actions">
        <a href="{{ url('/') }}" class="btn-error btn-primary-error">Kembali ke Beranda</a>
        <a href="javascript:history.back()" class="btn-error btn-secondary-error">Kembali Sebelumnya</a>
    </div>
@endsection
