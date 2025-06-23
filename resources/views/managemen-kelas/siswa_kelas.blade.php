@extends('layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    @endpush
    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="{{ route('kelas.index') }}" class="btn btn-primary mr-2">Kembali</a>
            </div>
        </div>
        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Daftar Siswa Kelas {{ $kelas->nama_kelas }}</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tableSiswaKelas" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Tempat Lahir</th>
                                    <th scope="col">Tanggal Lahir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesertaDidiks as $pesertaDidik)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="avatar me-2">
                                                    <img alt="avatar"
                                                        src="{{ $pesertaDidik->user->foto
                                                            ? asset('storage/' . $pesertaDidik->user->foto) . '?v=' . filemtime(storage_path('app/public/' . $pesertaDidik->user->foto))
                                                            : asset('src/assets/img/profile-7.png') }}"
                                                        class="rounded-circle" width="40" />
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <h6 class="mb-0">{{ $pesertaDidik->user->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $pesertaDidik->nis }}</td>
                                        <td>{{ $pesertaDidik->nisn }}</td>
                                        <td>{{ $pesertaDidik->user->jenis_kelamin }}</td>
                                        <td>{{ isset($pesertaDidik->user->tempat_lahir) ? ucwords(strtolower($pesertaDidik->user->tempat_lahir)) : '-' }}</td>
                                        <td>
                                            @if(!empty($pesertaDidik->user->tanggal_lahir))
                                                {{ \Carbon\Carbon::parse($pesertaDidik->user->tanggal_lahir)->translatedFormat('d F Y') }}
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
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Buttons + Ekstensi -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <!-- Ekspor ke Excel dan PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableSiswaKelas').DataTable({
                dom: 'Bfrtip', // B = Buttons
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export PDF',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        className: 'btn btn-secondary'
                    },
                    {
                        text: 'Print Rekap KTP',
                        className: 'btn btn-info',
                        action: function ( e, dt, node, config ) {
                            window.open("{{ route('pesertadidik.rekap_ktp', $kelas->id) }}", '_blank');
                        }
                    }
                ]
            });
        });
    </script>
@endpush
