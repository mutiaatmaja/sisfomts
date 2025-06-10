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
                    <a href="{{ route('suara-madrasah.semua-laporan') }}" class="btn btn-secondary mr-2">Lihat Laporan</a>
                @endrole

            </div>

        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Suara Madrasah</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @php
                        $a = rand(1, 9);
                        $b = rand(1, 9);
                        session(['captcha_answer' => $a + $b, 'captcha_question' => "$a + $b"]);
                    @endphp
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('suara-madrasah.store') }}" method="POST" enctype="multipart/form-data"
                        id="aduanForm">
                        @csrf

                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama_responden" class="form-label">Nama Responden</label>
                                    <input type="text" name="nama_responden" id="nama_responden"
                                        class="form-control @error('nama_responden') is-invalid @enderror"
                                        value="{{ old('nama_responden') }}" required>
                                    @error('nama_responden')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="hp_responden" class="form-label">No. HP Responden</label>
                                    <input type="text" name="hp_responden" id="hp_responden"
                                        class="form-control @error('hp_responden') is-invalid @enderror"
                                        value="{{ old('hp_responden') }}" required>
                                    @error('hp_responden')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="tipe_aduan" class="form-label">Tipe Aduan</label>
                                <select name="tipe_aduan" id="tipe_aduan"
                                    class="form-select @error('tipe_aduan') is-invalid @enderror" required>
                                    <option value="">-- Pilih Tipe Aduan --</option>
                                    <option value="gratifikasi" {{ old('tipe_aduan') == 'gratifikasi' ? 'selected' : '' }}>
                                        Gratifikasi</option>
                                    <option value="pengaduan_masyarakat"
                                        {{ old('tipe_aduan') == 'pengaduan_masyarakat' ? 'selected' : '' }}>Pengaduan
                                        Masyarakat</option>
                                    <option value="whistleblowing"
                                        {{ old('tipe_aduan') == 'whistleblowing' ? 'selected' : '' }}>Whistleblowing
                                    </option>
                                    <option value="kritik_saran"
                                        {{ old('tipe_aduan') == 'kritik_saran' ? 'selected' : '' }}>Kritik / Saran</option>
                                </select>
                                @error('tipe_aduan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="teks_suara" class="form-label">Teks Suara Anda</label>
                                <textarea name="teks_suara" id="teks_suara" rows="3"
                                    class="form-control @error('teks_suara') is-invalid @enderror" placeholder="Tulis ucapan atau narasi...">{{ old('teks_suara') }}</textarea>
                                @error('teks_suara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h5 class="mt-4">Data Terlapor</h5>
                            <div class="mb-3">
                                <label for="apa" class="form-label">Apa kejadian yang akan dilaporkan?</label>
                                <textarea name="apa" id="apa" rows="2" class="form-control @error('apa') is-invalid @enderror" required>{{ old('apa') }}</textarea>
                                @error('apa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="siapa" class="form-label">Siapa yang dilaporkan?</label>
                                <input type="text" name="siapa" id="siapa"
                                    class="form-control @error('siapa') is-invalid @enderror" value="{{ old('siapa') }}"
                                    required>
                                @error('siapa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kapan" class="form-label">Kapan kejadian?</label>
                                    <input type="date" name="kapan" id="kapan"
                                        class="form-control @error('kapan') is-invalid @enderror"
                                        value="{{ old('kapan') }}" required>
                                    @error('kapan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dimana" class="form-label">Di mana kejadian?</label>
                                    <input type="text" name="dimana" id="dimana"
                                        class="form-control @error('dimana') is-invalid @enderror"
                                        value="{{ old('dimana') }}" required>
                                    @error('dimana')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="mengapa" class="form-label">Mengapa kejadian itu terjadi?</label>
                                <textarea name="mengapa" id="mengapa" rows="2" class="form-control @error('mengapa') is-invalid @enderror"
                                    required>{{ old('mengapa') }}</textarea>
                                @error('mengapa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bagaimana" class="form-label">Bagaimana proses kejadiannya?</label>
                                <textarea name="bagaimana" id="bagaimana" rows="2"
                                    class="form-control @error('bagaimana') is-invalid @enderror" required>{{ old('bagaimana') }}</textarea>
                                @error('bagaimana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lampiran" class="form-label">Upload Bukti (foto/audio/video/pdf)</label>
                                <input type="file" name="lampiran" id="lampiran"
                                    class="form-control @error('lampiran') is-invalid @enderror"
                                    accept=".jpg,.jpeg,.png,.gif,.mp3,.mp4,.wav,.pdf">
                                <div class="form-text">Format yang diizinkan: JPG, PNG, MP3, MP4, PDF</div>
                                @error('lampiran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="captcha" class="form-label">Berapa hasil dari:
                                    <strong>{{ session('captcha_question') }}</strong> ?</label>
                                <input type="text" name="captcha" id="captcha"
                                    class="form-control @error('captcha') is-invalid @enderror" required>
                                @error('captcha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary" onclick="showLoading()" id="submitBtn">Kirim Aduan</button>
                        </div>
                    </form>


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




                </div>
            </div>
        </div>
    </div>
@endsection
