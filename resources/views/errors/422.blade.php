@extends('errors.layout')

@section('title', '422 Unprocessable Entity')

@section('content')
    <div class="error-code">422</div>
    <div class="error-icon">📝</div>
    <h1 class="error-title">Data Tidak Valid</h1>
    <p class="error-message">
        Maaf, data yang Anda kirim tidak dapat diproses karena tidak memenuhi persyaratan.
        Silakan periksa kembali data yang Anda masukkan dan coba lagi.
    </p>
    <div class="error-actions">
        <a href="javascript:history.back()" class="btn-error btn-primary-error">Kembali Sebelumnya</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
