@extends('layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('html/src/plugins/src/tomSelect/tom-select.default.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('html/src/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('html/src/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
    @endpush

    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="{{ route('osis.index') }}" class="btn btn-primary mr-2">Kembali</a>
            </div>
        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Tambah Pengurus OSIS</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{ route('osis.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="siswa_id" class="form-label">Siswa</label>
                                <select class="form-control-lg" id="siswa_id" name="siswa_id">
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($siswas as $siswa)
                                        <option value="{{ $siswa->id }}">{{ $siswa->user->name }}</option>
                                    @endforeach
                                </select>
                                @error('siswa_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <select class="form-control" id="jabatan" name="jabatan" required>
                                    <option value="">Pilih Jabatan</option>
                                    <option value="Ketua OSIS">Ketua OSIS</option>
                                    <option value="Wakil Ketua OSIS">Wakil Ketua OSIS</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Bendahara">Bendahara</option>
                                    <option value="Anggota">Anggota</option>
                                </select>
                                @error('jabatan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="periode" class="form-label">Periode</label>
                                <input type="text" class="form-control" id="periode" name="periode" required>
                                @error('periode')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('html/src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
        <script>
            new TomSelect("#siswa_id", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        </script>
    @endpush
@endsection
