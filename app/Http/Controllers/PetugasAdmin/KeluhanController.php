<?php

namespace App\Http\Controllers\PetugasAdmin;

use App\Http\Controllers\Controller;
use App\Models\KeluhanAdmin;
use Illuminate\Http\Request;
use App\Exports\KeluhanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\RiwayatKeluhan;
use App\Models\Keluhan;
use App\Models\RiwayatDepartment;
use App\Models\FotoMasalah;
use App\Models\Pengerjaan;
use App\Models\FeedbackAdmin;

class KeluhanController extends Controller
{

    public function index(Request $request)
    {
        $query = KeluhanAdmin::query();

        if ($request->tanggal_awal) {
            $query->whereDate('created_at', '>=', $request->tanggal_awal);
        }

        if ($request->tanggal_akhir) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        if ($request->departemen) {
            $query->where('departemen', $request->departemen);
        }

        if ($request->petugas) {
            $query->where('petugas', $request->petugas);
        }

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }
        // ✅ TAMBAHAN INI
        $perPage = min($request->get('perPage', 10), 200);

        // ✅ UBAH PAGINATE
        $keluhans = $query->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('petugas-admin.keluhan', compact('keluhans'));
    }


    public function detail($id)
    {
        $keluhan = KeluhanAdmin::with([
            'fotoMasalah',
            'pengerjaan',
            'feedback'
        ])->findOrFail($id);

        return view('petugas-admin.detail-keluhan', compact('keluhan'));
    }


    public function edit($id)
    {
        $keluhan = KeluhanAdmin::findOrFail($id);

        return view('petugas-admin.edit-keluhan', compact('keluhan'));
    }



    public function cetak()
    {
        $keluhans = KeluhanAdmin::latest()->get();

        return view('petugas-admin.cetak', compact('keluhans'));
    }
    public function exportExcel()
    {
        return Excel::download(new KeluhanExport, 'data-keluhan.xlsx');
    }
    // jangan lupa import

    public function exportPDF()
    {
        $keluhans = KeluhanAdmin::all();

        $pdf = Pdf::loadView('petugas-admin.keluhan-pdf', compact('keluhans'))
            ->setPaper('a4', 'landscape'); // landscape supaya tabel muat

        return $pdf->download('daily-work.pdf');
    }

    public function update(Request $request, $id)
    {
        $keluhan = KeluhanAdmin::findOrFail($id);

        $request->validate([
            'status' => 'required',
            'petugas' => 'required',
            'prioritas' => 'required',
        ]);

        // simpan status lama
        $statusLama = $keluhan->status;

        // update data
        $keluhan->update([
            'status' => $request->status,
            'petugas' => $request->petugas,
            'prioritas' => $request->prioritas,
            'catatan_admin' => $request->catatan_admin, // 🔥 ini tambahan
        ]);

        // 🔥 JIKA SELESAI
        if ($statusLama != 'Selesai' && $request->status == 'Selesai') {

            // =========================
            // ✅ RIWAYAT ADMIN
            // =========================
            RiwayatKeluhan::create([
                'waktu' => $keluhan->created_at,
                'jenis_masalah' => $keluhan->jenis_masalah,
                'lokasi' => $keluhan->lokasi,
                'petugas' => $request->petugas,
                'tanggal_selesai' => now(),
            ]);

            // =========================
            // 🔥 RIWAYAT DEPT (PAKSA MASUK + DEBUG)
            // =========================
            try {
                RiwayatDepartment::create([
                    'waktu' => now(),
                    'lokasi' => $keluhan->lokasi,
                    'jenis_masalah' => $keluhan->jenis_masalah,
                    'status' => 'Selesai',
                    'petugas' => $request->petugas,
                ]);

                // 🔥 DEBUG BERHASIL
                // dd('MASUK RIWAYAT DEPT');

            } catch (\Exception $e) {
                dd('ERROR RIWAYAT DEPT: ' . $e->getMessage());
            }
        }

        return redirect()->route('keluhan')->with('success', 'Data berhasil diupdate');
    }
}
