<div>
    <div
        x-data
        x-init="
            // Fokuskan input saat pertama kali di-load
            $nextTick(() => $refs.nisn.focus());

            // Fokuskan input setiap kali nisn berubah
            $watch('$wire.nisn', () => $nextTick(() => $refs.nisn.focus()));
        "
        @fokuskan-input.window="$nextTick(() => $refs.nisn.focus())"
        @click.window="if ($event.target !== $refs.nisn) $nextTick(() => $refs.nisn.focus())"
    >
        <label for="nisn" class="form-label">Scan / Masukkan NISN</label>

        <div class="input-group mb-3">
            <input
                wire:model.live="nisn"
                wire:keydown.enter.prevent="cekNisn"
                wire:loading.attr="disabled"
                x-ref="nisn"
                type="text"
                id="nisn"
                class="form-control"
                placeholder="Scan atau masukkan NISN"
                aria-label="NISN"
                aria-describedby="nisn-addon"
                autofocus
            >

            <span class="input-group-text" id="nisn-addon">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="20" height="20"
                    viewBox="0 0 24 24"
                    fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-loader spin"
                    wire:loading
                    wire:target="cekNisn">
                    <line x1="12" y1="2" x2="12" y2="6"></line>
                    <line x1="12" y1="18" x2="12" y2="22"></line>
                    <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                    <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                    <line x1="2" y1="12" x2="6" y2="12"></line>
                    <line x1="18" y1="12" x2="22" y2="12"></line>
                    <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                    <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                </svg>
            </span>
        </div>

        @if ($pesan)
            <div class="alert {{ Str::startsWith($pesan, 'Ditemukan: ') ? 'alert-success' : 'alert-danger' }}">
                {{ $pesan }}
            </div>
        @endif
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
                                <th scope="col">NISN</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensis as $absen)
                                <tr>
                                    <td>{{ $absen->peserta_didik->user->name }}</td>
                                    <td>{{ $absen->peserta_didik->nisn }}</td>
                                    <td>{{ $absen->peserta_didik->kelas->nama_kelas }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('H:i') }}</td>
                                    <td class="text-center">
                                        @if ($absen->keterangan == 'terlambat')
                                            <span class="badge badge-light-danger">TERLAMBAT</span>
                                            @else
                                            <span class="badge badge-light-primary">Tepat Waktu</span>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</div>