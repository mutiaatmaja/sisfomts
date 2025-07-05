@extends('errors.layout')

@section('title', $exception->getStatusCode() . ' Error')

@section('content')
    <div class="error-code">{{ $exception->getStatusCode() }}</div>
    <div class="error-icon">❓</div>
    <h1 class="error-title">Terjadi Kesalahan</h1>
    <p class="error-message">
        Maaf, terjadi kesalahan yang tidak terduga.
        Silakan coba lagi atau hubungi administrator jika masalah berlanjut.
    </p>
    <div class="error-actions">
        <a href="javascript:location.reload()" class="btn-error btn-primary-error">Coba Lagi</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
