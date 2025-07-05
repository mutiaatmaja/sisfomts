<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\AbsensiService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MarkAbsentStudentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $date;

    /**
     * Create a new job instance.
     */
    public function __construct($date = null)
    {
        $this->date = $date;
    }

    /**
     * Execute the job.
     */
    public function handle(AbsensiService $absensiService)
    {
        try {
            Log::info("Memulai job pengecekan absensi otomatis", [
                'date' => $this->date ? Carbon::parse($this->date)->format('Y-m-d') : Carbon::today()->format('Y-m-d'),
                'job_id' => $this->job->getJobId()
            ]);

            $results = $absensiService->markAbsentStudents($this->date);

            if (isset($results['holiday']) && $results['holiday']) {
                Log::info("Job pengecekan absensi otomatis - HARI LIBUR", [
                    'results' => $results,
                    'job_id' => $this->job->getJobId(),
                    'holiday_reason' => $results['holiday_reason']
                ]);
            } else {
                Log::info("Job pengecekan absensi otomatis selesai", [
                    'results' => $results,
                    'job_id' => $this->job->getJobId()
                ]);
            }

        } catch (\Exception $e) {
            Log::error("Error dalam job pengecekan absensi otomatis", [
                'error' => $e->getMessage(),
                'job_id' => $this->job->getJobId(),
                'date' => $this->date
            ]);

            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception)
    {
        Log::error("Job pengecekan absensi otomatis gagal", [
            'error' => $exception->getMessage(),
            'job_id' => $this->job->getJobId(),
            'date' => $this->date
        ]);
    }
}
