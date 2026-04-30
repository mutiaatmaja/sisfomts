<?php

namespace App\Imports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Prestasi;
use App\Models\PesertaDidik;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class PrestasiImport implements ToCollection, WithHeadingRow
{
    public array $errors = [];
    public int $successCount = 0;
    public int $failedCount = 0;

    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $collection)
    {
        DB::beginTransaction();

        try {

            foreach ($collection as $index => $row) {

                $baris = $index + 2; // karena heading di baris 1

                // Validasi NISN kosong
                if (empty($row['nisn'])) {
                    $this->errors[] = "Baris {$baris}: NISN kosong.";
                    $this->failedCount++;
                    continue;
                }

                // Cari Peserta Didik
                $pesertaDidik = PesertaDidik::where('nisn', $row['nisn'])->first();

                if (!$pesertaDidik) {
                    $this->errors[] = "Baris {$baris}: NISN {$row['nisn']} tidak ditemukan.";
                    $this->failedCount++;
                    continue;
                }

                // Validasi tanggal
                try {
                    $tanggal = Carbon::parse($row['tanggal'])->format('Y-m-d');
                } catch (\Exception $e) {
                    $this->errors[] = "Baris {$baris}: Format tanggal tidak valid.";
                    $this->failedCount++;
                    continue;
                }

                // Insert atau Update jika sudah ada
                Prestasi::updateOrCreate(
                    [
                        'peserta_didik_id' => $pesertaDidik->id,
                        'jenjang' => $row['jenjang'],
                        'prestasi' => $row['prestasi'],
                        'tingkat' => $row['tingkat'],
                        'peringkat' => $row['peringkat'],
                        'tanggal' => $tanggal,
                    ],
                    [
                        'deskripsi' => $row['deskripsi'] ?? null,
                    ]
                );

                $this->successCount++;
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception("Terjadi kesalahan sistem: " . $e->getMessage());
        }
    }
}