<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$roles): Response
    {
        if (!Session::has('id')) {
            return redirect()->route('login');
        } elseif(!in_array(Session::get('role_kerja'), $roles)) {
            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini!');
        }

        return $next($request);
    }
}
