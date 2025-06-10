<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Formulironline extends Controller
{
    public function index()
    {
        return view('formulir-online.index');
    }
}
