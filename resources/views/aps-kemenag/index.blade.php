@extends('layouts.app')
@section('content')
    <div class="middle-content container-xxl p-0">


        <div class="row layout-top-spacing">
            <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card">
                    <img src="{{ asset('gambarutama/emis.png') }}" style="height: 100px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title mb-3">EMIS</h5>
                        <p class="card-text">GERBANG DATA PENDIDIKAN KEMENTERIAN AGAMA</p>
                        <a href="https://emis.kemenag.go.id/" target="_blank" class="btn btn-secondary mt-3 w-100">Ke Aplikasi</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card">
                    <img src="{{ asset('gambarutama/simpatika.svg') }}" style="height: 100px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title mb-3">SIMPATIKA</h5>
                        <p class="card-text">
                            Pusat Informasi Layanan PTK Kemenag</p>
                        <a href="https://simpatika.kemenag.go.id/" target="_blank" class="btn btn-secondary mt-3 w-100">Ke Aplikasi</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card">
                    <img src="{{ asset('gambarutama/pdum-logo.png') }}" style="height: 100px;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title mb-3">PDUM</h5>
                        <p class="card-text">Pangkalan Data Ujian Madrasah<br /><br /></p>
                        <a href="https://pdum.kemenag.go.id/" target="_blank" class="btn btn-secondary mt-3 w-100">Ke Aplikasi</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card">
                    <img src="{{ asset('gambarutama/pusaka.png') }}" style="height: 100px;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Pusaka</h5>
                        <p class="card-text">Pusaka Kemenag Super Apps<br /><br /></p>
                        <a href="https://pusaka-v3.kemenag.go.id/" target="_blank" class="btn btn-secondary mt-3 w-100">Ke Aplikasi</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card">
                    <img src="{{ asset('gambarutama/absenkemenag.png') }}" style="height: 100px;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Absensi Kemenag</h5>
                        <p class="card-text">Laman Absensi Kemenag<br /><br /></p>
                        <a href="https://absensi.kemenag.go.id/" target="_blank" class="btn btn-secondary mt-3 w-100">Ke Aplikasi</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
