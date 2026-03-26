<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AuditHelper;

class SystemSettingController extends Controller
{
    public function index()
    {
        return view('super-admin.system-setting.index', [
            'maintenanceMode' => DB::table('system_settings')
                ->where('key', 'maintenance_mode')
                ->value('value'),

            'slaDays' => DB::table('system_settings')
                ->where('key', 'sla_days')
                ->value('value'),
        ]);
    }

    public function store(Request $request)
    {
        DB::table('system_settings')
            ->where('key', 'maintenance_mode')
            ->update([
                'value' => $request->has('maintenance_mode') ? 1 : 0
            ]);

        DB::table('system_settings')
            ->where('key', 'sla_days')
            ->update([
                'value' => $request->sla_days
            ]);

        return redirect()
            ->back()
            ->with('success', 'System setting berhasil disimpan');
    }
}