@extends('layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    @endpush

    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="/" class="btn btn-primary mr-2">Kembali</a>
                <a href="{{ route('absen.otomatis.logs') }}" class="btn btn-info mr-2">Lihat Log</a>
            </div>
        </div>

        <!-- Statistik Absensi -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Statistik Absensi - {{ $today->format('d/m/Y') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @php
                        $persenBelumAbsen = $stats['total_students'] > 0 ? ($stats['belum_absen'] / $stats['total_students']) * 100 : 0;
                        $isHoliday = $persenBelumAbsen >= 80;
                    @endphp

                    @if($isHoliday)
                        <div class="alert alert-warning" role="alert">
                            <h5 class="alert-heading">⚠️ HARI LIBUR OTOMATIS</h5>
                            <p>Lebih dari 80% siswa belum absen ({{ number_format($persenBelumAbsen, 1) }}%), hari ini dianggap libur otomatis.</p>
                            <p class="mb-0">Sistem tidak akan menandai siswa sebagai alpa.</p>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center">
                                <h5 class="text-primary">{{ $stats['total_students'] }}</h5>
                                <p class="text-muted">Total Siswa</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <h5 class="text-success">{{ $stats['hadir'] }}</h5>
                                <p class="text-muted">Hadir</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <h5 class="text-warning">{{ $stats['sakit'] }}</h5>
                                <p class="text-muted">Sakit</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <h5 class="text-info">{{ $stats['izin'] }}</h5>
                                <p class="text-muted">Izin</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <h5 class="text-danger">{{ $stats['alpha'] }}</h5>
                                <p class="text-muted">Alpa</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <h5 class="text-secondary">{{ $stats['belum_absen'] }}</h5>
                                <p class="text-muted">Belum Absen ({{ number_format($persenBelumAbsen, 1) }}%)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pengecekan Manual -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Pengecekan Absensi Otomatis</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{ route('absen.otomatis.run') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date">Tanggal Pengecekan</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                           value="{{ $today->format('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="use_queue" name="use_queue" value="1">
                                        <label class="form-check-label" for="use_queue">
                                            Jalankan sebagai Job (Queue)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-play"></i> Jalankan Pengecekan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Siswa yang Belum Absen -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Siswa yang Belum Absen ({{ $studentsWithoutAbsence->count() }})</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if($studentsWithoutAbsence->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>NISN</th>
                                        <th>Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studentsWithoutAbsence as $student)
                                        <tr>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $student->nisn }}</td>
                                            <td>{{ $student->anggotaRombel->kelas->nama_kelas ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-success">
                            Semua siswa sudah melakukan absensi hari ini!
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Siswa yang Sudah Absen -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Siswa yang Sudah Absen ({{ $studentsWithAbsence->count() }})</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if($studentsWithAbsence->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studentsWithAbsence as $absensi)
                                        <tr>
                                            <td>{{ $absensi->peserta_didik->user->name }}</td>
                                            <td>
                                                @php
                                                    $badgeClass = 'secondary';
                                                    if ($absensi->status === 'hadir') {
                                                        $badgeClass = 'success';
                                                    } elseif ($absensi->status === 'alpha') {
                                                        $badgeClass = 'danger';
                                                    } elseif ($absensi->status === 'izin') {
                                                        $badgeClass = 'info';
                                                    } elseif ($absensi->status === 'sakit') {
                                                        $badgeClass = 'warning';
                                                    }
                                                @endphp
                                                <span class="badge badge-light-{{ $badgeClass }}">{{ strtoupper($absensi->status) }}</span>
                                            </td>
                                            <td>{{ $absensi->tanggal->format('H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Belum ada siswa yang melakukan absensi hari ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                // Auto-refresh setiap 30 detik
                setInterval(function() {
                    location.reload();
                }, 30000);
            });
        </script>
    @endpush
@endsection
