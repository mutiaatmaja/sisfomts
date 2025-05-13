<?php

namespace App\Imports\Admin;

use App\Models\User;
use App\Models\PesertaDidik as Siswa;
use App\Models\Kelas;
use App\Models\AnggotaRombel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            // Preload semua data yang mungkin digunakan
            $emails = $rows->pluck('email')->unique()->filter()->all();
            $existingUsers = User::whereIn('email', $emails)->get()->keyBy('email');

            $kelasList = Kelas::all()->keyBy('nama_kelas');

            foreach ($rows as $row) {
                $email = trim($row['email']);
                if (!$email) continue; // Skip jika tidak ada email

                // USER
                $user = $existingUsers[$email] ?? new User(['email' => $email]);
                if (!$user->exists) $user->uuid = (string) Str::uuid();

                $alamat = preg_replace("/\r\n|\r|\n/", ', ', $row['alamat']);

                $user->fill([
                    'name' => $row['nama'],
                    'password' => bcrypt($row['password']),
                    'nik' => $row['nik'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'no_hp' => $row['no_hp'],
                    'alamat' => $alamat,
                    'tempat_lahir' => $row['tempat_lahir'],
                    'tanggal_lahir' => $row['tanggal_lahir'],
                ]);
                $user->save();
                $user->syncRoles(['siswa']);

                // SISWA
                $siswa = Siswa::firstOrNew(['user_id' => $user->id]);
                if (!$siswa->exists) $siswa->uuid = (string) Str::uuid();

                $siswa->fill([
                    'nisn' => $row['nisn'],
                    'nis' => $row['nis'],
                    'nis_lokal' => $row['nis_lokal'],
                ]);
                $siswa->save();

                // ANGGOTA ROMBEL
                $namaKelas = $row['nama_kelas'];
                $kelas = $kelasList[$namaKelas] ?? null;

                if ($kelas) {
                    $sudahTerdaftar = AnggotaRombel::where('peserta_didik_id', $siswa->id)
                        ->where('kelas_id', $kelas->id)
                        ->exists();

                    if (!$sudahTerdaftar) {
                        AnggotaRombel::create([
                            'peserta_didik_id' => $siswa->id,
                            'kelas_id' => $kelas->id,
                        ]);
                    }
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            throw $e;
        }
    }

    public function chunkSize(): int
    {
        return 300; // Boleh sesuaikan
    }
}
