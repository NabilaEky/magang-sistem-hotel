<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::query();

        // Filter Tanggal
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Filter Action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // jumlah data per halaman
        $perPage = $request->get('per_page', 10);

        $logs = $query->with('user')
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('super-admin.audit-log.index', compact('logs'));
    }
}