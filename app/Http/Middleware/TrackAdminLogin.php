<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TrackAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): mixed
    {
        if (Auth::guard('admin')->check()) {
            $adminId = Auth::guard('admin')->id();
            Cache::put("admin_logged_in_$adminId", true, now()->addMinutes(30));
        }
        return $next($request);
    }
}
