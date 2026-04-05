<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluhanCust;
use App\Models\Complaint;
use App\Models\KeluhanAdmin;
use Illuminate\Support\Facades\Auth;

class FormCustController extends Controller
{
    // 🔹 Tampilkan form
    public function create()
    {
        return view('customer.form');
    }

    // 🔹 Simpan data
    public function store(Request $request)
    {
        // ✅ VALIDASI
        $request->validate([
            'jenis_keluhan' => 'required|string|max:255',
            'kategori' => 'required|string',
            'pemeriksaan' => 'required|string',
            'foto' => 'nullable|array|max:3',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // =========================
        // 🔹 SIMPAN KE TABLE CUSTOMER
        // =========================
        $keluhan = new KeluhanCust();
        $keluhan->user_id = Auth::id() ?? 1;
        $keluhan->jenis_keluhan = $request->jenis_keluhan;
        $keluhan->kategori = $request->kategori;
        $keluhan->deskripsi = $request->pemeriksaan;
        $keluhan->status = 'Menunggu';

        // 🔹 Upload foto
        $fotos = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('keluhan', 'public');
                $fotos[] = $path;
            }
        }

        $keluhan->foto = $fotos;
        $keluhan->save();

        // =========================
        // 🔥 KIRIM KE PETUGAS ENG (TABLE COMPLAINT)
        // =========================
        $complaint = Complaint::create([
            'user_id' => $keluhan->user_id,
            'lokasi' => 'Customer',
            'jenis_masalah' => $keluhan->jenis_keluhan,
            'deskripsi' => $keluhan->deskripsi,
            'prioritas' => $request->pemeriksaan == 'Urgent' ? 'tinggi' : 'sedang',
            'status' => 'pending',
            'foto' => json_encode($fotos), // ✅ FIX
        ]);

        KeluhanAdmin::create([
    'Complaint_id' => $complaint->id, // 🔥 penting
    'waktu' => now(),
    'lokasi' => 'Customer',
    'jenis_masalah' => $request->jenis_keluhan,
    'kategori' => $request->kategori,
    'status' => 'Pending',
    'prioritas' => 'Rendah',
    'petugas' => '-',
    'sumber' => 'customer'
]);

        return redirect()->route('customer.homee')
            ->with('success', 'Keluhan berhasil dikirim ke petugas');
    }
}
