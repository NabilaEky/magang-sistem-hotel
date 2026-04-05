<?php

namespace App\Http\Controllers\Dept;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluhanAdmin;
use App\Models\FotoFormKeluhan;
use App\Models\FormKeluhan;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

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
          $fotos = [];

        // ✅ SIMPAN FOTO
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {

                $path = $file->store('form_keluhan', 'public');

                FotoFormKeluhan::create([
                    'form_keluhan_id' => $keluhan->id, // 🔥 ini harus ada di tabel form_keluhan
                    'foto' => $path
                ]);

                 $fotos[] = $path; // masuk array
            }
        }

        // =========================
        // 4. 🔥 KIRIM KE ENGINEERING
        // =========================
        Complaint::create([
            'user_id'        => Auth::id() ?? 1,
            'lokasi'         => $request->lokasi,
            'jenis_masalah'  => $request->jenis_keluhan,
            'deskripsi'      => $request->kategori, // sementara pakai kategori
            'prioritas'      => 'rendah',
            'status'         => 'pending',
            'foto'           => $fotos, // 🔥 FIX ERROR ARRAY
        ]);

        return redirect()->route('dept.homee')
    ->with('success', 'Keluhan berhasil ditambahkan');
        // return back()->with('success', 'Keluhan berhasil dikirim');
    }
}
