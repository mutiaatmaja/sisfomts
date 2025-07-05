@extends('errors.layout')

@section('title', '409 Conflict')

@section('content')
    <div class="error-code">409</div>
    <div class="error-icon">⚡</div>
    <h1 class="error-title">Conflict</h1>
    <p class="error-message">
        Maaf, terjadi konflik dengan data yang ada.
        Kemungkinan data yang Anda coba simpan sudah ada atau bertentangan dengan data lainnya.
    </p>
    <div class="error-actions">
        <a href="javascript:history.back()" class="btn-error btn-primary-error">Kembali Sebelumnya</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
