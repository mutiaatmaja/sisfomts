@extends('errors.layout')

@section('title', '413 Payload Too Large')

@section('content')
    <div class="error-code">413</div>
    <div class="error-icon">📦</div>
    <h1 class="error-title">Data Terlalu Besar</h1>
    <p class="error-message">
        Maaf, data yang Anda kirim terlalu besar untuk diproses oleh server.
        Silakan kurangi ukuran file atau data yang Anda upload.
    </p>
    <div class="error-actions">
        <a href="javascript:history.back()" class="btn-error btn-primary-error">Kembali Sebelumnya</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
