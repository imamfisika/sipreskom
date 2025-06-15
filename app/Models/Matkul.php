<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkul';
    protected $fillable = ['nama_matkul'];
    public $timestamps = false;
    protected $connection = 'sipreskom';
}