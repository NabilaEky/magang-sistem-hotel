<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\Kategori;
use App\Models\Departement;
use App\Models\Jabatan;
use App\Helpers\AuditHelper;
use Illuminate\Pagination\LengthAwarePaginator;

class MasterDataController extends Controller
{
    public function index(Request $request)
    {
        $data = collect()
            ->merge(Lokasi::withoutGlobalScopes()->get()->map(fn($item) => [
                'id' => $item->id,
                'kode' => $item->kode,
                'nama' => $item->nama,
                'tipe' => 'Lokasi',
                'tipe_slug' => 'lokasi',
                'status' => $item->status,
            ]))
            ->merge(Kategori::withoutGlobalScopes()->get()->map(fn($item) => [
                'id' => $item->id,
                'kode' => $item->kode,
                'nama' => $item->nama,
                'tipe' => 'Kategori',
                'tipe_slug' => 'kategori',
                'status' => $item->status,
            ]))
            ->merge(Departement::withoutGlobalScopes()->get()->map(fn($item) => [
                'id' => $item->id,
                'kode' => $item->kode,
                'nama' => $item->nama,
                'tipe' => 'Departement',
                'tipe_slug' => 'departement',
                'status' => $item->status,
            ]))
            ->merge(Jabatan::withoutGlobalScopes()->get()->map(fn($item) => [
                'id' => $item->id,
                'kode' => $item->kode,
                'nama' => $item->nama,
                'tipe' => 'Jabatan',
                'tipe_slug' => 'jabatan',
                'status' => $item->status,
            ]));

        // =========================
        // FILTER
        // =========================

        if ($request->filled('status')) {
            $data = $data->where('status', $request->status);
        }

        if ($request->filled('tipe')) {
            $data = $data->where('tipe', $request->tipe);
        }

        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $data = $data->filter(
                fn($item) =>
                str_contains(strtolower($item['nama']), $search) ||
                    str_contains(strtolower($item['kode']), $search)
            );
        }

        // dropdown options
        $statusOptions = $data->pluck('status')->unique()->values();
        $tipeOptions   = $data->pluck('tipe')->unique()->values();

        // =========================
        // PAGINATION
        // =========================

        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);

        $data = new LengthAwarePaginator(
            $data->forPage($page, $perPage),
            $data->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query()
            ]
        );

        return view('super-admin.master-data.index', compact(
            'data',
            'statusOptions',
            'tipeOptions'
        ));
    }

    public function edit($tipe, $id)
    {
        $data = match ($tipe) {
            'lokasi'      => Lokasi::withoutGlobalScopes()->findOrFail($id),
            'kategori'    => Kategori::withoutGlobalScopes()->findOrFail($id),
            'departement' => Departement::withoutGlobalScopes()->findOrFail($id),
            'jabatan'     => Jabatan::withoutGlobalScopes()->findOrFail($id),
            default       => abort(404),
        };

        return view('super-admin.master-data.edit', compact('data', 'tipe'));
    }

    public function update(Request $request, $tipe, $id)
    {
        $model = match ($tipe) {
            'lokasi'      => Lokasi::class,
            'kategori'    => Kategori::class,
            'departement' => Departement::class,
            'jabatan'     => Jabatan::class,
            default       => abort(404),
        };

        $data = $model::findOrFail($id);

        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'kode'      => 'required|string|max:50|unique:' . $data->getTable() . ',kode,' . $id,
            'status'    => 'required|in:aktif,non_aktif',
            'deskripsi' => 'nullable|string',
        ]);

        $data->update($validated);

        return redirect()
            ->route('superadmin.master-data.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($tipe, $id)
    {
        match ($tipe) {
            'lokasi'      => Lokasi::findOrFail($id)->delete(),
            'kategori'    => Kategori::findOrFail($id)->delete(),
            'departement' => Departement::findOrFail($id)->delete(),
            'jabatan'     => Jabatan::findOrFail($id)->delete(),
            default       => abort(404),
        };

        return redirect()
            ->route('superadmin.master-data.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50',
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,non_aktif',
        ]);

        Kategori::create($validated);

        return redirect()
            ->route('superadmin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }
}
