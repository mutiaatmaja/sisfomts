<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('gambarutama/logomts.png') }}" class="navbar-logo" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="{{ url('/') }}" class="nav-link"> Mts </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>

        <div class="profile-info">
            <div class="user-info">
                <div class="profile-img">
                    <img src="{{ asset('gambarutama/logomts.png') }}" alt="avatar">
                </div>
                <div class="profile-content">
                    <h6 class="">{{ Auth::user() ? Auth::user()->name : 'Tamu' }}</h6>
                    <p class="">Selamat Datang</p>
                </div>
            </div>
        </div>

        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ request()->is('/') ? 'active' : '' }}">
                <a href="/" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-home">
                            <path
                                d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V12H9v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2z" />
                        </svg>
                        <span>Beranda</span>
                    </div>
                </a>
            </li>
            @guest
                <li class="menu {{ request()->is('login') ? 'active' : '' }}">
                    <a href="/login" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-log-in">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                <polyline points="10 17 15 12 10 7" />
                                <line x1="15" y1="12" x2="3" y2="12" />
                            </svg>
                            <span>Login</span>
                        </div>
                    </a>
                </li>
            @endguest


            @role('admin-backend')
                <li class="menu menu-heading">
                    <div class="heading">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-minus">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg><span>ADMIN</span>
                    </div>
                </li>
                <li class="menu {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="/admin/dashboard" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" ...> <!-- ikon dashboard -->
                                <path d="M3 13h8V3H3v10zm10 8h8v-6h-8v6zM3 21h8v-6H3v6zM13 3v6h8V3h-8z" />
                            </svg>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </li>

                <li class="menu {{ request()->is('admin/users') ? 'active' : '' }}">
                    <a href="/admin/users" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" ...> <!-- ikon users -->
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 00-3-3.87" />
                                <path d="M16 3.13a4 4 0 010 7.75" />
                            </svg>
                            <span>Manajemen Pengguna</span>
                        </div>
                    </a>
                </li>

                <li class="menu {{ request()->is('admin/roles') ? 'active' : '' }}">
                    <a href="/admin/roles" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" ...> <!-- ikon shield -->
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg>
                            <span>Hak Akses & Peran</span>
                        </div>
                    </a>
                </li>

                <li class="menu {{ request()->is('admin/logs') ? 'active' : '' }}">
                    <a href="/admin/logs" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" ...> <!-- ikon file-text -->
                                <path
                                    d="M9 12h6M9 16h6M5 8h14M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2z" />
                            </svg>
                            <span>Log Aktivitas</span>
                        </div>
                    </a>
                </li>

                <li class="menu {{ request()->is('admin/settings') ? 'active' : '' }}">
                    <a href="/admin/settings" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" ...> <!-- ikon settings -->
                                <circle cx="12" cy="12" r="3" />
                                <path
                                    d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06a1.65 1.65 0 001.82.33h.09a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51h.09a1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82v.09a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
                            </svg>
                            <span>Pengaturan Sistem</span>
                        </div>
                    </a>
                </li>
            @endrole
            {{-- MULAI MENU --}}

            <li class="menu {{ request()->is('informasi-sekolah') ? 'active' : '' }}">
                <a href="/informasi-sekolah" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-info">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="16" x2="12" y2="12" />
                            <line x1="12" y1="8" x2="12" y2="8" />
                        </svg>
                        <span>Informasi Sekolah</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->is('kesiswaan*') ? 'active' : '' }}">
                <a href="#kesiswaan" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        <span>Kesiswaan</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ request()->is('kesiswaan*') ? 'show' : '' }}"
                    id="kesiswaan" data-bs-parent="#accordionExample">
                    <li class="{{ request()->is('kesiswaan/peserta-didik') ? 'active' : '' }}"">
                        <a href="/kesiswaan/peserta-didik"> Peserta Didik </a>
                    </li>
                    <li class="{{ request()->is('kesiswaan/kelas') ? 'active' : '' }}"">
                        <a href="/kesiswaan/kelas"> Kelas </a>
                    </li>
                    <li class="{{ request()->is('kesiswaan/absen') ? 'active' : '' }}"">
                        <a href="/kesiswaan/absen"> Absensi </a>
                    </li>
                    <li class="{{ request()->is('kesiswaan/prestasi') ? 'active' : '' }}"">
                        <a href="/kesiswaan/prestasi"> Prestasi </a>
                    </li>
                    <li class="{{ request()->is('kesiswaan/osis') ? 'active' : '' }}"">
                        <a href="/kesiswaan/osis"> OSIS </a>
                    </li>
                    <li class="{{ request()->is('kesiswaan/kelulusan') ? 'active' : '' }}"">
                        <a href="/kesiswaan/kelulusan"> Pengumuman Kelulusan </a>
                    </li>
                </ul>
            </li>
            <li class="menu {{ request()->is('kepegawaian*') ? 'active' : '' }}">
                <a href="#kepegawaian" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-briefcase">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                            <path d="M16 3H8v4h8V3z" />
                        </svg>
                        <span>Kepegawaian</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ request()->is('kepegawaian*') ? 'show' : '' }}"
                    id="kepegawaian" data-bs-parent="#accordionExample">
                    <li class="{{ request()->is('kepegawaian/pendidik-tendik') ? 'active' : '' }}"">
                        <a href="/kepegawaian/pendidik-tendik"> PTK </a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ request()->is('zona-integritas') ? 'active' : '' }}">
                <a href="/zona-integritas" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-shield">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                        <span>Zona Integritas</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->is('zona-integritas') ? 'active' : '' }}">
                <a href="/zona-integritas" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-square">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        </svg>
                        <span>Suara Madrasah</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->is('aplikasi-kemenag') ? 'active' : '' }}">
                <a href="/aplikasi-kemenag" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <img src="{{ asset('gambarutama/depag.png') }}" alt="Suara Madrasah"
                            style="width: 24px; height: 24px; margin-right: 8px;">
                        <span>Aplikasi Kemenag</span>
                    </div>
                </a>
            </li>
            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Layanan</span>
                </div>
            </li>
            <li class="menu {{ request()->is('akademik') ? 'active' : '' }}">
                <a href="/akademik" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-trello">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <rect x="7" y="7" width="3" height="9"></rect>
                            <rect x="14" y="7" width="3" height="5"></rect>
                        </svg>
                        <span> Akademik</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->is('administratif*') ? 'active' : '' }}">
                <a href="#administratif" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        <span> Administratif</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ request()->is('administratif*') ? 'show' : '' }}"
                    id="administratif" data-bs-parent="#accordionExample">
                    <li class="{{ request()->is('administratif/spmb') ? 'active' : '' }}"">
                        <a href="/administratif/spmb"> SPMB </a>
                    </li>
                    <li class="{{ request()->is('administratif/formulir') ? 'active' : '' }}"">
                        <a href="/administratif/formulir"> Formulir Online </a>
                    </li>
                    <li class="{{ request()->is('administratif/angket') ? 'active' : '' }}"">
                        <a href="/administratif/angket"> Angket Layanan </a>
                    </li>
                    <li class="{{ request()->is('administratif/terpadu') ? 'active' : '' }}"">
                        <a href="/administratif/terpadu"> Layanan Terpadu </a>
                    </li>
                </ul>
            </li>
            <li class="menu {{ request()->is('aplikasi-lain') ? 'active' : '' }}">
                <a href="/aplikasi-lain" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-terminal">
                            <polyline points="4 17 10 11 4 5"></polyline>
                            <line x1="12" y1="19" x2="20" y2="19"></line>
                        </svg>
                        <span>Aplikasi Lain</span>
                    </div>
                </a>
            </li>



            {{--
                <li class="menu {{ request()->is('alumni-sekolah/*') ? 'active' : '' }}">
                    <a href="/alumni-sekolah" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-award">
                                <circle cx="12" cy="8" r="7" />
                                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" />
                            </svg>
                            <span>Alumni Sekolah</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ request()->is('sarana-prasarana/*') ? 'active' : '' }}">
                    <a href="/sarana-prasarana" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                                <path
                                    d="M21 16V8a2 2 0 0 0-1-1.73L13 2.27a2 2 0 0 0-2 0L4 6.27A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.73z" />
                            </svg>
                            <span>Sarana & Prasarana</span>
                        </div>
                    </a>
                </li>
            --}}


            {{-- AKHIR MENU --}}


        </ul>

    </nav>

</div>
