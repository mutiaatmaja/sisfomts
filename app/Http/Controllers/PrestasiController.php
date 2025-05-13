<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Admin\PrestasiImport;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semuaPrestasi = Prestasi::all();
        return view('prestasi.index', compact('semuaPrestasi'));
    }
    public function import(Request $request)
    {
        // Validate si request
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        // menjalankan import
        $file = $request->file('file');
        $import = new PrestasiImport();
        Excel::import($import, $file);
        return redirect()->back()->with('success', 'File imported successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
