@extends('layouts.app')
@section('content')
    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="/" class="btn btn-primary mr-2">Kembali</a>
                <a href="{{ route('absen.rekam') }}" class="btn btn-secondary mr-2">Rekam</a>
            </div>

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
                    @livewire('rekamabsen')
                </div>
            </div>
        </div>
    </div>

@endsection
