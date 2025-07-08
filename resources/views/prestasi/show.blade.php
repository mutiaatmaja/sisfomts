@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('prestasi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            @role('admin')
                <a href="{{ route('prestasi.edit', $prestasi->id) }}" class="btn btn-warning mt-3 ms-2">Edit</a>
                <form action="{{ route('prestasi.destroy', $prestasi->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3 ms-2"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                </form>
            @endrole
        </div>
    </div>
    <div class="row layout-top-spacing">

        <div class="col-lg-4 col-12 layout-spacing">
            <div class="card mb-3">
                <div class="card-body text-center">
                    @if ($prestasi->pesertaDidik && $prestasi->pesertaDidik->user->foto)
                        <img src="{{ asset('storage/' . $prestasi->pesertaDidik->user->foto) }}" alt="Foto Siswa"
                            class="img-thumbnail w-50">
                    @else
                        <div class="text-muted">Tidak ada foto siswa</div>
                    @endif
                    <div class="list-group text-center mt-2">
                        <div class="list-group-item text-center">
                            <div>
                                <div class="fw-bold title text-primary">NISN</div>
                                <p class="sub-title mb-0">{{ $prestasi->pesertaDidik->nisn }}</p>
                            </div>
                        </div>

                        <div class="list-group-item text-center">
                            <div>
                                <div class="fw-bold title text-primary">Nama Siswa</div>
                                <p class="sub-title mb-0">{{ $prestasi->pesertaDidik->user->name ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="list-group-item text-center">
                            <div>
                                <div class="fw-bold title text-primary">Kelas</div>
                                <p class="sub-title mb-0">{{ $prestasi->pesertaDidik->kelas->nama_kelas ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Foto Prestasi</div>
                <div class="card-body text-center">
                    @if ($prestasi->foto)
                        <img src="{{ asset('storage/prestasi/' . $prestasi->foto) }}" alt="Foto Prestasi"
                            style="max-width: 200px; height: auto;">
                    @else
                        <div class="text-muted">Tidak ada foto prestasi</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-12 layout-spacing">
            <div class="card">
                <div class="card-header">Detail Prestasi</div>
                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold title text-primary">Jenjang</div>
                                <p class="sub-title mb-0">{{ $prestasi->jenjang }}</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold title text-primary">Prestasi</div>
                                <p class="sub-title mb-0">{{ $prestasi->prestasi }}</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold title text-primary">Tingkat</div>
                                <p class="sub-title mb-0">
                                    <span class="badge bg-{{ $badgeTingkat[$prestasi->tingkat]['color'] ?? 'secondary' }}">
                                        <i
                                            class="fa {{ $badgeTingkat[$prestasi->tingkat]['icon'] ?? 'fa-question' }} me-1"></i>
                                        {{ $prestasi->tingkat }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold title text-primary">Kategori</div>
                                <p class="sub-title mb-0">
                                    <span
                                        class="badge bg-{{ $badgeKategori[$prestasi->kategori] ?? 'secondary' }}">{{ $prestasi->kategori }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold title text-primary">Peringkat</div>
                                <p class="sub-title mb-0">
                                    <span
                                        class="badge bg-{{ $badgePeringkat[$prestasi->peringkat] ?? 'secondary' }}">{{ $prestasi->peringkat }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold title text-primary">Tanggal</div>
                                <p class="sub-title mb-0">
                                    {{ \Carbon\Carbon::parse($prestasi->tanggal)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold title text-primary">Deskripsi</div>
                                <p class="sub-title mb-0">{{ $prestasi->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
