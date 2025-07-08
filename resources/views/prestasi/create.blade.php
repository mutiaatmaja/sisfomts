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

                    <form action="{{ route('prestasi.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <input type="text" name="jenjang" id="jenjang" class="form-control" value="{{ old('jenjang') }}" placeholder="SMP/MTs">
                        </div>

                        <div class="mb-3">
                            <label for="prestasi" class="form-label">Prestasi</label>
                            <input type="text" name="prestasi" id="prestasi" class="form-control" value="{{ old('prestasi') }}" placeholder="Isikan Nama Prestasi (Lomba......)">
                        </div>

                        <div class="mb-3 d-flex gap-3">
                            <div class="flex-fill">
                                <label for="tingkat" class="form-label">Tingkat</label>
                                <select name="tingkat" id="tingkat" class="form-select">
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="Sekolah" {{ old('tingkat') == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                                    <option value="Kota" {{ old('tingkat') == 'Kota' ? 'selected' : '' }}>Kota</option>
                                    <option value="Kabupaten" {{ old('tingkat') == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                    <option value="Provinsi" {{ old('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                    <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                    <option value="Lainnya" {{ old('tingkat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="flex-fill">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori" id="kategori" class="form-select">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Individu" {{ old('kategori') == 'Individu' ? 'selected' : '' }}>Individu</option>
                                    <option value="Kelompok" {{ old('kategori') == 'Kelompok' ? 'selected' : '' }}>Kelompok</option>
                                    <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="peringkat" class="form-label">Peringkat</label>
                            <select name="peringkat" id="peringkat" class="form-select">
                                <option value="">-- Pilih Peringkat --</option>
                                <option value="Peserta" {{ old('peringkat') == 'Peserta' ? 'selected' : '' }}>Peserta</option>
                                <option value="Juara 1" {{ old('peringkat') == 'Juara 1' ? 'selected' : '' }}>Juara 1</option>
                                <option value="Juara 2" {{ old('peringkat') == 'Juara 2' ? 'selected' : '' }}>Juara 2</option>
                                <option value="Juara 3" {{ old('peringkat') == 'Juara 3' ? 'selected' : '' }}>Juara 3</option>
                                <option value="Finalis" {{ old('peringkat') == 'Finalis' ? 'selected' : '' }}>Finalis</option>
                                <option value="Juara Harapan" {{ old('peringkat') == 'Juara Harapan' ? 'selected' : '' }}>Juara Harapan</option>
                                <option value="Lainnya" {{ old('peringkat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}">
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Upload Foto Prestasi</label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="peserta_didik_id" class="form-label">Nama Siswa</label>
                            <select name="peserta_didik_id" id="peserta_didik_id" class="form-select">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($pesertaDidiks as $siswa)
                                    <option value="{{ $siswa->id }}" {{ old('peserta_didik_id') == $siswa->id ? 'selected' : '' }}>
                                        {{ $siswa->user->name ?? 'Nama tidak tersedia' }} - {{ $siswa->nisn }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
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
