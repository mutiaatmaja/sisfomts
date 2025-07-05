@extends('errors.layout')

@section('title', '504 Gateway Timeout')

@section('content')
    <div class="error-code">504</div>
    <div class="error-icon">⏱️</div>
    <h1 class="error-title">Gateway Timeout</h1>
    <p class="error-message">
        Maaf, server gateway mengalami timeout karena tidak menerima respons tepat waktu.
        Silakan coba lagi dalam beberapa saat.
    </p>
    <div class="error-actions">
        <a href="javascript:location.reload()" class="btn-error btn-primary-error">Coba Lagi</a>
        <a href="{{ url('/') }}" class="btn-error btn-secondary-error">Kembali ke Beranda</a>
    </div>
@endsection
