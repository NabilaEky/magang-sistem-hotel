<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LaporanEng;

class PetugasEngController extends Controller
{
    // 🔹 Profile
    public function profile()
    {
        $user = Auth::user();

        $todayCount = LaporanEng::where('user_id', $user->id)
            ->whereDate('created_at', now())
            ->count();

        return view('petugas-eng.profile', compact('user', 'todayCount'));
    }

    // 🔹 Form Edit
    public function editProfile()
    {
        $user = Auth::user();

        return view('petugas-eng.edit-profile', compact('user'));
    }

    // 🔹 Update Profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        //dd($request->all());
        // ✅ VALIDASI
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|max:15',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // ✅ UPDATE DATA
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // ✅ UPLOAD FOTO
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto-profile', 'public');
            $user->foto = $path;
        }

        // ✅ UPDATE PASSWORD (FIX HASH)
        if ($request->filled('password') && strlen($request->password) >= 4) {
            $user->password = Hash::make($request->password);
        }

        // ✅ SIMPAN
        $user->save();

        // ✅ REDIRECT KE PROFILE
        return redirect()->route('petugas.profile')
            ->with('success', 'Profile berhasil diupdate');
    }
}
