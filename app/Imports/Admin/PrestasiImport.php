<?php

namespace App\Imports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Prestasi;
use App\Models\PesertaDidik;
use Illuminate\Support\Facades\DB;

class PrestasiImport implements ToCollection, WithHeadingRow
{
    /**
     * Define the heading row number
     *
     * @return int
     */
    public function headingRow(): int
    {
        return 1; // The first row is the header
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            foreach ($collection as $row) {
                // cari peserta didik berdasarkan nisn
                $pesertaDidik = PesertaDidik::where('nisn', $row['nisn'])->first();

                Prestasi::create([
                    'jenjang' => $row['jenjang'],
                    'prestasi' => $row['prestasi'],
                    'tingkat' => $row['tingkat'],
                    'peringkat' => $row['peringkat'],
                    'tanggal' => \Carbon\Carbon::parse($row['tanggal'])->format('Y-m-d'),
                    'deskripsi' => $row['deskripsi'],
                    'peserta_didik_id' => $pesertaDidik ? $pesertaDidik->id : null,
                ]);
            }

            DB::commit(); // simpan semua jika berhasil
        } catch (\Exception $e) {
            DB::rollBack(); // batalkan semua jika error
            throw $e; // atau kamu bisa kasih feedback ke user
        }
    }
}
