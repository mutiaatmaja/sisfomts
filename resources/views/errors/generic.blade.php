@extends('errors.layout')

@section('title', $exception->getStatusCode() . ' Error')

@section('content')
    <div class="error-code">{{ $exception->getStatusCode() }}</div>
    <div class="error-icon">❓</div>
    <h1 class="error-title">Terjadi Kesalahan</h1>
    <p class="error-message">
        Maaf, terjadi kesalahan yang tidak terduga.
        Silakan coba lagi atau hubungi administrator jika masalah berlanjut.<br />
        Periksa kembali URL yang Anda masukkan atau coba akses halaman lain.
    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @elseif(isset($error) && $error)
        <div class="alert alert-danger mt-3">
            {{ $error }}
        </div>
    @endif
    </p>
    <div class="error-actions">
        <a href="javascript:location.reload()" class="btn-error btn-primary-error">Coba Lagi</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
