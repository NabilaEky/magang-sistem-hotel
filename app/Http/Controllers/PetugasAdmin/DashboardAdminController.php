<?php

namespace App\Http\Controllers\PetugasAdmin;

use App\Http\Controllers\Controller;
use App\Models\KeluhanAdmin;
use App\Models\PetugasAdmin;

class DashboardAdminController extends Controller
{
    public function index()
    {

        $totalKeluhan = KeluhanAdmin::count();

        $keluhanBaru = KeluhanAdmin::where('status','pending')->count();

        $dalamProses = KeluhanAdmin::where('status','diproses')->count();

        $selesai = KeluhanAdmin::where('status','selesai')->count();

        $keluhanTerbaru = KeluhanAdmin::latest()->take(5)->get();

        $petugas = PetugasAdmin::all();

        return view('petugas-admin.dashboard', compact(
            'totalKeluhan',
            'keluhanBaru',
            'dalamProses',
            'selesai',
            'keluhanTerbaru',
            'petugas'
        ));
    }
}