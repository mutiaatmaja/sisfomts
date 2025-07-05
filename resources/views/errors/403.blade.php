@extends('errors.layout')

@section('title', '403 Forbidden')

@section('content')
    <div class="error-code">403</div>
    <div class="error-icon">🚫</div>
    <h1 class="error-title">Forbidden</h1>
    <p class="error-message">
        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
        Jika Anda yakin seharusnya memiliki akses, silakan hubungi administrator.
    </p>
    <div class="error-actions">
        <a href="{{ url('/') }}" class="btn-error btn-primary-error">Kembali ke Beranda</a>
        <a href="javascript:history.back()" class="btn-error btn-secondary-error">Kembali Sebelumnya</a>
    </div>
@endsection
