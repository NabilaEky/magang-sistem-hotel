<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\AuditHelper;

class KeluhanController extends Controller
{
    public function index(Request $request)
    {
        $query = Keluhan::with(['petugas']);
        $filterKeterangan = [];

        // =========================
        // FILTER TANGGAL
        // =========================

        if ($request->tanggal_dari && $request->tanggal_sampai) {
            $query->whereBetween('created_at', [
                $request->tanggal_dari . ' 00:00:00',
                $request->tanggal_sampai . ' 23:59:59'
            ]);

            $filterKeterangan[] = "Tanggal: {$request->tanggal_dari} s/d {$request->tanggal_sampai}";
        } elseif ($request->tanggal_dari) {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
            $filterKeterangan[] = "Mulai: {$request->tanggal_dari}";
        } elseif ($request->tanggal_sampai) {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
            $filterKeterangan[] = "Sampai: {$request->tanggal_sampai}";
        }

        // =========================
        // FILTER PETUGAS
        // =========================

        if ($request->petugas) {
            $query->where('petugas_id', $request->petugas);

            $namaPetugas = User::find($request->petugas)?->name;
            $filterKeterangan[] = "Petugas: {$namaPetugas}";
        }

        // =========================
        // FILTER PRIORITAS
        // =========================

        if ($request->prioritas) {
            $query->where('prioritas', $request->prioritas);
            $filterKeterangan[] = "Prioritas: {$request->prioritas}";
        }

        // =========================
        // FILTER JENIS MASALAH
        // =========================

        if ($request->jenis_masalah) {
            $query->where('jenis_masalah', $request->jenis_masalah);
            $filterKeterangan[] = "Jenis: {$request->jenis_masalah}";
        }

        // =========================
        // FILTER STATUS
        // =========================

        if ($request->status) {
            $query->where('status', $request->status);
            $filterKeterangan[] = "Status: {$request->status}";
        }

        // =========================
        // PAGINATION
        // =========================

        $perPage = $request->get('per_page', 10);

        $keluhan = $query
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        // =========================
        // DATA DROPDOWN
        // =========================

        $petugasList = User::where('role', 'petugas')->get();
        $prioritasList = Keluhan::select('prioritas')->distinct()->pluck('prioritas');
        $jenisMasalahList = Keluhan::select('jenis_masalah')->distinct()->pluck('jenis_masalah');
        $statusList = Keluhan::select('status')->distinct()->pluck('status');

        $filterKeterangan = count($filterKeterangan)
            ? implode(' | ', $filterKeterangan)
            : 'Menampilkan semua data keluhan';

        return view('super-admin.daftar-keluhan.index', compact(
            'keluhan',
            'petugasList',
            'prioritasList',
            'jenisMasalahList',
            'statusList',
            'filterKeterangan'
        ));
    }

    public function show($id)
    {
        $keluhan = Keluhan::with(['petugas'])->findOrFail($id);

        return view('super-admin.daftar-keluhan.detail', compact('keluhan'));
    }

    public function edit($id)
    {
        $keluhan = Keluhan::findOrFail($id);
        $petugas = User::where('role', 'petugas')->get();

        return view('super-admin.daftar-keluhan.edit', compact('keluhan', 'petugas'));
    }

    public function update(Request $request, $id)
    {
        $keluhan = Keluhan::findOrFail($id);

        $keluhan->update([
            'catatan_admin' => $request->catatan_admin,
            'petugas_id'    => $request->petugas_id,
            'status'        => $request->status,
            'prioritas'     => $request->prioritas,
        ]);

        return redirect()->route('daftar-keluhan.index')
            ->with('success', 'Keluhan berhasil diupdate');
    }

    public function destroy($id)
    {
        Keluhan::findOrFail($id)->delete();

        return redirect()->route('daftar-keluhan.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
