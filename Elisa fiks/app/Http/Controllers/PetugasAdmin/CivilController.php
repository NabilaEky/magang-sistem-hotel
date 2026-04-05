<?php

namespace App\Http\Controllers\PetugasAdmin;

use App\Http\Controllers\Controller;
use App\Models\CivilRepair;
use App\Exports\CivilExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CivilController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month;

        $query = CivilRepair::query();

        if ($month) {
            $date = \Carbon\Carbon::parse($month);

            $query->whereMonth('tgl', $date->month)
                ->whereYear('tgl', $date->year);
        }

        $data = $query->orderBy('tgl', 'desc')->get();

        return view('petugas-admin.civil', compact('data'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new CivilExport($request->month),
            'Civil_Report.xlsx'
        );
    }

    public function exportPDF(Request $request)
    {
        $query = CivilRepair::query();

        if ($request->month) {
            $date = \Carbon\Carbon::parse($request->month);
            $query->whereMonth('tgl', $date->month)
                ->whereYear('tgl', $date->year);
        }

        $data = $query->orderBy('tgl', 'desc')->get();

        return Pdf::loadView('petugas-admin.civil-pdf', [
            'data' => $data,
            'month' => $request->month // ✅ INI PENTING
        ])->download('civil.pdf');
    }
}
