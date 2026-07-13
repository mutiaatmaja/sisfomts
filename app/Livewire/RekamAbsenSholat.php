<?php

namespace App\Livewire;

use App\Models\AbsensiSholat;
use App\Models\PesertaDidik;
use App\Models\SholatSetting;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class RekamAbsenSholat extends Component
{
    public string $nisn = '';
    public string $pesan = '';
    public bool $pesanError = false;

    /**
     * Cari waktu sholat yang aktif sekarang.
     */
    private function getSholatAktif(): ?SholatSetting
    {
        $now = Carbon::now()->format('H:i:s');

        return SholatSetting::where('is_active', true)
            ->where('jam_mulai', '<=', $now)
            ->where('jam_selesai', '>=', $now)
            ->first();
    }

    public function cekNisn(): void
    {
        $this->pesan = '';
        $this->pesanError = false;

        $this->nisn = trim($this->nisn);

        if (empty($this->nisn)) {
            return;
        }

        // Cari waktu sholat yang aktif saat ini
        $sholatAktif = $this->getSholatAktif();

        if (! $sholatAktif) {
            $this->pesan = 'Tidak ada jadwal sholat yang aktif saat ini.';
            $this->pesanError = true;
            $this->nisn = '';
            LivewireAlert::title('Info')
                ->text('Tidak ada jadwal sholat aktif saat ini.')
                ->warning()
                ->toast()
                ->position('top-end')
                ->show();
            return;
        }

        // Cari siswa berdasarkan NISN
        $siswa = PesertaDidik::with('user')->where('nisn', $this->nisn)->first();

        if (! $siswa) {
            $this->pesan = "NISN \"{$this->nisn}\" tidak ditemukan.";
            $this->pesanError = true;
            $this->nisn = '';
            LivewireAlert::title('Tidak Ditemukan')
                ->text("NISN tidak terdaftar.")
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
            return;
        }

        $today = Carbon::today()->toDateString();

        // Cek apakah sudah absen sholat ini hari ini
        $sudahAbsen = AbsensiSholat::where('peserta_didik_id', $siswa->id)
            ->where('sholat_setting_id', $sholatAktif->id)
            ->where('tanggal', $today)
            ->exists();

        if ($sudahAbsen) {
            $this->pesan = "{$siswa->user->name} sudah absen Sholat {$sholatAktif->nama_sholat} hari ini.";
            $this->pesanError = true;
            $this->nisn = '';
            LivewireAlert::title('Sudah Tercatat')
                ->text("{$siswa->user->name} sudah absen Sholat {$sholatAktif->nama_sholat}.")
                ->info()
                ->toast()
                ->position('top-end')
                ->show();
            return;
        }

        // Simpan absen sholat
        AbsensiSholat::create([
            'uuid' => (string) Str::uuid(),
            'peserta_didik_id' => $siswa->id,
            'sholat_setting_id' => $sholatAktif->id,
            'nama_sholat' => $sholatAktif->nama_sholat,
            'tanggal' => $today,
            'jam_absen' => Carbon::now()->format('H:i:s'),
            'status' => 'hadir',
        ]);

        $this->pesan = "✓ {$siswa->user->name} — Sholat {$sholatAktif->nama_sholat} berhasil dicatat.";
        $this->pesanError = false;
        $this->nisn = '';

        LivewireAlert::title('Berhasil!')
            ->text("{$siswa->user->name} absen Sholat {$sholatAktif->nama_sholat}.")
            ->success()
            ->toast()
            ->position('top-end')
            ->show();
    }

    public function render()
    {
        $sholatAktif = $this->getSholatAktif();

        $riwayat = AbsensiSholat::with('pesertaDidik.user')
            ->whereDate('tanggal', Carbon::today())
            ->latest()
            ->take(15)
            ->get();

        return view('livewire.rekam-absen-sholat', [
            'sholatAktif' => $sholatAktif,
            'riwayat' => $riwayat,
        ]);
    }
}
