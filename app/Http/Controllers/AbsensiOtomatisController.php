<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AbsensiService;
use App\Jobs\MarkAbsentStudentsJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiOtomatisController extends Controller
{
    protected $absensiService;

    public function __construct(AbsensiService $absensiService)
    {
        $this->absensiService = $absensiService;
    }

    /**
     * Menampilkan halaman dashboard absensi otomatis
     */
    public function index()
    {
        $today = Carbon::today();
        $stats = $this->absensiService->getAbsensiStats($today);
        $studentsWithoutAbsence = $this->absensiService->getStudentsWithoutAbsence($today);
        $studentsWithAbsence = $this->absensiService->getStudentsWithAbsence($today);

        return view('absen.otomatis', compact('stats', 'studentsWithoutAbsence', 'studentsWithAbsence', 'today'));
    }

        /**
     * Menjalankan pengecekan absensi otomatis secara manual
     */
    public function runManual(Request $request)
    {
        $request->validate([
            'date' => 'nullable|date',
            'use_queue' => 'boolean'
        ]);

        $date = $request->input('date');
        $useQueue = $request->boolean('use_queue', false);

        try {
            if ($useQueue) {
                // Jalankan sebagai job
                MarkAbsentStudentsJob::dispatch($date);

                Alert::success('Berhasil', 'Job pengecekan absensi telah dijadwalkan dan akan segera dijalankan.');
                Log::info("Job pengecekan absensi otomatis dijadwalkan", ['date' => $date]);
            } else {
                // Jalankan langsung
                $results = $this->absensiService->markAbsentStudents($date);

                if (isset($results['holiday']) && $results['holiday']) {
                    $message = "⚠️ HARI LIBUR OTOMATIS! ";
                    $message .= $results['holiday_reason'] . ". ";
                    $message .= "Total siswa: {$results['total_students']}, ";
                    $message .= "Sudah absen: {$results['already_absent']}, ";
                    $message .= "Persen belum absen: {$results['persen_belum_absen']}%";

                    Alert::warning('Hari Libur Otomatis', $message);
                } else {
                    $message = "Pengecekan absensi selesai. ";
                    $message .= "Total siswa: {$results['total_students']}, ";
                    $message .= "Sudah absen: {$results['already_absent']}, ";
                    $message .= "Ditandai alpa: {$results['marked_absent']}, ";
                    $message .= "Persen belum absen: {$results['persen_belum_absen']}%";

                    if (!empty($results['errors'])) {
                        $message .= ". Terjadi " . count($results['errors']) . " error.";
                    }

                    Alert::success('Berhasil', $message);
                }

                Log::info("Pengecekan absensi otomatis manual selesai", ['results' => $results]);
            }

        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            Log::error("Error dalam pengecekan absensi otomatis manual", ['error' => $e->getMessage()]);
        }

        return redirect()->route('absen.otomatis.index');
    }

    /**
     * Mendapatkan statistik absensi untuk tanggal tertentu
     */
    public function getStats(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $stats = $this->absensiService->getAbsensiStats($request->date);

        return response()->json($stats);
    }

    /**
     * Mendapatkan daftar siswa yang belum absen
     */
    public function getStudentsWithoutAbsence(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $students = $this->absensiService->getStudentsWithoutAbsence($request->date);

        return response()->json($students);
    }

    /**
     * Mendapatkan daftar siswa yang sudah absen
     */
    public function getStudentsWithAbsence(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $students = $this->absensiService->getStudentsWithAbsence($request->date);

        return response()->json($students);
    }

    /**
     * Menampilkan log absensi otomatis
     */
    public function logs()
    {
        // Ambil log dari file log Laravel
        $logFile = storage_path('logs/laravel.log');
        $logs = [];

        if (file_exists($logFile)) {
            $logContent = file_get_contents($logFile);
            $lines = explode("\n", $logContent);

            // Filter log yang berkaitan dengan absensi otomatis
            foreach ($lines as $line) {
                if (strpos($line, 'absensi otomatis') !== false ||
                    strpos($line, 'ditandai alpa') !== false ||
                    strpos($line, 'MarkAbsentStudents') !== false) {
                    $logs[] = $line;
                }
            }

            // Ambil 100 log terakhir
            $logs = array_slice(array_reverse($logs), 0, 100);
        }

        return view('absen.logs', compact('logs'));
    }
}
