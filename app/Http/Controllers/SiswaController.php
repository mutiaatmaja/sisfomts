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
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaController extends Controller
{
    //
    public function index()
    {
        // Get all PesertaDidik records
        $pesertaDidiks = PesertaDidik::where('status', 'aktif')->get();
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
            'status' => 'required|in:AKTIF,KELUAR,LULUS',
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
                'status' => strtoupper($validated['status']),
            ]);
            $pesertaDidik->save();

            // 3. Tambahkan ke anggota rombel jika ada kelas_id
            if (!empty($validated['kelas_id'])) {
                AnggotaRombel::create([
                    'kelas_id' => $validated['kelas_id'],
                    'peserta_didik_id' => $pesertaDidik->id,
                ]);
            }

            // Handle foto upload
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                    Storage::disk('public')->delete($user->foto);
                }
                $fotoFile = $request->file('foto');
                $extension = $fotoFile->getClientOriginalExtension(); // Dapatkan ekstensi file
                $filename = $pesertaDidik->uuid . '.' . $extension; // Gunakan uuid sebagai nama file
                $filenamebackup = $pesertaDidik->nisn . '_'.$user->name.'_.' . $extension; // Backup file
                $fotoPath = $fotoFile->storeAs('foto_siswa', $filename, 'public');
                $fotoPathbackup = $fotoFile->storeAs('foto_siswa_nisn', $filenamebackup, 'public');
                $user->foto = $fotoPath;
                // Jika ingin menyimpan ekstensi saja, bisa: $user->foto_ext = $extension;
                $user->save();
            }


            DB::commit();
            Alert::success('Success', 'Data peserta didik berhasil ditambahkan.');
            return redirect()->route('pesertadidik.index')->with('success', 'Data peserta didik berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()
                ->withErrors([
                    'error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
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
            'status' => 'required|in:AKTIF,KELUAR,LULUS',
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

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $fotoFile = $request->file('foto');
            $extension = $fotoFile->getClientOriginalExtension(); // Dapatkan ekstensi file
            $filename = $pesertaDidik->uuid . '.' . $extension; // Gunakan uuid sebagai nama file
            $filenamebackup = $pesertaDidik->nisn . '_'.$user->name.'_.' . $extension; // Backup file
            $fotoPath = $fotoFile->storeAs('foto_siswa', $filename, 'public');
            $fotoPathbackup = $fotoFile->storeAs('foto_siswa_nisn', $filenamebackup, 'public');
            $user->foto = $fotoPath;
            // Jika ingin menyimpan ekstensi saja, bisa: $user->foto_ext = $extension;
        }
        $user->save();
        $pesertaDidik->nisn = $request->nisn;
        $pesertaDidik->nis = $request->nis;
        $pesertaDidik->nis_lokal = $request->nis_lokal;
        $pesertaDidik->status = strtoupper($request->status);
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
    public function show($uuid)
    {
        // Find the PesertaDidik by UUID
        $pesertaDidik = PesertaDidik::where('uuid', $uuid)->firstOrFail();
        // Show the details of the PesertaDidik
        return view('pesertadidik.show', compact('pesertaDidik'));
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new SiswaImport(), $request->file('file'));

        return redirect()->back()->with('success', 'Data siswa berhasil diimport');
    }
    public function showCard($uuid)
    {
        $pesertaDidik = \App\Models\PesertaDidik::where('uuid', $uuid)->firstOrFail();
        return view('pesertadidik.showCard', compact('pesertaDidik'));
    }
    public function cetakKartu($uuid)
    {
        $pesertaDidik = \App\Models\PesertaDidik::where('uuid', $uuid)->firstOrFail();

        // $pdf = Pdf::loadView('pesertadidik.kartu_pdf', compact('pesertaDidik'));
        // return $pdf->stream('kartu-siswa-'.$pesertaDidik->nisn.'.pdf');
        return view('pesertadidik.kartu_pdf', compact('pesertaDidik'));
    }
    /**
     * Menampilkan seluruh data siswa aktif berdasarkan kelas
     * @param  int  $kelas_id
     * @return \Illuminate\View\View
     */
    public function rekapKtpKelas($kelas_id)
    {
        // Ambil data kelas
        $kelas = \App\Models\Kelas::findOrFail($kelas_id);
        // Ambil semua siswa aktif di kelas tersebut
        $pesertaDidiks = $kelas->peserta_didiks()->where('status', 'AKTIF')->get();
        return view('pesertadidik.rekap_ktp', [
            'kelas' => $kelas->nama_kelas,
            'pesertaDidiks' => $pesertaDidiks,
        ]);
    }
}
