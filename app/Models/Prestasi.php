<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    //fillable
    protected $fillable = [
        'nama',
        'jenjang',
        'prestasi',
        'peringkat',
        'tanggal',
        'deskripsi',
        'peserta_didik_id'
    ];
    public function pesertaDidik()
    {
        return $this->belongsTo(PesertaDidik::class);
    }
}
