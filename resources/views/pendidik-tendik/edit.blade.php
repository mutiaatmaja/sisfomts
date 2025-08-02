@extends('layouts.app')
@section('content')


    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="/pendidik-tendik" class="btn btn-primary mr-2">Kembali</a>
                <!-- Button trigger modal -->

            </div>

        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Edit Pendidik / Tendik</h4>
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
                    <form action="{{ route('pendidik-tendik.update', $pendidik->uuid) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Foto dan Upload di kiri -->
                            <div class="col-md-3 col-12 mb-3 d-flex flex-column align-items-center justify-content-start">
                                @php
                                    $foto = $pendidik->user->foto ?? null;
                                @endphp
                                <img id="preview-foto"
                                    src="{{ $foto ? asset('storage/' . $foto) . '?v=' . filemtime(storage_path('app/public/' . $foto)) : 'https://bootdey.com/img/Content/avatar/avatar7.png' }}"
                                    alt="Foto Pendidik/Tendik" class="rounded mb-2" width="240" height="340"
                                    style="object-fit:cover;">
                                <div class="mb-2 w-100">
                                    <input type="file" class="form-control-file @error('foto') is-invalid @enderror"
                                        id="foto" name="foto" accept="image/*" style="display:none;"
                                        onchange="previewFoto(event)">
                                    <button type="button" class="btn btn-secondary btn-block mb-1"
                                        onclick="document.getElementById('foto').click();">
                                        Browse Foto
                                    </button>
                                    <select id="cameraSelector" class="form-control mb-2">
                                        <option value="user">Kamera Depan</option>
                                        <option value="environment">Kamera Belakang</option>
                                    </select>
                                    <button type="button" class="btn btn-info btn-block" onclick="ambilGambar()">
                                        Ambil Gambar
                                    </button>

                                    @error('foto')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Video untuk kamera, hidden by default -->
                                <video id="video-capture" width="240" height="340" autoplay
                                    style="display:none; border-radius:8px; object-fit:cover; margin-bottom:8px;"></video>
                                <canvas id="canvas-capture" width="240" height="340" style="display:none;"></canvas>
                                <button type="button" id="btn-capture" class="btn btn-success btn-block mb-1"
                                    style="display:none;" onclick="captureFoto()">Ambil Foto</button>
                                <button type="button" id="btn-cancel-capture" class="btn btn-danger btn-block"
                                    style="display:none;" onclick="cancelCapture()">Batal</button>
                            </div>
                            <!-- Form di kanan -->
                            <div class="col-md-9 col-12">
                                <!-- Nama -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name"
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- NIK -->
                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                            id="nik" name="nik"
                                            value="{{ old('nik', $user->nik) }}">
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Jenis Kelamin -->
                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tempat Lahir & Tanggal Lahir -->
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" name="tempat_lahir"
                                            value="{{ old('tempat_lahir', $user->tempat_lahir) }}">
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- NIP & NUPTK -->
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                            id="nip" name="nip"
                                            value="{{ old('nip', $pendidik->nip) }}">
                                        @error('nip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="nuptk" class="form-label">NUPTK</label>
                                        <input type="text"
                                            class="form-control @error('nuptk') is-invalid @enderror" id="nuptk"
                                            name="nuptk"
                                            value="{{ old('nuptk', $pendidik->nuptk) }}">
                                        @error('nuptk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Email -->
                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email"
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Password -->
                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password">
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- No HP -->
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="no_hp" name="no_hp"
                                        value="{{ old('no_hp', $user->no_hp) }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Alamat -->
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tombol Submit -->
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" onclick="showLoading()">
                                        Perbarui
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('foto.js') }}?v={{ filemtime(public_path('foto.js')) }}"></script>
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
