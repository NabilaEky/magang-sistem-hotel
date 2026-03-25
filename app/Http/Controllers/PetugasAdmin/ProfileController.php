<?php

namespace App\Http\Controllers\PetugasAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $profile = Profile::first();
        return view('petugas-admin.profil', compact('profile'));
    }

    public function edit()
    {
        $profile = \App\Models\Profile::first();

        if (!$profile) {
            $profile = new \App\Models\Profile();
        }

        return view('petugas-admin.edit-profil', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::first();

        // jika belum ada data profile
        if (!$profile) {
            $profile = new Profile();
        }

        $profile->nama = $request->nama;
        $profile->email = $request->email;
        $profile->no_hp = $request->no_hp;
        $profile->username = $request->username;

        // password optional
        if ($request->password) {
            $profile->password = Hash::make($request->password);
        }

        // upload foto
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $path = $file->store('foto_profil', 'public');

            $profile->foto = $path;
        }

        $profile->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diupdate');
    }
}
