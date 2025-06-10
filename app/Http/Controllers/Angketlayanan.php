<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Angketlayanan extends Controller
{
    public function index()
    {
        return view('angket-layanan.index');
    }
}
