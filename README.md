# Sistem Absensi Otomatis

## Deskripsi
Sistem absensi otomatis adalah fitur yang secara otomatis menandai siswa sebagai 'alpa' jika belum melakukan scan absen pada jam 8 pagi setiap hari.

## Fitur Utama

### 1. Pengecekan Otomatis
- **Waktu**: Setiap hari kerja (Senin-Jumat) jam 9:00 pagi
- **Logika**: Jika siswa belum melakukan scan absen, sistem akan otomatis menandai sebagai 'alpa'
- **Status**: Ditandai dengan keterangan "Otomatis ditandai alpa - belum scan absen"
- **Hari Libur Otomatis**: Jika lebih dari 80% siswa belum absen, hari dianggap libur dan tidak ada siswa yang ditandai alpa

### 2. Dashboard Monitoring
- **Statistik Real-time**: Menampilkan jumlah siswa hadir, sakit, izin, alpa, dan belum absen
- **Persentase Belum Absen**: Menampilkan persentase siswa yang belum absen
- **Alert Hari Libur**: Otomatis menampilkan peringatan jika hari dianggap libur (≥80% belum absen)
- **Daftar Siswa**: Menampilkan siswa yang belum absen dan sudah absen
- **Auto-refresh**: Halaman otomatis refresh setiap 30 detik

### 3. Pengecekan Manual
- **Tanggal Custom**: Bisa memilih tanggal tertentu untuk pengecekan
- **Mode Queue**: Opsional menjalankan sebagai job (queue)
- **Mode Langsung**: Menjalankan pengecekan secara langsung

### 4. Logging & Audit Trail
- **Log Detail**: Semua aktivitas dicatat dalam log
- **Audit Trail**: Mencatat siapa yang ditandai alpa, kapan, dan alasan
- **Halaman Log**: Menampilkan log absensi otomatis

## Komponen Sistem

### 1. Command
```bash
php artisan attendance:mark-absent
```
**File**: `app/Console/Commands/MarkAbsentStudents.php`

**Parameter**:
- `--date=Y-m-d`: Tanggal untuk pengecekan (opsional, default hari ini)

### 2. Service
**File**: `app/Services/AbsensiService.php`

**Method**:
- `markAbsentStudents($date)`: Menandai siswa yang belum absen
- `getAbsensiStats($date)`: Mendapatkan statistik absensi
- `getStudentsWithoutAbsence($date)`: Daftar siswa belum absen
- `getStudentsWithAbsence($date)`: Daftar siswa sudah absen

### 3. Job
**File**: `app/Jobs/MarkAbsentStudentsJob.php`

**Fungsi**: Menjalankan pengecekan absensi sebagai background job

### 4. Controller
**File**: `app/Http/Controllers/AbsensiOtomatisController.php`

**Endpoint**:
- `GET /kesiswaan/absen/otomatis`: Dashboard absensi otomatis
- `POST /kesiswaan/absen/otomatis/run`: Jalankan pengecekan manual
- `GET /kesiswaan/absen/otomatis/logs`: Halaman log

### 5. Schedule
**File**: `app/Console/Kernel.php`

**Konfigurasi**:
```php
$schedule->command('attendance:mark-absent')
    ->dailyAt('08:00')
    ->withoutOverlapping()
    ->runInBackground()
    ->appendOutputTo(storage_path('logs/attendance-automatic.log'));
```

## Cara Penggunaan

### 1. Setup Cron Job
Tambahkan cron job berikut di server:
```bash
* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

### 2. Akses Dashboard
1. Login sebagai admin
2. Buka menu **Kesiswaan > Absensi Otomatis**
3. Dashboard akan menampilkan statistik dan daftar siswa

### 3. Pengecekan Manual
1. Pilih tanggal yang ingin dicek
2. Opsional: Centang "Jalankan sebagai Job (Queue)"
3. Klik "Jalankan Pengecekan"

### 4. Monitoring Log
1. Klik "Lihat Log" di dashboard
2. Log akan menampilkan aktivitas absensi otomatis

## Konfigurasi

### 1. Waktu Pengecekan
Edit file `app/Console/Kernel.php`:
```php
$schedule->command('attendance:mark-absent')
    ->dailyAt('08:00') // Ubah waktu sesuai kebutuhan
```

### 2. Log File
Log akan disimpan di:
- `storage/logs/laravel.log` (log umum)
- `storage/logs/attendance-automatic.log` (log khusus absensi)

### 3. Queue (Opsional)
Jika menggunakan queue, pastikan queue worker berjalan:
```bash
php artisan queue:work
```

## Keamanan

### 1. Role-based Access
- Hanya admin yang bisa mengakses fitur ini
- Middleware: `role:admin`

### 2. Validation
- Validasi tanggal input
- Validasi status absensi
- Error handling untuk database

### 3. Audit Trail
- Semua aktivitas dicatat dengan timestamp
- Mencatat user yang melakukan aksi
- Log error untuk troubleshooting

## Troubleshooting

### 1. Command Tidak Berjalan
```bash
# Test command manual
php artisan attendance:mark-absent

# Cek schedule list
php artisan schedule:list

# Test schedule
php artisan schedule:test
```

### 2. Log Error
```bash
# Cek log Laravel
tail -f storage/logs/laravel.log

# Cek log absensi otomatis
tail -f storage/logs/attendance-automatic.log
```

### 3. Database Error
- Pastikan tabel `absensis` dan `peserta_didiks` ada
- Cek foreign key constraints
- Pastikan data siswa aktif dan terdaftar di kelas

## Monitoring

### 1. Statistik Harian
- Total siswa aktif
- Jumlah hadir/sakit/izin/alpa
- Siswa yang belum absen

### 2. Alert
- Notifikasi jika ada error
- Log aktivitas untuk audit
- Dashboard real-time

### 3. Backup
- Log otomatis dibersihkan setiap minggu
- Backup database secara berkala
- Monitoring disk space untuk log

## Pengembangan

### 1. Menambah Fitur
- Notifikasi email/SMS untuk siswa alpa
- Export laporan absensi
- Integrasi dengan sistem lain

### 2. Customisasi
- Ubah waktu pengecekan
- Tambah kondisi khusus (libur, ujian)
- Modifikasi logika penandaan alpa

### 3. Testing
```bash
# Test service
php artisan tinker
>>> app(App\Services\AbsensiService::class)->markAbsentStudents()

# Test command dengan tanggal tertentu
php artisan attendance:mark-absent --date=2024-01-15
``` 
