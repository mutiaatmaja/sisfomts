<?php

namespace App\Http\Controllers;

use App\Models\PesertaDidik;
use Illuminate\Http\Request;

class VervalController extends Controller
{
    public function vervalNisn($nisn)
    {
        // Cek apakah NISN valid
        if (!preg_match('/^\d{10,12}$/', $nisn)) {
            return response()->view('errors.generic', [
                'exception' => new \Symfony\Component\HttpKernel\Exception\HttpException(
                    400,
                    'NISN tidak valid. Pastikan NISN terdiri dari 10 hingga 12 digit.'
                ),
                'error' => 'NISN tidak valid. Pastikan NISN terdiri dari 10 hingga 12 digit.'
            ], 400);
        }
        else{

            // Jika NISN valid, lanjutkan proses
            // Anda bisa menambahkan logika lain di sini jika diperlukan
            // Misalnya, Anda bisa mencari peserta didik berdasarkan NISN
            // atau melakukan operasi lain yang diperlukan
            // Contoh: mencari peserta didik berdasarkan NISN
            $pesertaDidik = PesertaDidik::where('nisn', $nisn)->first();
            if ($pesertaDidik) {
                return view('verval.siswa', compact('pesertaDidik'));
            } else {
                return redirect()->back()->withErrors(['nisn' => 'NISN tidak ditemukan.']);
            }
        }
        // Tampilkan NISN yang dimasukkan
        // dd($nisn); // Uncomment this line if you want to debug the NISN value
        // Untuk debugging, jika diperlukan
        // Uncomment the line below to see the NISN value
        //

        dd($nisn);
        // Validasi NISN
        $validated = request()->validate([
            'nisn' => 'required|numeric|digits_between:10,12',
        ]);
        dd($validated);

        // Cek apakah NISN sudah terdaftar
        $pesertaDidik = PesertaDidik::where('nisn', $validated['nisn'])->first();

        if ($pesertaDidik) {
            return redirect()->route('peserta-didik.show', $pesertaDidik->id)
                ->with('success', 'NISN ditemukan: ' . $pesertaDidik->nama);
        } else {
            return redirect()->back()->withErrors(['nisn' => 'NISN tidak ditemukan.']);
        }
    }
}
