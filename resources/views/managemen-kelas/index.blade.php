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
                <a href="/kelas/create" class="btn btn-secondary mr-2">Tambah Kelas</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambahPendidikTendik">
                    Import Data
                </button>

                <!-- Modal -->
                <div class="modal fade" id="tambahPendidikTendik" tabindex="-1" role="dialog"
                    aria-labelledby="tambahPendidikTendikTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahPendidikTendikTitle">Pendidik dan Tenaga Pendidik</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                            <form id="imporFormPendidikTendik" method="POST"
                                action="{{ route('admin.pendidik-tendik.import') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <h4 class="modal-heading mb-4 mt-2">Import Data</h4>
                                    <p class="modal-text">Pilih file yang akan di Import ke sistem. Gunakan format <a
                                            href="#" class="text-bold text-primary">Impor Pendidik dan Tenaga
                                            Kependidikan</a>, agar data yang dimasukkan sesuai</p>
                                    <input type="file" class="form-control" name="file" id="formFile" />

                                </div>
                            </form>
                            <div class="modal-footer">
                                <button class="btn btn-light-dark" data-bs-dismiss="modal">Batal</button>
                                <button type="button" onclick="document.getElementById('imporFormPendidikTendik').submit()"
                                    class="btn btn-primary">Kirim</button>
                            </div>

                        </div>
                    </div>
                </div>
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
                        <table class="table table-bordered" id="tableKelas" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Kelas</th>
                                    <th scope="col">Wali Kelas</th>
                                    <th scope="col">Anggota Kelas</th>
                                    <th class="text-center" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $k)
                                    <tr>
                                        <td>{{ $k->nama_kelas }}</td>
                                        <td>{{ $k->wali_kelas->user->name ?? '' }}</td>
                                        <td>
                                            {{ $k->anggota_rombels->count() }} Anggota
                                        </td>
                                        <td class="text-center">
                                            <a href="/kelas/{{ $k->id }}/edit" class="btn btn-primary">Edit</a>
                                            <form action="/kelas/{{ $k->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger confirm-delete">Hapus</button>
                                            </form>
                                        </td>
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
                $('#tableKelas').DataTable({
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
            $(document).on('click', 'button.confirm-delete', function() {
                Swal.fire({
                    title: 'Yakin untuk menghapus?',
                    text: "Data yang dihapus akan hilang selamanya!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus saja !',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent('form').trigger('submit')
                    } else if (result.isDenied) {
                        Swal.fire('dibatalkan', '', 'info')
                    }
                });
            });
        </script>
    @endpush
@endsection
