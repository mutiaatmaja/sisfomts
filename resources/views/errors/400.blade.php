@extends('errors.layout')

@section('title', '400 Bad Request')

@section('content')
    <div class="error-code">400</div>
    <div class="error-icon">⚠️</div>
    <h1 class="error-title">Bad Request</h1>
    <p class="error-message">
        Maaf, permintaan yang Anda kirim tidak valid atau tidak dapat diproses oleh server.
        Silakan periksa kembali data yang Anda masukkan dan coba lagi.
    </p>
    <div class="error-actions">
        <a href="{{ url('/') }}" class="btn-error btn-primary-error">Kembali ke Beranda</a>
        <a href="javascript:history.back()" class="btn-error btn-secondary-error">Kembali Sebelumnya</a>
    </div>
@endsection
