<?php

namespace App\Livewire;

use App\Models\Absensi;
use App\Models\Kelas;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\AnggotaRombel;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Ramsey\Uuid\Uuid;

class Rekapabsen extends Component
{
    public $kelasId;
    public $selectedKelas;
    public $selectedKelasName;
    public $selectedWaktu = 'hari_ini';
    public $seluruhAbsensi;
    public $customDate;

    public function mount()
    {
        $this->customDate = Carbon::today()->format('Y-m-d');
    }


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

    public function updatedCustomDate()
    {
        // Validate that the date is not in the future
        if ($this->customDate && Carbon::parse($this->customDate)->isFuture()) {
            $this->customDate = Carbon::today()->format('Y-m-d');
            LivewireAlert::title('Error')->text('Tanggal tidak boleh di masa depan.')->error()->toast()->position('top-end')->show();
            return;
        }

        if ($this->customDate && $this->selectedKelas) {
            $this->selectedWaktu = 'custom_date';
            $this->seluruhAbsensi = AnggotaRombel::where('kelas_id', $this->selectedKelas)
                ->with(['pesertaDidik.absensi' => function ($query) {
                    $query->whereDate('tanggal', Carbon::parse($this->customDate));
                }])
                ->get();
        }
    }
    public function updateStatus($status, $uuid, $siswaId)
    {

        // Validasi input
        if (!in_array($status, ['hadir', 'ijin', 'sakit', 'alpha'])) {
            LivewireAlert::title('Error')->text('Status tidak valid.')->error()->toast()->position('top-end')->show();
            return;
        }

        // Cek apakah UUID sudah ada
        $absensi = Absensi::where('uuid', $uuid)->first();

        if ($absensi) {

            // Jika sudah ada, update status
            $absensi->status = $status;
            $absensi->save();
        } else {
            // Jika belum ada, buat record baru
            Absensi::create([
                'uuid' => Uuid::uuid4(),
                'peserta_didik_id' => $siswaId,
                'status' => $status,
                'tanggal' => Carbon::now(),
                'keterangan' => 'OVERRIDE',
                // Tambahkan field lain yang diperlukan sesuai model Absensi
            ]);
        }
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
            ->when($waktu === 'custom_date', function ($query) {
                if ($this->customDate) {
                    $query->with(['pesertaDidik.absensi' => function ($query) {
                        $query->whereDate('tanggal', Carbon::parse($this->customDate));
                    }]);
                }
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
