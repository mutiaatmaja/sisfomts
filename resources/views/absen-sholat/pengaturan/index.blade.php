@extends('layouts.app')

@section('content')
    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="{{ route('absen.sholat.index') }}" class="btn btn-primary mr-2" wire:navigate>Kembali</a>
                <a href="{{ route('absen.sholat.pengaturan.create') }}" class="btn btn-secondary mr-2" wire:navigate>Tambah
                    Jam Sholat</a>
            </div>
        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Pengaturan Jam Absen Sholat</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Sholat</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($settings as $setting)
                                    <tr>
                                        <td>{{ $setting->nama_sholat }}</td>
                                        <td>{{ \Carbon\Carbon::parse($setting->jam_mulai)->format('H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($setting->jam_selesai)->format('H:i') }}</td>
                                        <td>
                                            @if ($setting->is_active)
                                                <span class="badge badge-light-success">Aktif</span>
                                            @else
                                                <span class="badge badge-light-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('absen.sholat.pengaturan.edit', $setting->id) }}"
                                                class="btn btn-sm btn-primary" wire:navigate>Edit</a>
                                            <form action="{{ route('absen.sholat.pengaturan.destroy', $setting->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus pengaturan ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pengaturan jam sholat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
