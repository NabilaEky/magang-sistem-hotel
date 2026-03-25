<?php

namespace App\Http\Controllers\PetugasAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MeRepair;
use App\Exports\MeExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class MeController extends Controller
{
    public function index(Request $request)
    {
        $query = MeRepair::query();

        // FILTER BULAN
        if ($request->month) {
            $date = \Carbon\Carbon::parse($request->month);

            $query->whereMonth('tgl', $date->month)
                ->whereYear('tgl', $date->year);
        }

        $data = $query->orderBy('tgl', 'desc')->get();

        return view('petugas-admin.me', compact('data'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new MeExport($request->month),
            'me-repair.xlsx'
        );
    }


    public function exportPDF(Request $request)
    {
        $query = MeRepair::query();

        if ($request->month) {
            $date = \Carbon\Carbon::parse($request->month);
            $query->whereMonth('tgl', $date->month)
                ->whereYear('tgl', $date->year);
        }

        $data = $query->orderBy('tgl', 'desc')->get();

        return Pdf::loadView('petugas-admin.me-pdf', [
            'data' => $data,
            'month' => $request->month // ✅ INI PENTING
        ])->download('me.pdf');
    }
}
