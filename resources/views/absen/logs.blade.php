@extends('layouts.app')
@section('content')
    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="{{ route('absen.otomatis.index') }}" class="btn btn-primary mr-2">Kembali</a>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Log Absensi Otomatis</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if(count($logs) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Waktu</th>
                                        <th>Log</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                        <tr>
                                            <td style="width: 200px;">
                                                @php
                                                    // Extract timestamp from log line
                                                    if (preg_match('/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]/', $log, $matches)) {
                                                        echo $matches[1];
                                                    } else {
                                                        echo '-';
                                                    }
                                                @endphp
                                            </td>
                                            <td>
                                                <code style="font-size: 12px;">{{ $log }}</code>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Belum ada log absensi otomatis yang tersedia.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
