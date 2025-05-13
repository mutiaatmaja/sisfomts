<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaDidik extends Model
{
    //fillable
    protected $fillable = ['uuid', 'user_id', 'nisn', 'nis', 'nis_lokal'];
    //relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //relasi ke anggota kelas
    public function anggotaRombel()
    {
        return $this->hasOne(AnggotaRombel::class);
    }

    public function kelas()
    {
        return $this->hasOneThrough(Kelas::class, AnggotaRombel::class, 'peserta_didik_id', 'id', 'id', 'kelas_id');
    }
}
