<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SholatSetting extends Model
{
    use HasFactory;

    protected $table = 'sholat_settings';

    protected $fillable = [
        'nama_sholat',
        'jam_mulai',
        'jam_selesai',
        'is_active',
    ];
}
