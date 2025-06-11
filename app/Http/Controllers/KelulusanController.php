<?php

namespace App\Http\Controllers;

use App\Models\PesertaDidik;
use Illuminate\Http\Request;

class KelulusanController extends Controller
{
    public function index()
    {
        $siswa = PesertaDidik::where('status', 'LULUS')->get();
        // Pass the data to the view
        return view('kelulusan.index')->with('pesertaDidiks', $siswa);
    }
}
