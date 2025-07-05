@extends('errors.layout')

@section('title', '419 Page Expired')

@section('content')
    <div class="error-code">419</div>
    <div class="error-icon">⏳</div>
    <h1 class="error-title">Halaman Kedaluwarsa</h1>
    <p class="error-message">
        Maaf, halaman ini telah kedaluwarsa karena tidak aktif dalam waktu yang lama.
        Silakan refresh halaman atau coba lagi dari awal.
    </p>
    <div class="error-actions">
        <a href="javascript:location.reload()" class="btn-error btn-primary-error">Refresh Halaman</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
