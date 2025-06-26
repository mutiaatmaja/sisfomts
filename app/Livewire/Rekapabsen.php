<?php

namespace App\Livewire;

use App\Models\Absensi;
use App\Models\Kelas;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\AnggotaRombel;
use Carbon\Carbon;

class Rekapabsen extends Component
{
    public $kelasId;
    public $selectedKelas;
    public $selectedKelasName;
    public $selectedWaktu = 'hari_ini';
    public $seluruhAbsensi;


    public function updatedSelectedKelas()
    {
        $this->selectedKelasName = Kelas::find($this->selectedKelas)->nama_kelas;
        $this->seluruhAbsensi = AnggotaRombel::where('kelas_id', $this->selectedKelas)
            ->with([
                'pesertaDidik.absensi' => function ($query) {
                    $query->whereDate('tanggal', Carbon::today());
                }
            ])
            ->get();
    }
    public function pilihWaktuDitekan($waktu)
    {
        $this->selectedWaktu = $waktu;
        $this->reset('seluruhAbsensi');
        $this->seluruhAbsensi = AnggotaRombel::where('kelas_id', $this->selectedKelas)
            ->when($waktu === 'hari_ini', function ($query) {
                $query->with(['pesertaDidik.absensi' => function ($query) {
                    $query->whereDate('tanggal', Carbon::today());
                }]);
            })
            ->when($waktu === 'kemarin', function ($query) {
                $query->with(['pesertaDidik.absensi' => function ($query) {
                    $query->whereDate('tanggal', Carbon::yesterday());
                }]);
            })
            ->when($waktu === 'minggu_ini', function ($query) {
                $query->with(['pesertaDidik.absensi' => function ($query) {
                    $query->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                }]);
            })
            ->when($waktu === 'bulan_ini', function ($query) {
                $query->with(['pesertaDidik.absensi' => function ($query) {
                    $query->whereMonth('tanggal', Carbon::now()->month)
                        ->whereYear('tanggal', Carbon::now()->year);
                }]);
            })

            ->get();
    }
    public function render()
    {
        $kelases = Kelas::all();
        return view('livewire.rekapabsen')->with([
            'kelases' => $kelases,
        ]);
    }
}
