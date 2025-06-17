@extends('layouts.app')
@section('content')
    @push('styles')

    @endpush
    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                @role('admin')
                    <a href="{{ route('osis.create') }}" class="btn btn-primary mr-2">Tambah Pengurus OSIS</a>
                @endrole
            </div>
        </div>

        <div class="col-12">
            @foreach($oses as $periode => $periodOsis)
                <div class="mb-4">
                    <h4 class="mb-3">Periode {{ $periode }}</h4>
                    <div class="row">
                        @foreach($periodOsis as $osis)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('storage/' . $osis->siswa->foto) }}" alt="{{ $osis->siswa->user->name }}"
                                             class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                                        <h5 class="card-title">{{ $osis->siswa->user->name }}</h5>
                                        <p class="card-text">
                                            @php
                                                $badgeClass = match($osis->jabatan) {
                                                    'Ketua OSIS' => 'badge-primary',
                                                    'Wakil Ketua OSIS' => 'badge-info',
                                                    'Sekretaris' => 'badge-success',
                                                    'Bendahara' => 'badge-warning',
                                                    default => 'badge-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">{{ $osis->jabatan }}</span>
                                        </p>
                                        @role('admin')
                                            <div>
                                                <a href="{{ route('osis.edit', $osis->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                                <form action="{{ route('osis.destroy', $osis->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                                </form>
                                            </div>
                                        @endrole
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @push('js')

    @endpush
@endsection
