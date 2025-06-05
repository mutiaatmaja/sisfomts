@extends('layouts.app')
@section('content')


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
                            <h4>{{ isset($pesertaDidik) ? 'Perbarui data ' . $pesertaDidik->user->name : 'Tambah Peserta Didik' }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan!</strong>
                            <ul>
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form
                        action="{{ isset($pesertaDidik) ? route('pesertadidik.update', $pesertaDidik->uuid) : route('pesertadidik.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($pesertaDidik))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <!-- Foto dan Upload di kiri -->
                            <div class="col-md-3 col-12 mb-3 d-flex flex-column align-items-center justify-content-start">
                                @php
                                    $foto = $pesertaDidik->user->foto ?? null;
                                @endphp
                                <img id="preview-foto"
                                    src="{{ $foto ? asset('storage/' . $foto) . '?v=' . filemtime(storage_path('app/public/' . $foto)) : 'https://bootdey.com/img/Content/avatar/avatar7.png' }}"
                                    alt="Foto Peserta Didik" class="rounded mb-2" width="240" height="240"
                                    style="object-fit:cover;">
                                <div class="mb-2 w-100">
                                    <input type="file" class="form-control-file @error('foto') is-invalid @enderror"
                                        id="foto" name="foto" accept="image/*" style="display:none;"
                                        onchange="previewFoto(event)">
                                    <button type="button" class="btn btn-secondary btn-block mb-1"
                                        onclick="document.getElementById('foto').click();">
                                        Browse Foto
                                    </button>
                                    <button type="button" class="btn btn-info btn-block" onclick="ambilGambar()">
                                        Ambil Gambar
                                    </button>
                                    @error('foto')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Video untuk kamera, hidden by default -->
                                <video id="video-capture" width="240" height="240" autoplay
                                    style="display:none; border-radius:8px; object-fit:cover; margin-bottom:8px;"></video>
                                <canvas id="canvas-capture" width="240" height="240" style="display:none;"></canvas>
                                <button type="button" id="btn-capture" class="btn btn-success btn-block mb-1"
                                    style="display:none;" onclick="captureFoto()">Ambil Foto</button>
                                <button type="button" id="btn-cancel-capture" class="btn btn-danger btn-block"
                                    style="display:none;" onclick="cancelCapture()">Batal</button>
                            </div>
                            <!-- Form di kanan -->
                            <div class="col-md-9 col-12">
                                <!-- Nama -->
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama"
                                        value="{{ old('nama', $pesertaDidik->user->name ?? '') }}">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- NIK -->
                                    <div class="col-md-8 col-12 mb-3">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                            id="nik" name="nik"
                                            value="{{ old('nik', $pesertaDidik->user->nik ?? '') }}">
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Jenis Kelamin -->
                                    <div class="col-md-4 col-12 mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L"
                                                {{ old('jenis_kelamin', $pesertaDidik->user->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P"
                                                {{ old('jenis_kelamin', $pesertaDidik->user->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tempat Lahir & Tanggal Lahir -->
                                <div class="row">
                                    <div class="col-md-8 col-12 mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" name="tempat_lahir"
                                            value="{{ old('tempat_lahir', $pesertaDidik->user->tempat_lahir ?? '') }}">
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-12 mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', $pesertaDidik->user->tanggal_lahir ?? '') }}">
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- NISN, NIS, NIS Lokal -->
                                <div class="row">
                                    <div class="col-md-4 col-12 mb-3">
                                        <label for="nisn" class="form-label">NISN</label>
                                        <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                            id="nisn" name="nisn"
                                            value="{{ old('nisn', $pesertaDidik->nisn ?? '') }}">
                                        @error('nisn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-12 mb-3">
                                        <label for="nis" class="form-label">NIS</label>
                                        <input type="text" class="form-control @error('nis') is-invalid @enderror"
                                            id="nis" name="nis"
                                            value="{{ old('nis', $pesertaDidik->nis ?? '') }}">
                                        @error('nis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-12 mb-3">
                                        <label for="nis_lokal" class="form-label">NIS Lokal</label>
                                        <input type="text"
                                            class="form-control @error('nis_lokal') is-invalid @enderror" id="nis_lokal"
                                            name="nis_lokal"
                                            value="{{ old('nis_lokal', $pesertaDidik->nis_lokal ?? '') }}">
                                        @error('nis_lokal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Email -->
                                    <div class="col-md-4 col-12 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email"
                                            value="{{ old('email', $pesertaDidik->user->email ?? '') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Password -->
                                    <div class="col-md-4 col-12 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" {{ isset($pesertaDidik) ? '' : 'required' }}>
                                        @if (isset($pesertaDidik))
                                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                                password.</small>
                                        @endif
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Kelas -->
                                    <div class="col-md-4 col-12 mb-3">
                                        <label for="kelas_id" class="form-label">Kelas </label>
                                        <select class="form-control @error('kelas_id') is-invalid @enderror"
                                            id="kelas_id" name="kelas_id">
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($kelases as $kelas)
                                                <option value="{{ $kelas->id }}"
                                                    {{ old('kelas_id', $pesertaDidik->kelas->id ?? '') == $kelas->id ? 'selected' : '' }}>
                                                    {{ $kelas->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- No HP -->
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="no_hp" name="no_hp"
                                        value="{{ old('no_hp', $pesertaDidik->user->no_hp ?? '') }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Alamat -->
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $pesertaDidik->user->alamat ?? '') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tombol Submit -->
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" onclick="showLoading()">
                                        {{ isset($pesertaDidik) ? 'Update' : 'Simpan' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        // Preview foto dari file input
                        function previewFoto(event) {
                            const input = event.target;
                            if (input.files && input.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('preview-foto').src = e.target.result;
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }

                        // Ambil gambar dari kamera
                        function ambilGambar() {
                            const video = document.getElementById('video-capture');
                            const canvas = document.getElementById('canvas-capture');
                            const preview = document.getElementById('preview-foto');
                            const btnCapture = document.getElementById('btn-capture');
                            const btnCancel = document.getElementById('btn-cancel-capture');
                            // Tampilkan video
                            video.style.display = 'block';
                            btnCapture.style.display = 'block';
                            btnCancel.style.display = 'block';
                            preview.style.display = 'none';
                            canvas.style.display = 'none';

                            // Mulai kamera dengan ukuran sedang (240x240)
                            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                                navigator.mediaDevices.getUserMedia({
                                    video: {
                                        width: 240,
                                        height: 240
                                    }
                                }).then(function(stream) {
                                    video.srcObject = stream;
                                    video.play();
                                });
                            }
                        }

                        function captureFoto() {
                            const video = document.getElementById('video-capture');
                            const canvas = document.getElementById('canvas-capture');
                            const preview = document.getElementById('preview-foto');
                            const context = canvas.getContext('2d');
                            context.drawImage(video, 0, 0, canvas.width, canvas.height);
                            // Stop kamera
                            if (video.srcObject) {
                                video.srcObject.getTracks().forEach(track => track.stop());
                            }
                            // Tampilkan hasil
                            canvas.style.display = 'none';
                            preview.src = canvas.toDataURL('image/png');
                            preview.style.display = 'block';
                            video.style.display = 'none';
                            document.getElementById('btn-capture').style.display = 'none';
                            document.getElementById('btn-cancel-capture').style.display = 'none';

                            // Simpan data ke input file (opsional, jika ingin upload hasil capture)
                            // Konversi dataURL ke file dan set ke input file
                            dataURLtoFile(canvas.toDataURL('image/png'), 'capture.png').then(function(file) {
                                let dataTransfer = new DataTransfer();
                                dataTransfer.items.add(file);
                                document.getElementById('foto').files = dataTransfer.files;
                            });
                        }

                        function cancelCapture() {
                            const video = document.getElementById('video-capture');
                            const preview = document.getElementById('preview-foto');
                            const canvas = document.getElementById('canvas-capture');
                            video.style.display = 'none';
                            document.getElementById('btn-capture').style.display = 'none';
                            document.getElementById('btn-cancel-capture').style.display = 'none';
                            preview.style.display = 'block';
                            canvas.style.display = 'none';
                            // Stop kamera
                            if (video.srcObject) {
                                video.srcObject.getTracks().forEach(track => track.stop());
                            }
                        }

                        // Helper: convert dataURL to File
                        function dataURLtoFile(dataurl, filename) {
                            return fetch(dataurl)
                                .then(res => res.arrayBuffer())
                                .then(buf => new File([buf], filename, {
                                    type: 'image/png'
                                }));
                        }
                    </script>







                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            function showLoading() {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        </script>
    @endpush


@endsection
