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
                <a href="/kelas" class="btn btn-primary mr-2">Kembali</a>
                <!-- Button trigger modal -->

            </div>

        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Tambah Kelas</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <form action="{{ route('kelas.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                <input type="text" placeholder="Isikan Nama Kelas" class="form-control" id="nama_kelas" name="nama_kelas" required>
                                @error('nama_kelas')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="wali_kelas_id" class="form-label">Wali Kelas</label>
                                <select class="form-control-lg" id="wali_kelas_id" name="wali_kelas">
                                    <option value="">Pilih Wali Kelas</option>
                                    @foreach ($pendidikTendiks as $guru)
                                        <option value="{{ $guru->id }}">{{ $guru->user->name }}</option>
                                    @endforeach
                                </select>
                                @error('wali_kelas')
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
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ asset('html/src/assets/js/scrollspyNav.js') }}"></script>
        <script src="{{ asset('html/src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
        <script>
            new TomSelect("#wali_kelas_id", {
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
