@extends('layouts.app')
@section('content')

    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="/" class="btn btn-primary mr-2">Kembali</a>
                <a href="{{ route('absen.rekam') }}" class="btn btn-secondary mr-2">Rekam</a>
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

                    @livewire('rekamabsen')


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
                        <table class="table table-bordered" id="tablepesertaDidik" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Kelas</th>
                                    <th class="text-center" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $('#nisnForm').on('submit', function(e) {
                e.preventDefault();
                let nisn = $('#nisn').val();

                $.ajax({
                    url: '{{ route('absen.rekam') }}',
                    method: 'POST',
                    data: {
                        nisn: nisn
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#hasil')
                            .removeClass('d-none alert-danger')
                            .addClass('alert-success')
                            .text(response.message);

                        // ✅ Kosongkan input setelah berhasil
                        $('#nisn').val('');
                    },
                    error: function(xhr) {
                        $('#hasil')
                            .removeClass('d-none alert-success')
                            .addClass('alert-danger')
                            .text('Terjadi kesalahan. Silakan coba lagi.');
                            $('#nisn').val('');
                    }
                });
            });
        </script>

    @endpush
@endsection
