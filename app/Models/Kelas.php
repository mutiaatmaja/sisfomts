<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    //fillable
    protected $fillable = [
        'nama_kelas',
        'wali_kelas_id',
    ];

    //relation
    public function wali_kelas()
    {
        return $this->belongsTo(PendidikTendik::class, 'wali_kelas_id');
    }
    public function anggota_rombels()
    {
        return $this->hasMany(AnggotaRombel::class, 'kelas_id');
    }
    public function peserta_didiks()
    {
        return $this->belongsToMany(PesertaDidik::class, 'anggota_rombels', 'kelas_id', 'peserta_didik_id');
    }
}
