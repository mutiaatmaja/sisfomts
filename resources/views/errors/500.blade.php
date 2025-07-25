@extends('errors.layout')

@section('title', '500 Internal Server Error')

@section('content')
    <div class="error-code">500</div>
    <div class="error-icon">🔧</div>
    <h1 class="error-title">Kesalahan Server</h1>
    <p class="error-message">
        Maaf, terjadi kesalahan internal pada server.
        Tim kami sedang bekerja untuk memperbaiki masalah ini. Silakan coba lagi nanti.
    </p>
    <div class="error-actions">
        <a href="javascript:location.reload()" class="btn-error btn-primary-error">Coba Lagi</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
