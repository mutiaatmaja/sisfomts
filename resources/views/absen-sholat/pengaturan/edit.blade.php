@extends('layouts.app')

@section('content')
    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="{{ route('absen.sholat.pengaturan.index') }}" class="btn btn-primary mr-2" wire:navigate>Kembali</a>
            </div>
        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Edit Jam {{ $sholatSetting->nama_sholat }}</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('absen.sholat.pengaturan.update', $sholatSetting->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Nama Sholat</label>
                                <input type="text" class="form-control" value="{{ $sholatSetting->nama_sholat }}"
                                    disabled>
                            </div>
                            <div class="col-md-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"
                                    value="{{ old('jam_mulai', \Carbon\Carbon::parse($sholatSetting->jam_mulai)->format('H:i')) }}"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai"
                                    value="{{ old('jam_selesai', \Carbon\Carbon::parse($sholatSetting->jam_selesai)->format('H:i')) }}"
                                    required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_active"
                                        name="is_active" {{ old('is_active', $sholatSetting->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Aktif</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
