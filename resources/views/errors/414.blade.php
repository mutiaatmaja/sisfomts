@extends('errors.layout')

@section('title', '414 URI Too Long')

@section('content')
    <div class="error-code">414</div>
    <div class="error-icon">🔗</div>
    <h1 class="error-title">URL Terlalu Panjang</h1>
    <p class="error-message">
        Maaf, URL yang Anda akses terlalu panjang untuk diproses oleh server.
        Silakan gunakan URL yang lebih pendek atau akses melalui menu navigasi.
    </p>
    <div class="error-actions">
        <a href="{{ url('/') }}" class="btn-error btn-primary-error">Kembali ke Beranda</a>
        <a href="javascript:history.back()" class="btn-error btn-secondary-error">Kembali Sebelumnya</a>
    </div>
@endsection
