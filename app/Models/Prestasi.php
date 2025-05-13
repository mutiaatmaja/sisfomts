<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    //fillable
    protected $fillable = [

        'jenjang',
        'prestasi',
        'tingkat',
        'peringkat',
        'tanggal',
        'deskripsi',
        'peserta_didik_id'
    ];
    public function pesertaDidik()
    {
        return $this->belongsTo(PesertaDidik::class);
    }
    //trough ke user
    public function user()
    {
        return $this->hasOneThrough(User::class, PesertaDidik::class, 'id', 'id', 'peserta_didik_id', 'user_id');
    }
}
