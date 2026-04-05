<?php

namespace App\Http\Controllers\Dept;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeptProfile;
use App\Models\RiwayatDepartment;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $data = DeptProfile::first();

        if (!$data) {
            $data = DeptProfile::create([
                'nama' => 'Admin Dept',
                'role' => 'Admin',
                'email' => 'admin@email.com',
                'no_hp' => '-',
                'username' => 'admin',
                'password' => Hash::make('123456'), // 🔥 WAJIB
                'notifikasi' => 1
            ]);
        }

        $jumlahHariIni = RiwayatDepartment::whereDate('created_at', now())->count();

        return view('department.profil-dept', compact('data', 'jumlahHariIni'));
    }

    public function notifOn()
    {
        $data = DeptProfile::first();
        $data->update(['notifikasi' => 1]);

        return back();
    }

    public function notifOff()
    {
        $data = DeptProfile::first();
        $data->update(['notifikasi' => 0]);

        return back();
    }

    public function edit()
    {
        $data = DeptProfile::first();
        return view('department.profil-edit', compact('data'));
    }

    public function update(Request $request)
    {
        $data = DeptProfile::first();

        // kalau belum ada → bikin dulu
        if (!$data) {
            $data = new DeptProfile();
        }

        // update data
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->no_hp = $request->no_hp;
        $data->username = $request->username;

        // 🔐 password (opsional)
        if ($request->password) {
            $data->password = Hash::make($request->password);
        }

        // 📸 upload logo
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('logo'), $namaFile);

            $data->logo = $namaFile;
        }

        $data->save();

        return redirect()->route('dept.profil-dept')->with('success', 'Profil berhasil diupdate!');
    }
}
