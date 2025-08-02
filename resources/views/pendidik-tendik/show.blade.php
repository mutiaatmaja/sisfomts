@extends('layouts.app')
@section('content')
    <div class="row gutters-sm mt-3">
        <div class="col-md-4 mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @php
                                $foto = $pendidik->user->foto ?? null;
                            @endphp
                            <img src="{{ $foto ? asset('storage/' . $foto) . '?v=' . filemtime(storage_path('app/public/' . $foto)) : 'https://bootdey.com/img/Content/avatar/avatar7.png' }}"
                                alt="Admin" class="img-thumbnail" width="150">

                            <div class="mt-3">
                                <h4>{{ $pendidik->user->name }}</h4>
                                <p class="text-secondary mb-1">{{ $pendidik->nip ?? 'NIP tidak tersedia' }}</p>
                                <p class="text-muted font-size-sm">{{ $pendidik->nuptk ?? 'NUPTK tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @role('admin')
                    <div class="card mt-3">
                        <div class="text-center my-3">
                            <a href="{{ route('pendidik-tendik.edit', $pendidik->uuid) }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    style="vertical-align:middle; margin-right:4px;">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Edit Data
                            </a>
                        </div>
                    </div>
                @endrole
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">NIK</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pendidik->user->nik ?? 'Tidak tersedia' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">NIP</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pendidik->nip ?? 'Tidak tersedia' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">NUPTK</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pendidik->nuptk ?? 'Tidak tersedia' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Tempat, Tanggal Lahir</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pendidik->user->tempat_lahir ?? 'Tidak tersedia' }},
                            {{ $pendidik->user->tanggal_lahir ? \Carbon\Carbon::parse($pendidik->user->tanggal_lahir)->translatedFormat('d F Y') : 'Tidak tersedia' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pendidik->user->email }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">HP</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pendidik->user->no_hp ?? 'Tidak tersedia' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Alamat</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pendidik->user->alamat ?? 'Tidak tersedia' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            @role('admin')
                                <a href="{{ route('pendidik-tendik.edit', $pendidik->uuid) }}"
                                    class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top"
                                    title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                        </path>
                                    </svg>
                                </a>
                                <form action="{{ route('pendidik-tendik.destroy', $pendidik->uuid) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete bs-tooltip border-0 bg-transparent"
                                        data-toggle="tooltip" data-placement="top" title="Delete"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </form>
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
