<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluhanCust;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        // ✅ DEBUG (aktifin kalau mau cek)
        //dd($request->all(), $request->file('foto'));

        // ✅ SIMPAN DATA
        $keluhan = new KeluhanCust();
        $keluhan->user_id = Auth::id() ?? 1; // fallback kalau belum login
        $keluhan->jenis_keluhan = $request->jenis_keluhan;
        $keluhan->kategori = $request->kategori;
        $keluhan->deskripsi = $request->pemeriksaan;
        $keluhan->status = 'Menunggu';

        $fotos = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                // $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                // $path = $file->storeAs('keluhan', $filename, 'public');
                // $fotos[] = $path;
                $path = $file->store('keluhan', 'public');
                $fotos[] = $path;
            }
        }

        $keluhan->foto = $fotos; // 🔥 WAJIB ARRAY

        $keluhan->save();

        return redirect()->route('customer.homee')
            ->with('success', 'Keluhan berhasil ditambahkan');
    }
}
