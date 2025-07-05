@extends('errors.layout')

@section('title', '415 Unsupported Media Type')

@section('content')
    <div class="error-code">415</div>
    <div class="error-icon">📄</div>
    <h1 class="error-title">Tipe Media Tidak Didukung</h1>
    <p class="error-message">
        Maaf, tipe file atau media yang Anda upload tidak didukung oleh sistem.
        Silakan gunakan format file yang sesuai (seperti JPG, PNG, PDF, dll).
    </p>
    <div class="error-actions">
        <a href="javascript:history.back()" class="btn-error btn-primary-error">Kembali Sebelumnya</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
