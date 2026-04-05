<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluhanCust;

class HistoryController extends Controller
{
    public function history(Request $request)
    {
        
        // ambil semua data
        $query = KeluhanCust::query();

        // 🔍 SEARCH (jenis_keluhan, kategori, deskripsi)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('jenis_keluhan', 'like', "%$search%")
                  ->orWhere('kategori', 'like', "%$search%")
                  ->orWhere('deskripsi', 'like', "%$search%");
            });
        }

        // 📅 FILTER TANGGAL
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // 🔢 PER PAGE (default 10)
        $perPage = $request->per_page ?? 10;

        // ambil data + urut terbaru
        $keluhan = $query
            ->latest()
            ->paginate($perPage)
            ->withQueryString(); // 🔥 biar search & filter ga hilang saat pindah page

        return view('customer.history', compact('keluhan'));
    }
}