<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\PendidikTendik;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class ManagemenKelasController extends Controller
{
    public function index()
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('managemen-kelas.index')->with([
            'kelas' => Kelas::with('wali_kelas')->get(),
        ]);
    }

    public function create()
    {
        $pendidikTendiks = PendidikTendik::all();
        return view('managemen-kelas.create', compact('pendidikTendiks'));
    }

    public function store(Request $request)
    {

        //validasi
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
            'wali_kelas' => 'required|exists:pendidik_tendiks,id',
        ]);
        // Logic to store the class data
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas_id' => $request->wali_kelas,
        ]);
        Alert::toast('Berhasil Menyimpan kelas '.$request->nama_kelas, 'success');


        return redirect()->route('kelas.index')->with('success', 'Class created successfully.');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $pendidikTendiks = PendidikTendik::all();
        return view('managemen-kelas.edit')->with([
            'kelas' => $kelas,
            'pendidikTendiks' => $pendidikTendiks,
        ]);
    }

    public function update(Request $request, $id)
    {
        //validasi
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $id,
            'wali_kelas' => 'required|exists:pendidik_tendiks,id',
        ]);
        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas_id' => $request->wali_kelas,
        ]);
        Alert::toast('Berhasil Mengupdate kelas '.$request->nama_kelas, 'success');
        // Logic to update the class data
        return redirect()->route('kelas.index')->with('success', 'Class updated successfully.');
    }

    public function destroy($id)
    {
        // Logic to delete the class data
        $kelas = Kelas::findOrFail($id);
        //$kelas->delete();
        Alert::toast('Berhasil Menghapus kelas '.$kelas->nama_kelas, 'success');
        return redirect()->route('kelas.index')->with('success', 'Class deleted successfully.');
    }

    /**
     * Menampilkan seluruh siswa pada kelas tertentu
     * @param int $kelas_id
     * @return \Illuminate\View\View
     */
    public function siswaKelas($kelas_id)
    {
        $kelas = \App\Models\Kelas::with(['wali_kelas.user', 'peserta_didiks.user'])->findOrFail($kelas_id);
        $pesertaDidiks = $kelas->peserta_didiks;
        return view('managemen-kelas.siswa_kelas', compact('kelas', 'pesertaDidiks'));
    }

    /**
     * Export daftar siswa kelas ke PDF
     * @param int $kelas_id
     * @return \Illuminate\Http\Response
     */
    public function exportPdfSiswaKelas($kelas_id)
    {

        $kelas = \App\Models\Kelas::with(['wali_kelas.user', 'peserta_didiks.user'])->findOrFail($kelas_id);
        $pesertaDidiks = $kelas->peserta_didiks;
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('managemen-kelas.pdfktpkelas', compact('kelas', 'pesertaDidiks'))
            ->setPaper('a4', 'landscape');
        return $pdf->stream('daftar_siswa_kelas_' . $kelas->nama_kelas . '.pdf');
    }

    /**
     * Export semua kelas beserta anggotanya ke PDF per kelas, lalu kompres ke ZIP
     * @return \Illuminate\Http\Response
     */
    public function exportPdfSemuaKelas()
    {
        $semuaKelas = \App\Models\Kelas::with(['wali_kelas.user', 'peserta_didiks.user'])->get();
        $zipFileName = 'daftar_siswa_semua_kelas_' . date('Ymd_His') . '.zip';
        $zipPath = storage_path('app/public/' . $zipFileName);
        $pdfPaths = [];
        $zip = new \ZipArchive;
        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            foreach ($semuaKelas as $kelas) {
                $pesertaDidiks = $kelas->peserta_didiks;
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('managemen-kelas.pdfktpkelas', compact('kelas', 'pesertaDidiks'))
                    ->setPaper('a4', 'landscape');
                $pdfFileName = 'kelas_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $kelas->nama_kelas) . '.pdf';
                $pdfPath = storage_path('app/public/' . $pdfFileName);
                file_put_contents($pdfPath, $pdf->output());
                $zip->addFile($pdfPath, $pdfFileName);
                $pdfPaths[] = $pdfPath;
            }
            $zip->close();
        } else {
            return response()->json(['error' => 'Gagal membuat file ZIP'], 500);
        }
        // Hapus file PDF sementara setelah response selesai
        $response = response()->download($zipPath, $zipFileName, [
            'Content-Type' => 'application/zip',
        ])->deleteFileAfterSend(true);
        // Hapus file PDF sementara setelah ZIP dikirim
        register_shutdown_function(function() use ($pdfPaths) {
            foreach ($pdfPaths as $pdfPath) {
                if (file_exists($pdfPath)) {
                    @unlink($pdfPath);
                }
            }
        });
        return $response;
    }
}
