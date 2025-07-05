<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Jalankan pengecekan absensi otomatis setiap hari kerja jam 9:00 pagi
        $schedule->command('attendance:mark-absent')
            ->weekdays()  // ← Hanya hari Senin-Jumat
            ->at('09:00')
            ->withoutOverlapping()
            ->runInBackground()
            ->appendOutputTo(storage_path('logs/attendance-automatic.log'));

        // Backup log setiap minggu
        $schedule->command('log:clear')
            ->weekly()
            ->sundays()
            ->at('01:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
