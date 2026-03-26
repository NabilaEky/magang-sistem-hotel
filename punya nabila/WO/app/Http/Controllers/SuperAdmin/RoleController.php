<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Helpers\AuditHelper;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $roles = Role::withCount('permissions')
            ->paginate($perPage)
            ->withQueryString();

        $roles->getCollection()->transform(function ($role) {
            $role->users_count = DB::table('model_has_roles')
                ->where('role_id', $role->id)
                ->count();
            return $role;
        });

        return view('super-admin.user-role.index', compact('roles'));
    }

    public function create()
    {
        return view('super-admin.user-role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($role)
            ->log('Membuat role ' . $role->name);

        return redirect()
            ->route('superadmin.roles.index')
            ->with('success', 'Role berhasil dibuat');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('super-admin.user-role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]);

        // 🔒 protek super_admin agar tidak bisa di-rename
        if ($role->name === 'super_admin' && $request->name !== 'super_admin') {
            return back()->with('error', 'Role super_admin tidak dapat diubah namanya');
        }

        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions ?? []);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($role)
            ->log('Mengupdate role ' . $role->name);

        return redirect()
            ->route('superadmin.roles.index')
            ->with('success', 'Role berhasil diupdate');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->name === 'super_admin') {
            return back()->with('error', 'Role super_admin tidak dapat dihapus');
        }

        // detach permissions
        $role->permissions()->detach();

        // detach users via pivot (BENAR)
        DB::table('model_has_roles')
            ->where('role_id', $role->id)
            ->delete();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($role)
            ->log('Menghapus role ' . $role->name);

        $role->delete();

        return redirect()
            ->route('superadmin.roles.index')
            ->with('success', 'Role berhasil dihapus');
    }
}
