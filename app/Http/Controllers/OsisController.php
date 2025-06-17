<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Osis;
use App\Models\PesertaDidik;

class OsisController extends Controller
{
    public function index()
    {
        $oses = Osis::with(['siswa.user'])->get();
        return view('osis.index', compact('oses'));
    }

    public function update(Request $request, Osis $osis)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jabatan' => 'required|string',
            'periode' => 'required|string'
        ]);

        $osis->update($request->all());

        return redirect()->route('osis.index')
            ->with('success', 'Data pengurus OSIS berhasil diperbarui');
    }

    public function create()
    {
        $siswas = PesertaDidik::with('user')->get();
        return view('osis.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:peserta_didiks,id',
            'jabatan' => 'required|string',
            'periode' => 'required|string'
        ]);

        Osis::create($request->all());

        return redirect()->route('osis.index')
            ->with('success', 'Data pengurus OSIS berhasil ditambahkan');
    }
}
