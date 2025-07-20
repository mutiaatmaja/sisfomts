<?php

namespace App\Livewire;

use App\Models\Kelas;
use Livewire\Component;
use App\Models\PesertaDidik;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Batchsiswakelas extends Component
{
    public $nisnyangakandipindah;
    public $hasil;
    public $pilihanKelas;
    public $tidakDitemukan = [];
    public function cariSiswa()
    {
        $lines = preg_split('/\r\n|\r|\n/', $this->nisnyangakandipindah);
        $nisns = collect($lines)
            ->map(fn($item) => trim($item))
            ->filter()
            ->unique();

        // Ambil semua peserta sesuai NISN
        $pesertas = PesertaDidik::with(['user', 'anggotaRombel.kelas'])
            ->whereIn('nisn', $nisns)
            ->get()
            ->keyBy('nisn'); // Supaya mudah dicari berdasarkan NISN

        // Buat hasil akhir, termasuk yang tidak ditemukan
        $this->hasil = $nisns->map(function ($nisn) use ($pesertas) {
            $pd = $pesertas->get($nisn);

            return [
                'nisn' => $nisn,
                'nama' => $pd?->user->name ?? 'Tidak ditemukan',
                'kelas' => $pd?->anggotaRombel->kelas->nama_kelas ?? '-',
                'ditemukan' => $pd ? true : false,
            ];
        });
    }

    public function pindahKelas()
    {
        $this->validate([
            'pilihanKelas' => 'required|exists:kelas,id',
        ]);

        $lines = preg_split('/\r\n|\r|\n/', $this->nisnyangakandipindah);
        $nisns = collect($lines)
            ->map(fn($item) => trim($item))
            ->filter()
            ->unique();

        $pesertas = PesertaDidik::with('anggotaRombel')
            ->whereIn('nisn', $nisns)
            ->get();

        // Pisahkan yang tidak ditemukan
        $ditemukanNisn = $pesertas->pluck('nisn')->all();
        $this->tidakDitemukan = $nisns->diff($ditemukanNisn)->values()->all();

        foreach ($pesertas as $peserta) {
            if ($peserta->anggotaRombel) {
                $peserta->anggotaRombel->update([
                    'kelas_id' => $this->pilihanKelas,
                ]);
            } else {
                // Jika belum punya anggotaRombel, bisa dibuat baru jika perlu
                \App\Models\AnggotaRombel::create([
                    'peserta_didik_id' => $peserta->id,
                    'kelas_id' => $this->pilihanKelas,
                ]);
            }
        }

        LivewireAlert::title('Berhasil!')
            ->text(count($pesertas) . ' siswa berhasil dipindahkan ke kelas baru.')
            ->success()
            ->show();
        $this->reset(['nisnyangakandipindah', 'hasil', 'pilihanKelas', 'tidakDitemukan']);
    }


    public function test()
    {
        dd('Batchsiswakelas component is working!');
    }
    public function render()
    {
        $semuaKelas = Kelas::all();
        return view('livewire.batchsiswakelas')
            ->with([
                'semuaKelas' => $semuaKelas,
            ])
            ->layout('layouts.app');
    }
}
