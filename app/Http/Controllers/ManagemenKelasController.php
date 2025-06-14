<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\PendidikTendik;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class ManagemenKelasController extends Controller
{
    public function index()
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('managemen-kelas.index')->with([
            'kelas' => Kelas::with('wali_kelas')->get(),
        ]);
    }

    public function create()
    {
        $pendidikTendiks = PendidikTendik::all();
        return view('managemen-kelas.create', compact('pendidikTendiks'));
    }

    public function store(Request $request)
    {

        //validasi
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
            'wali_kelas' => 'required|exists:pendidik_tendiks,id',
        ]);
        // Logic to store the class data
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas_id' => $request->wali_kelas,
        ]);
        Alert::toast('Berhasil Menyimpan kelas '.$request->nama_kelas, 'success');


        return redirect()->route('kelas.index')->with('success', 'Class created successfully.');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $pendidikTendiks = PendidikTendik::all();
        return view('managemen-kelas.edit')->with([
            'kelas' => $kelas,
            'pendidikTendiks' => $pendidikTendiks,
        ]);
    }

    public function update(Request $request, $id)
    {
        //validasi
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $id,
            'wali_kelas' => 'required|exists:pendidik_tendiks,id',
        ]);
        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas_id' => $request->wali_kelas,
        ]);
        Alert::toast('Berhasil Mengupdate kelas '.$request->nama_kelas, 'success');
        // Logic to update the class data
        return redirect()->route('kelas.index')->with('success', 'Class updated successfully.');
    }

    public function destroy($id)
    {
        // Logic to delete the class data
        $kelas = Kelas::findOrFail($id);
        //$kelas->delete();
        Alert::toast('Berhasil Menghapus kelas '.$kelas->nama_kelas, 'success');
        return redirect()->route('kelas.index')->with('success', 'Class deleted successfully.');
    }
}
