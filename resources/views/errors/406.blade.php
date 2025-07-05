@extends('errors.layout')

@section('title', '406 Not Acceptable')

@section('content')
    <div class="error-code">406</div>
    <div class="error-icon">🚫</div>
    <h1 class="error-title">Not Acceptable</h1>
    <p class="error-message">
        Maaf, server tidak dapat menghasilkan respons yang sesuai dengan header Accept yang dikirim.
        Silakan coba dengan format yang berbeda.
    </p>
    <div class="error-actions">
        <a href="javascript:history.back()" class="btn-error btn-primary-error">Kembali Sebelumnya</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
