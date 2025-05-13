@extends('layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('layouts/src/plugins/src/tomSelect/tom-select.default.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('layouts/src/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('layouts/src/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
    @endpush

    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="/kelas" class="btn btn-primary mr-2">Kembali</a>
                <!-- Button trigger modal -->

            </div>

        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Tambah Prestasi</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <form action="{{ route('prestasi.update', $prestasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <input type="text" name="jenjang" class="form-control" value="{{ old('jenjang', $prestasi->jenjang) }}">
                        </div>

                        <div class="mb-3">
                            <label for="prestasi" class="form-label">Prestasi</label>
                            <input type="text" name="prestasi" class="form-control" value="{{ old('prestasi', $prestasi->prestasi) }}">
                        </div>

                        <div class="mb-3">
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <input type="text" name="tingkat" class="form-control" value="{{ old('tingkat', $prestasi->tingkat) }}">
                        </div>

                        <div class="mb-3">
                            <label for="peringkat" class="form-label">Peringkat</label>
                            <input type="text" name="peringkat" class="form-control" value="{{ old('peringkat', $prestasi->peringkat) }}">
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $prestasi->tanggal) }}">
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="peserta_didik_id" class="form-label">Nama Siswa</label>
                            <select name="peserta_didik_id" class="form-select">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($pesertaDidiks as $siswa)
                                    <option value="{{ $siswa->id }}" {{ old('peserta_didik_id', $prestasi->peserta_didik_id) == $siswa->id ? 'selected' : '' }}>
                                        {{ $siswa->user->name ?? 'Nama tidak tersedia' }} - {{ $siswa->nisn }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">Batal</a>
                    </form>


                </div>
            </div>
        </div>
    </div>

    @push('js')
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ asset('layouts/src/assets/js/scrollspyNav.js') }}"></script>
        <script src="{{ asset('layouts/src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
        <script>
            new TomSelect("#peserta_didik_id", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        </script>
        <!-- END PAGE LEVEL SCRIPTS -->
    @endpush
@endsection
