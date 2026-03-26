<?php

namespace App\Helpers;

use App\Models\AuditLog;

class AuditHelper
{
    public static function log($action, $activity = null)
    {
        $user = auth()->user();

        AuditLog::create([
            'user_id'    => $user?->id,
            'username'   => $user?->username,
            'name'       => $user?->name,
            'role'       => $user?->role,
            'action'     => $action,
            'activity'   => $activity,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}