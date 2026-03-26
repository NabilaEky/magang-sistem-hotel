<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluhanCust;

class KeluhanCustController extends Controller
{

    // menampilkan halaman form keluhan
    public function form()
    {
        return view('customer.form');
    }

    // menyimpan data keluhan ke database
    public function store(Request $request)
    {
        // kudu diumpakno
        // KeluhanCust::create([
        //     'user_id' => //auth()->id(),
        //     'judul' => $request->judul,
        //     'kategori' => $request->kategori,
        //     'deskripsi' => $request->deskripsi,
        //     'status' => 'Menunggu'
        // ]);

        return redirect()->route('customer.history')
            ->with('success', 'Keluhan berhasil dikirim');
    }

    //riwayat
    public function history()
    {
        $keluhan = KeluhanCust::latest()->paginate(5)->withQueryString();

        return view('customer.history', compact('keluhan'));
    }

    //delete
    public function delete($id)
    {
        $keluhan = KeluhanCust::findOrFail($id);

        $keluhan->delete();

        return redirect()->route('customer.history')
            ->with('success', 'Keluhan berhasil dihapus');
    }
}
