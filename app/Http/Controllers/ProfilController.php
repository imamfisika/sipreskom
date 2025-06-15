<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class ProfilController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profil', compact('user'));
    }

    public function update(Request $request)
{
    $request->validate([
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    /** @var User $user */
    $user = Auth::user();

    if ($request->hasFile('foto')) {
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        $path = $request->file('foto')->store('foto', 'public');
        $user->foto = $path;
    }

    $user->save();

    return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
}

    public function index()
    {
        $user = Auth::user();

        return view('profil', compact('user'));
    }
}