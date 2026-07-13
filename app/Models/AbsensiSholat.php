<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiSholat extends Model
{
    protected $table = 'absensi_sholats';

    protected $fillable = [
        'uuid',
        'peserta_didik_id',
        'sholat_setting_id',
        'nama_sholat',
        'tanggal',
        'jam_absen',
        'status',
    ];

    public function pesertaDidik()
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id');
    }

    public function sholatSetting()
    {
        return $this->belongsTo(SholatSetting::class, 'sholat_setting_id');
    }
}
