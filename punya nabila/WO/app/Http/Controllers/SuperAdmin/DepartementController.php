<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Helpers\AuditHelper;

class DepartementController extends Controller
{
    public function create()
    {
        $departements = Departement::all(); // ambil semua departement
        return view('super-admin.master-data.departement-create', compact('departements'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:departements,kode',
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,non_aktif',
        ]);

        // Simpan ke DB
        $departement = Departement::create($validated);

        // Log audit (optional)
        AuditHelper::log('created', 'Menambahkan departement: ' . $departement->nama);

        // Redirect ke index dengan notifikasi
        return redirect()
            ->route('superadmin.master-data.index')
            ->with('success', 'Departement berhasil ditambahkan!');
    }
}
