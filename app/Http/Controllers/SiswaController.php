<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesertaDidik;
use App\Models\User;
use App\Imports\Admin\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    //
    public function index()
    {
        // Get all PesertaDidik records
        $pesertaDidiks = PesertaDidik::all();
        // Pass the data to the view
        return view('pesertadidik.index', compact('pesertaDidiks'));

    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data siswa berhasil diimport');
    }
}
