<?php

namespace App\Imports\Admin;

use App\Models\PendidikTendik;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class PendidikTendikImport implements ToCollection
{
    /**
     * @param \Illuminate\Support\Collection $collection
     *
     * @return void
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            dd($row);
        }
    }
}

