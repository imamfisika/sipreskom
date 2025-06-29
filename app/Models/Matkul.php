<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'id_matkul');
    }
}
