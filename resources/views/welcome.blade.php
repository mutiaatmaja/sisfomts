@extends('layouts.app')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                <img src="{{ asset('src/assets/img/informasisekolah.png') }}" class="card-img-top" alt="...">
                {{-- <div class="card-body px-0 pb-0">
                <h5 class="card-title mb-3">14 Tips to improve your photography</h5>
                <div class="media mt-4 mb-0 pt-1">
                    <img src="{{asset('src/assets/img/profile-5.jpg') }}" class="card-media-image me-3" alt="">
                    <div class="media-body">
                        <h4 class="media-heading mb-1">Shaun Park</h4>
                        <p class="media-text">01 May</p>
                    </div>
                </div>
            </div> --}}
            </a>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="{{ route('absen.index') }}" class="card style-2 mb-md-0 mb-4">
                <img src="{{ asset('src/assets/img/absen_siswa.png') }}" class="card-img-top" alt="...">
                {{-- <div class="card-body px-0 pb-0">
                <h5 class="card-title mb-3">14 Tips to improve your photography</h5>
                <div class="media mt-4 mb-0 pt-1">
                    <img src="{{asset('src/assets/img/profile-5.jpg') }}" class="card-media-image me-3" alt="">
                    <div class="media-body">
                        <h4 class="media-heading mb-1">Shaun Park</h4>
                        <p class="media-text">01 May</p>
                    </div>
                </div>
            </div> --}}
            </a>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="/kelas" class="card style-2 mb-md-0 mb-4">
                <img src="{{ asset('src/assets/img/kelas.png') }}" class="card-img-top" alt="...">
                {{-- <div class="card-body px-0 pb-0">
                <h5 class="card-title mb-3">14 Tips to improve your photography</h5>
                <div class="media mt-4 mb-0 pt-1">
                    <img src="{{asset('src/assets/img/profile-5.jpg') }}" class="card-media-image me-3" alt="">
                    <div class="media-body">
                        <h4 class="media-heading mb-1">Shaun Park</h4>
                        <p class="media-text">01 May</p>
                    </div>
                </div>
            </div> --}}
            </a>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="/peserta-didik" class="card style-2 mb-md-0 mb-4">
                <img src="{{ asset('src/assets/img/peserta_didik.png') }}" class="card-img-top" alt="...">
                {{-- <div class="card-body px-0 pb-0">
                <h5 class="card-title mb-3">14 Tips to improve your photography</h5>
                <div class="media mt-4 mb-0 pt-1">
                    <img src="{{asset('src/assets/img/profile-5.jpg') }}" class="card-media-image me-3" alt="">
                    <div class="media-body">
                        <h4 class="media-heading mb-1">Shaun Park</h4>
                        <p class="media-text">01 May</p>
                    </div>
                </div>
            </div> --}}
            </a>
        </div>
        {{--
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                <img src="{{ asset('src/assets/img/alumni.png') }}" class="card-img-top" alt="...">
                <div class="card-body px-0 pb-0">
                    <h5 class="card-title mb-3">14 Tips to improve your photography</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <img src="{{ asset('src/assets/img/profile-5.jpg') }}" class="card-media-image me-3" alt="">
                        <div class="media-body">
                            <h4 class="media-heading mb-1">Shaun Park</h4>
                            <p class="media-text">01 May</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
         --}}
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="/pendidik-tendik" class="card style-2 mb-md-0 mb-4">
                <img src="{{ asset('src/assets/img/gurudantendik.png') }}" class="card-img-top" alt="...">
                {{-- <div class="card-body px-0 pb-0">
                <h5 class="card-title mb-3">14 Tips to improve your photography</h5>
                <div class="media mt-4 mb-0 pt-1">
                    <img src="{{asset('src/assets/img/profile-5.jpg') }}" class="card-media-image me-3" alt="">
                    <div class="media-body">
                        <h4 class="media-heading mb-1">Shaun Park</h4>
                        <p class="media-text">01 May</p>
                    </div>
                </div>
            </div> --}}
            </a>
        </div>
        {{-- <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="/peserta-didik" class="card style-2 mb-md-0 mb-4">
                <img src="{{ asset('src/assets/img/sarpras.png') }}" class="card-img-top" alt="...">
                <div class="card-body px-0 pb-0">
                <h5 class="card-title mb-3">14 Tips to improve your photography</h5>
                <div class="media mt-4 mb-0 pt-1">
                    <img src="{{asset('src/assets/img/profile-5.jpg') }}" class="card-media-image me-3" alt="">
                    <div class="media-body">
                        <h4 class="media-heading mb-1">Shaun Park</h4>
                        <p class="media-text">01 May</p>
                    </div>
                </div>
            </div>
            </a>
        </div> --}}
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="{{ url('/prestasi') }}" class="card style-2 mb-md-0 mb-4">
                <img src="{{ asset('src/assets/img/prestasi.png') }}" class="card-img-top" alt="...">
                {{-- <div class="card-body px-0 pb-0">
                <h5 class="card-title mb-3">14 Tips to improve your photography</h5>
                <div class="media mt-4 mb-0 pt-1">
                    <img src="{{asset('src/assets/img/profile-5.jpg') }}" class="card-media-image me-3" alt="">
                    <div class="media-body">
                        <h4 class="media-heading mb-1">Shaun Park</h4>
                        <p class="media-text">01 May</p>
                    </div>
                </div>
            </div> --}}
            </a>
        </div>



        {{--
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                <img src="{{asset('src/assets/img/grid-blog-style-1.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body px-0 pb-0">
                    <h5 class="card-title mb-3">The ideal work from home office setup</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <img src="{{asset('src/assets/img/profile-2.jpg') }}" class="card-media-image me-3" alt="">
                        <div class="media-body">
                            <h4 class="media-heading mb-1">Vanessa Kirby</h4>
                            <p class="media-text">02 May</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                <img src="{{asset('src/assets/img/grid-blog-style-3.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body px-0 pb-0">
                    <h5 class="card-title mb-3">Top haunted houses in Great Britain</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <img src="{{asset('src/assets/img/profile-16.jpg') }}" class="card-media-image me-3" alt="">
                        <div class="media-body">
                            <h4 class="media-heading mb-1">Kelly Young</h4>
                            <p class="media-text">10 May</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                <img src="{{asset('src/assets/img/list-blog-style-3.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body px-0 pb-0">
                    <h5 class="card-title mb-3">29 Most Beautiful Places in the World</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <img src="{{asset('src/assets/img/profile-32.jpg') }}" class="card-media-image me-3" alt="">
                        <div class="media-body">
                            <h4 class="media-heading mb-1">Xavier</h4>
                            <p class="media-text">14 May</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                <img src="{{asset('src/assets/img/grid-blog-style-5.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body px-0 pb-0">
                    <h5 class="card-title mb-3">21 Habits of highly productive people</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <img src="{{asset('src/assets/img/profile-2.jpg') }}" class="card-media-image me-3" alt="">
                        <div class="media-body">
                            <h4 class="media-heading mb-1">Vanessa Kirby</h4>
                            <p class="media-text">19 May</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                <img src="{{asset('src/assets/img/masonry-blog-style-3.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body px-0 pb-0">
                    <h5 class="card-title mb-3">9 Reasons why sugar is bad for your health</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <img src="{{asset('src/assets/img/profile-19.png') }}" class="card-media-image me-3" alt="">
                        <div class="media-body">
                            <h4 class="media-heading mb-1">Oscar Garner</h4>
                            <p class="media-text">25 May</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                <img src="{{asset('src/assets/img/grid-blog-style-4.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body px-0 pb-0">
                    <h5 class="card-title mb-3">7 Effective ways to instantly look more faishonable</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <img src="{{asset('src/assets/img/profile-32.jpg') }}" class="card-media-image me-3" alt="">
                        <div class="media-body">
                            <h4 class="media-heading mb-1">Xavier</h4>
                            <p class="media-text">27 May</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
            <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                <img src="{{asset('src/assets/img/masonry-blog-style-4.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body px-0 pb-0">
                    <h5 class="card-title mb-3">How to plan a trip in 7 easy steps</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <img src="{{asset('src/assets/img/profile-9.jpg') }}" class="card-media-image me-3" alt="">
                        <div class="media-body">
                            <h4 class="media-heading mb-1">Daisy Anderson</h4>
                            <p class="media-text">31 May</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    --}}
    </div>
    <div class="row layout-top-spacing">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-card-one">
                <div class="widget-content">

                    <div class="media">
                        <div class="w-img">
                            <img src="{{ asset('src/assets/img/profile-19.png') }}" alt="avatar">
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
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-card-one">
                <div class="widget-content">

                    <div class="media">
                        <div class="w-img">
                            <img src="{{ asset('src/assets/img/profile-19.png') }}" alt="avatar">
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
