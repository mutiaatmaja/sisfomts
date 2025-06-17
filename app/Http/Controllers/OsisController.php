<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Osis;
use App\Models\PesertaDidik;

class OsisController extends Controller
{
    public function index()
    {
        $oses = Osis::with(['siswa.user'])
            ->whereHas('siswa', function($query) {
                $query->where('status', 'aktif');
            })
            ->orderBy('periode', 'desc')
            ->orderBy('order')
            ->get()
            ->groupBy('periode');

        return view('osis.index', compact('oses'));
    }

    public function update(Request $request, Osis $osis)
    {
        $request->validate([
            'siswa_id' => [
                'required',
                'exists:peserta_didiks,id',
                function ($attribute, $value, $fail) {
                    $siswa = PesertaDidik::find($value);
                    if ($siswa && $siswa->status !== 'aktif') {
                        $fail('Siswa yang dipilih harus berstatus aktif.');
                    }
                },
            ],
            'jabatan' => 'required|string',
            'periode' => [
                'required',
                'string',
                'regex:/^\d{4}-\d{4}$/',
                function ($attribute, $value, $fail) use ($request, $osis) {
                    // Check for duplicate important positions
                    $existingPosition = Osis::where('jabatan', $request->jabatan)
                        ->where('periode', $value)
                        ->where('id', '!=', $osis->id)
                        ->first();

                    if ($existingPosition && in_array($request->jabatan, ['Ketua OSIS', 'Wakil Ketua OSIS', 'Sekretaris', 'Bendahara'])) {
                        $fail("Jabatan {$request->jabatan} sudah ada untuk periode ini.");
                    }
                },
            ],
        ]);

        // Set order based on jabatan
        $order = match($request->jabatan) {
            'Ketua OSIS' => 1,
            'Wakil Ketua OSIS' => 2,
            'Sekretaris' => 3,
            'Bendahara' => 4,
            default => 5
        };

        $osis->update([
            'siswa_id' => $request->siswa_id,
            'jabatan' => $request->jabatan,
            'periode' => $request->periode,
            'order' => $order
        ]);

        return redirect()->route('osis.index')
            ->with('success', 'Data pengurus OSIS berhasil diperbarui');
    }

    public function create()
    {
        $siswas = PesertaDidik::with('user')->get();
        return view('osis.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => [
                'required',
                'exists:peserta_didiks,id',
                function ($attribute, $value, $fail) {
                    $siswa = PesertaDidik::find($value);
                    if ($siswa && $siswa->status !== 'aktif') {
                        $fail('Siswa yang dipilih harus berstatus aktif.');
                    }
                },
            ],
            'jabatan' => 'required|string',
            'periode' => [
                'required',
                'string',
                'regex:/^\d{4}-\d{4}$/',
                function ($attribute, $value, $fail) use ($request) {
                    // Check for duplicate important positions
                    $existingPosition = Osis::where('jabatan', $request->jabatan)
                        ->where('periode', $value)
                        ->first();

                    if ($existingPosition && in_array($request->jabatan, ['Ketua OSIS', 'Wakil Ketua OSIS', 'Sekretaris', 'Bendahara'])) {
                        $fail("Jabatan {$request->jabatan} sudah ada untuk periode ini.");
                    }
                },
            ],
        ]);

        // Set order based on jabatan
        $order = match($request->jabatan) {
            'Ketua OSIS' => 1,
            'Wakil Ketua OSIS' => 2,
            'Sekretaris' => 3,
            'Bendahara' => 4,
            default => 5
        };

        Osis::create([
            'siswa_id' => $request->siswa_id,
            'jabatan' => $request->jabatan,
            'periode' => $request->periode,
            'order' => $order
        ]);

        return redirect()->route('osis.index')
            ->with('success', 'Data pengurus OSIS berhasil ditambahkan');
    }

    public function edit(Osis $osis)
    {
        $siswas = PesertaDidik::with('user')->get();
        return view('osis.edit', compact('osis', 'siswas'));
    }

    public function destroy(Osis $osis)
    {
        $osis->delete();
        return redirect()->route('osis.index')
            ->with('success', 'Data pengurus OSIS berhasil dihapus');
    }
}
