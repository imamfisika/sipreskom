<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nim', 'matkul_rekomendasi', 'isi'];
    protected $connection = 'sipreskom';

}