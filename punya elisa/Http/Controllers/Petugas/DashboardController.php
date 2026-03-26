<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $keluhanAktif = Complaint::where('status','pending')->count();

        $taskHariIni = Complaint::whereDate('created_at', today())->count();

        $selesai = Complaint::where('status','selesai')->count();

        $keluhan = Complaint::where('status','pending')
                    ->latest()
                    ->take(5)
                    ->get();

        return view('petugas-eng.dashboard', compact(
            'keluhanAktif',
            'taskHariIni',
            'selesai',
            'keluhan'
        ));
    }
}
