<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        $maintenance = DB::table('system_settings')
            ->where('key', 'maintenance_mode')
            ->value('value');

        // Jika maintenance AKTIF
        if ($maintenance) {

            // Super admin tetap boleh masuk
            if (Auth::check() && Auth::user()->hasRole('super_admin')) {
                return $next($request);
            }

            // User lain diblok
            return response()->view('maintenance');
        }

        return $next($request);
    }
}