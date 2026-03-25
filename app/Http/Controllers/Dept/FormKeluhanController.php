<?php

namespace App\Http\Controllers\Dept;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluhanAdmin;
use App\Models\FotoFormKeluhan;
use App\Models\FormKeluhan;

class FormKeluhanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required',
            'jenis_keluhan' => 'required',
            'kategori' => 'required',
            'foto.*' => 'image|mimes:jpg,png,jpeg|max:5120'
        ]);

        // ✅ MASUK KE form_keluhan (BUKAN admin)
        $keluhan = FormKeluhan::create([
            'lokasi' => $request->lokasi,
            'jenis_keluhan' => $request->jenis_keluhan,
            'kategori' => $request->kategori,
            'status' => 'Pending'
        ]);

        KeluhanAdmin::create([
            'waktu' => now(),
            'lokasi' => $request->lokasi,
            'jenis_masalah' => $request->jenis_keluhan,
            'kategori' => $request->kategori, // optional kalau mau simpan kategori
            'status' => 'Pending',
            'prioritas' => 'Rendah',  // default bisa disesuaikan
            'petugas' => '-', 
            'sumber' => 'department' // 🔥 INI PENTING         // default
        
        ]);

        // ✅ SIMPAN FOTO
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {

                $path = $file->store('form_keluhan', 'public');

                FotoFormKeluhan::create([
                    'form_keluhan_id' => $keluhan->id, // 🔥 ini harus ada di tabel form_keluhan
                    'foto' => $path
                ]);
            }
        }

        return back()->with('success', 'Keluhan berhasil dikirim');
    }
}
