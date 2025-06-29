<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $fillable = [
        'kode_matkul',
        'nama_matkul',
        'jml_sks',
    ];
    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'id_matkul');
    }
}
