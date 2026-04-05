<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::query();

        // filter tanggal
        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }
        // filter lokasi
        if ($request->lokasi) {
            $query->where('lokasi', $request->lokasi);
        }

        $complaints = $query->latest()
            ->paginate($request->per_page ?? 10)
            ->withQueryString();
        return view('petugas-eng.riwayat', compact('complaints'));
    }
    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);

        return view('petugas-eng.detail-riwayat', compact('complaint'));
    }
}
