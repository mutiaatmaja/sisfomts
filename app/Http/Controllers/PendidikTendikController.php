<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\Admin\PendidikTendikImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PendidikTendik;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PendidikTendikController extends Controller
{
    public function index()
    {
        // Get all PendidikTendik records
        $pendidikTendiks = PendidikTendik::all();
        // Pass the data to the view
        return view('pendidik-tendik.index', compact('pendidikTendiks'));
    }
    public function create()
    {
        // Show the form to create a new PendidikTendik
        return view('pendidik-tendik.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nik' => 'nullable|unique:users,nik',
            'nip' => 'nullable|unique:pendidik_tendiks,nip',
            'nuptk' => 'nullable|unique:pendidik_tendiks,nuptk',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // 1. Simpan user
            $user = User::create([
                'uuid' => (string) Str::uuid(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'alamat' => preg_replace("/\r\n|\r|\n/", ', ', $request->alamat),
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            $user->syncRoles(['guru']); // atau role sesuai kebutuhan

            // 2. Simpan ke pendidik tendik
            $pendidikTendik = PendidikTendik::create([
                'uuid' => (string) Str::uuid(),
                'user_id' => $user->id,
                'nip' => $request->nip,
                'nuptk' => $request->nuptk,
            ]);

            // Handle foto upload
            if ($request->hasFile('foto')) {
                $fotoFile = $request->file('foto');
                $extension = $fotoFile->getClientOriginalExtension();
                $filename = $pendidikTendik->uuid . '.' . $extension;
                $filenamebackup = $pendidikTendik->nip . '_' . $user->name . '_.' . $extension;
                $fotoPath = $fotoFile->storeAs('foto_pendidik', $filename, 'public');
                $fotoPathbackup = $fotoFile->storeAs('foto_pendidik_nip', $filenamebackup, 'public');
                $user->foto = $fotoPath;
                $user->save();
            }

            DB::commit();
            return redirect()->route('pendidik-tendik.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan data. ' . $e->getMessage()]);
        }
    }
    public function edit(string $uuid)
    {
        // Find the PendidikTendik record by UUID
        $pendidik = PendidikTendik::where('uuid', $uuid)->first();

        if (!$pendidik) {
            return redirect()->route('pendidik-tendik.index')->with('error', 'Pendidik/Tendik not found.');
        }
        // Get the user associated with the PendidikTendik
        $user = User::where('id', $pendidik->user_id)->first();

        if (!$user) {
            return redirect()->route('pendidik-tendik.index')->with('error', 'User not found.');
        }
        // Pass the data to the view
        return view('pendidik-tendik.edit', compact('pendidik', 'user'));

    }
    public function update(Request $request, $uuid)
    {
        $pendidik = PendidikTendik::where('uuid',$uuid)->first();
        if (!$pendidik) {
            return redirect()->route('pendidik-tendik.index')->with('error', 'Pendidik/Tendik not found.');
        }
        // Get the user associated with the PendidikTendik

        $user = $pendidik->user;

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nik' => 'nullable|unique:users,nik,' . $user->id,
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'nip' => 'nullable|unique:pendidik_tendiks,nip,' . $pendidik->id,
            'nuptk' => 'nullable|unique:pendidik_tendiks,nuptk,' . $pendidik->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Update user
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            // Handle foto upload
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                    Storage::disk('public')->delete($user->foto);
                }
                $fotoFile = $request->file('foto');
                $extension = $fotoFile->getClientOriginalExtension();
                $filename = $pendidik->uuid . '.' . $extension;
                $filenamebackup = $pendidik->nip . '_' . $user->name . '_.' . $extension;
                $fotoPath = $fotoFile->storeAs('foto_pendidik', $filename, 'public');
                $fotoPathbackup = $fotoFile->storeAs('foto_pendidik_nip', $filenamebackup, 'public');
                $user->foto = $fotoPath;
                $user->save();
            }

            // Update pendidik
            $pendidik->update([
                'nip' => $request->nip,
                'nuptk' => $request->nuptk,
            ]);

            DB::commit();
            Alert::success('Data berhasil diperbarui', 'Berhasil');

            return redirect()->route('pendidik-tendik.index')
                ->with('success', 'Data pendidik berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {

        // Validate the request
        $request->validate([
            'uuid' => 'required|exists:pendidik_tendiks,uuid',
        ]);
        $pendidik = PendidikTendik::where('uuid', $request->uuid)->first();
        // Delete the associated user
        $user = User::where('id', $pendidik->user_id)->first();
        if ($user) {
            $user->delete();
        }
        // Find the PendidikTendik record

        if (!$pendidik) {
            return redirect()->route('pendidik-tendik.index')->with('error', 'Pendidik/Tendik not found.');
        }
        // Delete the PendidikTendik record
        $pendidik->delete();
        // Redirect back with success message
        return redirect()->route('pendidik-tendik.index')->with('success', 'Pendidik/Tendik deleted successfully.');
    }
    public function show($uuid)
    {

        // Find the pendidik tendik by UUID
        $pendidik = PendidikTendik::where('uuid', $uuid)->firstOrFail();
        // Show the details of the PendidikTendik
        return view('pendidik-tendik.show', compact('pendidik'));
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
