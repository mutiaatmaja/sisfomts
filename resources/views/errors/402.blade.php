@extends('errors.layout')

@section('title', '402 Payment Required')

@section('content')
    <div class="error-code">402</div>
    <div class="error-icon">💳</div>
    <h1 class="error-title">Payment Required</h1>
    <p class="error-message">
        Maaf, akses ke halaman ini memerlukan pembayaran terlebih dahulu.
        Silakan selesaikan proses pembayaran untuk melanjutkan.
    </p>
    <div class="error-actions">
        <a href="{{ url('/') }}" class="btn-error btn-primary-error">Kembali ke Beranda</a>
        <a href="javascript:history.back()" class="btn-error btn-secondary-error">Kembali Sebelumnya</a>
    </div>
@endsection
