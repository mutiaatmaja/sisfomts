@extends('errors.layout')

@section('title', '401 Unauthorized')

@section('content')
    <div class="error-code">401</div>
    <div class="error-icon">🔒</div>
    <h1 class="error-title">Unauthorized</h1>
    <p class="error-message">
        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
        Silakan login terlebih dahulu atau hubungi administrator jika Anda yakin memiliki akses.
    </p>
    <div class="error-actions">
        <a href="{{ route('login') }}" class="btn-error btn-primary-error">Login</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
