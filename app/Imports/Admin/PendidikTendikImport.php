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

            $uuid = Str::uuid();
            $user = User::updateOrCreate(
                ['email' => $row['email']],
                [
                    'name' => $row['nama'],
                    'password' => bcrypt($row['password']), // Set a default password
                ]
            )->addRole('guru');
            PendidikTendik::create([
                'uuid' => $uuid,
                'nuptk' => $row['nuptk'],
                'nip' => $row['nip'],
                'user_id' => $user->id,
            ]);
        }
    }
}

