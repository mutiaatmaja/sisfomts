<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suaramadrasah extends Model
{
    protected $fillable = [
        'uuid',
        'nama_responden',
        'hp_responden',
        'tipe_aduan',
        'teks_suara',
        'apa',
        'siapa',
        'kapan',
        'dimana',
        'mengapa',
        'bagaimana',
        'lampiran',
    ];
}
