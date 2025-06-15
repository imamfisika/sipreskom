<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediksi extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    public $timestamps = false;
    protected $table = 'rekomendasi';

    protected $casts = [
        'ip_data' => 'array',
    ];
    protected $connection = 'sipreskom';
    protected $fillable = ['nim', 'ip_data', 'predicted_ip', 'next_semester'];
}
