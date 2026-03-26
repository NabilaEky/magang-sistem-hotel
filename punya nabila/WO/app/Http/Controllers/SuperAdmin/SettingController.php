<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    // Tampilkan halaman setting
    public function index()
    {
        $user = \App\Models\User::find(auth()->id());
        return view('super-admin.setting.index', compact('user'));
    }

    // Tampilkan halaman edit profile
    public function editProfile()
    {
        $user = Auth::user();
        return view('super-admin.setting.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|confirmed|min:6',
        ]);

        // UPDATE DATA DASAR
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // UPDATE FOTO (PAKAI JETSTREAM)
        if ($request->hasFile('photo')) {
            $user->updateProfilePhoto($request->file('photo'));
        }

        // UPDATE PASSWORD
        if ($request->filled('password')) {
            $user->password = $request->password;
            // tidak perlu Hash::make karena sudah 'hashed' di model
        }

        $user->save();

        return redirect()
            ->route('superadmin.setting.index')
            ->with('success', 'Profil berhasil diperbarui');
    }

    public function updateNotification(Request $request)
    {
        $user = auth()->user();

        if ($request->has('notification')) {
            $user->notification_enabled = $request->notification;
        }

        if ($request->has('volume')) {
            $user->notification_volume = $request->volume;
        }

        $user->save();

        return back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
