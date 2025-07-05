@extends('errors.layout')

@section('title', '501 Not Implemented')

@section('content')
    <div class="error-code">501</div>
    <div class="error-icon">🚧</div>
    <h1 class="error-title">Fitur Belum Tersedia</h1>
    <p class="error-message">
        Maaf, fitur yang Anda coba akses belum diimplementasikan atau sedang dalam pengembangan.
        Silakan coba fitur lain yang sudah tersedia.
    </p>
    <div class="error-actions">
        <a href="{{ url('/') }}" class="btn-error btn-primary-error">Kembali ke Beranda</a>
        <a href="javascript:history.back()" class="btn-error btn-secondary-error">Kembali Sebelumnya</a>
    </div>
@endsection
