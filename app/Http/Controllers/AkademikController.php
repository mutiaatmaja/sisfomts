<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkademikController extends Controller
{
    /**
     * Display the Akademik page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('akademik.index');
    }
}
