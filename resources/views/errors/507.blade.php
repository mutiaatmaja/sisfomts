@extends('errors.layout')

@section('title', '507 Insufficient Storage')

@section('content')
    <div class="error-code">507</div>
    <div class="error-icon">💾</div>
    <h1 class="error-title">Penyimpanan Tidak Cukup</h1>
    <p class="error-message">
        Maaf, server tidak memiliki ruang penyimpanan yang cukup untuk memproses permintaan Anda.
        Silakan coba lagi nanti atau hubungi administrator.
    </p>
    <div class="error-actions">
        <a href="javascript:history.back()" class="btn-error btn-primary-error">Kembali Sebelumnya</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
