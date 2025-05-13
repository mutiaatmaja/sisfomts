<?php

namespace App\Imports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PrestasiImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }
}
