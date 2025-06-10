<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Layananterpadu extends Controller
{
    public function index()
    {
        return view('layanan-terpadu.index');
    }
}
