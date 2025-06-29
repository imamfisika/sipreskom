<?php

namespace App\Models;

// use App\Models\Akademik;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'password',
        'role',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setNimAttribute($value)
    {
        $this->attributes['nim'] = $value;

        $this->attributes['role'] = match (strlen($value)) {
            18 => 'dosenpa',
            5  => 'adminprodi',
            default => 'mahasiswa',
        };
    }

    public function akademiks()
    {
        return $this->hasMany(Akademik::class, 'id_user');
    }
    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'id_user');
    }


}
