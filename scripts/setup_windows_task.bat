@echo off
REM Script Setup Windows Task Scheduler untuk Sistem Absensi Otomatis
REM Cara penggunaan: scripts/setup_windows_task.bat

echo === SETUP WINDOWS TASK SCHEDULER ABSENSI OTOMATIS ===
echo.

REM Dapatkan path project
set PROJECT_PATH=%CD%
echo Project path: %PROJECT_PATH%

REM Cek apakah PHP tersedia
php --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: PHP tidak ditemukan di PATH
    echo Pastikan PHP sudah terinstall dan ditambahkan ke PATH
    pause
    exit /b 1
)

echo PHP ditemukan, melanjutkan setup...
echo.

REM Buat batch file untuk menjalankan schedule
echo @echo off > "%PROJECT_PATH%\run_schedule.bat"
echo cd /d "%PROJECT_PATH%" >> "%PROJECT_PATH%\run_schedule.bat"
echo php artisan schedule:run >> "%PROJECT_PATH%\run_schedule.bat"

echo Batch file berhasil dibuat: run_schedule.bat
echo.

REM Cek apakah task sudah ada
schtasks /query /tn "LaravelSchedule" >nul 2>&1
if errorlevel 1 (
    echo Task belum ada, akan dibuat...

    REM Buat task untuk menjalankan setiap menit
    schtasks /create /tn "LaravelSchedule" /tr "%PROJECT_PATH%\run_schedule.bat" /sc minute /mo 1 /f

    if errorlevel 1 (
        echo ERROR: Gagal membuat task scheduler
        echo Pastikan script dijalankan sebagai Administrator
        pause
        exit /b 1
    ) else (
        echo ✓ Task scheduler berhasil dibuat
    )
) else (
    echo ✓ Task scheduler sudah ada
)

echo.
echo === VERIFIKASI ===

REM Tampilkan task yang ada
echo Task yang aktif:
schtasks /query /tn "LaravelSchedule"

echo.
echo === TESTING ===

REM Test command
echo Testing command attendance:mark-absent:
cd /d "%PROJECT_PATH%"
php artisan attendance:mark-absent --help

echo.
echo Testing schedule list:
php artisan schedule:list

echo.
echo === SELESAI ===
echo Task scheduler sudah disetup untuk menjalankan schedule setiap menit
echo Sistem absensi otomatis akan berjalan setiap hari jam 8:00 pagi
echo.
echo Untuk monitoring, cek log di:
echo - storage/logs/laravel.log
echo - storage/logs/attendance-automatic.log
echo.
echo Catatan: Pastikan komputer tidak sleep/hibernate agar task tetap berjalan
pause
