<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Petugas;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use App\Helpers\AuditHelper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        // ambil jumlah data per halaman
        $perPage = $request->get('per_page', 10);

        // ambil data petugas
        $petugas = Petugas::with(['kategori', 'lokasi'])
            ->paginate($perPage)
            ->withQueryString();

        return view('super-admin.manajemen-petugas.index', compact('petugas'));
    }

    public function create()
    {
        #   $kategoris = Kategori::all();
        #  $lokasis = Lokasi::all();
        $roles = \Spatie\Permission\Models\Role::whereIn('name', ['petugas'])->get();

        return view(
            'super-admin.manajemen-petugas.create',
            compact('roles')
        );
    }

    public function edit($id)
    {
        $petugas = \App\Models\Petugas::findOrFail($id);

        return view('super-admin.manajemen-petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . ($petugas->user->id ?? 0),
            'role' => 'required|string',
        ]);

        // Update User email
        if ($petugas->user) {
            $petugas->user->update([
                'email' => $request->email,
                'name'  => $request->nama,
            ]);
        }

        // Update Petugas
        $petugas->update([
            'nama' => $request->nama,
            'role' => $request->role,
            'status' => $request->status ?? 'non-aktif',
        ]);

        // Tambahkan audit log jika perlu
        AuditHelper::log('updated', 'Mengubah data petugas: ' . $petugas->nama);

        // Redirect dengan notif
        return redirect()->route('superadmin.petugas.index')
            ->with('success', 'Data petugas berhasil diupdate!');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'role' => 'required|string',
            'status' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
        ]);

        $no = $this->generateNo($request->role);

        // 1️⃣ Buat user login dulu
        $user = User::create([
            'name' => $request->nama,
            'username' => '@' . $no,
            'email' => $request->email,
            'password' => Hash::make('password123'),
        ]);

        $user->assignRole($request->role);

        // 2️⃣ Buat petugas
        $petugas = Petugas::create([
            'user_id' => $user->id,
            'no' => $no,
            'nama' => $request->nama,
            'role' => $request->role,
            'status' => $request->status ?? 'aktif',
        ]);

        AuditHelper::log(
            'created',
            'Menambahkan data petugas: ' . $petugas->nama
        );

        return redirect()
            ->route('superadmin.petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan');
    }

    private function generateNo($role)
    {
        $prefix = match ($role) {
            'super_admin' => 'SA',
            'admin'       => 'ENG',
            'dept'        => 'FB',
            default       => 'PTG',
        };

        do {
            $numberLength = $role === 'super_admin' ? 3 : 2;

            $randomNumber = str_pad(
                rand(1, pow(10, $numberLength) - 1),
                $numberLength,
                '0',
                STR_PAD_LEFT
            );

            $no = $prefix . $randomNumber;
        } while (Petugas::where('no', $no)->exists());

        return $no;
    }

    public function destroy($id)
    {
        $petugas = \App\Models\Petugas::findOrFail($id);

        $petugas->delete();

        return redirect()
            ->route('superadmin.petugas.index')
            ->with('success', 'Data petugas berhasil dihapus');
    }

    public function resetPassword($id)
    {
        $petugas = \App\Models\Petugas::findOrFail($id);

        return view('super-admin.manajemen-petugas.reset-password', compact('petugas'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $petugas = \App\Models\Petugas::findOrFail($id);

        $petugas->user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()
            ->route('superadmin.petugas.index')
            ->with('success', 'Password berhasil diperbarui');
    }
}
