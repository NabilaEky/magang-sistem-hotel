<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keluhan;
use App\Models\User;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $query = Keluhan::with('petugas')
            ->where('status', 'selesai');

        // =========================
        // FILTER TANGGAL SELESAI
        // =========================

        if ($request->tanggal_dari && $request->tanggal_sampai) {
            $query->whereBetween('waktu_selesai', [
                $request->tanggal_dari . ' 00:00:00',
                $request->tanggal_sampai . ' 23:59:59'
            ]);
        } elseif ($request->tanggal_dari) {
            $query->whereDate('waktu_selesai', '>=', $request->tanggal_dari);
        } elseif ($request->tanggal_sampai) {
            $query->whereDate('waktu_selesai', '<=', $request->tanggal_sampai);
        }

        // =========================
        // FILTER PETUGAS
        // =========================

        if ($request->petugas) {
            $query->where('petugas_id', $request->petugas);
        }

        // =========================
        // FILTER JENIS MASALAH
        // =========================

        if ($request->jenis_masalah) {
            $query->where('jenis_masalah', $request->jenis_masalah);
        }

        // =========================
        // PAGINATION
        // =========================

        $perPage = $request->get('per_page', 10);

        $riwayat = $query
            ->latest('waktu_selesai')
            ->paginate($perPage)
            ->withQueryString();

        // =========================
        // DATA UNTUK DROPDOWN FILTER
        // =========================

        $petugasList = User::where('role', 'petugas')->get();

        $jenisMasalahList = Keluhan::where('status', 'selesai')
            ->select('jenis_masalah')
            ->distinct()
            ->pluck('jenis_masalah');

        return view('super-admin.riwayat.index', compact(
            'riwayat',
            'petugasList',
            'jenisMasalahList'
        ));
    }
}
