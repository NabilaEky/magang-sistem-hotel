<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Helpers\AuditHelper;

class KategoriController extends Controller
{
    public function create()
    {
        return view('super-admin.master-data.kategori-create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,non_aktif',
        ]);

        // Generate kode otomatis, misal KAT-001, KAT-002
        $latest = Kategori::latest('id')->first();
        $num = $latest ? $latest->id + 1 : 1;
        $validated['kode'] = 'KAT-' . str_pad($num, 3, '0', STR_PAD_LEFT);

        // Simpan data
        Kategori::create($validated);

        return redirect()->route('superadmin.master-data.index')
                         ->with('success', 'Kategori berhasil ditambahkan');
    }
}