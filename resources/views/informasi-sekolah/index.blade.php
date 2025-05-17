@extends('layouts.app')
@section('content')
    <div class="row layout-top-spacing">

        <div class="row mb-2">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-card-five">
                    <div class="widget-content">
                        <div class="account-box">

                            <div class="info-box">
                                <div class="icon">
                                    <span>
                                        <img src="{{ asset('html/src/assets/img/smilingkids.png') }}" alt="money-bag">
                                    </span>
                                </div>

                                <div class="balance-info">
                                    <h6>Jumlah Siswa</h6>
                                    <p>{{ $jumlah['siswa'] }} orang</p>
                                </div>
                            </div>

                            <div class="card-bottom-section">
                                <div></div>
                                <a href="{{ route('pesertadidik.index') }}" class="">Lihat Detil</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-card-five">
                    <div class="widget-content">
                        <div class="account-box">

                            <div class="info-box">
                                <div class="icon">
                                    <span>
                                        <img src="{{ asset('html/src/assets/img/gurucolor.png') }}" alt="money-bag">
                                    </span>
                                </div>

                                <div class="balance-info">
                                    <h6>Jumlah Pendidik & Tendik</h6>
                                    <p>{{ $jumlah['pendidik'] }} orang</p>
                                </div>
                            </div>

                            <div class="card-bottom-section">
                                <div></div>
                                <a href="{{ route('pendidik-tendik.index') }}" class="">Lihat Detil</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-card-five">
                    <div class="widget-content">
                        <div class="account-box">

                            <div class="info-box">
                                <div class="icon">
                                    <span>
                                        <img src="{{ asset('html/src/assets/img/piala.png') }}" alt="money-bag">
                                    </span>
                                </div>

                                <div class="balance-info">
                                    <h6>Prestasi</h6>
                                    <p>{{ $jumlah['prestasi'] }} prestasi</p>
                                </div>
                            </div>

                            <div class="card-bottom-section">
                                <div></div>
                                <a href="{{ route('prestasi.index') }}" class="">Lihat Detil</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Simple</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">




                </div>
            </div>
        </div> --}}
    </div>
@endsection
