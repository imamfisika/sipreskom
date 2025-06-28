<?php

namespace App\Service;

use App\Models\User;

class DosenpaService
{
    public function getAll()
    {
        return User::where('role', 'dosenpa')
            ->select('id', 'nama', 'nim', 'email')
            ->get();
    }
    public function findById($id)
    {
        return User::where('role', 'dosenpa')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);

        $user->update([
            'name'  => $data['nama'],
            'nim'   => $data['nim'],
            'email' => $data['email'],
        ]);
    }

    public function delete($id)
    {
        return $this->findById($id)->delete();
    }
}
