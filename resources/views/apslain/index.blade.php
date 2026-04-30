@extends('layouts.app')

@section('content')

<div class="container-xxl top-space">

    <div class="row g-4">

        {{-- VERVAL PD --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card app-card h-100">

                <div class="card-image">
                    <img src="{{ asset('gambarutama/rumahpendidikan.png') }}" alt="VERVAL PD">
                </div>

                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">VERVAL PD</h5>
                    <p class="text-muted small flex-grow-1">
                        Rumah Pendidikan
                    </p>

                    <a href="https://sdm.data.kemdikbud.go.id/sys/login?appkey=8CB4A609-CE3C-41E8-B1DB-41589CF96AE5"
                       target="_blank"
                       class="btn btn-primary w-100">
                        Buka Aplikasi
                    </a>
                </div>

            </div>
        </div>

        {{-- SP4N LAPOR --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card app-card h-100">

                <div class="card-image">
                    <img src="{{ asset('gambarutama/lapor.png') }}" alt="SP4N LAPOR">
                </div>

                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">SP4N LAPOR</h5>
                    <p class="text-muted small flex-grow-1">
                        Sistem Pengelolaan Pengaduan Pelayanan Publik
                    </p>

                    <a href="https://www.lapor.go.id/"
                       target="_blank"
                       class="btn btn-primary w-100">
                        Buka Aplikasi
                    </a>
                </div>

            </div>
        </div>

        {{-- SIPPN --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card app-card h-100">

                <div class="card-image">
                    <img src="https://sippn.menpan.go.id/_next/static/media/logo-cariyanlik.cbd92cd9.svg"
                         alt="SIPPN">
                </div>

                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">SIPPN</h5>
                    <p class="text-muted small flex-grow-1">
                        Sistem Informasi Pelayanan Publik Nasional
                    </p>

                    <a href="https://sippn.menpan.go.id/instansi/madrasah-tsanawiyah-negeri-1-mempawah-1881393"
                       target="_blank"
                       class="btn btn-primary w-100">
                        Buka Aplikasi
                    </a>
                </div>

            </div>
        </div>

        {{-- SIMAN --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card app-card h-100">

                <div class="card-image">
                    <img src="{{ asset('gambarutama/siman.png') }}" alt="SIMAN">
                </div>

                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">SIMAN</h5>
                    <p class="text-muted small flex-grow-1">
                        Sistem Manajemen Aset Negara
                    </p>

                    <a href="https://siman.kemenkeu.go.id/login"
                       target="_blank"
                       class="btn btn-primary w-100">
                        Buka Aplikasi
                    </a>
                </div>

            </div>
        </div>

        {{-- SAKTI --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card app-card h-100">

                <div class="card-image">
                    <img src="{{ asset('gambarutama/sakti.png') }}" alt="SAKTI">
                </div>

                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">SAKTI</h5>
                    <p class="text-muted small flex-grow-1">
                        Sistem Aplikasi Keuangan Tingkat Instansi
                    </p>

                    <a href="https://sakti.kemenkeu.go.id/"
                       target="_blank"
                       class="btn btn-primary w-100">
                        Buka Aplikasi
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>


<style>

.top-space{
    margin-top:120px;
}

/* CARD */

.app-card{
    border:none;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
    transition:all .25s ease;
}

.app-card:hover{
    transform:translateY(-6px);
    box-shadow:0 12px 30px rgba(0,0,0,0.12);
}

/* IMAGE */

.card-image{
    width:100%;
    height:140px;
    overflow:hidden;
}

.card-image img{
    width:100%;
    height:100%;
    object-fit:contain;
}

/* TITLE */

.card-title{
    font-weight:600;
}

</style>

@endsection