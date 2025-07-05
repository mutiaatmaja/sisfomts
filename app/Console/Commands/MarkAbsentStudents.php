<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AbsensiService;
use Carbon\Carbon;

class MarkAbsentStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:mark-absent {--date= : Tanggal untuk pengecekan (format: Y-m-d)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menandai siswa yang belum absen sebagai alpa pada jam 8 pagi';

    /**
     * Execute the console command.
     */
    public function handle(AbsensiService $absensiService)
    {
        $date = $this->option('date') ? Carbon::parse($this->option('date')) : Carbon::today();

        $this->info("Memulai pengecekan absensi untuk tanggal: " . $date->format('Y-m-d'));

        try {
            $results = $absensiService->markAbsentStudents($date);

            $this->info("\nRingkasan:");
            $this->info("- Total siswa: " . $results['total_students']);
            $this->info("- Sudah absen: " . $results['already_absent']);
            $this->info("- Ditandai alpa: " . $results['marked_absent']);

            if (!empty($results['errors'])) {
                $this->warn("\nError yang terjadi:");
                foreach ($results['errors'] as $error) {
                    $this->error("- {$error['student_name']}: {$error['error']}");
                }
            }

        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
