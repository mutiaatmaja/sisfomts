@extends('layouts.app')

@section('content')
    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="/kesiswaan/absen" class="btn btn-primary mr-2" wire:navigate>Kembali ke Absensi</a>
                @role('admin')
                    <a href="{{ route('absen.sholat.pengaturan.index') }}" class="btn btn-secondary mr-2" wire:navigate>
                        Pengaturan Sholat
                    </a>
                @endrole
            </div>
        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Absen Sholat</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="alert alert-light-primary border border-primary" role="alert">
                        Under Development.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
