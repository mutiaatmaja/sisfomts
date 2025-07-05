<?php

namespace App\Services;

use App\Models\PesertaDidik;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AbsensiService
{
    /**
     * Menandai siswa yang belum absen sebagai alpa
     */
    public function markAbsentStudents($date = null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::today();

        // Ambil semua siswa aktif yang terdaftar di kelas
        $activeStudents = PesertaDidik::where('status', 'aktif')
            ->whereHas('anggotaRombel')
            ->with(['anggotaRombel.kelas', 'user'])
            ->get();

        $results = [
            'total_students' => $activeStudents->count(),
            'marked_absent' => 0,
            'already_absent' => 0,
            'errors' => []
        ];

        DB::beginTransaction();

        try {
            foreach ($activeStudents as $student) {
                // Cek apakah siswa sudah absen hari ini
                $existingAbsence = Absensi::where('peserta_didik_id', $student->id)
                    ->whereDate('tanggal', $date->toDateString())
                    ->first();

                if ($existingAbsence) {
                    $results['already_absent']++;
                    continue;
                }

                // Jika belum absen, tandai sebagai alpa
                try {
                    Absensi::create([
                        'uuid' => Str::uuid(),
                        'peserta_didik_id' => $student->id,
                        'tanggal' => $date->copy()->setTime(8, 0, 0), // Set jam 8:00
                        'status' => 'alpha',
                        'keterangan' => 'Otomatis ditandai alpa - belum scan absen',
                    ]);

                    $results['marked_absent']++;

                    // Log untuk audit trail
                    Log::info("Siswa ditandai alpa otomatis", [
                        'student_id' => $student->id,
                        'student_name' => $student->user->name,
                        'nisn' => $student->nisn,
                        'date' => $date->format('Y-m-d'),
                        'time' => now()->format('H:i:s')
                    ]);

                } catch (\Exception $e) {
                    $results['errors'][] = [
                        'student_id' => $student->id,
                        'student_name' => $student->user->name,
                        'error' => $e->getMessage()
                    ];

                    Log::error("Error menandai alpa otomatis", [
                        'student_id' => $student->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            DB::commit();

            // Log ringkasan
            Log::info("Pengecekan absensi otomatis selesai", [
                'date' => $date->format('Y-m-d'),
                'results' => $results
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error dalam pengecekan absensi otomatis", [
                'error' => $e->getMessage(),
                'date' => $date->format('Y-m-d')
            ]);
            throw $e;
        }

        return $results;
    }

    /**
     * Mendapatkan statistik absensi untuk tanggal tertentu
     */
    public function getAbsensiStats($date = null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::today();

        $stats = Absensi::whereDate('tanggal', $date->toDateString())
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $totalStudents = PesertaDidik::where('status', 'aktif')
            ->whereHas('anggotaRombel')
            ->count();

        return [
            'date' => $date->format('Y-m-d'),
            'total_students' => $totalStudents,
            'hadir' => $stats['hadir'] ?? 0,
            'sakit' => $stats['sakit'] ?? 0,
            'izin' => $stats['izin'] ?? 0,
            'alpha' => $stats['alpha'] ?? 0,
            'belum_absen' => $totalStudents - array_sum($stats)
        ];
    }

    /**
     * Mendapatkan daftar siswa yang belum absen
     */
    public function getStudentsWithoutAbsence($date = null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::today();

        return PesertaDidik::where('status', 'aktif')
            ->whereHas('anggotaRombel')
            ->whereDoesntHave('absensi', function($query) use ($date) {
                $query->whereDate('tanggal', $date->toDateString());
            })
            ->with(['anggotaRombel.kelas', 'user'])
            ->get();
    }

    /**
     * Mendapatkan daftar siswa yang sudah absen
     */
    public function getStudentsWithAbsence($date = null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::today();

        return Absensi::whereDate('tanggal', $date->toDateString())
            ->with(['peserta_didik.user', 'peserta_didik.anggotaRombel.kelas'])
            ->get();
    }
}
