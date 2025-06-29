<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'id_user',
        'id_matkul',
        'bobot',
        'nilai',
        'semester',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul');
    }
}