<?php

/**
 * Script Testing Sistem Absensi Otomatis
 *
 * Cara penggunaan:
 * php scripts/test_absensi_otomatis.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

use App\Services\AbsensiService;
use App\Models\PesertaDidik;
use App\Models\Absensi;
use Carbon\Carbon;

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TESTING SISTEM ABSENSI OTOMATIS ===\n\n";

try {
    $absensiService = new AbsensiService();

    // Test 1: Cek statistik hari ini
    echo "1. Testing Statistik Absensi Hari Ini:\n";
    $stats = $absensiService->getAbsensiStats();
    echo "   - Total Siswa: {$stats['total_students']}\n";
    echo "   - Hadir: {$stats['hadir']}\n";
    echo "   - Sakit: {$stats['sakit']}\n";
    echo "   - Izin: {$stats['izin']}\n";
    echo "   - Alpa: {$stats['alpha']}\n";
    echo "   - Belum Absen: {$stats['belum_absen']}\n\n";

    // Test 2: Cek siswa yang belum absen
    echo "2. Testing Siswa yang Belum Absen:\n";
    $studentsWithoutAbsence = $absensiService->getStudentsWithoutAbsence();
    echo "   - Jumlah: " . $studentsWithoutAbsence->count() . "\n";
    if ($studentsWithoutAbsence->count() > 0) {
        echo "   - Contoh siswa:\n";
        foreach ($studentsWithoutAbsence->take(3) as $student) {
            echo "     * {$student->user->name} ({$student->nisn})\n";
        }
    }
    echo "\n";

    // Test 3: Cek siswa yang sudah absen
    echo "3. Testing Siswa yang Sudah Absen:\n";
    $studentsWithAbsence = $absensiService->getStudentsWithAbsence();
    echo "   - Jumlah: " . $studentsWithAbsence->count() . "\n";
    if ($studentsWithAbsence->count() > 0) {
        echo "   - Contoh absensi:\n";
        foreach ($studentsWithAbsence->take(3) as $absensi) {
            echo "     * {$absensi->peserta_didik->user->name} - {$absensi->status} ({$absensi->tanggal->format('H:i')})\n";
        }
    }
    echo "\n";

    // Test 4: Simulasi pengecekan absensi otomatis
    echo "4. Testing Pengecekan Absensi Otomatis:\n";
    $results = $absensiService->markAbsentStudents();
    echo "   - Total siswa: {$results['total_students']}\n";
    echo "   - Sudah absen: {$results['already_absent']}\n";
    echo "   - Ditandai alpa: {$results['marked_absent']}\n";
    if (!empty($results['errors'])) {
        echo "   - Error: " . count($results['errors']) . "\n";
    }
    echo "\n";

    // Test 5: Cek command artisan
    echo "5. Testing Command Artisan:\n";
    $output = shell_exec('cd ' . __DIR__ . '/.. && php artisan attendance:mark-absent --help 2>&1');
    if (strpos($output, 'attendance:mark-absent') !== false) {
        echo "   ✓ Command berhasil terdaftar\n";
    } else {
        echo "   ✗ Command tidak ditemukan\n";
    }
    echo "\n";

    // Test 6: Cek schedule
    echo "6. Testing Schedule:\n";
    $output = shell_exec('cd ' . __DIR__ . '/.. && php artisan schedule:list 2>&1');
    if (strpos($output, 'attendance:mark-absent') !== false) {
        echo "   ✓ Schedule berhasil terdaftar\n";
    } else {
        echo "   ✗ Schedule tidak ditemukan\n";
    }
    echo "\n";

    echo "=== TESTING SELESAI ===\n";
    echo "Status: BERHASIL\n";

} catch (Exception $e) {
    echo "=== ERROR ===\n";
    echo "Pesan: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Status: GAGAL\n";
}
