<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\KeluhanCust;
use Illuminate\Http\Request;

class KeluhanController extends Controller
{

    public function index(Request $request)
    {
        $query = Complaint::query();
//$query = KeluhanCust::query();

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('jenis_masalah', 'like', '%' . $request->search . '%')
                    ->orWhere('lokasi', 'like', '%' . $request->search . '%');
            });
        }
        // FILTER PRIORITAS
        if ($request->prioritas) {
            $query->where('prioritas', $request->prioritas);
        }
        // 🔥 PISAHKAN DATA
        $belum = (clone $query)
            ->where('status', 'pending')
            ->latest()
            ->get();

        $dikerjakan = (clone $query)
            ->where('status', 'diproses')
            ->latest()
            ->get();

        return view('petugas-eng.daftar-keluhan', compact('belum', 'dikerjakan'));
    }

    public function kerjakan($id)
    {
        $keluhan = Complaint::findOrFail($id);
// $keluhan = KeluhanCust::findOrFail($id);
        $keluhan->status = 'diproses';
        $keluhan->save();

        return redirect()->back()->with('success', 'Keluhan sedang dikerjakan');
    }

    public function selesai(Request $request, $id)
{
    $keluhan = Complaint::findOrFail($id);

    if ($request->hasFile('foto_selesai')) {

        $files = [];

        foreach ($request->file('foto_selesai') as $file) {
            $files[] = $file->store('complaints/selesai', 'public');
        }

        $keluhan->foto_selesai = json_encode($files);
    }

    $keluhan->catatan = $request->catatan ?? null;
    $keluhan->status = 'selesai'; // paksa langsung selesai
    $keluhan->save();

    return redirect()->route('petugas.daftar-keluhan')
        ->with('success', 'Keluhan berhasil diselesaikan');
}
//     public function selesai(Request $request, $id)
//     {
//         $keluhan = Complaint::findOrFail($id);
// // $keluhan = KeluhanCust::findOrFail($id);
//         if ($request->hasFile('foto')) {
//             $paths = [];
//             foreach ($request->file('foto') as $file) {
//                 $paths[] = $file->store('bukti', 'public');
//             }
//             $keluhan->bukti_foto = json_encode($paths);
//         }

//         $keluhan->catatan = $request->catatan ?? null;
//         $keluhan->status = $request->status;
//         $keluhan->save();

//         return redirect()->route('petugas.daftar-keluhan')
//             ->with('success', 'Keluhan berhasil diselesaikan');
//     }

    public function formSelesai($id)
    {
        $keluhan = Complaint::findOrFail($id);
        return view('petugas-eng.selesai-keluhan', compact('keluhan'));
    }

    public function show($id)
    {
        $keluhan = Complaint::findOrFail($id);
//$keluhan = KeluhanCust::findOrFail($id);
        return view('petugas-eng.detail-keluhan', compact('keluhan'));
    }

    public function update(Request $request, $id)
    {
        $keluhan = Complaint::findOrFail($id);

        $keluhan->status = $request->status;
        $keluhan->catatan = $request->catatan;

        $keluhan->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }
}
