<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsenController extends Controller
{
    public function index()
    {
        $absensi = Absensi::latest()->whereDate('created_at', now())->get();
        return view('absen.index', compact('absensi'));
    }
    public function rekam()
    {
        return view('absen.rekam');
    }
}
