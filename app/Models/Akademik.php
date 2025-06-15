<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akademik extends Model
{
    protected $connection = 'sipreskom';

    protected $table = 'akademik_semester';

    protected $primaryKey = 'nim';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;
}
