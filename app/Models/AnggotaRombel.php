<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaRombel extends Model
{
    //fillable
    protected $fillable = [

        'kelas_id',
        'peserta_didik_id',
    ];
    //relasi ke peserta didik
    public function pesertaDidik()
    {
        return $this->belongsTo(PesertaDidik::class);
    }
}
