<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\KeluhanCust;
use App\Models\KeluhanAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeluhanController extends Controller
{

    public function index(Request $request)
    {
        $query = Complaint::query();

        // SEARCH
        // ================= BELUM DIKERJAKAN =================
        $perPageBelum = $request->per_page_belum ?? 5;
        $perPageDikerjakan = $request->per_page_dikerjakan ?? 5;
        $belum = Complaint::where('status', 'pending');

        if ($request->search_belum) {
            $belum->where(function ($q) use ($request) {
                $q->where('jenis_masalah', 'like', '%' . $request->search_belum . '%')
                    ->orWhere('lokasi', 'like', '%' . $request->search_belum . '%');
            });
        }

        if ($request->prioritas_belum) {
            $belum->where('prioritas', $request->prioritas_belum);
        }

        if ($request->status_belum) {
            $belum->where('status', $request->status_belum);
        }

        $belum = $belum->latest()
            ->paginate($perPageBelum, ['*'], 'page_belum')
            ->withQueryString();


        // ================= DIKERJAKAN =================

        $dikerjakan = Complaint::where('status', 'diproses');

        if ($request->search_dikerjakan) {
            $dikerjakan->where(function ($q) use ($request) {
                $q->where('jenis_masalah', 'like', '%' . $request->search_dikerjakan . '%')
                    ->orWhere('lokasi', 'like', '%' . $request->search_dikerjakan . '%');
            });
        }

        if ($request->prioritas_dikerjakan) {
            $dikerjakan->where('prioritas', $request->prioritas_dikerjakan);
        }

        if ($request->status_dikerjakan) {
            $dikerjakan->where('status', $request->status_dikerjakan);
        }

        $dikerjakan = $dikerjakan->latest()
            ->paginate($perPageDikerjakan, ['*'], 'page_dikerjakan')
            ->withQueryString();


        return view('petugas-eng.daftar-keluhan', compact('belum', 'dikerjakan'));
    }

    public function kerjakan($id)
    {

        $keluhan = Complaint::findOrFail($id);

        $keluhan->status = 'diproses';
        $keluhan->user_id = Auth::id();
        $keluhan->save();

        // 🔥 TAMBAHAN (SYNC KE CUST)
        KeluhanCust::where('deskripsi', $keluhan->deskripsi)
            ->where('user_id', $keluhan->user_id)
            ->update([
                'status' => 'Diproses'
            ]);
        // 🔥 TAMBAHAN (SYNC KE admin
        KeluhanAdmin::where('complaint_id', $keluhan->id)
            ->update([
                'status' => 'Diproses',
                'petugas' => Auth::user()->name ?? 'Petugas ENG'
            ]);

        return redirect()->route('petugas.daftar-keluhan')->with('success', 'Keluhan sedang dikerjakan');
    }

    public function selesai(Request $request, $id)
    {
        $keluhan = Complaint::findOrFail($id);
        $keluhan->user_id = Auth::id();

        $files = [];

        // 🔥 LANGSUNG PROSES TANPA hasFile
        if ($request->file('foto_selesai')) {
            foreach ($request->file('foto_selesai') as $file) {
                $files[] = $file->store('complaints/selesai', 'public');
            }
        }
        // 🔥 SIMPAN (PASTIKAN INI ADA)
        if (!empty($files)) {
            $keluhan->foto_selesai = $files;
        }

        $keluhan->catatan = $request->catatan ?? null;
        $keluhan->status = 'selesai';

        $keluhan->save();

        // 🔥 TAMBAHAN (SYNC KE CUST)
        KeluhanCust::where('deskripsi', $keluhan->deskripsi)
            ->where('user_id', $keluhan->user_id)
            ->update([
                'status' => 'Selesai'
            ]);

        // 🔥 KIRIM KE ADMIN
    
        KeluhanAdmin::where('complaint_id', $keluhan->id)
            ->update([
                'status' => 'Selesai']);

        return redirect()->route('petugas.daftar-keluhan')
            ->with('success', 'Keluhan berhasil diselesaikan');
    }


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
