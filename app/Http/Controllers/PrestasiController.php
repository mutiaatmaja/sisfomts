<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Admin\PrestasiImport;
use App\Models\PesertaDidik;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semuaPrestasi = Prestasi::all();
        return view('prestasi.index', compact('semuaPrestasi'));
    }
    public function import(Request $request)
    {
        // Validate si request
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        // menjalankan import
        $file = $request->file('file');
        $import = new PrestasiImport();
        Excel::import($import, $file);
        return redirect()->back()->with('success', 'File imported successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //semua siswa
        $pesertaDidiks = PesertaDidik::all();
        return view('prestasi.create', compact('pesertaDidiks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jenjang' => 'nullable|string|max:255',
            'prestasi' => 'nullable|string|max:255',
            'tingkat' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'peringkat' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'peserta_didik_id' => 'nullable|exists:peserta_didiks,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time().'_'.uniqid().'.'.$foto->getClientOriginalExtension();

            $foto->storeAs('prestasi', $fotoName, 'public');
            $validated['foto'] = $fotoName;
        }

        // Simpan data
        Prestasi::create($validated);

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prestasi = Prestasi::with('pesertaDidik.user')->findOrFail($id);
        return view('prestasi.show', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $pesertaDidiks = PesertaDidik::with('user')->get();

        return view('prestasi.edit', compact('prestasi', 'pesertaDidiks'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $prestasi = Prestasi::findOrFail($id);

    $validated = $request->validate([
        'jenjang' => 'nullable|string|max:255',
        'prestasi' => 'nullable|string|max:255',
        'tingkat' => 'nullable|string|max:255',
        'kategori' => 'nullable|string|max:255',
        'peringkat' => 'nullable|string|max:255',
        'tanggal' => 'nullable|date',
        'deskripsi' => 'nullable|string',
        'peserta_didik_id' => 'nullable|exists:peserta_didiks,id',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $fotoName = time().'_'.uniqid().'.'.$foto->getClientOriginalExtension();
        $foto->storeAs('prestasi', $fotoName, 'public');
        $validated['foto'] = $fotoName;
    }

    $prestasi->update($validated);

    return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //hapus prestasi
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->delete();
        //pake alert


        Alert::toast('Berhasil menghapus Prestasi', 'success');
        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
