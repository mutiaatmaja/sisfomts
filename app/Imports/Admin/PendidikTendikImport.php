<?php

namespace App\Imports\Admin;

use App\Models\PendidikTendik;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;

class PendidikTendikImport implements ToCollection, WithHeadingRow
{
    /**
     * @param \Illuminate\Support\Collection $collection
     *
     * @return void
     */
    public function headingRow(): int
    {
        return 1; // Assuming the first row contains the headings
    }
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Cek atau buat user berdasarkan email
            $user = User::firstOrNew(['email' => $row['email']]);

            if (!$user->exists) {
                $user->uuid = (string) Str::uuid(); // UUID hanya untuk user baru
            }

            $user->fill([
                'name' => $row['nama'],
                'password' => bcrypt($row['password']),
                'nik' => $row['nik'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'no_hp' => $row['no_hp'],
                'alamat' => $row['alamat'],
                'tempat_lahir' => $row['tempat_lahir'],
                'tanggal_lahir' => $row['tanggal_lahir'],
            ]);
            $user->save();
            $user->syncRoles(['guru']);

            // Cek duplikat NIP/NUPTK oleh user lain
            $nip = $row['nip'] ? preg_replace('/[^0-9]/', '', $row['nip']) : null;
            $nuptk = $row['nuptk'] ?? null;

            $nipExists = $nip ? PendidikTendik::where('nip', $nip)->where('user_id', '!=', $user->id)->exists() : false;

            $nuptkExists = $nuptk ? PendidikTendik::where('nuptk', $nuptk)->where('user_id', '!=', $user->id)->exists() : false;

            if ($nipExists || $nuptkExists) {
                // Duplikat ditemukan, skip baris ini
                continue;
            }

            // Ambil atau buat PendidikTendik berdasarkan user_id
            $pendidik = PendidikTendik::firstOrNew(['user_id' => $user->id]);

            if (!$pendidik->exists) {
                $pendidik->uuid = (string) Str::uuid(); // UUID hanya untuk entri baru
            }

            $pendidik->fill([
                'nip' => $nip ?? null,
                'nuptk' => $nuptk ?? null,
                'nrg' => $row['nrg'] ?? null,
                'npwp' => $row['npwp'] ?? null,
                'user_id' => $user->id,
            ]);
            $pendidik->save();
        }
    }
}
