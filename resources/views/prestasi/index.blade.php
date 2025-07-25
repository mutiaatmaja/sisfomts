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
                    <a href="{{ route('prestasi.create') }}" class="btn btn-secondary mr-2">Tambah Prestasi</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPrestasi">
                        Import Data
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="tambahPrestasi" tabindex="-1" role="dialog"
                        aria-labelledby="tambahPrestasiTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahPrestasiTitle">Prestasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <form id="imporFormPrestasi" method="POST" action="{{ route('admin.prestasi.import') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <h4 class="modal-heading mb-4 mt-2">Import Data</h4>
                                        <p class="modal-text">Pilih file yang akan di Import ke sistem. Gunakan format <a
                                                href="{{ asset('docs/prestasi.xlsx') }}" class="text-bold text-primary">Impor
                                                Prestasi</a>, agar data yang dimasukkan sesuai</p>
                                        <input type="file" class="form-control" name="file" id="formFile" />

                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <button class="btn btn-light-dark" data-bs-dismiss="modal">Batal</button>
                                    <button type="button" id="btnKirimPendidik" onclick="submitImporPrestasi()"
                                        class="btn btn-primary d-flex align-items-center gap-2">
                                        <span id="btnText">Kirim</span>
                                        <div id="spinner" class="spinner-border spinner-border-sm d-none" role="status"
                                            aria-hidden="true"></div>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endrole
            </div>

        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Simple</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablePrestasi" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Peserta Didik</th>
                                    <th scope="col">Prestasi</th>
                                    <th scope="col">Juara</th>
                                    <th scope="col">Tanggal</th>
                                    @role('admin')
                                        <th class="text-center" scope="col"></th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                {{-- populasikan data dari database --}}
                                @foreach ($semuaPrestasi as $prestasi)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="avatar me-2">
                                                    @if ($prestasi->pesertaDidik && $prestasi->pesertaDidik->user->foto)
                                                        <img src="{{ asset('storage/' . $prestasi->pesertaDidik->user->foto) }}"
                                                            alt="Foto Siswa" class="rounded-circle">
                                                    @else
                                                        <img alt="avatar" src="../src/assets/img/profile-7.png"
                                                            class="rounded-circle" />
                                                    @endif

                                                </div>
                                                <div class="media-body align-self-center">
                                                    <h6 class="mb-0">{{ $prestasi->user->name }}</h6>
                                                    <span>{{ $prestasi->pesertaDidik->nisn }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-wrap">{{ $prestasi->prestasi }}</p>
                                            <span class="text-success">Jenjang {{ $prestasi->jenjang }}</span>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $prestasi->peringkat }}</p>
                                            <span class="text-success">{{ $prestasi->tingkat }}</span>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                {{ \Carbon\Carbon::parse($prestasi->tanggal)->locale('id')->isoFormat('D MMMM Y') }}
                                            </p>
                                        </td>
                                        {{-- <td class="text-center">
                                        <span class="badge badge-light-success">Online</span>
                                        </td> --}}
                                        @role('admin')
                                            <td class="text-center">
                                                <div class="action-btns">
                                                    <a href="{{ route('prestasi.show', $prestasi->id) }}"
                                                        class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip"
                                                        data-placement="top" title="View">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-eye">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('prestasi.edit', $prestasi->id) }}"
                                                        class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
                                                        data-placement="top" title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-edit-2">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('prestasi.destroy', $prestasi->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="action-btn btn-delete bs-tooltip border-0 bg-transparent"
                                                            data-toggle="tooltip" data-placement="top" title="Delete"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10"
                                                                    y2="17"></line>
                                                                <line x1="14" y1="11" x2="14"
                                                                    y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endrole
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
                $('#tablePrestasi').DataTable({
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
            function submitImporPrestasi() {
                const btn = document.getElementById('btnKirimPendidik');
                const spinner = document.getElementById('spinner');
                const text = document.getElementById('btnText');

                // Nonaktifkan tombol dan tampilkan spinner
                btn.disabled = true;
                spinner.classList.remove('d-none');
                text.textContent = "Mengirim...";

                // Submit form
                document.getElementById('imporFormPrestasi').submit();
            }
        </script>
    @endpush
@endsection
