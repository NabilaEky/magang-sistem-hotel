<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\LaporanEng;
use Illuminate\Http\Request;

class LaporanEngController extends Controller
{
    public function index(Request $request)
    {
        $query = LaporanEng::query();

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('jenis', 'like', '%' . $request->search . '%')
                    ->orWhere('realisasi', 'like', '%' . $request->search . '%')
                    ->orWhere('shift', 'like', '%' . $request->search . '%');
            });
        }

        // 🎯 FILTER
        if ($request->realisasi) {
            $query->where('realisasi', $request->realisasi);
        }

        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->shift) {
            $query->where('shift', $request->shift);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        // 📄 PAGINATION LIMIT
        $perPage = $request->perPage ?? 10;

        $laporan = $query->latest()
            ->paginate($request->per_page ?? 10)
            ->withQueryString();

        return view('petugas-eng.laporan-engineering', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = LaporanEng::findOrFail($id);
        return view('petugas-eng.detail-laporan', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = LaporanEng::findOrFail($id);
        return view('petugas-eng.edit-laporan', compact('laporan'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'realisasi' => 'required',
            'jenis' => 'required',
            'shift' => 'required',
            'items' => 'required|array',
            'items.*' => 'nullable|string',
            'before.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5550',
            'progress.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5550',
            'after.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5550',
        ]);

        $items = [];

        foreach ($request->items as $index => $nama) {

            if (!$nama) continue;

            $before = null;
            $progress = null;
            $after = null;

            if ($request->hasFile('before') && isset($request->before[$index])) {
                $before = $request->before[$index]->store('laporan', 'public');
            }

            if ($request->hasFile('progress') && isset($request->progress[$index])) {
                $progress = $request->progress[$index]->store('laporan', 'public');
            }

            if ($request->hasFile('after') && isset($request->after[$index])) {
                $after = $request->after[$index]->store('laporan', 'public');
            }

            $items[] = [
                'nama' => $nama,
                'before' => $before,
                'progress' => $progress,
                'after' => $after,
            ];
        }

        // 🔥 AUTO JAM
        $jamMulai = null;
        $jamSelesai = null;

        foreach ($items as $item) {
            if (!$jamMulai && !empty($item['before'])) {
                $jamMulai = now();
            }

            if (!empty($item['after'])) {
                $jamSelesai = now();
            }
        }

        LaporanEng::create([
            'realisasi' => $request->realisasi,
            'jenis' => $request->jenis,
            'shift' => $request->shift,
            'status' => 'draft',
            'items' => $items,
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
        ]);

        return redirect()->route('petugas.laporan')
            ->with('success', 'Laporan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'realisasi' => 'required',
            'jenis' => 'required',
            'shift' => 'required',
            'status' => 'required',
            'items' => 'nullable|array',
            'items.*' => 'nullable|string',
            'before.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5550',
            'progress.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5550',
            'after.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5550',
        ]);

        $laporan = LaporanEng::findOrFail($id);

        $items = [];

        foreach ($request->items ?? [] as $index => $nama) {
            if (!$nama) continue;

            $before = $laporan->items[$index]['before'] ?? null;
            $progress = $laporan->items[$index]['progress'] ?? null;
            $after = $laporan->items[$index]['after'] ?? null;

            if ($request->hasFile('before') && isset($request->before[$index])) {
                $before = $request->before[$index]->store('laporan', 'public');
            }

            if ($request->hasFile('progress') && isset($request->progress[$index])) {
                $progress = $request->progress[$index]->store('laporan', 'public');
            }

            if ($request->hasFile('after') && isset($request->after[$index])) {
                $after = $request->after[$index]->store('laporan', 'public');
            }

            $items[] = [
                'nama' => $nama,
                'before' => $before,
                'progress' => $progress,
                'after' => $after,
            ];
        }

        // 🔥 AUTO JAM
        $jamMulai = $laporan->jam_mulai;
        $jamSelesai = $laporan->jam_selesai;

        foreach ($items as $item) {
            if (!$jamMulai && !empty($item['before'])) {
                $jamMulai = now();
            }

            if (!empty($item['after'])) {
                $jamSelesai = now();
            }
        }

        $laporan->update([
            'realisasi' => $request->realisasi,
            'jenis' => $request->jenis,
            'shift' => $request->shift,
            'status' => $request->status,
            'items' => $items,
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
        ]);

        return redirect()->route('petugas.laporan')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $laporan = LaporanEng::findOrFail($id);
        $laporan->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function create()
    {
        return view('petugas-eng.tambah-laporan');
    }
}
