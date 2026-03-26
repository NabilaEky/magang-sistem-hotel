<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keluhan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Keluhan::query();

        // Filter kategori
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // Filter lokasi
        if ($request->lokasi) {
            $query->where('lokasi', $request->lokasi);
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter tanggal
        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        // PAGINATION
        $keluhans = $query->latest()->paginate(10)->withQueryString();

        // Summary
        $summary = [
            'total' => Keluhan::count(),
            'selesai' => Keluhan::where('status', 'selesai')->count(),
            'proses' => Keluhan::where('status', 'proses')->count(),
            'pending' => Keluhan::where('status', 'pending')->count(),
        ];

        return view('super-admin.laporan.index', compact('keluhans', 'summary'));
    }
}