<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        return view('absen.index');
    }
    public function rekam()
    {
        return view('absen.rekam');
    }
}
