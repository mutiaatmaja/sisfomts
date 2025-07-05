@extends('errors.layout')

@section('title', '502 Bad Gateway')

@section('content')
    <div class="error-code">502</div>
    <div class="error-icon">🌐</div>
    <h1 class="error-title">Bad Gateway</h1>
    <p class="error-message">
        Maaf, server gateway mengalami masalah sementara.
        Ini biasanya terjadi karena server sedang dalam pemeliharaan atau overload.
    </p>
    <div class="error-actions">
        <a href="javascript:location.reload()" class="btn-error btn-primary-error">Coba Lagi</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
