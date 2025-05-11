<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\Admin\PendidikTendikImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PendidikTendik;

class PendidikTendikController extends Controller
{
    public function index()
    {
        // Get all PendidikTendik records
        $pendidikTendiks = PendidikTendik::all();
        // Pass the data to the view
        return view('pendidik-tendik.index', compact('pendidikTendiks'));
    }
    public function import(Request $request)
    {

        // Validate si request
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        // menjalankan import
        $file = $request->file('file');
        $import = new PendidikTendikImport();
        Excel::import($import, $file);
        return redirect()->back()->with('success', 'File imported successfully.');
    }
}
