<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        // ==============================
        // Helper Function Growth
        // ==============================
        $hitungGrowth = function ($queryBulanIni, $queryBulanLalu) {
            $bulanIni = $queryBulanIni->count();
            $bulanLalu = $queryBulanLalu->count();

            if ($bulanLalu == 0) {
                return 0;
            }

            return round((($bulanIni - $bulanLalu) / $bulanLalu) * 100);
        };

        // ==============================
        // TOTAL KELUHAN
        // ==============================
        $totalKeluhan = Keluhan::count();
        $keluhanBaru = Keluhan::where('status', 'menunggu')->count();
        $dalamProses = Keluhan::where('status', 'diproses')->count();
        $selesai = Keluhan::where('status', 'selesai')->count();

        // ==============================
        // Growth
        // ==============================
        $growthTotal = $hitungGrowth(
            Keluhan::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year),
            Keluhan::whereMonth('created_at', $lastMonth->month)->whereYear('created_at', $lastMonth->year)
        );

        $growthBaru = $hitungGrowth(
            Keluhan::where('status', 'menunggu')->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year),
            Keluhan::where('status', 'menunggu')->whereMonth('created_at', $lastMonth->month)->whereYear('created_at', $lastMonth->year)
        );

        $growthDiproses = $hitungGrowth(
            Keluhan::where('status', 'diproses')->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year),
            Keluhan::where('status', 'diproses')->whereMonth('created_at', $lastMonth->month)->whereYear('created_at', $lastMonth->year)
        );

        $growthSelesai = $hitungGrowth(
            Keluhan::where('status', 'selesai')->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year),
            Keluhan::where('status', 'selesai')->whereMonth('created_at', $lastMonth->month)->whereYear('created_at', $lastMonth->year)
        );

        // ==============================
        // 5 Keluhan Terbaru
        // ==============================
        $keluhanTerbaru = Keluhan::with(['user', 'petugas'])->latest()->take(5)->get();

        // ==============================
        // Distribusi Status
        // ==============================
        $statusDistribusi = Keluhan::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        // ==============================
        // Performa Petugas (total selesai)
        // ==============================
        $performaPetugas = User::role('petugas') // pake spatie/permission
            ->withCount([
                'keluhanDitangani as total_selesai' => function ($query) {
                    $query->where('status', 'selesai'); // hanya keluhan yang selesai
                }
            ])
            ->orderByDesc('total_selesai')
            ->take(5)
            ->get();

        return view('super-admin.dashboard', compact(
            'totalKeluhan',
            'keluhanBaru',
            'dalamProses',
            'selesai',
            'keluhanTerbaru',
            'statusDistribusi',
            'performaPetugas',
            'growthTotal',
            'growthBaru',
            'growthDiproses',
            'growthSelesai'
        ));
    }
}
