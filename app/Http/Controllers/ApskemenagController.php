<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApskemenagController extends Controller
{
    /**
     * Display the Apskemenag page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('aps-kemenag.index');
    }
}
