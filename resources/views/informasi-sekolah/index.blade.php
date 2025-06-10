@extends('layouts.app')
@section('content')
    <div class="row layout-top-spacing">

        <div class="row">
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
    <div class="row ">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
            <div class="col-12 mb-2">
                <div class="widget widget-card-one">
                    <div class="widget-content">

                        <div class="media">
                            <div class="w-img">
                                <img src="{{ asset('gambarutama/logomts.png') }}" alt="avatar">
                            </div>
                            <div class="media-body">
                                <h6>Visi Sekolah</h6>

                            </div>
                        </div>

                        <p>TERWUJUDNYA MADRASAH YANG RELIGIUS, PROFESIONAL, UNGGUL DALAM PRESTASI, BERBASIS RISET, TEKNOLOGI
                            INFORMATIKA, BERBUDAYA LINGKUNGAN BERLANDASKAN IMAN DAN TAQWA</p>

                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="widget widget-card-one">
                    <div class="widget-content">

                        <div class="media">
                            <div class="w-img">
                                <img src="{{ asset('gambarutama/logomts.png') }}" alt="avatar">
                            </div>
                            <div class="media-body">
                                <h6>Sosial Media</h6>

                            </div>
                        </div>

                        <p>
                            <a href="https://www.instagram.com/mtsn1mempawah?igsh=NTc4MTIwNjQ2YQ%3D%3D"
                                class="btn btn-danger position-relative mb-2 w-100" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="me-2" viewBox="0 0 24 24">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"
                                        stroke="currentColor" stroke-width="2" fill="none" />
                                    <circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="2"
                                        fill="none" />
                                    <circle cx="17" cy="7" r="1.5" fill="currentColor" />
                                </svg>
                                <span class="btn-text-inner">Instagram</span>
                            </a>
                            <a href="https://www.youtube.com/@mtsnegeri1mempawah"
                                class="btn btn-danger position-relative mb-2 w-100" style="background-color:#FF0000; border-color:#FF0000;" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="me-2" viewBox="0 0 24 24">
                                    <rect width="24" height="24" fill="none"/>
                                    <path d="M21.8 8.001a2.75 2.75 0 0 0-1.94-1.94C18.2 6 12 6 12 6s-6.2 0-7.86.06a2.75 2.75 0 0 0-1.94 1.94A28.6 28.6 0 0 0 2 12a28.6 28.6 0 0 0 .2 3.999 2.75 2.75 0 0 0 1.94 1.94C5.8 18 12 18 12 18s6.2 0 7.86-.06a2.75 2.75 0 0 0 1.94-1.94A28.6 28.6 0 0 0 22 12a28.6 28.6 0 0 0-.2-3.999zM10 15V9l6 3-6 3z" fill="white"/>
                                </svg>
                                <span class="btn-text-inner">YouTube</span>
                            </a>
                            <a href="https://www.tiktok.com/@mtsnegeri1mempawah?_t=8peII2f6jiC&_r=1"
                                class="btn btn-dark position-relative mb-2 w-100" style="background: #000; border-color: #000;" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="me-2" viewBox="0 0 24 24">
                                    <rect width="24" height="24" fill="none"/>
                                    <path d="M17.5 3A4.5 4.5 0 0 0 13 7.5V17a2.5 2.5 0 1 1-2-2.45V12a4.5 4.5 0 1 0 4.5-4.5h-1V7.5A3.5 3.5 0 0 1 17.5 4h1V3h-1z" fill="#fff"/>
                                </svg>
                                <span class="btn-text-inner">TikTok</span>
                            </a>
                            <a href="https://www.facebook.com/people/MTs-Negeri-1-Mempawah/100095577422471/"
                                class="btn btn-primary position-relative mb-2 w-100" target="_blank" style="background-color:#1877f3; border-color:#1877f3;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="me-2" viewBox="0 0 24 24">
                                    <rect width="24" height="24" fill="none"/>
                                    <path d="M17 2.1H7A4.9 4.9 0 0 0 2.1 7v10A4.9 4.9 0 0 0 7 21.9h5.1v-7.1H9.5v-2.4h2.6V10c0-2.1 1.3-3.2 3.1-3.2.9 0 1.7.1 1.9.1v2.2h-1.3c-1 0-1.2.5-1.2 1.2v1.6h2.5l-.3 2.4h-2.2V21.9H17A4.9 4.9 0 0 0 21.9 17V7A4.9 4.9 0 0 0 17 2.1z" fill="#fff"/>
                                </svg>
                                <span class="btn-text-inner">Facebook</span>
                            </a>
                            <a href="https://mtsn1mempawah.sch.id/"
                                class="btn btn-success position-relative mb-2 w-100" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="me-2" viewBox="0 0 24 24">
                                    <rect width="24" height="24" fill="none"/>
                                    <path d="M12 3l9.5 7.5-1.5 1.5V21h-6v-5h-4v5H4v-9L2.5 10.5z" fill="#fff"/>
                                </svg>
                                <span class="btn-text-inner">Web Resmi</span>
                            </a>
                        </p>

                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-card-one">
                <div class="widget-content">

                    <div class="media">
                        <div class="w-img">
                            <img src="{{ asset('gambarutama/logomts.png') }}" alt="avatar">
                        </div>
                        <div class="media-body">
                            <h6>Misi Sekolah</h6>
                            <p class="meta-date-time">Monday, May 18</p>
                        </div>
                    </div>


                    <ol>
                        <li>Meningkatkan dan mengembangkan pemahaman dan pengamalan nilai-nilai agama;</li>
                        <li>Mengintegrasikan pendidikan agama kedalam seluruh mata pelajaran;</li>
                        <li>Menyelenggarakan kegiatan tahfiz sebagai program unggulan madrasah;</li>
                        <li>Menciptakan suasana agamis dan harmonis dilingkungan madrasah sehingga terbentuk pembiasaan yang
                            religius, disiplin, dan peduli;</li>
                        <li>Meningkatkan dan mengembangkan profesionalisme pendidik dan tenaga kependidikan dalam memberikan
                            pelayanan kepada pesertadidik dan orang tua peserta didik serta masyarakat;</li>
                        <li>Meningkatkan profesionalisme tata kelola dan akuntabilitas pelayanan pendidikan bagi peserta
                            didik dan orang tua peserta didik serta masyarakat;</li>
                        <li>Meningkatkan prestasi akademik dan no akademik melalui kegiatan intrakurikuler maupun
                            ekstrakurikuler;</li>
                        <li>Meningkatkan prestasi akademik yang berwawasan ilmiah melalui kegiatan penelitian;</li>
                        <li>Menciptakan dan mengembangkan suasana belajar berbasis teknologi informatika bagi warga madrasah
                            sehingga tercipta budaya belajar yang efektif dan efisien;</li>
                        <li>Mengembangkan dan mengaplikasikan pembiasaan dalam upaya perilaku mencegah kerusakan alam dan
                            pencemaran lingkungan sebagai budaya dari madrasah;</li>
                        <li>Menciptakan madarasah yang BESTARI (Bersih, Sejuk, Tertib, Aman, Ramah, dan Indah);</li>
                        <li>Membangun kerjasama dan kebersamaan dengan seluruh komponan madarasah dan instansi yang terkait;
                        </li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection
