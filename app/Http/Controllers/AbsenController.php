<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\PesertaDidik;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AbsenController extends Controller
{
    public function index()
    {
        $absensi = Absensi::latest()->whereDate('created_at', now())->get();
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
}
