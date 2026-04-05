<?php

namespace App\Http\Controllers\PetugasAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatKeluhan;
use App\Models\RiwayatDepartment;

class RiwayatController extends Controller
{

    public function riwayat(Request $request)
    {
        $query = RiwayatKeluhan::query();

        // FILTER TANGGAL
        if ($request->tanggal) {
            $query->whereDate('waktu', $request->tanggal);
        }

        // FILTER PETUGAS
        if ($request->petugas) {
            $query->where('petugas', $request->petugas);
        }

        $riwayat = $query->latest()->paginate(5)->withQueryString();

        return view('petugas-admin.riwayat', compact('riwayat'));
    }

    public function detail($id)
    {
        $riwayat = RiwayatKeluhan::findOrFail($id);

        return view('petugas-admin.detail-riwayat', compact('riwayat'));
    }

    public function destroy($id)
    {
        $riwayat = RiwayatKeluhan::findOrFail($id);
        $riwayat->delete();

        return redirect()->route('admin.riwayat')->with('success', 'Riwayat berhasil dihapus ✅');
    }

    public function index()
    {
        $data = RiwayatDepartment::latest()->get();

        return view('department.index', compact('data'));
    }
}
