<?php

namespace App\Http\Controllers\Dept;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatDepartment;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $query = RiwayatDepartment::query();

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('lokasi', 'like', '%' . $request->search . '%')
                    ->orWhere('jenis_masalah', 'like', '%' . $request->search . '%');
            });
        }

        // 📅 TANGGAL
        if ($request->tanggal) {
            $query->whereDate('waktu', $request->tanggal);
        }

        // 📊 STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // 🔥 PAGINATION DINAMIS
        $perPage = $request->per_page ?? 5;

        $data = $query->latest()->paginate($perPage)->withQueryString();

        return view('department.index', compact('data'));
    }

    public function detail($id)
    {
        $data = RiwayatDepartment::findOrFail($id);

        return view('department.detail', compact('data'));
    }
}
