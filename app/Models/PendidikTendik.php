<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendidikTendik extends Model
{
    //buat fillable
    protected $fillable = [
        'uuid',
        'nuptk',
        'nip',
        'user_id',
    ];

    //buat relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //buat relasi ke role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
