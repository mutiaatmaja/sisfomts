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
        <div class="row mb-2">
            <div class="col-12">
                <label for="nisn" class="form-label">Scan / Masukkan NISN</label>
                <div class="input-group mb-3">
                    <input type="text" id="nisn" class="form-control" placeholder="Scan atau masukkan NISN"
                        aria-label="NISN" aria-describedby="nisn-addon" autofocus>
                    <span class="input-group-text" id="loading-indicator" style="display:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-loader spin">
                            <!-- SVG spinner -->
                        </svg>
                    </span>
                </div>
                <div id="error-message" class="text-danger mt-2" style="display:none;"></div>
                <div id="success-message" class="text-success mt-2" style="display:none;"></div>
            </div>
        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Daftar Kehadiran</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablepesertaDidik" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th>Jam</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

        <script>
            $(document).ready(function() {
                // Inisialisasi DataTable
                var table = $('#tablepesertaDidik').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('absen.data') }}',
                        type: 'GET'
                    },
                    columns: [{
                            data: 'peserta_didik_id',
                            name: 'peserta_didik_id'
                        },
                        {
                            data: 'peserta_didik_id',
                            name: 'peserta_didik_id'
                        },
                        {
                            data: 'peserta_didik_id',
                            name: 'peserta_didik_id'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                    ],
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'excel',
                            className: 'btn btn-success'
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-danger'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-secondary'
                        }
                    ]
                });

                // Fungsi untuk handle submit NISN
                function submitNisn() {
                    const nisn = $('#nisn').val().trim();
                    if (!nisn) {
                        showError('NISN tidak boleh kosong');
                        return;
                    }

                    $('#loading-indicator').show();
                    $('#error-message').hide();
                    $('#success-message').hide();

                    $.ajax({
                        url: '{{ route('absen.rekam2proses') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            nisn: nisn
                        },
                        success: function(response) {
                            $('#nisn').val(''); // Clear input
                            table.ajax.reload(); // Refresh tabel
                            showSuccess('Data berhasil disimpan');
                            $('#nisn').val('').focus(); // Clear input and set focus kembali
                        },
                        error: function(xhr) {
                            let errorMsg = 'Terjadi kesalahan';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                            $('#nisn').val('').focus(); // Clear input and set focus kembali
                            showError(errorMsg);
                        },
                        complete: function() {
                            $('#loading-indicator').hide();
                        }
                    });
                }

                // Event listener untuk tombol Enter
                $('#nisn').on('keypress', function(e) {
                    if (e.which === 13) { // 13 adalah keycode untuk Enter
                        e.preventDefault();
                        submitNisn();
                    }
                });

                // Fungsi untuk menampilkan pesan error
                function showError(message) {
                    $('#error-message').text(message).show();
                    $('#success-message').hide();
                }

                // Fungsi untuk menampilkan pesan sukses
                function showSuccess(message) {
                    $('#success-message').text(message).show();
                    $('#error-message').hide();
                    // Sembunyikan pesan sukses setelah 3 detik
                    setTimeout(() => {
                        $('#success-message').fadeOut();
                    }, 3000);
                }
            });
        </script>
    @endpush
@endsection
