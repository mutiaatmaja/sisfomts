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
                        <table class="table table-bordered" id="tableLaporan" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">HP</th>
                                    <th scope="col">Tanggal lapor</th>
                                    <th scope="col">Jenis</th>
                                    <th class="text-center" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aduans as $laporan)
                                    <tr>
                                        <td>{{ $laporan->nama_responden }}</td>
                                        <td>{{ $laporan->hp_responden }}</td>
                                        <td>{{ $laporan->created_at->format('d-m-Y H:i') }}</td>
                                        <td>{{ $laporan->tipe_aduan }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('suara-madrasah.show', $laporan->uuid) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                            <form action="{{ route('suara-madrasah.destroy', $laporan->uuid) }}" method="POST" onsubmit="confirmDelete(event)"
                                                class="d-inline">@csrf @method('DELETE')<button type="submit"
                                                    class="btn btn-danger btn-sm">Hapus</button></form>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function confirmDelete(event) {
                event.preventDefault();
                const form = event.target.closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            }
        </script>
        <script>
            $(document).ready(function() {
                $('#tableLaporan').DataTable({
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
