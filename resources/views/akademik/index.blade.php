@extends('layouts.app')
@section('content')
    <div class="middle-content container-xxl p-0">


        <div class="row layout-top-spacing">
            <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card">
                    <img src="{{ asset('gambarutama/Elearning.png') }}"  class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title mb-3">E-Learning</h5>
                        <p class="card-text">GERBANG DATA PENDIDIKAN KEMENTERIAN AGAMA</p>
                        <a href="https://simpatika.kemenag.go.id/" target="_blank" class="btn btn-secondary mt-3">Ke Aplikasi</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card">
                    <img src="{{ asset('gambarutama/cbt.png') }}"  class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title mb-3">CBT</h5>
                        <p class="card-text">
                            Computer Base Test</p>
                        <a href="https://cbt.mtsn1mempawah.sch.id/" target="_blank" class="btn btn-secondary mt-3">Ke Aplikasi</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card">
                    <img src="{{ asset('gambarutama/rdm.png') }}"  class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title mb-3">RDM</h5>
                        <p class="card-text">Rapor Digital Madrasah</p>
                        <a href="https://rdm.mtsn1mempawah.sch.id/" target="_blank" class="btn btn-secondary mt-3">Ke Aplikasi</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card">
                    <img src="{{ asset('gambarutama/akmi.png') }}"  class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title mb-3">AKMI</h5>
                        <p class="card-text">Asesmen Kompetensi Madrasah Indonesia<br /><br /></p>
                        <a href="https://portal-akmi.kemenag.go.id/" target="_blank" class="btn btn-secondary mt-3">Ke Aplikasi</a>
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection
