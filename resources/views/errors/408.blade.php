@extends('errors.layout')

@section('title', '408 Request Timeout')

@section('content')
    <div class="error-code">408</div>
    <div class="error-icon">⏰</div>
    <h1 class="error-title">Request Timeout</h1>
    <p class="error-message">
        Maaf, permintaan Anda telah melebihi batas waktu yang ditentukan.
        Silakan coba lagi atau periksa koneksi internet Anda.
    </p>
    <div class="error-actions">
        <a href="javascript:location.reload()" class="btn-error btn-primary-error">Coba Lagi</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
