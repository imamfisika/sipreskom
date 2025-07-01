<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Rekomendasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_matkul',
        'nama_dosen',
        'keterangan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
