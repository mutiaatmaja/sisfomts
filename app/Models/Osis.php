<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PesertaDidik;

class Osis extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'jabatan',
        'periode'
    ];

    public function siswa()
    {
        return $this->belongsTo(PesertaDidik::class);
    }
}
