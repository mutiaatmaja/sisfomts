<?php

namespace App\Imports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\PesertaDidik as Siswa;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use App\Models\Kelas;
use App\Models\AnggotaRombel;

class SiswaImport implements ToCollection, WithHeadingRow
{
    /**
     * @return int
     */
    public function headingRow(): int
    {
        return 1; // Assuming the first row contains the headings
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            // 1. Handle User berdasarkan email
            $user = User::firstOrNew(['email' => $row['email']]);

            if (!$user->exists) {
                $user->uuid = (string) Str::uuid();
            }
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


            $siswa = Siswa::firstOrNew(['user_id' => $user->id]);

            if (!$siswa->exists) {
                $siswa->uuid = (string) Str::uuid();
            }

            $siswa->fill([
                'user_id' => $user->id,
                'nisn' => $row['nisn'],
                'nis' => $row['nis'],
                'nis_lokal' => $row['nis_lokal'],

            ]);

            $siswa->save();
            // 3. Masukkan ke kelas lewat anggota_rombel
            $kelas = Kelas::where('nama_kelas', $row['nama_kelas'])->first();

            if ($kelas) {
                // Cek apakah siswa sudah terdaftar di kelas ini
                $sudahTerdaftar = AnggotaRombel::where('peserta_didik_id', $siswa->id)->where('kelas_id', $kelas->id)->exists();

                if (!$sudahTerdaftar) {
                    AnggotaRombel::create([
                        'peserta_didik_id' => $siswa->id,
                        'kelas_id' => $kelas->id,
                    ]);
                }
            }
        }
    }
}
