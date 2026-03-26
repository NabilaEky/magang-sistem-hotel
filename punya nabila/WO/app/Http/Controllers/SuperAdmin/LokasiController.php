<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AuditHelper;

class LokasiController extends Controller
{
    // Menampilkan form Tambah Lokasi
    public function create()
    {
       return view('super-admin.master-data.lokasi-create'); 
    }

    // Menyimpan data lokasi dari form
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kode' => 'required|string|max:50',
            'status' => 'required|in:aktif,non_aktif',
        ]);

        \App\Models\Lokasi::create($validated);

        return redirect()->route('superadmin.master-data.index')
                         ->with('success', 'Lokasi berhasil ditambahkan!');
    }
}