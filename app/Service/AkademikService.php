<?php

namespace App\Service;

use App\Models\User;
use App\Models\Akademik;

class AkademikService
{
    public function getAkademikByUserId($userId)
    {
        $user = User::findOrFail($userId);
        return Akademik::where('nim', $user->nim)->get();
    }
}