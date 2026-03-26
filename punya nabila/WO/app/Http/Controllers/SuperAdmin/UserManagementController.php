<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\AuditHelper;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $users = User::with('roles')
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('super-admin.user-management.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('super-admin.user-management.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'jabatan' => 'nullable|string|max:255',
            'role' => 'required|string'
        ]);

        // generate username
        do {
            $username = '@PJS' . date('Y') . '-' . rand(10000, 99999);
        } while (User::where('username', $username)->exists());

        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('superadmin.user-management.index')
            ->with('success', 'User berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('super-admin.user-management.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'jabatan' => 'nullable|string|max:255',
            'role' => 'required|string',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $updateData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        $user->update($updateData);

        $user->syncRoles([$request->role]);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log('Mengupdate user ' . $user->name);

        return redirect()
            ->route('superadmin.user-management.index')
            ->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // ❌ tidak boleh hapus diri sendiri
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        // 🔥 WAJIB untuk spatie
        $user->roles()->detach();
        $user->permissions()->detach();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log('Menghapus user ' . $user->name);

        $user->delete();

        return redirect()
            ->route('superadmin.user-management.index')
            ->with('success', 'User berhasil dihapus');
    }

    private function generateUsername($role)
    {
        do {
            $username = match ($role) {
                'super_admin' => '@PJS2026-SA' . rand(10000, 99999),
                'admin'       => '@PJS2026-ENG' . rand(10000, 99999),
                'dept'        => '@PJS2026-FB' . rand(10000, 99999),
                'customer'    => '@PJS2026-R' . rand(100, 999),
                default       => '@PJS2026-' . rand(10000, 99999),
            };
        } while (User::where('username', $username)->exists());

        return $username;
    }
}
