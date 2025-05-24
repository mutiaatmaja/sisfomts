<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesertaDidik;
use App\Models\User;
use App\Imports\Admin\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kelas;
use App\Models\AnggotaRombel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    //
    public function index()
    {
        // Get all PesertaDidik records
        $pesertaDidiks = PesertaDidik::all();
        $kelases = Kelas::all();
        // Pass the data to the view
        return view('pesertadidik.index', compact('pesertaDidiks', 'kelases'));
    }
    public function create()
    {
        $kelases = Kelas::all();
        // Show the form to create a new PesertaDidik
        return view('pesertadidik.form', compact('kelases'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nik' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'nisn' => 'required|string|unique:peserta_didiks,nisn',
            'nis' => 'nullable|string',
            'nis_lokal' => 'nullable|string',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        DB::beginTransaction();

        try {
            // 1. Buat User
            $user = new User([
                'uuid' => (string) Str::uuid(),
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'nik' => $validated['nik'] ?? null,
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'no_hp' => $validated['no_hp'] ?? null,
                'alamat' => preg_replace("/\r\n|\r|\n/", ', ', $validated['alamat'] ?? ''),
                'tempat_lahir' => $validated['tempat_lahir'] ?? null,
                'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
            ]);
            $user->save();
            $user->syncRoles(['siswa']);

            // 2. Buat Peserta Didik
            $pesertaDidik = new PesertaDidik([
                'uuid' => (string) Str::uuid(),
                'user_id' => $user->id,
                'nisn' => $validated['nisn'],
                'nis' => $validated['nis'] ?? null,
                'nis_lokal' => $validated['nis_lokal'] ?? null,
            ]);
            $pesertaDidik->save();

            // 3. Tambahkan ke anggota rombel jika ada kelas_id
            if (!empty($validated['kelas_id'])) {
                AnggotaRombel::create([
                    'kelas_id' => $validated['kelas_id'],
                    'peserta_didik_id' => $pesertaDidik->id,
                ]);
            }

            DB::commit();
            Alert::success('Success', 'Data peserta didik berhasil ditambahkan.');
            return redirect()->route('pesertadidik.index')->with('success', 'Data peserta didik berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()
                ->withErrors([
                    'error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }

    public function edit($id)
    {
        // Find the PesertaDidik by ID
        $pesertaDidik = PesertaDidik::where('uuid', $id)->firstOrFail();
        $kelases = Kelas::all();
        // Show the form to edit the PesertaDidik
        return view('pesertadidik.form', compact('pesertaDidik', 'kelases'));
    }
    public function update(Request $request, $id)
    {

        $pesertaDidik = PesertaDidik::where('uuid', $id)->firstOrFail();
        $user = User::where('id', $pesertaDidik->user_id)->first();
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Add other validation rules as needed
        ]);
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->save();
        $pesertaDidik->nisn = $request->nisn;
        $pesertaDidik->nis = $request->nis;
        $pesertaDidik->nis_lokal = $request->nis_lokal;
        $pesertaDidik->save();
        $anggotaRombel = AnggotaRombel::where('peserta_didik_id', $pesertaDidik->id)->first();
        $anggotaRombel->kelas_id = $request->kelas_id;
        $anggotaRombel->save();
        Alert::success('Success', 'Data peserta didik berhasil diubah.');
        return redirect()->route('pesertadidik.index')->with('success', 'Peserta Didik updated successfully.');
    }
    public function destroy($uuid)
    {
        // Find the PesertaDidik by UUID
        $pesertaDidik = PesertaDidik::where('uuid', $uuid)->firstOrFail();
        $user = User::where('id', $pesertaDidik->user_id)->first();
        // Delete the User associated with the PesertaDidik
        if ($user) {
            $user->delete();
        }
        $pesertaDidik->delete();
        Alert::success('Success', 'Data peserta didik berhasil dihapus.');

        return redirect()->route('pesertadidik.index')->with('success', 'Peserta Didik deleted successfully.');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new SiswaImport(), $request->file('file'));

        return redirect()->back()->with('success', 'Data siswa berhasil diimport');
    }
}
