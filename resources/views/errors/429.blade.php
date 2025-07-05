@extends('errors.layout')

@section('title', '429 Too Many Requests')

@section('content')
    <div class="error-code">429</div>
    <div class="error-icon">🚦</div>
    <h1 class="error-title">Terlalu Banyak Permintaan</h1>
    <p class="error-message">
        Maaf, Anda telah mengirim terlalu banyak permintaan dalam waktu singkat.
        Silakan tunggu beberapa saat sebelum mencoba lagi.
    </p>
    <div class="error-actions">
        <a href="javascript:setTimeout(() => location.reload(), 5000)" class="btn-error btn-primary-error">Coba Lagi (5 detik)</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
