<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Suaramadrasah as Aduan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class SuaramadrasahController extends Controller
{
    public function index()
    {
        return view('suara-madrasah.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_responden' => 'nullable|string|max:255',
            'hp_responden' => 'nullable|string|max:20',

            'tipe_aduan' => 'required|in:gratifikasi,pengaduan_masyarakat,whistleblowing,kritik_saran',
            'teks_suara' => 'nullable|string',

            // Data terlapor
            'apa' => 'required|string',
            'siapa' => 'required|string|max:255',
            'kapan' => 'required|date',
            'dimana' => 'required|string',
            'mengapa' => 'required|string',
            'bagaimana' => 'required|string',

            // File upload
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp3,mp4,wav,pdf|max:10240',

            // CAPTCHA
            'captcha' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ((int) $value !== session('captcha_answer')) {
                        $fail('Jawaban captcha salah.');
                    }
                },
            ],
        ]);

        // Simpan file jika ada
        $filePath = null;
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $folder = 'lampiran/' . $request->tipe_aduan;
            $filePath = $file->storeAs($folder, $filename, 'public');
        }

        // Simpan data aduan
        Aduan::create([
            'uuid' => Str::uuid(),
            'nama_responden' => $request->nama_responden,
            'hp_responden' => $request->hp_responden,
            'tipe_aduan' => $request->tipe_aduan,
            'teks_suara' => $request->teks_suara,
            'apa' => $request->apa,
            'siapa' => $request->siapa,
            'kapan' => $request->kapan,
            'dimana' => $request->dimana,
            'mengapa' => $request->mengapa,
            'bagaimana' => $request->bagaimana,
            'lampiran' => $filePath,
        ]);

        // Reset CAPTCHA
        session()->forget('captcha_answer');
        session()->forget('captcha_question');

        return redirect()->back()->with('success', 'Aduan berhasil dikirim. Terima kasih atas partisipasi Anda.');
    }
    public function semualaporan()
    {
        $aduans = Aduan::orderBy('created_at', 'desc')->get();
        return view('suara-madrasah.semualaporan', compact('aduans'));
    }
    public function show($uuid)
    {
        $aduan = Aduan::where('uuid', $uuid)->firstOrFail();
        // Pastikan hanya admin yang bisa melihat detail aduan
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('suara-madrasah.semua-laporan')->with('error', 'Anda tidak memiliki izin untuk melihat detail aduan ini.');
        }
        // Cek apakah aduan ada
        if (!$aduan) {
            return redirect()->route('suara-madrasah.semua-laporan')->with('error', 'Aduan tidak ditemukan.');
        }

        return view('suara-madrasah.show', compact('aduan'));
    }
    public function destroy($uuid)
    {
        $aduan = Aduan::where('uuid', $uuid)->firstOrFail();
        // Pastikan hanya admin yang bisa menghapus aduan
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('suara-madrasah.semua-laporan')->with('error', 'Anda tidak memiliki izin untuk menghapus aduan ini.');
        }
        // Cek apakah aduan ada
        if (!$aduan) {
            return redirect()->route('suara-madrasah.semua-laporan')->with('error', 'Aduan tidak ditemukan.');
        }
        // Pastikan aduan milik pengguna yang sedang login

        // Hapus file lampiran jika ada
        if ($aduan->lampiran) {
            Storage::disk('public')->delete($aduan->lampiran);
        }

        // Hapus data aduan
        $aduan->delete();
        Alert::success('Aduan berhasil dihapus.');

        return redirect()->route('suara-madrasah.semua-laporan')->with('success', 'Aduan berhasil dihapus.');
    }
}
