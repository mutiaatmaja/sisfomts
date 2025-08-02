<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\PesertaDidik;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AnggotaRombel;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;

class AbsenController extends Controller
{
    public function index()
    {
        $absensi = Absensi::latest()->whereDate('tanggal', now())->get();
        return view('absen.index', compact('absensi'));
    }
    public function lihatAbsenKelas(){
        return view('absen.lihatAbsenKelas');
    }
    public function rekam()
    {
        return view('absen.rekam');
    }
    public function rekam2()
    {
        return view('absen.rekam2');
    }
    public function data()
    {
        return DataTables::of(Absensi::query())->toJson();
    }
    public function rekam2proses(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string'
        ]);
        dd($request->all());
        try {
            // Simpan data ke database
            Absensi::create([
                'uuid' => Str::uuid(),
                'peserta_didik_id' => $siswa->id,
                'tanggal' => $now,
                'status' => $status,
                'keterangan' => $keterangan,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }

    }
    public function cetakrekap($kelas, $waktu, $jenis, Request $request)
    {
        $customDate = $request->query('custom_date');

        $seluruhAbsensi = AnggotaRombel::where('kelas_id', $kelas)
            ->when($waktu === 'hari_ini', function ($query) {
                $query->with(['pesertaDidik.absensi' => function ($query) {
                    $query->whereDate('tanggal', Carbon::today());
                }]);
            })
            ->when($waktu === 'kemarin', function ($query) {
                $query->with(['pesertaDidik.absensi' => function ($query) {
                    $query->whereDate('tanggal', Carbon::yesterday());
                }]);
            })
            ->when($waktu === 'minggu_ini', function ($query) {
                $query->with(['pesertaDidik.absensi' => function ($query) {
                    $query->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                }]);
            })
            ->when($waktu === 'bulan_ini', function ($query) {
                $query->with(['pesertaDidik.absensi' => function ($query) {
                    $query->whereMonth('tanggal', Carbon::now()->month)
                        ->whereYear('tanggal', Carbon::now()->year);
                }]);
            })
            ->when($waktu === 'custom_date', function ($query) use ($customDate) {
                $query->with(['pesertaDidik.absensi' => function ($query) use ($customDate) {
                    $query->whereDate('tanggal', Carbon::parse($customDate));
                }]);
            })
            ->get();

        // Get kelas name
        $kelasName = $seluruhAbsensi->first()->kelas->nama_kelas ?? '';

        if ($jenis === 'pdf') {
            $pdf = Pdf::loadView('absen.cetakrekap', compact('seluruhAbsensi', 'kelas', 'waktu', 'jenis', 'kelasName', 'customDate'));
            return $pdf->download('rekap_absensi_' . $kelasName . '_' . $waktu . '.pdf');
        } elseif ($jenis === 'excel') {
            return Excel::download(new AbsensiExport($seluruhAbsensi, $waktu, $kelasName, $customDate), 'rekap_absensi_' . $kelasName . '_' . $waktu . '.xlsx');
        }

        return view('absen.cetakrekap', compact('seluruhAbsensi', 'kelas', 'waktu', 'jenis', 'kelasName', 'customDate'));
    }
}
