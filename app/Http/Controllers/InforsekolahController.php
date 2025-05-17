<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\PendidikTendik;
use App\Models\PesertaDidik;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class InforsekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlah=[
            'siswa' => PesertaDidik::count(),
            'kelas' => Kelas::count(),
            'pendidik' => PendidikTendik::count(),
            'prestasi' => Prestasi::count(),
        ];
        return view('informasi-sekolah.index')->with([
            'jumlah' => $jumlah
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
