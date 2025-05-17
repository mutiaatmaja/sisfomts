<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    public $fillable = [
        'uuid',
        'peserta_didik_id',
        'tanggal',
        'status',
        'keterangan',
    ];
    protected $casts = [
        'tanggal' => 'datetime',
    ];
    public function peserta_didik()
    {
        return $this->belongsTo(PesertaDidik::class);
    }
    public function scopeToday($query)
    {
        return $query->whereDate('tanggal', now()->toDateString());
    }
    public function scopeTerlambat($query)
    {
        return $query->where('keterangan', 'terlambat');
    }

}
