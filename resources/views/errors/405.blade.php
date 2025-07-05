@extends('errors.layout')

@section('title', '405 Method Not Allowed')

@section('content')
    <div class="error-code">405</div>
    <div class="error-icon">❌</div>
    <h1 class="error-title">Method Not Allowed</h1>
    <p class="error-message">
        Maaf, metode HTTP yang digunakan tidak diizinkan untuk halaman ini.
        Silakan gunakan metode yang sesuai atau hubungi administrator.
    </p>
    <div class="error-actions">
        <a href="{{ url('/') }}" class="btn-error btn-primary-error">Kembali ke Beranda</a>
        <a href="javascript:history.back()" class="btn-error btn-secondary-error">Kembali Sebelumnya</a>
    </div>
@endsection
