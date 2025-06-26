<div>
    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="/" class="btn btn-primary mr-2">Kembali</a>
                {{-- select Pilihan Kelas --}}
                <div class="btn-group mb-2" role="group" aria-label="Basic example">
                    <select class="form-select" id="pilihKelas" wire:model.live="selectedKelas">
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelases as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Tombol Hari ini, Pekan Ini, Bulan Ini --}}
                @if ($selectedKelas)
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button class="btn {{ $selectedWaktu == 'hari_ini' ? 'btn-primary' : 'btn-dark' }}"
                            wire:click="pilihWaktuDitekan('hari_ini')">Hari Ini</button>
                        <button class="btn {{ $selectedWaktu == 'kemarin' ? 'btn-primary' : 'btn-dark' }}"
                            wire:click="pilihWaktuDitekan('kemarin')">Kemarin</button>
                        <button class="btn {{ $selectedWaktu == 'minggu_ini' ? 'btn-primary' : 'btn-dark' }}"
                            wire:click="pilihWaktuDitekan('minggu_ini')">Minggu Ini</button>
                        <button class="btn {{ $selectedWaktu == 'bulan_ini' ? 'btn-primary' : 'btn-dark' }}"
                            wire:click="pilihWaktuDitekan('bulan_ini')">Bulan Ini</button>

                    </div>
                @endif
            </div>

        </div>
        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div wire:loading.delay class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            @if ($selectedWaktu == 'hari_ini')
                <div class="statbox widget box box-shadow box">
                    @if ($selectedKelas)
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Absensi Peserta Didik hari Ini kelas {{ $selectedKelasName }}</h4>
                                </div>

                            </div>
                        </div>
                        @if ($seluruhAbsensi)
                            <div class="widget-content widget-content-area">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablepesertaDidik" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">NISN</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($seluruhAbsensi as $absen)
                                                <tr>
                                                    <td>{{ $absen->pesertaDidik->user->name ?? '' }}</td>
                                                    <td>{{ $absen->pesertaDidik->nis ?? '' }}</td>
                                                    <td>{{ $absen->pesertaDidik->nisn ?? '' }}</td>
                                                    <td>{{ $absen->kelas->nama_kelas }}</td>
                                                    <td>
                                                        @php
                                                            $absensi = $absen->pesertaDidik->absensi->first();
                                                            $status = $absensi->status ?? null;
                                                            $badgeClass = 'secondary';
                                                            $badgeText = $status ?? '-';
                                                            if ($status === 'hadir') {
                                                                $badgeClass = 'success';
                                                            } elseif ($status === 'alpa') {
                                                                $badgeClass = 'danger';
                                                            } elseif ($status === 'ijin') {
                                                                $badgeClass = 'warning';
                                                            } elseif ($status === 'info') {
                                                                $badgeClass = 'info';
                                                            }
                                                        @endphp
                                                        <span class="badge bg-{{ $badgeClass }}">
                                                            {{ ucfirst($badgeText) }}
                                                        </span>
                                                        -
                                                        {{ $absensi?->tanggal ? \Carbon\Carbon::parse($absensi->tanggal)->format('H:i') : '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        @endif
                    @else
                        <div class="widget-content widget-content-area">
                            <div class="alert alert-warning" role="alert">
                                Silakan pilih kelas untuk melihat absensi.
                            </div>
                        </div>
                    @endif

                </div>
            @elseif($selectedWaktu == 'kemarin')
                <div class="statbox widget box box-shadow box">
                    @if ($selectedKelas)
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Rekap Absen {{ $selectedKelasName }}</h4>
                                </div>

                            </div>
                        </div>
                        @if ($seluruhAbsensi)
                            <div class="widget-content widget-content-area">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablepesertaDidik" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">NISN</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($seluruhAbsensi as $absen)
                                                <tr>
                                                    <td>{{ $absen->pesertaDidik->user->name ?? '' }}</td>
                                                    <td>{{ $absen->pesertaDidik->nis ?? '' }}</td>
                                                    <td>{{ $absen->pesertaDidik->nisn ?? '' }}</td>
                                                    <td>{{ $absen->kelas->nama_kelas }}</td>
                                                    <td>
                                                        @php
                                                            $absensi = $absen->pesertaDidik->absensi->first();
                                                            $status = $absensi->status ?? null;
                                                            $badgeClass = 'secondary';
                                                            $badgeText = $status ?? '-';
                                                            if ($status === 'hadir') {
                                                                $badgeClass = 'success';
                                                            } elseif ($status === 'alpa') {
                                                                $badgeClass = 'danger';
                                                            } elseif ($status === 'ijin') {
                                                                $badgeClass = 'warning';
                                                            } elseif ($status === 'info') {
                                                                $badgeClass = 'info';
                                                            }
                                                        @endphp
                                                        <span class="badge bg-{{ $badgeClass }}">
                                                            {{ ucfirst($badgeText) }}
                                                        </span>
                                                        -
                                                        @if ($absensi?->tanggal)
                                                            {{ \Carbon\Carbon::parse($absensi->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                                            <br>
                                                            {{ \Carbon\Carbon::parse($absensi->tanggal)->format('H:i') }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        @endif
                    @else
                        <div class="widget-content widget-content-area">
                            <div class="alert alert-warning" role="alert">
                                Silakan pilih kelas untuk melihat absensi.
                            </div>
                        </div>
                    @endif

                </div>
            @else
                <div class="statbox widget box box-shadow box">
                    @if ($selectedKelas)
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Rekap Absen {{ $selectedKelasName }}</h4>
                                </div>

                            </div>
                        </div>
                        @if ($seluruhAbsensi)
                            <div class="widget-content widget-content-area">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablepesertaDidik" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">NISN</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Hadir</th>
                                                <th scope="col">Sakit</th>
                                                <th scope="col">Ijin</th>
                                                <th scope="col">Alpa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($seluruhAbsensi as $absen)
                                                @php
                                                    $absensi = $absen->pesertaDidik->absensi;

                                                    $hadir = $absensi->where('status', 'hadir')->count();
                                                    $ijin = $absensi->where('status', 'ijin')->count();
                                                    $sakit = $absensi->where('status', 'sakit')->count();
                                                    $alpa = $absensi->where('status', 'alpa')->count();
                                                @endphp

                                                <tr>
                                                    <td>{{ $absen->pesertaDidik->user->name ?? '' }}</td>
                                                    <td>{{ $absen->pesertaDidik->nis }}</td>
                                                    <td>{{ $absen->pesertaDidik->nisn }}</td>
                                                    <td>{{ $absen->kelas->nama_kelas }}</td>
                                                    <td>{{ $hadir }}</td>
                                                    <td>{{ $ijin }}</td>
                                                    <td>{{ $sakit }}</td>
                                                    <td>{{ $alpa }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        @endif
                    @else
                        <div class="widget-content widget-content-area">
                            <div class="alert alert-warning" role="alert">
                                Silakan pilih kelas untuk melihat absensi.
                            </div>
                        </div>
                    @endif

                </div>
            @endif
        </div>
    </div>
</div>
