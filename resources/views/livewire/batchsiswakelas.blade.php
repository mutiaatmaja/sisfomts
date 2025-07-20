<div>
    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="/" class="btn btn-primary mr-2">Kembali</a>
                @role('admin')
                    <a href="{{ route('kelas.create') }}" class="btn btn-secondary mr-2">Tambah Kelas</a>
                @endrole
                <!-- Button trigger modal -->
            </div>

        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Pindah Kelas Massal</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div class="form-group">
                        <label for="nisnTextarea">NISN yang akan diubah kelas</label>
                        <textarea id="nisnTextarea" class="form-control" rows="4" wire:model.live="nisnyangakandipindah"></textarea>
                        <small class="form-text text-muted">Satu nisn satu baris</small>
                    </div>

                    <button type="button" class="btn btn-success mb-3" wire:click="cariSiswa"
                        wire:loading.attr="disabled">
                        <span wire:loading wire:target="cariSiswa" class="spinner-border spinner-border-sm mr-2"
                            role="status" aria-hidden="true"></span>
                        <span wire:loading.remove wire:target="cariSiswa">Cek</span>
                        <span wire:loading wire:target="cariSiswa">Memproses...</span>
                    </button>

                    @if ($hasil)
                        <div class="accordion" x-data="{ open: false }">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0 d-flex align-items-center">
                                        <button type="button" @click="open = !open"
                                            class="btn btn-link text-decoration-none text-reset d-flex align-items-center w-100 justify-content-between">
                                            Table Siswa
                                            @php
                                                $jumlahDitemukan = collect($hasil)->where('ditemukan', true)->count();
                                                $jumlahTidakDitemukan = collect($hasil)
                                                    ->where('ditemukan', false)
                                                    ->count();
                                            @endphp

                                            <div class="d-flex justify-content-end gap-2">
                                                <span class="badge badge-success">{{ $jumlahDitemukan }} siswa
                                                    ditemukan</span>
                                                <span class="badge badge-danger">{{ $jumlahTidakDitemukan }} tidak
                                                    ditemukan</span>
                                            </div>
                                        </button>

                                    </h2>
                                </div>
                                <div x-show="open" x-transition class="card-body border-top">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NISN</th>
                                                <th>Nama Siswa</th>
                                                <th>Kelas Saat Ini</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($hasil as $siswa)
                                                <tr class="{{ $siswa['ditemukan'] ? '' : 'table-danger' }}">
                                                    <td>{{ $siswa['nisn'] }}</td>
                                                    <td>{{ $siswa['nama'] }}</td>
                                                    <td>{{ $siswa['kelas'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="pilihanKelas">Pilihan Kelas</label>
                            <select id="pilihanKelas" class="form-control" wire:model="pilihanKelas">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($semuaKelas as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-success mb-3" wire:click="pindahKelas"
                        wire:loading.attr="disabled">
                        <span wire:loading wire:target="pindahKelas" class="spinner-border spinner-border-sm mr-2"
                            role="status" aria-hidden="true"></span>
                        <span wire:loading.remove wire:target="pindahKelas">Pindahkan Kelas</span>
                        <span wire:loading wire:target="pindahKelas">Memproses...</span>
                    </button>
                    @endif





                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</div>
