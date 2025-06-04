<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApslainController extends Controller
{
    /**
     * Display the Apslain page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('apslain.index');
    }
}
