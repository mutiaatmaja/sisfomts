<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PesertaDidik as Siswa;
use Carbon\Carbon;
use App\Models\Absensi as Absen;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

class Rekamabsen extends Component
{
    public $nisn;
    public $pesan;

    public function cekNisn()
    {
        $siswa = Siswa::where('nisn', $this->nisn)->first();

        if ($siswa) {
            $this->pesan = "Ditemukan: {$siswa->user->name} - {$siswa->nisn}";

            $now = Carbon::now();

            // Cek apakah sudah absen hari ini
            $sudahAbsen = Absen::where('peserta_didik_id', $siswa->id)->whereDate('tanggal', $now->toDateString())->exists();

            if ($sudahAbsen) {
                $this->pesan .= ' — Siswa sudah absen hari ini.';

            }else {

                // Hitung apakah terlambat
                $waktuTerlambat = Carbon::createFromTime(7, 15); // Jam 07:15
                $status = 'hadir';
                $keterangan = null;

                if ($now->gt($waktuTerlambat)) {
                    $keterangan = 'terlambat';
                }

                //Simpan absen
                Absen::create([
                    'uuid' => Str::uuid(),
                    'peserta_didik_id' => $siswa->id,
                    'tanggal' => $now,
                    'status' => $status,
                    'keterangan' => $keterangan,
                ]);

                $this->pesan .= ' — Absen berhasil disimpan.';
            }
        } else {
            $this->pesan = 'NISN tidak ditemukan.';
        }
        $this->nisn = '';
        $this->dispatch('fokuskan-input');
    }
    public function render()
    {
        $absensis = Absen::with('peserta_didik.user')->whereDate('tanggal', Carbon::today())->latest()->take(10)->get();
        return view('livewire.rekamabsen')->with([
            'absensis' => $absensis,
        ]);
    }
}
