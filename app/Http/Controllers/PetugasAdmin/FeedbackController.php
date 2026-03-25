<?php

namespace App\Http\Controllers\PetugasAdmin;

use App\Http\Controllers\Controller; // ✅ WAJIB
use Illuminate\Http\Request;
use App\Models\FeedbackAdmin;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = FeedbackAdmin::query();

        // FILTER TANGGAL
        if ($request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // FILTER PETUGAS
        if ($request->petugas) {
            $query->where('petugas', $request->petugas);
        }

        // FILTER RATING
        if ($request->rating) {
            $query->where('rating', $request->rating);
        }

        // PAGINATION (5 data per halaman)
        $feedbacks = $query->latest()->paginate(5);

        return view('petugas-admin.feedback', compact('feedbacks'));
    }
}
