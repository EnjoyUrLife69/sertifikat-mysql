<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleById
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $roleId
     * @return mixed
     */
    public function handle($request, Closure $next, $roleId)
    {
        // Pastikan user sudah login
        if (Auth::check()) {
            // Cek apakah role_id dari user yang login sesuai dengan roleId yang diinginkan
            if (Auth::user()->roles_id != $roleId) {
                // Jika role_id tidak sesuai, kembalikan dengan error 403 Forbidden
                return abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
