<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Akademik;


class User extends Authenticatable
{
    use Notifiable;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nim',
        'email',
        'foto',
        'password',
    ];

    public function setNimAttribute($value)
    {
        $this->attributes['nim'] = $value;

        if (strlen($value) == 18) {
            $this->attributes['role'] = 'admin';
        } elseif (strlen($value) == 5) {
            $this->attributes['role'] = 'superadmin';
        } else {
            $this->attributes['role'] = 'mahasiswa';
        }
    }

    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : asset('images/profil.jpg');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function akademik()
    {
        return $this->hasOne(Akademik::class, 'nim', 'nim');
    }
}
