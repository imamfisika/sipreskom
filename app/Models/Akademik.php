<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademik extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'semester', 'jml_sks', 'IP'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
