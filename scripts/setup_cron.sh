#!/bin/bash

# Script Setup Cron Job untuk Sistem Absensi Otomatis
# Cara penggunaan: bash scripts/setup_cron.sh

echo "=== SETUP CRON JOB ABSENSI OTOMATIS ==="
echo ""

# Dapatkan path project
PROJECT_PATH=$(pwd)
echo "Project path: $PROJECT_PATH"

# Cek apakah sudah ada cron job
if crontab -l 2>/dev/null | grep -q "schedule:run"; then
    echo "✓ Cron job sudah ada"
    crontab -l | grep "schedule:run"
else
    echo "✗ Cron job belum ada, akan ditambahkan..."

    # Tambahkan cron job
    (crontab -l 2>/dev/null; echo "* * * * * cd $PROJECT_PATH && php artisan schedule:run >> /dev/null 2>&1") | crontab -

    echo "✓ Cron job berhasil ditambahkan"
fi

echo ""
echo "=== VERIFIKASI ==="

# Cek cron job
echo "Cron job yang aktif:"
crontab -l

echo ""
echo "=== TESTING ==="

# Test command
echo "Testing command attendance:mark-absent:"
cd $PROJECT_PATH
php artisan attendance:mark-absent --help

echo ""
echo "Testing schedule list:"
php artisan schedule:list

echo ""
echo "=== SELESAI ==="
echo "Cron job sudah disetup untuk menjalankan schedule setiap menit"
echo "Sistem absensi otomatis akan berjalan setiap hari jam 8:00 pagi"
echo ""
echo "Untuk monitoring, cek log di:"
echo "- storage/logs/laravel.log"
echo "- storage/logs/attendance-automatic.log"
