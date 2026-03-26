<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Helpers\AuditHelper;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::with('departement')->latest()->get();
        return view('super-admin.jabatan.index', compact('jabatans'));
    }

    public function create()
    {
        $departements = Departement::where('status', 'aktif')->get();
        return view('super-admin.master-data.jabatan-create', compact('departements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'departement_id' => 'required|exists:departements,id',
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:100|unique:jabatans,kode',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,non_aktif',
            'level' => 'required|integer|min:1',
        ]);

        Jabatan::create($request->all());

        return redirect()
            ->route('superadmin.jabatan.index')
            ->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function edit(Jabatan $jabatan)
    {
        $departements = Departement::where('status', 'aktif')->get();
        return view('super-admin.jabatan.edit', compact('jabatan', 'departements'));
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'departement_id' => 'required|exists:departements,id',
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:100|unique:jabatans,kode,' . $jabatan->id,
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,non_aktif',
            'level' => 'required|integer|min:1',
        ]);

        $jabatan->update($request->all());

        return redirect()
            ->route('superadmin.jabatan.index')
            ->with('success', 'Jabatan berhasil diperbarui');
    }

    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();

        return back()->with('success', 'Jabatan berhasil dihapus');
    }
}