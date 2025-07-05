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
                <a href="/" class="btn btn-primary mr-2">Kembali</a>
                @role('admin')
                    <a href="{{ route('absen.rekam') }}" class="btn btn-secondary mr-2">Rekam</a>
                    <a href="{{ route('absen.rekam2') }}" class="btn btn-secondary mr-2">Rekam-AJAX</a>
                    <a href="{{ route('absen.lihat-absen-kelas') }}" class="btn btn-secondary mr-2">Lihat Rekap</a>
                @endrole
            </div>

        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Absensi Peserta Didik hari Ini</h4>
                        </div>

                    </div>
                </div>

                <div class="widget-content widget-content-area">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 mb-2">
                        {{-- <a href="{{ route('absen.rekam') }}" class="btn btn-rounded btn-outline-dark ">Hari Ini</a>
                        <a href="{{ route('absen.rekam') }}" class="btn btn-rounded btn-outline-dark ">Kemarin</a>
                        <a href="{{ route('absen.rekam') }}" class="btn btn-rounded btn-outline-dark ">Minggu Ini</a>
                        <a href="{{ route('absen.rekam') }}" class="btn btn-rounded btn-outline-dark ">Bulan Ini</a>
                        <button type="button" class="btn btn-rounded btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahPrestasi">
                            Custom
                        </button> --}}

                        <!-- Modal -->
                        <div class="modal fade" id="tambahPrestasi" tabindex="-1" role="dialog"
                            aria-labelledby="tambahPrestasiTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahPrestasiTitle">Melihat Absensi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <form id="imporFormPrestasi" method="POST"
                                        action="{{ route('admin.prestasi.import') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                        <h4 class="modal-heading mb-4 mt-2">Filter Absensi</h4>
                                        <div class="mb-3">
                                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kelas_id" class="form-label">Kelas</label>
                                            <select class="form-select" id="kelas_id" name="kelas_id" required>
                                                <option value="all">Semua</option>
                                                {{-- @foreach($semuaKelas as $kelas)
                                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>

                                        </div>
                                    </form>
                                    <div class="modal-footer">
                                        <button class="btn btn-light-dark" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" id="btnKirimPendidik" onclick="submitImporPrestasi()"
                                            class="btn btn-primary d-flex align-items-center gap-2">
                                            <span id="btnText">Kirim</span>
                                            <div id="spinner" class="spinner-border spinner-border-sm d-none"
                                                role="status" aria-hidden="true"></div>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
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
                                @foreach($absensi as $absen)
                                    <tr>
                                        <td>{{ $absen->peserta_didik->user->name }}</td>
                                        <td>{{ $absen->peserta_didik->nis }}</td>
                                        <td>{{ $absen->peserta_didik->nisn }}</td>
                                        <td>{{ $absen->peserta_didik->kelas->nama_kelas }}</td>
                                        <td>
                                            @if ($absen->keterangan == 'terlambat')
                                            <span class="badge badge-light-danger">TERLAMBAT</span>
                                            @else
                                            <span class="badge badge-light-primary">{{ $absen->keterangan }}</span>
                                        @endif
                                            {{ $absen->created_at->format('H:i:s') }}
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
                $('#tablepesertaDidik').DataTable({
                    dom: 'Bfrtip', // B = Buttons
                    buttons: [{
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
                        }
                    ]
                });
            });
        </script>
        <script>
            function submitImporPendidikTendik() {
                const btn = document.getElementById('btnKirimSiswa');
                const spinner = document.getElementById('spinner');
                const text = document.getElementById('btnText');

                // Nonaktifkan tombol dan tampilkan spinner
                btn.disabled = true;
                spinner.classList.remove('d-none');
                text.textContent = "Mengirim...";

                // Submit form
                document.getElementById('imporFormPesertaDidik').submit();
            }
        </script>
    @endpush
@endsection
