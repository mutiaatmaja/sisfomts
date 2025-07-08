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
                <a href="{{ route('prestasi.index') }}" class="btn btn-primary mr-2">Kembali</a>
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

                    <form action="{{ route('prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
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

                        <div class="mb-3 d-flex gap-3">
                            <div class="flex-fill">
                                <label for="tingkat" class="form-label">Tingkat</label>
                                <select name="tingkat" class="form-select">
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="Sekolah" {{ old('tingkat', $prestasi->tingkat) == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                                    <option value="Kota" {{ old('tingkat', $prestasi->tingkat) == 'Kota' ? 'selected' : '' }}>Kota</option>
                                    <option value="Kabupaten" {{ old('tingkat', $prestasi->tingkat) == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                    <option value="Provinsi" {{ old('tingkat', $prestasi->tingkat) == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                    <option value="Internasional" {{ old('tingkat', $prestasi->tingkat) == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                    <option value="Lainnya" {{ old('tingkat', $prestasi->tingkat) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="flex-fill">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori" class="form-select">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Individu" {{ old('kategori', $prestasi->kategori ?? '') == 'Individu' ? 'selected' : '' }}>Individu</option>
                                    <option value="Kelompok" {{ old('kategori', $prestasi->kategori ?? '') == 'Kelompok' ? 'selected' : '' }}>Kelompok</option>
                                    <option value="Lainnya" {{ old('kategori', $prestasi->kategori ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="flex-fill">
                                <label for="peringkat" class="form-label">Peringkat</label>
                                <select name="peringkat" class="form-select">
                                    <option value="">-- Pilih Peringkat --</option>
                                    <option value="Peserta" {{ old('peringkat', $prestasi->peringkat) == 'Peserta' ? 'selected' : '' }}>Peserta</option>
                                    <option value="Juara 1" {{ old('peringkat', $prestasi->peringkat) == 'Juara 1' ? 'selected' : '' }}>Juara 1</option>
                                    <option value="Juara 2" {{ old('peringkat', $prestasi->peringkat) == 'Juara 2' ? 'selected' : '' }}>Juara 2</option>
                                    <option value="Juara 3" {{ old('peringkat', $prestasi->peringkat) == 'Juara 3' ? 'selected' : '' }}>Juara 3</option>
                                    <option value="Finalis" {{ old('peringkat', $prestasi->peringkat) == 'Finalis' ? 'selected' : '' }}>Finalis</option>
                                    <option value="Juara Harapan" {{ old('peringkat', $prestasi->peringkat) == 'Juara Harapan' ? 'selected' : '' }}>Juara Harapan</option>
                                    <option value="Lainnya" {{ old('peringkat', $prestasi->peringkat) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
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

                        @if($prestasi->foto)
                            <div class="mb-3">
                                <label class="form-label">Foto Saat Ini</label><br>
                                <img src="{{ asset('storage/prestasi/' . $prestasi->foto) }}" alt="Foto Prestasi" style="max-width: 200px; height: auto;">
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="foto" class="form-label">Upload Foto Prestasi</label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
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
